document.addEventListener("DOMContentLoaded", () => {
	const query = selector => document.querySelector(selector);
	const queryAll = selector => document.querySelectorAll(selector);

	const state = {
		login: {
			phone: "",
			email: "",
			phonePass: "",
			emailPass: "",
		},
		register: {
			phone: "",
			email: "",
			pass: "",
		},
	};

	const resetState = () => {
		state.login = { phone: "", email: "", phonePass: "", emailPass: "" };
		state.register = { phone: "", email: "", pass: "" };
	};

	const elements = {
		btnGoogle: query("#regModal #up_google"),
		btnTelegram: query("#regModal #up_telegram"),
		btnPhone: query("#up_phone"),
		btnEmail: query("#up_email"),
		phoneForm: query("#phone_form"),
		emailForm: query("#email_form"),
		phoneInput: query("#up_phone_input"),
		phonePass: query("#up_phone_password"),
		emailInput: query("#up_email_input"),
		emailPass: query("#up_email_password"),
		loginPhone: query("#up_login_phone"),
		loginEmail: query("#up_login_email"),
		eyeIcons: queryAll(".eye"),
		regForm: query("#reg_form"),
		phoneInputReg: query("#up_phone_input_reg"),
		emailInputReg: query("#up_email_input_reg"),
		passInputReg: query("#up_phone_password_reg"),
		regButton: query("#up_reg_phone"),
		btnRgQuick: query("#up_quick"),
		btnRgSocials: query("#up_socials"),
		boxRgSocials: query("#rg_socials"),
		loginModal: query("#loginModal"),
		regModal: query("#regModal"),
		openLoginModalBtn: query(".openLoginModal"),
		openRegModalBtn: query(".openRegModal"),
		closeBtn: query("#closeLoginModal"),
		closeRegBtn: query("#closeRegModal"),
	};

	const toggleSelected = (btnToSelect, btnToDeselect) => {
		btnToSelect.classList.add("up_selected");
		btnToDeselect.classList.remove("up_selected");
	};

	const resetForms = () => {
		elements.btnPhone.classList.remove("up_selected");
		elements.btnEmail.classList.remove("up_selected");
		elements.phoneForm.style.display = "none";
		elements.emailForm.style.display = "none";
		elements.phoneInput.value = "";
		elements.phonePass.value = "";
		elements.emailInput.value = "";
		elements.emailPass.value = "";
		elements.phoneInputReg.value = "";
		elements.emailInputReg.value = "";
		elements.passInputReg.value = "";
	};

	const showPhone = () => {
		resetForms();
		elements.btnPhone.classList.add("up_selected");
		elements.phoneForm.style.display = "block";
		updatePhoneBtn();
	};

	const showEmail = () => {
		resetForms();
		elements.btnEmail.classList.add("up_selected");
		elements.emailForm.style.display = "block";
		updateEmailBtn();
	};

	const updatePhoneBtn = () => {
		const valid = /^\d{2} \d{3} \d{4}$/.test(elements.phoneInput.value);
		const hasPass = elements.phonePass.value.trim().length > 0;
		elements.loginPhone.disabled = !(valid && hasPass);
	};

	const updateEmailBtn = () => {
		const valid = elements.emailInput.checkValidity();
		const hasPass = elements.emailPass.value.trim().length > 0;
		elements.loginEmail.disabled = !(valid && hasPass);
	};

	const updateRegBtn = () => {
		const validPhone = /^\d{2} \d{3} \d{4}$/.test(elements.phoneInputReg.value);
		const validEmail = elements.emailInputReg.checkValidity();
		const hasPass = elements.passInputReg.value.trim().length > 0;
		elements.regButton.disabled = !(validPhone && validEmail && hasPass);
	};

	const maskPhone = () => {
		const digits = elements.phoneInput.value.replace(/\D/g, "");
		if (digits.length > 2) {
			elements.phoneInput.value = `${digits.slice(0, 2)} ${digits.slice(2, 5)}${digits.length > 5 ? " " + digits.slice(5, 9) : ""}`;
		} else {
			elements.phoneInput.value = digits;
		}
	};

	const maskPhoneReg = () => {
		const digits = elements.phoneInputReg.value.replace(/\D/g, "");
		if (digits.length > 2) {
			elements.phoneInputReg.value = `${digits.slice(0, 2)} ${digits.slice(2, 5)}${digits.length > 5 ? " " + digits.slice(5, 9) : ""}`;
		} else {
			elements.phoneInputReg.value = digits;
		}
	};


	const animateModal = (modalEl, show = true) => {
		const inner = modalEl.querySelector(".up_modal");
		if (!inner) return;
		// inner.classList.remove("fade-in", "fade-out");
		// void inner.offsetWidth;
		// inner.classList.add(show ? "fade-in" : "fade-out");
		if (!show) {
			// setTimeout(() => modalEl.classList.remove("open"), 300);
			modalEl.classList.remove("open")
		} else {
			modalEl.classList.add("open");
		}
	};

	const closeLoginModal = () => animateModal(elements.loginModal, false);
	const closeRegModal = () => animateModal(elements.regModal, false);
	const openLoginModal = () => {
		closeRegModal();
		animateModal(elements.loginModal, true);
	};
	const openRegModal = () => {
		closeLoginModal();
		animateModal(elements.regModal, true);
	};

	const switchMode = mode => {
		resetState();
		resetForms();
		switch (mode) {
			case "loginemail":
				openLoginModal();
				showEmail();
				break;
			case "loginphone":
				openLoginModal();
				showPhone();
				break;
			case "regquick":
				openRegModal();
				toggleSelected(elements.btnRgQuick, elements.btnRgSocials);
				elements.regForm.style.display = "block";
				elements.boxRgSocials.style.display = "none";
				break;
			case "regsocial":
				openRegModal();
				toggleSelected(elements.btnRgSocials, elements.btnRgQuick);
				elements.regForm.style.display = "none";
				elements.boxRgSocials.style.display = "block";
				break;
			default:
				break;
		}
	};

	elements.phoneInput.addEventListener("input", () => {
		maskPhone();
		const value = elements.phoneInput.value.trim();
		const valid = /^\d{2} \d{3} \d{4}$/.test(value);
		elements.phoneInput.parentElement.classList.toggle("error", value !== "" && !valid);
		updatePhoneBtn();
		state.login.phone = value;
	});

	elements.phonePass.addEventListener("input", () => {
		const value = elements.phonePass.value.trim();
		elements.phonePass.parentElement.classList.toggle("error", value !== "" && value.length === 0);
		updatePhoneBtn();
		state.login.phonePass = value;
	});

	elements.emailInput.addEventListener("input", () => {
		const value = elements.emailInput.value.trim();
		const valid = elements.emailInput.checkValidity();
		elements.emailInput.parentElement.classList.toggle("error", value !== "" && !valid);
		updateEmailBtn();
		state.login.email = value;
	});

	elements.emailPass.addEventListener("input", () => {
		const value = elements.emailPass.value.trim();
		elements.emailPass.parentElement.classList.toggle("error", value !== "" && value.length === 0);
		updateEmailBtn();
		state.login.emailPass = value;
	});

	elements.phoneInputReg.addEventListener("input", () => {
		maskPhoneReg();
		const value = elements.phoneInputReg.value.trim();
		const valid = /^\d{2} \d{3} \d{4}$/.test(value);
		elements.phoneInputReg.parentElement.classList.toggle("error", value !== "" && !valid);
		updateRegBtn();
		state.register.phone = value;
	});

	elements.emailInputReg.addEventListener("input", () => {
		const value = elements.emailInputReg.value.trim();
		const valid = elements.emailInputReg.checkValidity();
		elements.emailInputReg.parentElement.classList.toggle("error", value !== "" && !valid);
		updateRegBtn();
		state.register.email = value;
	});

	elements.passInputReg.addEventListener("input", () => {
		const value = elements.passInputReg.value.trim();
		elements.passInputReg.parentElement.classList.toggle("error", value !== "" && value.length === 0);
		updateRegBtn();
		state.register.pass = value;
	});


	elements.btnPhone.addEventListener("click", () => switchMode("loginphone"));
	elements.btnEmail.addEventListener("click", () => switchMode("loginemail"));
	elements.btnRgQuick.addEventListener("click", () => switchMode("regquick"));
	elements.btnRgSocials.addEventListener("click", () => switchMode("regsocial"));
	elements.openLoginModalBtn.addEventListener("click", () => switchMode("loginphone"));
	elements.openRegModalBtn.addEventListener("click", () => switchMode("regquick"));
	elements.closeBtn.addEventListener("click", closeLoginModal);
	elements.closeRegBtn.addEventListener("click", closeRegModal);

	elements.loginPhone.addEventListener("click", loginPhone);
	elements.loginEmail.addEventListener("click", loginEmail);
	elements.regButton.addEventListener("click", regQuick);

	elements.eyeIcons.forEach(icon => {
		icon.addEventListener("click", () => {
			const input = icon.previousElementSibling;
			const isPass = input.type === "password";
			input.type = isPass ? "text" : "password";
			icon.children[0].src = isPass ? "./img/eye-open.svg" : "./img/eye-close.svg";
		});
	});

	document.querySelectorAll("a[data-switch]").forEach(link => {
		link.addEventListener("click", event => {
			event.preventDefault();
			const mode = link.getAttribute("data-switch");
			switchMode(mode);
		});
	});

	document.addEventListener("keydown", e => {
		if (e.key === "Escape") {
			closeLoginModal();
			closeRegModal();
		}
	});

	const modalParam = new URLSearchParams(window.location.search).get("modal");
	switchMode(modalParam || "");
});


function login() {
	$.post('/login', { login: $('#log_acc').val(), password: $('#pass_acc').val() })
		.then((e) => {
			if (e.error) return notification('error', e.message);

			notification('success', e.message)
			setTimeout(() => {
				location.reload(true);
			}, 2500);
		});
}

function loginEmail() {
	const form = $('#email_form');
	const email = form.find('input[type="email"]').val();
	const password = form.find('#up_email_password').val();

	$.post('/login/email', { email: email, password: password })
		.then((e) => {
			if (e.error) return notification('error', e.message);

			notification('success', e.message);
			setTimeout(() => {
				location.reload(true);
			}, 2500);
		});
}


function loginPhone() {
	const form = $('#phone_form');
	const phone = '+998' + form.find('input[type="tel"]').val().replace(/\s+/g, '');
	console.log(phone)
	const password = form.find('#up_phone_password').val();

	$.post('/login/phone', { phone: phone, password: password })
		.then((e) => {
			if (e.error) return notification('error', e.message);

			notification('success', e.message);
			setTimeout(() => {
				location.reload(true);
			}, 2500);
		});
}

function regQuick() {
	const form = $('#reg_form');
	const phone = form.find('#up_phone_input_reg').val().replace(/\s+/g, ''); // убираем пробелы
	const email = form.find('#up_email_input_reg').val();
	const password = form.find('#up_phone_password_reg').val();

	// Безопасно достаём данные
	let telegram_id = null;
	let bot_id = null;

	try {
		telegram_id = localStorage.getItem('telegram_id') || (typeof getCookie === 'function' ? getCookie('telegram_id') : null);
		bot_id = localStorage.getItem('bot_id') || (typeof getCookie === 'function' ? getCookie('bot_id') : null);
	} catch (err) {
		console.warn('Не удалось получить telegram_id или bot_id:', err);
	}

	// Отправляем запрос, даже если всё пустое
	$.post('/register/quick', {
		phone: phone,
		email: email,
		password: password,
		telegram_id: telegram_id || '',
		bot_id: bot_id || ''
	}).then((e) => {
		if (e.error) return notification('error', e.message);

		notification('success', e.message);
		setTimeout(() => {
			location.href = '/games/chicken-road';
		}, 100);
	});

}



function setReg(type) {
	if (type == 'login') {
		$('#social').removeClass('active');
		$('#click').removeClass('active');
		$('#login').addClass('active');

		$('#typeReg').val('login');

		$('#socialTab').hide();
		$('#loginTab').show();
	}
	else if (type == 'social') {
		$('#login').removeClass('active');
		$('#click').removeClass('active');
		$('#social').addClass('active');

		$('#loginTab').hide();
		$('#socialTab').show();
	}
	else if (type == 'click') {
		$('#social').removeClass('active');
		$('#login').removeClass('active');
		$('#click').addClass('active');

		$('#typeReg').val('click');

		$('#socialTab').hide();
		$('#loginTab').hide();
	}
}

