import { io } from 'socket.io-client';

const socket = io(`https://${location.hostname}:2083`, {
  transports: ['websocket']
});

// Подключаемся и подписываемся, если есть USER_ID
export function initSocketConnection() {
  socket.on('connect', () => {
    console.log('✅ Socket connected:', socket.id);

    if (window.USER_ID) {
      socket.emit('subscribe', `roomUser_${window.USER_ID}`);
    }
  });

  socket.on('disconnect', () => {
    console.log('❌ Socket disconnected');
  });
}

export default socket;
