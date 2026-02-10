export function initAuthModals({ onLoginPhone, onLoginEmail, onRegister }) {
  document.addEventListener("DOMContentLoaded", () => {
    const $ = s => document.querySelector(s);
    const $$ = s => document.querySelectorAll(s);

    const state = {
      login: { phone: "", email: "", phonePass: "", emailPass: "" },
      register: { phone: "", email: "", pass: "" },
    };

    const el = {
      btnGoogle: $("#regModal #up_google"),
      btnTelegram: $("#regModal #up_telegram"),
      btnPhone: $("#up_phone"),
      btnEmail: $("#up_email"),
      phoneForm: $("#phone_form"),
      emailForm: $("#email_form"),
      phoneInput: $("#up_phone_input"),
      phonePass: $("#up_phone_password"),
      emailInput: $("#up_email_input"),
      emailPass: $("#up_email_password"),
      loginPhone: $("#up_login_phone"),
      loginEmail: $("#up_login_email"),
      eyeIcons: $$(".eye"),
      regForm: $("#reg_form"),
      phoneInputReg: $("#up_phone_input_reg"),
      emailInputReg: $("#up_email_input_reg"),
      passInputReg: $("#up_phone_password_reg"),
      regButton: $("#up_reg_phone"),
      btnRgQuick: $("#up_quick"),
      btnRgSocials: $("#up_socials"),
      boxRgSocials: $("#rg_socials"),
      loginModal: $("#loginModal"),
      regModal: $("#regModal"),
      openLoginModalBtn: $(".openLoginModal"),
      openRegModalBtn: $(".openRegModal"),
      closeBtn: $("#closeLoginModal"),
      closeRegBtn: $("#closeRegModal"),
    };

    const toggleSelected = (on, off) => {
      on.classList.add("up_selected");
      off.classList.remove("up_selected");
    };

    const showPhone = () => {
      el.phoneForm.style.display = "block";
      el.emailForm.style.display = "none";
      toggleSelected(el.btnPhone, el.btnEmail);
    };

    const showEmail = () => {
      el.phoneForm.style.display = "none";
      el.emailForm.style.display = "block";
      toggleSelected(el.btnEmail, el.btnPhone);
    };

    const animateModal = (m, show = true) => {
      const inner = m.querySelector(".up_modal");
      if (!inner) return;
      if (!show) m.classList.remove("open");
      else m.classList.add("open");
    };

    const openLoginModal = () => {
      animateModal(el.regModal, false);
      animateModal(el.loginModal, true);
    };

    const openRegModal = () => {
      animateModal(el.loginModal, false);
      animateModal(el.regModal, true);
    };

    const switchMode = mode => {
      if (!mode) return;
      switch (mode) {
        case "loginphone": openLoginModal(); showPhone(); break;
        case "loginemail": openLoginModal(); showEmail(); break;
        case "regquick": openRegModal(); toggleSelected(el.btnRgQuick, el.btnRgSocials); el.regForm.style.display = "block"; el.boxRgSocials.style.display = "none"; break;
        case "regsocial": openRegModal(); toggleSelected(el.btnRgSocials, el.btnRgQuick); el.regForm.style.display = "none"; el.boxRgSocials.style.display = "block"; break;
      }
    };

    el.btnPhone?.addEventListener("click", () => switchMode("loginphone"));
    el.btnEmail?.addEventListener("click", () => switchMode("loginemail"));
    el.btnRgQuick?.addEventListener("click", () => switchMode("regquick"));
    el.btnRgSocials?.addEventListener("click", () => switchMode("regsocial"));
    el.openLoginModalBtn?.addEventListener("click", () => switchMode("loginphone"));
    el.openRegModalBtn?.addEventListener("click", () => switchMode("regquick"));
    el.closeBtn?.addEventListener("click", () => animateModal(el.loginModal, false));
    el.closeRegBtn?.addEventListener("click", () => animateModal(el.regModal, false));

    el.loginPhone?.addEventListener("click", () => onLoginPhone?.(state.login));
    el.loginEmail?.addEventListener("click", () => onLoginEmail?.(state.login));
    el.regButton?.addEventListener("click", () => onRegister?.(state.register));

    el.eyeIcons?.forEach(icon => {
      icon.addEventListener("click", () => {
        const input = icon.previousElementSibling;
        const isPass = input?.type === "password";
        if (input) input.type = isPass ? "text" : "password";
        const img = icon.querySelector("img");
        if (img) img.src = isPass ? "./img/eye-open.svg" : "./img/eye-close.svg";
      });
    });

    document.querySelectorAll("a[data-switch]").forEach(link => {
      link.addEventListener("click", e => {
        e.preventDefault();
        switchMode(link.getAttribute("data-switch"));
      });
    });

    document.addEventListener("keydown", e => {
      if (e.key === "Escape") {
        animateModal(el.loginModal, false);
        animateModal(el.regModal, false);
      }
    });

    const param = new URLSearchParams(location.search).get("modal");
    switchMode(param);
  });
}