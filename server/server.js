require('dotenv').config();
const fs = require('fs');
const https = require('https');
const { Server } = require('socket.io');
const app = require('./src/app');

const server = https.createServer({
  key: fs.readFileSync(process.env.SSL_KEY_PATH),
  cert: fs.readFileSync(process.env.SSL_CERT_PATH),
}, app);

const io = new Server(server, {
  cors: {
    origin: process.env.DOMAIN,
    methods: ['GET', 'POST']
  }
});

require('./src/games/crash/crash.module')(io);
require('./src/modules/users/users.module')(io, client, redis);


server.listen(process.env.PORT, () => {
  console.log(`✅ Server started on port ${process.env.PORT}`);
}).on('error', (err) => {
  if (err.code === 'EADDRINUSE') {
    console.error(`❌ Порт ${process.env.PORT} уже используется. Завершаю процесс.`);
    process.exit(1);
  } else {
    throw err;
  }
});
