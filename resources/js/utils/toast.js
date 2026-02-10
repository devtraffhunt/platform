import Toastify from 'toastify-js';
import "toastify-js/src/toastify.css";

const baseStyle = {
  borderRadius: "12px",
  padding: "16px 20px",
  fontSize: "14px",
  color: "#fff",
  boxShadow: "0 6px 20px rgba(0, 0, 0, 0.25)",
  maxWidth: "340px",
  minHeight: "auto",
  lineHeight: "1.4",
};

const colors = {
  success: "linear-gradient(to right, rgba(40, 167, 69, 0.85), rgba(72, 180, 97, 0.85))",
  error: "linear-gradient(to right, rgba(229, 57, 53, 0.85), rgba(227, 93, 91, 0.85))",
  info: "linear-gradient(to right, rgba(33, 150, 243, 0.85), rgba(109, 213, 237, 0.85))",
  default: "linear-gradient(to right, rgba(51, 51, 51, 0.85), rgba(34, 34, 34, 0.85))",
};


let activeToasts = [];

function showToast(title, message = '', type = 'default') {
  // Удалим лишние тосты
  if (activeToasts.length >= 3) {
    const oldest = activeToasts.shift();
    oldest?.toastElement?.remove();
  }

  const toast = Toastify({
    text: `
      <div class="up_toast">
        <div class="up_toast-title">${title}</div>
        ${message ? `<div class="up_toast-text">${message}</div>` : ''}
      </div>`,
    duration: 4000,
    gravity: "top",
    position: "right",
    close: true,
    stopOnFocus: true,
    style: {
      background: colors[type] || colors.default,
      ...baseStyle,
    },
    escapeMarkup: false,
    onClick: () => {},
  });

  toast.showToast();
  activeToasts.push(toast);
}

export const toast = {
  success: (title, message = '') => showToast(title, message, 'success'),
  error: (title, message = '') => showToast(title, message, 'error'),
  info: (title, message = '') => showToast(title, message, 'info'),
  default: (title, message = '') => showToast(title, message, 'default'),
};
