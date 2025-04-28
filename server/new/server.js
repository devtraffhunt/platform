// server.js
require('dotenv').config();
const fs      = require('fs');
const https   = require('https');
const { Server } = require('socket.io');
const app     = require('./app');
const cfg     = require('./config');

// HTTPS‑сервер
const server = https.createServer({
  key:  fs.readFileSync(cfg.ssl.key),
  cert: fs.readFileSync(cfg.ssl.cert)
}, app);

// Socket.IO
const io = new Server(server, {
  cors: {
    origin: cfg.domain,
    methods: ['GET','POST']
  }
});

// Модуль «Crash»
const initCrash = require('./games/crash');
io.on('connection', socket => initCrash(socket, io));

// «Legacy»‑логика остальных игр
require('./legacy-games')(io);

server.listen(cfg.port, () => {
  console.log(`Listening on port ${cfg.port}`);
});
