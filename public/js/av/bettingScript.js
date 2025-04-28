// 1. Налаштування ставок
const BET_CONFIG = {
	left: { min: 10, max: 99000, step: 1, speeds: [100, 200, 500, 1000] },
	right: { min: 10, max: 99000, step: 1, speeds: [100, 200, 500, 1000] },
};

// 2. Форматування до en-US з двома десятковими
function formatNumberToEN(number, digits = 2) {
	return new Intl.NumberFormat("en-US", {
		minimumFractionDigits: digits,
		maximumFractionDigits: digits,
	}).format(Number(number));
}

// 3. Налаштування поля вводу та оновлення кнопки при blur
function setupBetInput(inputEl, buttonEl, minValue, maxValue, position) {
	// лише цифри і одна крапка
	inputEl.addEventListener("input", e => {
		let v = e.target.value.replace(/[^0-9.]/g, "");
		const parts = v.split(".");
		if (parts.length > 2) {
			v = parts[0] + "." + parts.slice(1).join("").replace(/\./g, "");
		}
		if (e.target.value !== v) e.target.value = v;
	});

	// при втраті фокусу — обрізка по межах і оновлення span
	inputEl.addEventListener("blur", e => {
		let v = parseFloat(e.target.value);
		if (isNaN(v) || v < minValue) v = minValue;
		if (v > maxValue) v = maxValue;
		const formatted = v.toFixed(2);
		e.target.value = formatted;

		const span = buttonEl.querySelector(`.av_${position}_buttonBet`);
		if (span) span.textContent = formatNumberToEN(formatted);
	});
}

// 4. Ініціалізація швидкісних кнопок (з правильним скиданням для першого кліку)
function initSpeedButtons(inputEl, speedBtns, buttonEl, maxValue, position) {
	let lastBtn = null;
	speedBtns.forEach(btn => {
		btn.addEventListener("click", () => {
			// при першому кліку або при зміні кнопки — скидаємо в 0
			if (!lastBtn || lastBtn !== btn) {
				inputEl.value = "0.00";
			}
			const curr = parseFloat(inputEl.value) || 0;
			const add = parseFloat(btn.textContent) || 0;
			let nv = curr + add;
			if (nv > maxValue) nv = maxValue;
			const formatted = nv.toFixed(2);
			inputEl.value = formatted;

			const span = buttonEl.querySelector(`.av_${position}_buttonBet`);
			if (span) span.textContent = formatNumberToEN(formatted);

			lastBtn = btn;
		});
	});
}

// 5. Ініціалізація кнопок + і –
function initIncrementDecrement(
	inputEl,
	plusBtn,
	minusBtn,
	step,
	buttonEl,
	minValue,
	maxValue,
	position,
) {
	const change = delta => {
		let curr = parseFloat(inputEl.value) || 0;
		let nv = curr + delta;
		if (nv > maxValue) nv = maxValue;
		if (nv < minValue) nv = minValue;
		const formatted = nv.toFixed(2);
		inputEl.value = formatted;

		const span = buttonEl.querySelector(`.av_${position}_buttonBet`);
		if (span) span.textContent = formatNumberToEN(formatted);
	};

	plusBtn.addEventListener("click", () => change(step));
	minusBtn.addEventListener("click", () => change(-step));
}

// 6. Функція для зміни стану кнопки Bet
function changeButtonBet(position, state) {
	const cfg = BET_CONFIG[position];
	const button = document.querySelector(`.av_buttonBet_${position}`);
	const inputEl = document.getElementById(`av_${position}Input`);

	if (state === "basic") {
		button.classList.remove("av_buttonBet_danger", "av_buttonBet_warning");
		button.innerHTML = `
      <span>Bet</span>
      <span>
        <span class="av_${position}_buttonBet">${formatNumberToEN(inputEl.value)}</span>
        <span class="av_usd">INR</span>
      </span>
    `;
		const speedBtns = cfg.speeds.map(v => document.getElementById(`${position}ButtonSpeed_${v}`));
		const plusBtn = document.getElementById(`${position}ButtonIncrement`);
		const minusBtn = document.getElementById(`${position}ButtonDecrement`);
		// повторна ініціалізація логіки
		initSpeedButtons(inputEl, speedBtns, button, cfg.max, position);
		initIncrementDecrement(
			inputEl,
			plusBtn,
			minusBtn,
			cfg.step,
			button,
			cfg.min,
			cfg.max,
			position,
		);
	} else if (state === "danger") {
		button.classList.remove("av_buttonBet_warning");
		button.classList.add("av_buttonBet_danger");
		button.innerHTML = `<span>Cancel</span>`;
	} else if (state === "warning") {
		button.classList.remove("av_buttonBet_danger");
		button.classList.add("av_buttonBet_warning");
		button.innerHTML = `
      <span>Cash Out</span>
      <span>
        <span class="av_${position}_buttonBet">${formatNumberToEN(inputEl.value)}</span>
        <span class="av_usd">INR</span>
      </span>
    `;
		const speedBtns = cfg.speeds.map(v => document.getElementById(`${position}ButtonSpeed_${v}`));
		const plusBtn = document.getElementById(`${position}ButtonIncrement`);
		const minusBtn = document.getElementById(`${position}ButtonDecrement`);
		// повторна ініціалізація логіки
		initSpeedButtons(inputEl, speedBtns, button, cfg.max, position);
		initIncrementDecrement(
			inputEl,
			plusBtn,
			minusBtn,
			cfg.step,
			button,
			cfg.min,
			cfg.max,
			position,
		);
	}
}

// 7. Автоматична ініціалізація для обох панелей
["left", "right"].forEach(position => {
	const cfg = BET_CONFIG[position];
	const inputEl = document.getElementById(`av_${position}Input`);
	const buttonEl = document.querySelector(`.av_buttonBet_${position}`);
	const plusBtn = document.getElementById(`${position}ButtonIncrement`);
	const minusBtn = document.getElementById(`${position}ButtonDecrement`);
	const speedBtns = cfg.speeds.map(v => document.getElementById(`${position}ButtonSpeed_${v}`));

	setupBetInput(inputEl, buttonEl, cfg.min, cfg.max, position);
	initIncrementDecrement(
		inputEl,
		plusBtn,
		minusBtn,
		cfg.step,
		buttonEl,
		cfg.min,
		cfg.max,
		position,
	);
	initSpeedButtons(inputEl, speedBtns, buttonEl, cfg.max, position);
});

function setWarningAmount(position, amount) {
	// находим саму кнопку и span с суммой
	const button = document.querySelector(`.av_buttonBet_${position}`);
	const span = button.querySelector(`.av_${position}_buttonBet`);
	
	// проверяем, что кнопка в состоянии warning
	if (!button.classList.contains('av_buttonBet_warning')) {
	  console.warn(`Кнопка ${position} не в режиме warning — обновление игнорируется.`);
	  return;
	}
	
	// форматируем и подставляем новую сумму
	const formatted = formatNumberToEN(amount);
	span.textContent = formatted;
  }

//changeButtonBet("left", "warning");
