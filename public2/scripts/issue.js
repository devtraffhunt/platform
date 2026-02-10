document.addEventListener("DOMContentLoaded", () => {
	// ===== Утиліти для вибору елементів =====
	const $ = s => document.querySelector(s);
	const $$ = s => document.querySelectorAll(s);


	// ===== Кнопки та елементи взаємодії =====
	const methodPayPage3 = $$(".up_item_pay_other"); // Методи оплати (на 3 сторінці)

	const buttonPay = $("#btn-pay"); // Кнопка "Pay"
	
	let balance = 0; // Баланс користувача
	
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



	
	

	// Обробка вибору методу на 3 сторінці
	methodPayPage3.forEach(el => {
		el.addEventListener("click", () => {
			methodPayPage3.forEach(k => k.classList.remove("up_item_pay_active"));
			el.classList.add("up_item_pay_active");
			updateBtnPayState();
		});
	});


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

