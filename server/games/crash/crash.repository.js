// games/crash/crash.repository.js
const mysql = require('mysql');
const util  = require('util');
const cfg   = require('../../config').mysql;

const client = mysql.createConnection({
  host:     cfg.host,
  user:     cfg.user,
  password: cfg.password,
  database: cfg.database
});
client.query = util.promisify(client.query);
client.query(`SET SESSION wait_timeout = ${cfg.waitTimeout}`);

/** Читаем настройки */
async function getSettings() {
  const rows = await client.query('SELECT * FROM settings');
  return rows[0];
}

/** Обновляем статус crash (0/1/3/2 и т.п.) */
async function updateCrashStatus(status) {
  return client.query('UPDATE settings SET crash_status = ?', [status]);
}

/** Берём одиночную ставку по id */
async function getById(id) {
  const rows = await client.query('SELECT * FROM crash WHERE id = ?', [id]);
  return rows[0];
}

/** Берём авто‑ставки <= resultCoef */
async function getPendingAutoBets(maxAuto) {
  return client.query(
    'SELECT * FROM crash WHERE result = 0 AND auto <= ?',
    [maxAuto]
  );
}

/** Записываем фактический результат (коэффициент) */
async function updateResult(id, result) {
  return client.query(
    'UPDATE crash SET result = ? WHERE id = ?',
    [result, id]
  );
}

/** Баланс пользователя */
async function getUserById(id) {
  const rows = await client.query(
    'SELECT balance, demo_balance, type_balance FROM users WHERE id = ?',
    [id]
  );
  return rows[0];
}

/** Обновляем баланс (основной + демо) */
async function updateUserBalance(id, balance, demo_balance) {
  return client.query(
    'UPDATE users SET balance = ?, demo_balance = ? WHERE id = ?',
    [balance, demo_balance, id]
  );
}

/** Запись в историю */
async function insertCrashHistory(num) {
  return client.query('INSERT INTO crash_history (num) VALUES (?)', [num]);
}

/** Получить последние записи истории */
async function getCrashHistory(limit = 30) {
  return client.query(
    'SELECT * FROM crash_history ORDER BY id DESC LIMIT ?',
    [limit]
  );
}

/** Очистить таблицу active-crash */
async function clearCrashTable() {
  return client.query('TRUNCATE crash');
}

module.exports = {
  getSettings,
  updateCrashStatus,
  getById,
  getPendingAutoBets,
  updateResult,
  getUserById,
  updateUserBalance,
  insertCrashHistory,
  getCrashHistory,
  clearCrashTable
};
