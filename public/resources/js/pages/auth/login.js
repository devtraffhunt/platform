// resources/js/pages/auth/login.js

import { apiPost } from "@/core/api.js";
import { notify } from "@/utils/notifications.js";

export async function loginPhone({ phone, password }) {
  try {
    const response = await apiPost("/login-phone", { phone, password });
    if (response.success) {
      notify.success("Вы успешно вошли по телефону");
      window.location.reload();
    } else {
      notify.error(response.message || "Ошибка входа по телефону");
    }
  } catch (err) {
    console.error("Ошибка loginPhone:", err);
    notify.error("Серверная ошибка при входе");
  }
}

export async function loginEmail({ email, password }) {
  try {
    const response = await apiPost("/login-email", { email, password });
    if (response.success) {
      notify.success("Вы успешно вошли по email");
      window.location.reload();
    } else {
      notify.error(response.message || "Ошибка входа по email");
    }
  } catch (err) {
    console.error("Ошибка loginEmail:", err);
    notify.error("Серверная ошибка при входе");
  }
}
