/**
 * Унифицированная система уведомлений
 * @param {'success' | 'error' | 'info' | 'warning'} type
 * @param {string} message
 */
export function notify(type, message) {
    if (!window.toastr || typeof toastr[type] !== 'function') {
        console.warn(`[notify] ${type}: ${message}`);
        return;
    }

    toastr.options = {
        closeButton: false,
        progressBar: true,
        positionClass: 'toast-top-right',
        showDuration: 300,
        hideDuration: 1000,
        timeOut: 5000,
        extendedTimeOut: 1000,
        showEasing: 'swing',
        hideEasing: 'linear',
        showMethod: 'fadeIn',
        hideMethod: 'fadeOut',
    };

    toastr[type](message);
}
