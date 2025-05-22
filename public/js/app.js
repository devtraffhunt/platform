console.log('test')
const socket = io('https://upwin.co', { transports: ['websocket'] });

socket.on('connect', () => {
  console.log('✅ Socket connected:', socket.id);
  socket.emit('giveCrash', { gameId: 123 });
});

socket.on('disconnect', () => {
  console.log('❌ Socket disconnected');
});
