// core/socket.js

import { showNotification } from '@/shared/notifications';

let socketInstance = null;

/**
 * Инициализация Socket.IO клиента
 * @param {string} url - адрес сокет-сервера (например, https://site.com:2083)
 * @param {Object} options - настройки подключения
 * @returns {SocketIOClient.Socket} - экземпляр сокета
 */
export function initSocket(url, options = { transports: ['websocket'] }) {
    if (!window.io) {
        showNotification('error', 'Socket.IO не загружен');
        throw new Error('[Socket] Библиотека Socket.IO не подключена');
    }

    socketInstance = window.io(url, options);

    socketInstance.on('connect', () => {
        console.info('[Socket] ✅ Подключено:', socketInstance.id);
    });

    socketInstance.on('disconnect', (reason) => {
        console.warn('[Socket] ❌ Отключено:', reason);
    });

    socketInstance.on('connect_error', (err) => {
        console.error('[Socket] Ошибка подключения:', err.message);
        showNotification('error', `Ошибка соединения: ${err.message}`);
    });

    return socketInstance;
}

/**
 * Возвращает текущий экземпляр сокета
 * @returns {SocketIOClient.Socket|null}
 */
export function getSocket() {
    if (!socketInstance) {
        console.warn('[Socket] Socket ещё не инициализирован');
    }
    return socketInstance;
}
