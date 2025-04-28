const controller = require('./crash.controller');
const service    = require('./crash.service');

// Модуль‑уровневый флаг, чтобы цикл стартовал только один раз
let loopStarted = false;

/**
 * Этот экспорт мы будем вызывать из server.js:
 *   a) для регистрации WS‑обработчиков
 *   b) для старта фонового цикла (только при первом вызове)
 */
module.exports = (socket, io) => {
  // 1) регистрируем per‑socket события
  controller(socket, io);

  // 2) запускаем общий фон‑цикл при первом коннекте
  if (!loopStarted) {
    service.startLoop(io);
    loopStarted = true;
  }
};
