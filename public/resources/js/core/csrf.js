// core/csrf.js

/**
 * Получает CSRF-токен из <meta name="csrf-token">
 * @returns {string|null}
 */
export function getCsrfToken() {
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (!token) {
        console.warn('[CSRF] Не найден CSRF-токен в <meta>');
    }
    return token || null;
}
