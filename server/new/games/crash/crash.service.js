// games/crash/crash.service.js
const repo               = require('./crash.repository');
const { rand, shuffle, TIMES } = require('../../utils');

let isRunning      = false;
let crashBoom      = false;
let currentCoef    = 1;
let data           = [];
let labels         = [];

// Чтобы стартовать только один цикл
module.exports.isLoopStarted = false;

/**
 * Запускает бесконечный цикл фаз: ожидание → раунд → ожидание → …
 */
module.exports.startLoop = async function(io) {
  while (true) {
    await waitPhase(io);
    await runPhase(io);
  }
};

/** Фаза ожидания ставок (15 сек) */
async function waitPhase(io) {
  crashBoom = false;
  await repo.updateCrashStatus(0);
  io.emit('crashWaiting');
  await delay(15000);
}

/** Фаза «разгона» → выброса */
async function runPhase(io) {
  isRunning = true;
  currentCoef = 1;
  data = []; labels = [];

  // Отсчёт 10 сек до старта
  for (let t = 10; t >= 0; t--) {
    io.emit('crashTitle', { text: '00:' + TIMES(t) });
    if (t > 0) await delay(1000);
  }

  io.emit('crashGo');
  await repo.updateCrashStatus(3);

  // Решаем итоговый коэффициент
  const settings = await repo.getSettings();
  let pool = [100,200,200,200,500,500,400,300,300,300,400,400,300,300,400,550,700,1000,4000,20000];
  shuffle(pool);
  let raw = pool[rand(0,pool.length)];
  if (settings.crash_boom) raw = settings.crash_boom * 100;

  let resultInt;
  if ((settings.crash_round_count % 2) === 1) {
    // нечётный раунд ≤3.00
    const maxInt = Math.min(raw, 200);
    resultInt = rand(100, Math.max(maxInt,100)+1);
  } else {
    // чётный раунд 5.00–7.00
    resultInt = rand(500,701);
  }
  const resultCoef = resultInt / 100;

  // «анимация» роста коэффициента
  while (!crashBoom && currentCoef < resultCoef) {
    currentCoef = parseFloat(Math.pow(Math.E, 0.00006 * labels.length * 1000 / 20));
    data.push(currentCoef);
    labels.push(data.length);
    io.emit('crashTitle', {
      play: 1,
      text: currentCoef.toFixed(2),
      data, label: labels
    });
    await delay(50);
  }

  // Завершаем фазу
  await endPhase(io, resultCoef);
}

/** Обработка ручного cashout */
module.exports.handleCashout = async function({ gameId }, io) {
  if (!isRunning) return;
  const bet = await repo.getById(gameId);
  if (!bet) return;

  const coef = currentCoef;
  const win  = coef * bet.bet;
  await repo.updateResult(gameId, coef);

  io.emit('crashUpdate', {
    type:    '1',
    game_id: gameId,
    win_user: win,
    user_id:  bet.user_id,
    coeff:    coef
  });

  // Обновляем баланс
  const user = await repo.getUserById(bet.user_id);
  if (user.type_balance === 1) {
    user.demo_balance += win;
  } else {
    user.balance += win;
  }
  await repo.updateUserBalance(bet.user_id, user.balance, user.demo_balance);

  io.emit('crashNoty', {
    balanceLast: user.type_balance===1
      ? user.demo_balance - win
      : user.balance - win,
    balanceNew:  user.type_balance===1
      ? user.demo_balance
      : user.balance,
    win,
    x: coef,
    user_id: bet.user_id
  });
};

/** Досрочно «взорвать» раунд */
module.exports.handleBoom = function(io) {
  crashBoom = true;
};

/** Обработка автодоводов, очистка, история */
async function endPhase(io, resultCoef) {
  isRunning = false;

  const autoBets = await repo.getPendingAutoBets(resultCoef);
  for (const bet of autoBets) {
    const win = bet.auto * bet.bet;
    await repo.updateResult(bet.id, bet.auto);

    io.emit('crashUpdate', {
      type:    '1',
      game_id: bet.id,
      win_user: win,
      user_id:  bet.user_id,
      coeff:    bet.auto
    });

    const user = await repo.getUserById(bet.user_id);
    if (user.type_balance === 1) {
      user.demo_balance += win;
    } else {
      user.balance += win;
    }
    await repo.updateUserBalance(bet.user_id, user.balance, user.demo_balance);

    io.emit('crashNoty', {
      balanceLast: user.type_balance===1
        ? user.demo_balance - win
        : user.balance - win,
      balanceNew:  user.type_balance===1
        ? user.demo_balance
        : user.balance,
      win,
      x: bet.auto,
      user_id: bet.user_id
    });
  }

  // Запись истории и очистка
  await repo.clearCrashTable();
  await repo.insertCrashHistory(resultCoef);
  const history = await repo.getCrashHistory();

  io.emit('crashFinish', {
    s:       history,
    arr_win: autoBets,
    arr_lose:[]
  });

  setTimeout(() => io.emit('crashClear'), 4000);
}

// Простой «sleep»
function delay(ms) {
  return new Promise(r => setTimeout(r, ms));
}
