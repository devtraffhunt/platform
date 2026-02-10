import { getCSRFToken } from './csrf.js';
import { notifyError } from '../shared/notifications.js'; // centralized toast error handler

function buildHeaders(method = 'GET') {
	return {
		'Content-Type': 'application/json',
		'Accept': 'application/json',
		...(method === 'POST' && { 'X-CSRF-TOKEN': getCSRFToken() }),
	};
}

/**
 * Централизованная обработка ответа
 * — кидает исключения, если что-то пошло не так
 */
async function handleResponse(res, method, url) {
	let json = null;

	try {
		json = await res.json();
	} catch (e) {
		console.warn(`[API][${method}] Failed to parse JSON from ${url}`, e);
		throw new Error(`Некорректный ответ от сервера: ${res.status}`);
	}

	if (!res.ok) {
		const msg = json?.message || `Ошибка ${res.status}`;
		console.warn(`[API][${method}] ${url} → ${msg}`);
		throw new Error(msg);
	}

	return json;
}

/**
 * Универсальный fetch с логами, оборачиванием ошибок и fallback‑сообщением
 */
async function request(method, url, data = {}) {
	const opts = {
		method,
		headers: buildHeaders(method),
		...(method !== 'GET' && { body: JSON.stringify(data) }),
	};

	try {
		const res = await fetch(url, opts);
		return await handleResponse(res, method, url);
	} catch (error) {
		// Показываем пользователю и логируем
		console.error(`[API][${method}] ${url} → ${error.message}`);
		notifyError(error.message); // может быть toast или модалка
		throw error; // пробрасываем дальше, если вызывающая сторона обрабатывает
	}
}

export const api = {
	get: (url) => request('GET', url),
	post: (url, data = {}) => request('POST', url, data),
	raw: request,
};
