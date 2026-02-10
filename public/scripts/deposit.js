document.addEventListener("DOMContentLoaded", () => {
	const query = selector => document.querySelector(selector);
	const queryAll = selector => document.querySelectorAll(selector);


	const elements = {
		wrapper: query(".screenWrapper"),
		itemPays: queryAll("#methodsWindow .up_item_pay"),
		backButtons: queryAll("#methodsWindow .up_back_button, #topupWindow .up_back_button"),
		changeButton: query("#topupWindow .up_pay_change_button"),
		howToBtn: query("#howToBtn"),
		depositBtn: query("#depositBtn"),
		selImg: query("#topupWindow .up_pay_change_method img"),
		selSpan: query("#topupWindow .selected-method"),
		amountInput: query("#amountInput"),
		amountGroup: query("#amountGroup"),
		presetBtns: queryAll(".up_amounts_select_item"),
		promoInput: query("#promoInput"),
		promoGroup: query("#promoGroup"),
		bonusText: query("#bonusText"),
		totalText: query("#totalText"),
		from: query(`.up_from`),
		to: query(`.up_to`),
		videoContainer: query("#up_video_container"),
		video: query("#up_video"),
	};

	let state = {
		selectedMethodId: null,
		selectedMethodName: null,
		bonusPercent: 0,
		//суми
		recommended: 0,
		from: 0,
		to: 0,
		promo: null,
	};

	// Форматує число з пробілами для відображення
	const formatNum = n => n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");

	// Підрахунок бонусу і загальної суми з урахуванням бонусу
	const updateBonusAndTotal = () => {
		const amount = parseInt(elements.amountInput.value, 10) || 0;
		const total = Math.floor(amount * (1 + state.bonusPercent / 100));
		elements.bonusText.textContent = `BONUS ${state.bonusPercent}%`;
		elements.totalText.textContent = `TOTAL ₹ ${formatNum(total)}`;
	};

	// Перевірка введеної суми і активація кнопки депозиту
	const validateAmount = () => {
		elements.amountGroup.classList.remove("error");
		let v = elements.amountInput.value.replace(/\D/g, "");
		elements.amountInput.value = v;
		const num = parseInt(v, 10);

		if (num >= state.from && num <= state.to) {
			elements.depositBtn.disabled = false;
		} else {
			elements.depositBtn.disabled = true;
			elements.amountGroup.classList.add("error");
		}
		updateBonusAndTotal();
	};

	// Перевірка промокоду і оновлення бонусу
	const validatePromo = () => {
		 const code = elements.promoInput.value.trim().toUpperCase();
		 state.promo = code;
		 if (code === "WELCOME") {
		   state.bonusPercent = 500;
		   elements.promoGroup.classList.remove("error");
		 } else {
		   state.bonusPercent = 0;
		   elements.promoGroup.classList.toggle("error", code.length > 0);
		 }
		updateBonusAndTotal();
	};

	// Обробка вибору платіжного методу
	const onMethodSelect = el => {
		elements.itemPays.forEach(e => e.classList.remove("up_item_pay_active"));
		el.classList.add("up_item_pay_active");

		state.selectedMethodId = el.dataset.methodId;
		state.selectedMethodName = el.dataset.methodName;

		elements.selImg.src = el.querySelector("img").src;
		elements.selSpan.textContent = state.selectedMethodName;

		// Отримуємо значення з дата-атрибутів
		const from = parseInt(el.dataset.from, 10);
		const to = parseInt(el.dataset.to, 10);
		const recommended = parseInt(el.dataset.recommended, 10);

		// Передаємо у setDepositData
		setDepositData({ from, to, recommended });

		elements.wrapper.classList.add("show-topup");
		validateAmount();
		validatePromo();
	};

	// Скидання стану форми при поверненні на вибір методу
	const resetToMethodScreen = () => {
		elements.wrapper.classList.remove("show-topup");
		elements.amountGroup.classList.remove("error");
		elements.promoGroup.classList.remove("error");
		elements.amountInput.value = state.recommended;
		elements.promoInput.value = "";
		state.bonusPercent = 0;
		updateBonusAndTotal();
		elements.depositBtn.disabled = true;
	};

	// Обробка натискання на швидкі суми
	const onPresetClick = btn => {
		const num = btn.textContent.replace(/\D/g, "");
		elements.amountInput.value = num;
		validateAmount();
	};


	// Клік по "How to deposit?" — показ інформації в консолі
	const handleHowToClick = () => {
		if (!state.selectedMethodId) return alert("Сначала выберите метод оплаты");
		if (elements.depositBtn.disabled) return alert(`Сумма должна быть не менее ${state.from}`);

		console.log("How to deposit?", {
			method: state.selectedMethodName,
			amount: elements.amountInput.value,
			bonus: `${state.bonusPercent}%`,
			total: elements.totalText.textContent,
		});
	};

	// Клік по "Deposit" — показ даних в консолі
	const handleDepositClick = () => {
		if (!state.selectedMethodId) return;

		goDeposit(state.selectedMethodId, elements.amountInput.value, state.promo)
	};

	//встановлюємо дані
	const setDepositData = data => {
		state = { ...state, ...data };
		elements.from.textContent = data.from;
		elements.to.textContent = data.to;
		elements.amountInput.value = data.recommended;
	};

	//Доступний баланс
	const updateBalanceUI = balance => {
		const formatted = `₹ ${balance.toLocaleString("en-EN", { minimumFractionDigits: 2 })}`;
		const balanceEls = document.querySelectorAll(".up_balance-amount");
		balanceEls.forEach(el => {
			el.textContent = formatted;
		});
	};

	// Події
	elements.itemPays.forEach(el =>
		el.addEventListener("click", e => {
			e.preventDefault();
			onMethodSelect(el);
		}),
	);

	[...elements.backButtons, elements.changeButton].forEach(btn =>
		btn.addEventListener("click", e => {
			e.preventDefault();
			resetToMethodScreen();
		}),
	);

	elements.presetBtns.forEach(btn => btn.addEventListener("click", () => onPresetClick(btn)));

	elements.amountInput.addEventListener("input", validateAmount);
	elements.promoInput.addEventListener("input", validatePromo);

	elements.howToBtn.addEventListener("click", e => {
		e.preventDefault();
		handleHowToClick();
	});

	elements.depositBtn.addEventListener("click", e => {
		e.preventDefault();
		handleDepositClick();
	});

	// Початкова ініціалізація значень, якщо ширина екрану > 800
	if (window.innerWidth > 800 && elements.itemPays.length > 0) {
		onMethodSelect(elements.itemPays[0]);
	}
	updateBonusAndTotal();
	validateAmount();
});
