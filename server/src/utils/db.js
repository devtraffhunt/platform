const mysql = require('mysql');
const util = require('util');

const pool = mysql.createPool({
  host: process.env.MYSQL_HOST,
  user: process.env.MYSQL_USER,
  password: process.env.MYSQL_PASSWORD,
  database: process.env.MYSQL_DATABASE
});

pool.query = util.promisify(pool.query);
pool.query("SET SESSION wait_timeout = " + process.env.MYSQL_WAIT_TIMEOUT);

module.exports = pool;
