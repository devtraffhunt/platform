document.addEventListener('DOMContentLoaded', () => {
  const qs = selector => document.querySelector(selector);

  // login modal elements
  const btnGoogle = qs('#up_google');
  const btnTelegram = qs('#up_telegram');
  const btnPhone = qs('#up_phone');
  const btnEmail = qs('#up_email');
  const phoneForm = qs('#phone_form');
  const emailForm = qs('#email_form');
  const phoneInput = qs('#up_phone_input');
  const phonePass = qs('#up_phone_password');
  const emailInput = qs('#up_email_input');
  const emailPass = qs('#up_email_password');
  const loginPhone = qs('#up_login_phone');
  const loginEmail = qs('#up_login_email');
  const eyeIcons = document.querySelectorAll('.eye');

  function resetForms() {
    btnPhone.classList.remove('up_selected');
    btnEmail.classList.remove('up_selected');
    phoneForm.style.display = 'none';
    emailForm.style.display = 'none';
  }

  function showPhone() {
    resetForms();
    btnPhone.classList.add('up_selected');
    phoneForm.style.display = 'block';
    updatePhoneBtn();
  }

  function showEmail() {
    resetForms();
    btnEmail.classList.add('up_selected');
    emailForm.style.display = 'block';
    updateEmailBtn();
  }

  function maskPhone() {
    let v = phoneInput.value.replace(/\D/g, '');
    if (v.length > 5) v = v.slice(0, 5) + ' ' + v.slice(5, 10);
    phoneInput.value = v;
    updatePhoneBtn();
  }

  function updatePhoneBtn() {
    const validPhone = /^\d{5} \d{5}$/.test(phoneInput.value);
    const hasPass = phonePass.value.trim().length > 0;
    loginPhone.disabled = !(validPhone && hasPass);
  }

  function updateEmailBtn() {
    const validEmail = emailInput.checkValidity();
    const hasPass = emailPass.value.trim().length > 0;
    loginEmail.disabled = !(validEmail && hasPass);
  }


  btnPhone.addEventListener('click', showPhone);
  btnEmail.addEventListener('click', showEmail);

  phoneInput.addEventListener('input', maskPhone);
  phonePass.addEventListener('input', updatePhoneBtn);
  emailInput.addEventListener('input', updateEmailBtn);
  emailPass.addEventListener('input', updateEmailBtn);



  showPhone();

  // поле blur
  document.querySelectorAll('.up_input-group, .up_password-group').forEach(group => {
    const input = group.querySelector('input');
    if (!input) return;

    input.addEventListener('blur', () => {
      group.classList.toggle('error', !input.checkValidity());
    });

    input.addEventListener('input', () => {
      if (input.checkValidity()) group.classList.remove('error');
    });
  });

  // переключение пароля
  eyeIcons.forEach(icon => {
    icon.addEventListener('click', () => {
      const inp = icon.previousElementSibling;
      if (inp.type === 'password') {
        inp.type = 'text';
        icon.src = './modals/img/eye-open.svg';
      } else {
        inp.type = 'password';
        icon.src = './modals/img/eye-close.svg';
      }
    });
  });

  // Регистрация
  const regForm = qs('#reg_form');
  const phoneInputReg = qs('#up_phone_input_reg');
  const emailInputReg = qs('#up_email_input_reg');
  const passInputReg = qs('#up_phone_password_reg');
  const regButton = qs('#up_reg_phone');
  const btnRgQuick = qs('#up_quick');
  const btnRgSocials = qs('#up_socials');
  const boxRgSocials = qs('#rg_socials');

  function maskPhoneReg() {
    let v = phoneInputReg.value.replace(/\D/g, '');
    if (v.length > 5) v = v.slice(0, 5) + ' ' + v.slice(5, 10);
    phoneInputReg.value = v;
    updateRegBtn();
  }

  function updateRegBtn() {
    const validPhone = /^\d{5}\s\d{5}$/.test(phoneInputReg.value);
    const validEmail = emailInputReg.checkValidity();
    const hasPass = passInputReg.value.trim().length > 0;
    regButton.disabled = !(validPhone && validEmail && hasPass);
  }

  phoneInputReg.addEventListener('input', maskPhoneReg);
  emailInputReg.addEventListener('input', updateRegBtn);
  passInputReg.addEventListener('input', updateRegBtn);


  document.querySelectorAll('#reg_form .up_input-group, #reg_form .up_password-group').forEach(group => {
    const input = group.querySelector('input');
    if (!input) return;
    input.addEventListener('blur', () => {
      group.classList.toggle('error', !input.checkValidity());
    });
    input.addEventListener('input', () => {
      if (input.checkValidity()) group.classList.remove('error');
      updateRegBtn();
    });
  });

  btnRgQuick.addEventListener('click', () => {
    btnRgQuick.classList.add('up_selected');
    btnRgSocials.classList.remove('up_selected');
    regForm.hidden = false;
    boxRgSocials.hidden = true;
  });

  btnRgSocials.addEventListener('click', () => {
    btnRgQuick.classList.remove('up_selected');
    btnRgSocials.classList.add('up_selected');
    regForm.hidden = true;
    boxRgSocials.hidden = false;
  });

  updateRegBtn();

  // Модалки
  const openLoginModalBtn = qs('#openLoginModal');
  const openRegModalBtn = qs('#openRegModal');
  const closeBtn = qs('#closeLoginModal');
  const closeRegBtn = qs('#closeRegModal');
  const loginModal = qs('#loginModal');
  const regModal = qs('#regModal');

  function openLoginModal() {
    closeRegModal();
    loginModal.classList.add('open');
  }

  function openRegModal() {
    closeLoginModal();
    regModal.classList.add('open');
  }

  function closeLoginModal() {
    loginModal.classList.remove('open');
  }

  function closeRegModal() {
    regModal.classList.remove('open');
  }

  openLoginModalBtn.addEventListener('click', openLoginModal);
  openRegModalBtn.addEventListener('click', openRegModal);
  closeBtn.addEventListener('click', closeLoginModal);
  closeRegBtn.addEventListener('click', closeRegModal);

  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
      closeLoginModal();
      closeRegModal();
    }
  });

  // === Обработка параметра ?modal=
  const params = new URLSearchParams(window.location.search);
  const modal = params.get('modal');

  if (modal === 'login') openLoginModal();
  if (modal === 'reg') openRegModal();
});
