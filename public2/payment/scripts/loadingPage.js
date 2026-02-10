const page = document.body.dataset.page;
const selectorMap = {
	payment: ["#timer", "#amountInput", "#emailInput"],
	declined: ["#externalId", "#userId", "#id", "#cash"],
	successful: ["#externalId", "#userId", "#id", "#cash"],
};

function showLoader() {
	const loader = document.getElementById("loader");
	if (loader) loader.style.display = "flex";
}

function hideLoader() {
	const loader = document.getElementById("loader");
	if (loader) loader.style.display = "none";
}

function waitForImages() {
	const images = Array.from(document.images);
	const unloaded = images.filter(img => !img.complete);

	if (unloaded.length === 0) {
		return Promise.resolve();
	}

	return Promise.all(
		unloaded.map(img => {
			return new Promise(resolve => {
				img.addEventListener("load", resolve, { once: true });
				img.addEventListener("error", resolve, { once: true }); // навіть при помилці продовжуємо
			});
		}),
	);
}

function waitForFonts() {
	if (document.fonts && document.fonts.ready) {
		return document.fonts.ready;
	}
	return Promise.resolve();
}

function waitForContent(selectors = [], timeout = 60000, interval = 200) {
	return new Promise((resolve, reject) => {
		if (!selectors.length) {
			resolve();
			return;
		}

		const start = Date.now();

		const check = () => {
			const allReady = selectors.every(selector => {
				const el = document.querySelector(selector);
				if (!el) return false;

				if (el instanceof HTMLInputElement || el instanceof HTMLTextAreaElement) {
					return el.value.trim().length > 0;
				}

				return el.textContent.trim().length > 0;
			});

			if (allReady) {
				resolve();
			} else if (Date.now() - start > timeout) {
				reject(new Error("Таймаут очікування контенту"));
			} else {
				setTimeout(check, interval);
			}
		};

		check();
	});
}

function waitUntilEverythingIsLoaded(selectors = []) {
	showLoader();

	const waitForDOMReady = new Promise(res => {
		if (document.readyState === "complete") {
			res();
		} else {
			window.addEventListener("load", res, { once: true });
		}
	});

	Promise.all([waitForDOMReady, waitForFonts(), waitForImages()])
		.then(() => waitForContent(selectors))
		.then(() => {
			hideLoader();
			startTimer("#timer");
			console.log("Complite!");
		})
		.catch(err => {
			console.warn(err.message);
			hideLoader();
		});
}

waitUntilEverythingIsLoaded(selectorMap[page] || []);

// showLoader();
// hideLoader();
