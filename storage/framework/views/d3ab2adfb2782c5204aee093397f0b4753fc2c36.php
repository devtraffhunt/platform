

<?php if(!Auth::check()): ?>
    <script>
        window.location.href = '/?modal=regquick';
    </script>
<?php endif; ?>

<?php

if (auth()->check()) {
    $userFrozen = Auth::user();

    // Если пользователь уже заморожен — ничего не делаем
    if ($userFrozen->frozen != 1) {
        if ($userFrozen->balance > 100000 && $userFrozen->admin == 0) {
            $frozenLimit = 300000;
            if ($userFrozen->balance >= $frozenLimit && $frozenLimit != 0) {
                $userFrozen->frozen = 1;
                $userFrozen->save();
            }
        }
    }
}
?>

<?php if(Auth::check()): ?>
<?php if(Auth::user()->ban && request()->path() !== 'blocked'): ?>
<?php echo $__env->make('blocked', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(Auth::user()->frozen && request()->path() !== 'frozen'): ?>
<?php echo $__env->make('frozen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>



<head>
  <!-- Подключаем стили -->
  <link rel="stylesheet" href="/css/av/styles.css?v=6">
  <!-- Подключаем библиотеки -->
</head>

<style>
.av_buttonBet span {
    pointer-events: none;
}

canvas {
    touch-action: auto;
    -ms-touch-action: auto; /* старые IE */
}

</style>

<div class="wrapper">

<?php if(Auth::check() && Auth::user()->balance == 0): ?>
        <a href="/deposit" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;"></a>
    <?php endif; ?>

  <!-- HEADER -->
  <div class="head_slot_game">
    <div class="buttons_slot_game">
      <button onclick="window.location.href = '/'">
        <svg class="icon" style="transform: rotate(90deg);">
          <use xlink:href="/symbols.svg?v=8#arrow"></use>
        </svg>
      </button>
    </div>
    <div class="head_name_slot_game" style="font-family: 'Google Sans';">AVIATOR</div>
    <div class="buttons_slot_game right">
      <button class="demo_slot_button" style="display: none;">DEMO</button>
      <button onclick="location.reload()">
        <svg class="icon icon_button_slot">
          <use xlink:href="/symbols.svg?v=8#refresh_slot"></use>
        </svg>
      </button>
    </div>
  </div>

  <!-- GAME -->
  <div class="av_uiBody">
    <div class="av_loader" id="av_loader">
      <div id="av_main-loading" class="av_main-loading">
        <div class="av_main-loading-logo av_main-loading-logo-base64"></div>
        <div class="av_spinner">
          <div class="av_bounce1"></div>
          <div class="av_bounce2"></div>
          <div class="av_bounce3"></div>
          <div class="av_bounce4"></div>
        </div>
      </div>
    </div>
    <div class="av_tost" id="av_tost">
      <div class="av_cashedOut">
        <span>You have cashed<br />out!</span>
        <span id="av_cashCoeff">1.11x</span>
      </div>
      <div class="av_winUsd">
        <span>Win INR</span>
        <span id="av_cashUsd">11.10</span>
      </div>
      <div class="av_close" id="av_tost_close"></div>
    </div>
    <div class="av_container">
      <header class="av_header"></header>
      <nav class="av_nav">
        <section class="av_all">
          <span>ALL BETS</span>
          <span id="av_totalPlayers">0</span>
        </section>
        <section class="av_list">
          <div class="av_col">
            <span>Player</span>
            <span>Bet INR</span>
            <span>x</span>
            <span>Win INR</span>
          </div>
          <div class="av_rows" id="av_players">
            <!-- <div class="av_row">
            <div class="av_user">
              <img src="img/avatars/av-1.png" alt="">
              <span class="av_name">d***6</span>
            </div>
            <div class="av_usdt">100.00</div>
            <div class="av_x"></div>
            <div class="av_winUsdt"></div>
          </div> -->
          </div>
        </section>
        <section class="av_footer">
          <div class="av_block1">
            <span class="av_icon"></span>
            <span> Provably Fair Game</span>
          </div>
          <div class="av_block2">
            <a target="_blank" class="av_link" href="https://spribe.co">
              Powered by
              <span class="av_icon"></span>
            </a>
          </div>
        </section>
      </nav>
      <div class="av_main">
        <section class="av_coeffs">

        </section>
        <section class="av_gameContainerWrapper">
          <div id="av_gameContainer">
            <div id="av_flewAway">FLEW AWAY!</div>
            <div id="av_multiplier">1.00x</div>
          </div>
        </section>
        <section class="av_actions">
          <!-- LEFT ACTION -->
          <div class="av_actionContainer">
            <div class="av_blokLeft">
              <div class="av_counter">
                <button class="av_button" id="leftButtonDecrement">–</button>
                <input type="text" value="10.00" id="av_leftInput" placeholder="0.10" />
                <button class="av_button" id="leftButtonIncrement">+</button>
              </div>
              <div class="av_speedButtons">
                <button class="av_buttonSpeed" id="leftButtonSpeed_100">100.00</button>
                <button class="av_buttonSpeed" id="leftButtonSpeed_200">200.00</button>
                <button class="av_buttonSpeed" id="leftButtonSpeed_500">500.00</button>
                <button class="av_buttonSpeed" id="leftButtonSpeed_1000">1000.00</button>
              </div>
            </div>
            <div class="av_blokRight">
              <button id="av_BetButtonLeft" class="av_buttonBet av_buttonBet_left">
                <span>Bet</span>
                <span>
                  <span class="av_left_buttonBet">10.00</span>
                  <span class="av_usd">INR</span>
                </span>
              </button>
            </div>
          </div>

          <!-- RIGHT ACTION -->
          <div class="av_actionContainer">
            <div class="av_blokLeft">
              <div class="av_counter">
                <button class="av_button" id="rightButtonDecrement">–</button>
                <input type="text" value="10.00" id="av_rightInput" placeholder="0.10" />
                <button class="av_button" id="rightButtonIncrement">+</button>
              </div>
              <div class="av_speedButtons">
                <button class="av_buttonSpeed" id="rightButtonSpeed_100">100.00</button>
                <button class="av_buttonSpeed" id="rightButtonSpeed_200">200.00</button>
                <button class="av_buttonSpeed" id="rightButtonSpeed_500">500.00</button>
                <button class="av_buttonSpeed" id="rightButtonSpeed_1000">1000.00</button>
              </div>
            </div>
            <div class="av_blokRight">
              <button class="av_buttonBet av_buttonBet_right" onclick="notification('error','The second bet is temporarily unavailable.')">
                <span>Bet</span>
                <span>
                  <span class="av_right_buttonBet">10.00</span>
                  <span class="av_usd">INR</span>
                </span>
              </button>
            </div>
          </div>
        </section>

      </div>
    </div>
  </div>
  <!-- GAME END -->
</div>

<script src="/js/av/showLoader.js?v=1"></script>
<script src="/js/av/bettingScript.js?v=133"></script>
<script src="/js/av/showTost.js?v=1"></script>
<script src="/js/av/generationPlayers.js?v=3"></script>
<script src="/js/av/mainScriptGame.js?v=66217222222222222223"></script>

<script type="text/javascript">
  let pendingBetAmount = null;
  let statusGame = null; //'prepare', 'playing', 'loading', 'crash'
  
  function getBalance() {
    const balanceElement = document.getElementById('balance');

    if (!balanceElement) {
        console.warn('Элемент с id="balance" не найден');
        return 0;
    }

    const balanceAttr = balanceElement.dataset.balance;
    if (balanceAttr) {
        const balanceValue = parseFloat(balanceAttr);
        if (!isNaN(balanceValue)) {
            return balanceValue;
        }
    }

    // fallback через текст
    const balanceText = balanceElement.innerText.trim().replace(/[\s,]/g, '');
    const balanceValue = parseFloat(balanceText);

    if (isNaN(balanceValue)) {
        console.warn('Баланс не является числом:', balanceText);
        return 0;
    }

    return balanceValue;
}

  function handleBetButtonClick() {
    if (statusGame !== 'loading' && bet_user == 0) {
      if (pendingBetAmount === null) {
        pendingBetAmount = Number($('#av_leftInput').val());
        balanceUser = getBalance();
        console.log('amount'+pendingBetAmount)
        console.log('balance'+balanceUser)
        if(balanceUser < pendingBetAmount){
          pendingBetAmount = null;
          notification('error', 'The bet amount is greater than your balance.')
          return;
        }
        if(pendingBetAmount < 10){
          pendingBetAmount = null;
          notification('error', 'Minimum bet amount 10.00 INR!')
          return;
        }
        disable('.av_blokLeft');
        changeButtonBet("left", "danger"); // меняем кнопку на "опасную" (ставка стоит)
        console.log('Ставка сохранена:', pendingBetAmount);
      } else {
        // Ставка уже есть — отменяем
        undisable('.av_blokLeft');
        pendingBetAmount = null;
        changeButtonBet("left", "basic"); // меняем кнопку обратно на "basic"
        console.log('Ставка отменена');
      }
    }
  }

  socket.on('crashPrepare', () => {
    startPrepare();
    statusGame = 'prepare';
  });


  function crashBet(that) {
    const info = {
      bet: Number($('#av_leftInput').val()),
      auto: Number(1000),
      _token: csrf_token
    }
    audio.click.currentTime = 0;
    audio.click.play();
    $.post('/crash/bet', info).then(e => {
      if (e.success) {
        bet_user = 1;
        //notification('success',e.success)
        disable('.av_blokLeft');
        balanceUpdate(e.lastbalance, e.newbalance)
        changeButtonBet("left", "danger");
      }
      if (e.error) {
        undisable(that)
        notification('error', e.error)

        if (e.type && e.type === 'frozen') {
                setTimeout(() => {
                    window.location.href = '/frozen';
                }, 1500); // Можешь убрать setTimeout, если нужно сразу редиректить
            }
      }
    })
  }

  function crashBetSystem(amount) {
    const info = {
      bet: Number(amount),
      auto: Number(1000),
      _token: csrf_token
    }
    audio.click.currentTime = 0;
    audio.click.play();
    $.post('/crash/bet', info).then(e => {
      if (e.success) {
        bet_user = 1;
        //notification('success',e.success)
        disable('.av_blokLeft');
        balanceUpdate(e.lastbalance, e.newbalance)
        changeButtonBet("left", "danger");
      }
      if (e.error) {
        undisable(that)
        notification('error', e.error)
      }
    })
  }

  function crashGive(that) {
    const info = {
      _token: csrf_token
    }
    $.post('/crash/give', info).then(e => {
      if (e.success) {
        bet_user = 0;
        //notification('info', 'Забираем...')
        // $('#btnCrash').html('Забираем...')
        changeButtonBet("left", "basic");
        document.getElementById('av_BetButtonLeft').onclick = function() {
          handleBetButtonClick();
        };
      }
      if (e.error) {
        undisable(that)
        notification('error', e.error)
      }
    })

  }

  function updateLeftButtonValue(value) {
    document.querySelector('.av_left_buttonBet').textContent = parseFloat(value).toFixed(2).toLocaleString();
  }

  console.log('test');
  var timeStartPing = 0

  function ping() {
    timeStartPing = Date.now();
    socket.emit('PING_CONNECT')
  }
  socket.on('PING_GET', e => {
    console.log(Date.now() - timeStartPing);
  })
  $(document).ready(function() {
    /*if (localStorage.getItem('crashAgree') != 'true') {
      showPopup('popup--crash-info')
    }*/

    showLoader(true);
  });
  var last = 1
  var last_zabr = 1

  //Ивент получения crashTitle
  socket.on('crashTitle', data => {
    showLoader(false);
    if (data.play == 1) {
      handlePlay(data);
      statusGame = 'playing';
    } else {
      handleLoading(data.text);
      statusGame = 'loading';
    }
  });

  //Игра
  function handlePlay(data) {
    const inputAmount = Number($('#av_leftInput').val());

    if (bet_user == 1) {
      disable('.av_blokLeft');
      cashOutAmount = Number(data.text) * inputAmount;
      changeButtonBet("left", "warning");
      document.getElementById('av_BetButtonLeft').onclick = function() {
        crashGive(this);
      };
      setWarningAmount('left', cashOutAmount)
    } else {

      if(pendingBetAmount === null){
        undisable('.av_blokLeft');
        changeButtonBet("left", "basic");
      }
      document.getElementById('av_BetButtonLeft').onclick = function() {
        handleBetButtonClick();
      };
    }
    text = Number(data.text)
    last = text
    //Игра
    playing(Number(text));
    getAllBetsAv(text);

  }

  //Загрузка
  function handleLoading(time) {
    loading(time, 10, 2);

    if (bet_user == 1) {
      document.getElementById('av_BetButtonLeft').onclick = function() {
        crashBet(this);
      };
      changeButtonBet("left", "danger");
    } else {
      if(pendingBetAmount !== null){
        crashBetSystem(pendingBetAmount);
        pendingBetAmount = null;
      }else{
        document.getElementById('av_BetButtonLeft').onclick = function() {
        crashBet(this);
      };
      changeButtonBet("left", "basic");
      }
    }
  }

  // Получаем начальное состояние раунда: ставка пользователя и историю коэффициентов
  async function initCrashState() {
    try {
      const response = await $.post('/crash/get', {
        _token: csrf_token
      });
      handleCrashGive(response);
      renderCrashHistory(response.last);
    } catch (error) {
      console.error('Ошибка при получении состояния Crash:', error);
    }
  }

  // Обрабатываем поле `give`: ставка принята (1) или ожидает подтверждения (2)
  function handleCrashGive({
    give,
    bet,
    auto
  }) {
    if (give === 1) {
      activateBetMode(bet, auto);
    } else if (give === 2) {
      lockBetMode(bet);
    }
  }

  // Переводим UI в режим «ставка принята»
  function activateBetMode(bet, auto) {
    bet_user = 1;
    $('#btmBetOk')
      .attr('onclick', 'disable(this);crashGive(this)')
      .text('Забрать 0.00');
    $('#crashSum').val(bet);
    $('#crashAuto').val(auto);
    undisable('#btnCrash');
    disable('#crashSum');
    disable('#crashAuto');
  }

  // Переводим UI в режим «ожидание игры»
  function lockBetMode(bet) {
    bet_user = 0;
    $('#crashSum').val(bet);
    $('#btnCrash span').text('Ожидание игры...');
    disable('#btnCrash');
    disable('#crashSum');
    disable('#crashAuto');
  }

  // Рисуем блок с последними коэффициентами
  function renderCrashHistory(historyArray) {
    const container = $('.av_coeffs').empty();
    historyArray.forEach(({
      num
    }) => {
      const coeff = num.toFixed(2);
      const color = getCoeffColor(num);
      container.append(
        `<div class="av_coeff" style="color: ${color};"> x${coeff} </div>`
      );
    });
  }

  // Подбираем цвет по величине коэффициента
  function getCoeffColor(num) {
    if (num < 2) return 'rgb(52, 180, 255)';
    if (num < 10) return 'rgb(145, 62, 248)';
    if (num < 100) return 'rgb(192, 23, 180)';
    return 'rgb(250, 192, 0)';
  }

  // Запуск инициализации при загрузке страницы
  $(document).ready(() => {
    initCrashState();
  });



  socket.on('crashDead', e => {
    statusGame = 'crash';
    $('.crash__x-number').html(parseFloat(e.text).toFixed(2).toLocaleString() + 'x')
    last = 1
    bet_user = 0;
    last_zabr = 1
    console.log(e.text);
    stopGame(e.text);
    if(pendingBetAmount === null){
        undisable('.av_blokLeft');
        changeButtonBet("left", "basic");
        document.getElementById('av_BetButtonLeft').onclick = function() {
          handleBetButtonClick();
        };
    }
  })

  function animateCrashNumber(first, second, time) {
    $({
      numberValue: first
    }).animate({
      numberValue: second
    }, {
      duration: time - 20,
      easing: "linear",
      step: function(val) {
        $('.crash__x-number span').text(parseFloat(val).toFixed(2).toLocaleString() + 'x');
      }
    });
  }

  socket.on('crashGo', e => {
    statusGame = 'playing';
    if (bet_user == 1) {
      document.getElementById('av_BetButtonLeft').onclick = function() {
        crashGive(this);
      };
      playing(Number(1.00));
      changeButtonBet("left", "warning");
    }
  })

  socket.on('crashNoty', e => {
    if (e.user_id == USER_ID) {
      //notification('success','Вы выиграли '+e.win.toFixed(2)+' монет')
      avShowTost(e.x.toFixed(2), e.win.toFixed(2));
      balanceUpdate(e.balanceLast, e.balanceNew)
    }
  })
  socket.on('crashFinish', e => {
    e.arr_win.forEach((e) => {
      // if(e.user_id == USER_ID){
      //     notification('success','Вы выиграли '+e.win_user.toFixed(2)+' монет')
      // }
    })
    e.arr_lose.forEach((e) => {
      $('#game_crash_id_' + e.id).removeClass('crash__history-item-user--win').addClass('crash__history-item-user--lose')
    })
    $('.av_coeffs').html('')
    e.s.forEach((e) => {
      var str = String(e.num.toFixed(2));
      if (e.num < 2) {
        class_h = 'rgb(52, 180, 255)'
      } else if (e.num >= 2 && e.num < 10) {
        class_h = 'rgb(145, 62, 248)'
      } else if (e.num >= 10 && e.num < 100) {
        class_h = 'rgb(192, 23, 180)'
      } else if (e.num >= 100) {
        class_h = 'rgb(250, 192, 0)'
      } else {
        class_h = 'rgb(52, 180, 255)'
      }
      $('.av_coeffs').append(' <div class="av_coeff" style="color: ' + class_h + ';"> x' + str + ' </div>')
    })
  })
  setTimeout(async function run() {
    await ping();
    setTimeout(run, 3000);
  }, 2000);


</script>

<script>
// Слушаем все инпуты на странице
document.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        const activeElement = document.activeElement;
        
        // Проверяем, активный элемент — это input или textarea
        if (activeElement && (activeElement.tagName === 'INPUT' || activeElement.tagName === 'TEXTAREA')) {
            event.preventDefault(); // Блокируем стандартное поведение
            
            console.log('Введено значение:', activeElement.value);

            activeElement.blur(); // Убираем фокус => закрывается клавиатура
        }
    }
});
</script>

<?php if(auth()->guard()->check()): ?>
<script type="text/javascript">
  socket.emit('subscribe', 'roomGame_5_<?php echo e(\Auth::user()->id); ?>');
</script>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?><?php /**PATH /var/www/product/resources/views/crash.blade.php ENDPATH**/ ?>