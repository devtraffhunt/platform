// resources/js/pages/auth/register.js

import { apiPost } from "@/core/api.js";
import { notify } from "@/utils/notifications.js";

export async function registerUser({ phone, email, password }) {
  try {
    const response = await apiPost("/register", { phone, email, password });
    if (response.success) {
      notify.success("Регистрация прошла успешно");
      window.location.reload();
    } else {
      notify.error(response.message || "Ошибка при регистрации");
    }
  } catch (err) {
    console.error("Ошибка registerUser:", err);
    notify.error("Серверная ошибка при регистрации");
  }
}
