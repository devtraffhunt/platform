/**
 * Один элемент по селектору
 * @param {string} selector
 * @param {HTMLElement} context
 * @returns {HTMLElement|null}
 */
export function $(selector, context = document) {
    return context.querySelector(selector);
}

/**
 * Все элементы по селектору
 * @param {string} selector
 * @param {HTMLElement} context
 * @returns {HTMLElement[]}
 */
export function $all(selector, context = document) {
    return Array.from(context.querySelectorAll(selector));
}

/**
 * Установить innerHTML
 * @param {HTMLElement} el
 * @param {string} content
 */
export function html(el, content) {
    if (el) el.innerHTML = content;
}

/**
 * Переключить класс
 * @param {HTMLElement} el
 * @param {string} className
 */
export function toggleClass(el, className) {
    el?.classList?.toggle(className);
}

/**
 * Добавить класс, если его нет
 * @param {HTMLElement} el
 * @param {string} className
 */
export function addClass(el, className) {
    if (el && !el.classList.contains(className)) el.classList.add(className);
}

/**
 * Удалить класс, если он есть
 * @param {HTMLElement} el
 * @param {string} className
 */
export function removeClass(el, className) {
    if (el?.classList?.contains(className)) el.classList.remove(className);
}
