const fs       = require('fs');
const https    = require('https');
const socketIo = require('socket.io');
const config   = require('./config');
const app      = require('./app').app;

// HTTPS + Express
const server = https.createServer({
  key : fs.readFileSync(config.server.ssl.key),
  cert: fs.readFileSync(config.server.ssl.cert),
}, app);

const io = socketIo(server, {
  cors: { origin: config.server.domain, methods: ['GET','POST'] }
});

// при каждом новом WS‑соединении:
io.on('connection', socket => {
  require('./games/crash')(socket, io);
  // позже можно подключить и другие игры:
  // require('./games/wheel')(socket, io);
});

server.listen(config.server.port, () => {
  console.log(`Server listening on port ${config.server.port}`);
});
