import { registerQuick } from '../api/auth';

function getParamValue(key) {
  const cookie = document.cookie
    .split('; ')
    .find(row => row.startsWith(`${key}=`));
  if (cookie) {
    return decodeURIComponent(cookie.split('=')[1]);
  }

  return localStorage.getItem(key) || null;
}

function getCleanDomain() {
  return window.location.hostname.replace(/^www\./, '');
}


export default function initRegisterPage() {
  const form = document.getElementById('reg_form');
  if (!form) return;

  const submitBtn = form.querySelector('button[type="submit"]');

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    submitBtn.disabled = true;
    submitBtn.textContent = 'Register...';

    const formData = new FormData(form);
    const phone = (formData.get('phone') || '').replace(/\D/g, '');

    const data = {
      phone,
      email: formData.get('email'),
      password: formData.get('password'),
      domain: getCleanDomain(),
      url: window.location.href,
      sub1: getParamValue('sub1'),
      sub2: getParamValue('sub2'),
      sub3: getParamValue('sub3'),
      sub4: getParamValue('sub4'),
      sub5: getParamValue('sub5'),
    };

    try {
      await registerQuick(data);
      alert('Регистрация успешна!');
      window.location.reload();
    } catch (error) {
      console.error(error);
      alert(error?.message || 'Ошибка регистрации');
    } finally {
      submitBtn.disabled = false;
      submitBtn.textContent = 'Register';
    }
  });
}
