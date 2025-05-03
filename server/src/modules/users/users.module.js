module.exports = (io, mysql, redis) => {
    const usersNamespace = io.of('/users');
  
    usersNamespace.on('connection', (socket) => {
      console.log(`[users] Connected: ${socket.id}`);
  
      socket.on('subscribeUserRoom', (userId) => {
        const room = `user_${userId}`;
        socket.join(room);
        console.log(`[users] ${socket.id} joined room ${room}`);
      });
  
      socket.on('unsubscribeUserRoom', (userId) => {
        const room = `user_${userId}`;
        socket.leave(room);
        console.log(`[users] ${socket.id} left room ${room}`);
      });
    });
  
    // функция отправки обновлений в нужную комнату
    const notifyUserUpdate = (userId, data) => {
      const room = `user_${userId}`;
      usersNamespace.to(room).emit('userUpdated', data);
    };
  
    // экспортируем функцию для использования из других модулей
    return {
      notifyUserUpdate
    };
  };
  