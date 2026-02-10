import { loginByEmail, loginByPhone } from '../api/auth';
import { toast } from '../utils/toast';

export default function initLoginModal() {
  const emailForm = document.getElementById('email_form');
  const phoneForm = document.getElementById('phone_form');

  // Email Login
  if (emailForm) {
    emailForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      const email = document.getElementById('up_email_input')?.value?.trim();
      const password = document.getElementById('up_email_password')?.value;
      const submitBtn = document.getElementById('up_login_email');


      submitBtn.disabled = true;
      submitBtn.textContent = 'Logging in...';

      try {
        await loginByEmail({ email, password });
        toast.success('Login successful!');
        window.location.reload();
      } catch (error) {
        console.error(error);
        toast.error('Failed to login', error?.response?.errors?.email?.[0] || error?.message );
      } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<img class="up_icon_15" src="./img/login.svg" alt="Login"> Login';
      }
    });
  }

  // Phone Login
  if (phoneForm) {
    phoneForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      const rawPhone = document.getElementById('up_phone_input')?.value || '';
      const password = document.getElementById('up_phone_password')?.value;
      const submitBtn = document.getElementById('up_login_phone');

      const phone = rawPhone.replace(/\D/g, '');


      submitBtn.disabled = true;
      submitBtn.textContent = 'Logging in...';

      try {
        await loginByPhone({ phone, password });
        toast.success('Login successful!');
        window.location.reload();
      } catch (error) {
        console.error(error);
        toast.error('Failed to login', error?.response?.errors?.phone?.[0] || error?.message);
      } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<img class="up_icon_15" src="./img/login.svg" alt="Login"> Login';
      }
    });
  }

}
