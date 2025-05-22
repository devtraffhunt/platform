const mysql = require('mysql');
const util = require('util');

let pool;

function createPool() {
  pool = mysql.createPool({
    host: process.env.MYSQL_HOST,
    user: process.env.MYSQL_USER,
    password: process.env.MYSQL_PASSWORD,
    database: process.env.MYSQL_DATABASE,
    waitForConnections: true,
    connectionLimit: 10,
    queueLimit: 0
  });

  pool.query = util.promisify(pool.query);
}

createPool();

async function query(sql, params = []) {
  try {
    return await pool.query(sql, params);
  } catch (err) {
    // если ошибка связана с соединением — пересоздаём pool
    if (
      err.code === 'PROTOCOL_CONNECTION_LOST' ||
      err.code === 'ECONNREFUSED' ||
      err.code === 'ECONNRESET' ||
      err.code === 'PROTOCOL_ENQUEUE_AFTER_FATAL_ERROR'
    ) {
      console.warn('[MySQL] Recreating pool after fatal error:', err.code);
      createPool();
    }

    console.error('[MySQL Query Error]', err.code, err.message);
    throw err;
  }
}

module.exports = { query };
