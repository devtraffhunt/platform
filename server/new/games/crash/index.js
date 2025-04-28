// games/crash/index.js
const controller = require('./crash.controller');
const service    = require('./crash.service');

module.exports = (socket, io) => {
  // 1) регистрируем события для одного клиента
  controller(socket, io, service);

  // 2) запускаем общий фон-цикл раундов при первом коннекте
  if (!service.isLoopStarted) {
    service.startLoop(io);
    service.isLoopStarted = true;
  }
};
