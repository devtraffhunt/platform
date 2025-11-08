function startTimer(selector) {
	const el = document.querySelector(selector);
	if (!el) {
		console.warn(`Елемент ${selector} не знайдено`);
		return;
	}

	// Витягуємо час у форматі mm:ss
	const [minStr, secStr] = el.textContent.trim().split(":");
	let totalSeconds = parseInt(minStr, 10) * 60 + parseInt(secStr, 10);

	const updateTimer = () => {
		if (totalSeconds <= 0) {
			el.textContent = "00:00";
			clearInterval(interval);
			return;
		}

		totalSeconds--;

		const minutes = String(Math.floor(totalSeconds / 60)).padStart(2, "0");
		const seconds = String(totalSeconds % 60).padStart(2, "0");

		el.textContent = `${minutes}:${seconds}`;
	};

	updateTimer(); // одразу оновити перший раз
	const interval = setInterval(updateTimer, 1000);
}
