// resources/js/app.js

import { initAuthModals } from "./pages/auth/modal.js";
import { loginPhone, loginEmail } from "./pages/auth/login.js";
import { registerUser } from "./pages/auth/register.js";
import { setupCsrf } from "./core/csrf.js";
import { initSocket } from "./core/socket.js";

// Глобальный setup для всего фронта

(async () => {
  try {
    await setupCsrf();
    initSocket();

    initAuthModals({
      onLoginPhone: loginPhone,
      onLoginEmail: loginEmail,
      onRegister: registerUser,
    });
  } catch (err) {
    console.error("❌ Ошибка инициализации:", err);
  }
})();
