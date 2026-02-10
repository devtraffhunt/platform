import { api } from '../core/api';

export async function registerQuick(data) {
  return api('/auth/register/quick', 'POST', data);
}

export async function loginByEmail(data) {
  return await api('/auth/login/email', 'POST', data);
}

export async function loginByPhone(data) {
  return await api('/auth/login/phone', 'POST', data);
}
