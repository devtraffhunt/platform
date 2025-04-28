// games/crash/crash.controller.js

/**
 * Вешаем обработчики socket‑событий
 */
module.exports = (socket, io, service) => {
    socket.on('giveCrash', msg => {
      service.handleCashout(msg, io)
        .catch(err => socket.emit('error', err.message));
    });
  
    socket.on('boomCrash', () => {
      service.handleBoom(io);
    });
  };
  