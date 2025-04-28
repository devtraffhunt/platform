// config.js
require('dotenv').config();

module.exports = {
  port:        process.env.PORT,
  domain:      process.env.DOMAIN,
  ssl: {
    key:  process.env.SSL_KEY,
    cert: process.env.SSL_CERT
  },
  mysql: {
    host:        process.env.MYSQL_HOST,
    user:        process.env.MYSQL_USER,
    password:    process.env.MYSQL_PASSWORD,
    database:    process.env.MYSQL_DATABASE,
    waitTimeout: process.env.MYSQL_WAIT_TIMEOUT || 604800
  },
  redisUrl:          process.env.REDIS_URL,
  randomOrgApiKey:   process.env.RANDOM_ORG_API_KEY
};
