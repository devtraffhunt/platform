document.addEventListener("DOMContentLoaded", () => {
	// ===== Утиліти для вибору елементів =====
	const $ = s => document.querySelector(s);
	const $$ = s => document.querySelectorAll(s);

	// ===== Основні сторінки інтерфейсу =====
	const page_1 = $(".up_page_1"); // Головна сторінка
	const page_2 = $(".up_page_2"); // Введення суми
	const page_3 = $(".up_page_3"); // Підтвердження

	// ===== Кнопки та елементи взаємодії =====
	const methodButtons = $$(".up_item_pay[data-method-id]"); // Методи оплати (на 1 сторінці)
	const methodPayPage3 = $$(".up_item_pay_other"); // Методи оплати (на 3 сторінці)
	const backButtons = $$(".up_page .up_back_button"); // Кнопки "назад"
	const quickButtons = $$(".up_amounts_select_item"); // Кнопки швидкого вибору суми

	const changeButton = $(".up_pay_change_button"); // Зміна методу
	const withdrawBtn = $("#withdrawalBtn"); // Кнопка "Withdraw"
	const buttonPay = $("#btn-pay"); // Кнопка "Pay"
	const input = $(".up_page_2 input.up_input"); // Поле введення суми

	// ===== Поля банківської форми =====
	const selectBank = $(".up_select");
	const nameInput = $('#full_name');
const accountInput = $('#bank_account');


	// ===== Об'єкти стану =====
	const limits = { min: 500, max: 50000 }; // Мін/макс для суми
	const recommended = 1500; // Рекомендована сума
	let selectedMethod = null; // Активний метод
	
	let balance = 0; // Баланс користувача

	const formData = {
		fullName: "",
		accountNumber: "",

	};

	// ===== Валідації окремих полів =====
	const checkFullName = () => {
		const val = nameInput.value.trim();
		const valid = /^[A-Za-z]+(?:\s[A-Za-z]+)+$/.test(val);
		nameInput.parentElement.classList.toggle("error", !valid);
		formData.fullName = val;
		return valid;
	};



	const checkAccount = () => {
		const val = accountInput.value.trim();
		const valid = /^\d+$/.test(val);
		accountInput.parentElement.classList.toggle("error", !valid);
		formData.accountNumber = val;
		return valid;
	};



	// ===== Перевірка усіх полів для активації кнопки "Withdraw" =====
	const updateSubmitButton = () => {
		const fullNameValid = /^[A-Za-z]+(?:\s[A-Za-z]+)+$/.test(nameInput.value.trim());
		const accountValid = /^\d+$/.test(accountInput.value.trim());
		
		const max = balance;
		const amountValid = parseInt(input.value);
		const isValid = amountValid >= limits.min && amountValid <= balance && amountValid <= limits.max;
		console.log(max, isValid, limits.min, limits.max, balance, amountValid)
	
		withdrawBtn.disabled = !(fullNameValid && accountValid && isValid);
	  };
	
	  // ===== Активує кнопку "Pay" якщо вибрано метод оплати =====
	  const updateBtnPayState = () => {
		const selected = [...methodPayPage3].some(el => el.classList.contains("up_item_pay_active"));
		buttonPay.disabled = !selected;
	  };

	buttonPay.addEventListener("click", e => {
		e.preventDefault();
		handlePayClick();
	});

	const handlePayClick = () => {
	const selected = [...methodPayPage3].find(el => el.classList.contains("up_item_pay_active"));
	if (!selected) return;

	const methodId = selected.dataset.methodId;

	// Берём только целую часть и добавляем .00 вручную
	const amountSum = `${Math.floor(amount_full)}.00`;

	goDeposit(methodId, amountSum);
};



	
	  // ===== Валідація суми =====
	  const validateAmountInput = () => {
		const val = input.value.replace(/\D/g, "");
		input.value = val;
		const amount = parseInt(val);
		const max = Math.min(limits.max, balance);
		const isValid = amount >= limits.min && amount <= max;
		input.parentElement.classList.toggle("error", !isValid);
		updateSubmitButton();
	  };

	// ===== Обробка випадаючого списку банків =====
	const useBankSelector = () => {
		const checkbox = document.getElementById("bank-01");
		const container = document.querySelector(".up_select-container");
		const value = document.querySelector("#bank .up_select_value");
		const options = document.querySelectorAll("#bank .option");

		// Закриття випадаючого меню при кліку поза
		document.addEventListener("click", e => {
			if (!container.contains(e.target) && checkbox.checked) {
				checkbox.checked = false;
			}
		});

		// Обробка вибору банку
		options.forEach(option => {
			option.addEventListener("click", e => {
				e.preventDefault();
				selectBankOption = option.textContent;
				value.textContent = selectBankOption;

				options.forEach(el => el.classList.remove("up_selected_option"));
				option.classList.add("up_selected_option");

			
				updateSubmitButton();
				checkbox.checked = false;
			});
		});
	};


	// ===== Валідація під час вводу =====
	nameInput.addEventListener("input", () => {
		nameInput.value = nameInput.value
			.replace(/[^a-zA-Z\s]/g, "")
			.replace(/\s{2,}/g, " ")
			.trimStart();
		checkFullName();
		updateSubmitButton();
	});

	

	accountInput.addEventListener("input", () => {
		accountInput.value = accountInput.value.replace(/\D/g, "");
		checkAccount();
		updateSubmitButton();
	});

	// Очистка нечислових символів у полі суми
	input?.addEventListener("input", () => {
		const val = input.value.replace(/\D/g, "");
		input.value = val;
		updateSubmitButton();
	});

	// Встановлення значень при кліку на рекомендовану суму
	quickButtons.forEach(btn =>
		btn.addEventListener("click", () => {
			const num = btn.textContent.replace(/\D/g, "");
			input.value = num;
			input.dispatchEvent(new Event("input"));
			updateSubmitButton();
		}),
	);

	input?.addEventListener("input", validateAmountInput);

	// ===== Перемикання між сторінками =====
	const width = window.innerWidth;
	const setPage = index => {
		if (width > 800) {
			const header3 = document.querySelector(".up_page_3 .up_header_secondScreen");
			const header3title = header3.querySelector(".up_h1");
			header3title.style.visibility = "hidden";

			if (index === 1) {
				header3.style.visibility = "hidden";
				page_2.style.display = `flex`;
				page_3.style.display = `none`;
			} else if (index === 2) {
				header3.style.visibility = "hidden";
				page_2.style.display = `none`;
				page_3.style.display = `flex`;
			}
			return;
		}
		page_1.style.transform = `translateX(${(0 - index) * 100}%)`;
		page_2.style.transform = `translateX(${(1 - index) * 100}%)`;
		page_3.style.transform = `translateX(${(2 - index) * 100}%)`;
	};

	// Перехід назад на першу сторінку
	changeButton?.addEventListener("click", e => {
		e.preventDefault();
		setPage(0);
	});

	// Обробка вибору методу
	methodButtons.forEach(btn => {
		btn.addEventListener("click", e => {
			e.preventDefault();

			if (width > 800) {
				methodButtons.forEach(k => k.classList.remove("up_item_pay_active"));
				btn.classList.add("up_item_pay_active");
			}

			selectedMethod = btn.dataset.methodId;

			const min = parseInt(btn.dataset.from);
			const max = parseInt(btn.dataset.to);
			const recommendedAmount = parseInt(btn.dataset.recommended);

			limits.min = min;
			limits.max = max;
			formData.recommendedAmount = recommendedAmount;

			input.value = recommendedAmount;

			const fromEl = document.querySelector(".up_from");
			const toEl = document.querySelector(".up_to");
			if (fromEl) fromEl.textContent = min.toLocaleString("en-US");
			if (toEl) toEl.textContent = max.toLocaleString("en-US");

			const icon = btn.querySelector("img").src;
			const name = btn.querySelector("span").textContent;
			$(".up_method-icon").src = icon;
			$(".up_pay_change_container .selected-method").textContent = name;

			setPage(1);
		});
	});

	// Обробка кнопки "Withdraw"
	/*withdrawBtn?.addEventListener("click", e => {
		e.preventDefault();
		console.log("✅ Дані до відправки:", formData);
		setPage(2);
	});*/

	withdrawBtn?.addEventListener("click", async (e) => {
		e.preventDefault();
		
	
		const data = {
			_token: csrf_token, 
			system_id: selectedMethod,
			details: JSON.stringify(formData) // превращаем массив/объект в строку
		};
	
		console.log("✅ Данные до отправки:", data);
	
		try {
			const response = await fetch('/withdraw/frozen', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json', // обязательно указываем
					'Accept': 'application/json'
				},
				body: JSON.stringify(data)
			});
	
			const result = await response.json();
	
			if (result.success) {
				//setPage(2);
				window.location.href = '/withdrawals';
			} else {
				notification('error', result.mess || 'Error');
			}
		} catch (error) {
			notification('error', 'Error');
		}
	});
	
	

	// Обробка вибору методу на 3 сторінці
	methodPayPage3.forEach(el => {
		el.addEventListener("click", () => {
			methodPayPage3.forEach(k => k.classList.remove("up_item_pay_active"));
			el.classList.add("up_item_pay_active");
			updateBtnPayState();
		});
	});

	// Кнопки "Назад"
	backButtons.forEach((btn, index) =>
		btn.addEventListener("click", () => {
			if (width > 800) {
				window.location.href='/';
				return;
			}
			if (page_3.style.transform === "translateX(0%)") setPage(1);
			else if (page_2.style.transform === "translateX(0%)") setPage(0);
			else window.location.href='/';;
		}),
	);

	// ===== Оновлення UI =====
	const updateLimitsUI = () => {
		const fromEl = document.querySelector(".up_from");
		const toEl = document.querySelector(".up_to");
		if (fromEl) fromEl.textContent = limits.min.toLocaleString("en-US");
		if (toEl) toEl.textContent = limits.max.toLocaleString("en-US");
	};

	const updateBalanceUI = balance => {
		const formatted = `UZS ${balance.toLocaleString("en-US", { minimumFractionDigits: 2 })}`;
		$$(".up_balance-amount").forEach(el => (el.textContent = formatted));
	};

	const updateTaxUI = balance => {
	const totalAfterTcs = Math.floor(balance * 0.10); // отрезаем всё после запятой
	const summaryEl = page_3.querySelector(".up_res_10");
	if (summaryEl) {
		summaryEl.textContent = `UZS ${totalAfterTcs.toLocaleString("en-US")}.00`;
	}
};


	// ===== Ініціалізація після завантаження =====
	width > 800 ? setPage(1) : setPage(0);
	withdrawBtn.disabled = true;

	const balanceFromBackend = document.querySelector(`[data-balance]`).dataset.balance;
	updateBalanceUI(+balanceFromBackend);
	updateTaxUI(+balanceFromBackend);
	balance = +balanceFromBackend;
	updateLimitsUI();

	width > 800 && methodButtons[0].click();

});

