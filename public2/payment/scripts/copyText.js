function copyDataAttributeById(id) {
	const el = document.getElementById(id);
	if (!el) {
		console.warn(`Елемент з id="${id}" не знайдено`);
		return;
	}

	const textToCopy = el.getAttribute("data-copy");
	if (!textToCopy) {
		console.warn(`Атрибут data-copy відсутній у елементі #${id}`);
		return;
	}

	const textarea = document.createElement("textarea");
	textarea.value = textToCopy;

	textarea.style.position = "fixed";
	textarea.style.opacity = "0";
	document.body.appendChild(textarea);
	textarea.focus();
	textarea.select();

	try {
		document.execCommand("copy");
		Toastify({ text: "Copied!", duration: 3000 }).showToast();
	} catch (err) {
		console.error("Помилка копіювання:", err);
	}

	document.body.removeChild(textarea);
}
