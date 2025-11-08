//перевірка завантаження ресурсів (зображень)
function checkImagesLoaded(callback) {
	const images = Array.from(document.images);
	if (images.length === 0) return callback();

	let loaded = 0;

	images.forEach(img => {
		if (img.complete) {
			loaded++;
			if (loaded === images.length) callback();
		} else {
			img.addEventListener("load", () => {
				loaded++;
				if (loaded === images.length) callback();
			});
			img.addEventListener("error", () => {
				loaded++;
				if (loaded === images.length) callback();
			});
		}
	});
}

checkImagesLoaded(() => {
	const el = document.querySelector(".loading");
	el.style.display = "none";
});

//копіюємо текст
document.addEventListener("click", function (e) {
	const target = e.target.closest(".copy");
	if (!target) return;

	const text = target.textContent.trim();

	navigator.clipboard
		.writeText(text)
		.then(() => {
			console.log("Текст скопійовано:", text);
			const tooltipBasic = document.querySelector(".tooltipBasic");
			tooltipBasic.style.opacity = "1";
			setTimeout(() => {
				tooltipBasic.style.opacity = "0";
			}, 2000);
		})
		.catch(err => {
			console.error("Не вдалося скопіювати:", err);
		});
});

//анімація прогресбару
const animateProgress = () => {
	const element = document.querySelector(".complete");
	const progressValue = parseFloat(element.dataset.progress);
	const textEl = element.querySelector("span");
	const progressLine = element.querySelector(".progressLine");

	let current = 0;
	const duration = 3000;
	const start = performance.now();

	function step(timestamp) {
		const elapsed = timestamp - start;
		const progress = Math.min(elapsed / duration, 1);
		current = progressValue * progress;

		textEl.textContent = current.toFixed(2);
		progressLine.style.width = `${current}%`;

		if (progress < 1) {
			requestAnimationFrame(step);
		}
	}

	requestAnimationFrame(step);
};

animateProgress();

//обираємо пейдж який показати
const showOnly = targetClass => {
	const allClasses = ["register", "deposit", "play"];

	allClasses.forEach(className => {
		const elements = document.querySelectorAll(`.${className}`);
		elements.forEach(el => {
			if (className === targetClass) {
				el.style.display = "block"; // або 'flex', якщо треба
			} else {
				el.style.display = "none";
			}
		});
	});
};

showOnly("play");
