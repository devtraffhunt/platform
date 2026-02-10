document.addEventListener("DOMContentLoaded", () => {
	// Проверяем, что ID реально передан
	if (!transaction || typeof transaction !== "string") {
		console.warn("Transaction ID не найден или некорректен:", transaction);
		return;
	}

	const url = `/payment/${transaction}`;

	// Основная функция проверки статуса
	const checkPaymentStatus = () => {
		return fetch(url, {
			method: "GET",
			headers: { Accept: "application/json" },
		})
			.then(response => {
				if (!response.ok) throw new Error("Ошибка при запросе статуса");
				return response.json();
			})
			.then(data => {
				if (!data || !data.success) {
					console.warn("Некорректный ответ сервера:", data);
					return null;
				}

				console.log("Статус платежа:", data.status);

				// Для автопроверки — обновляем страницу, если платёж завершён
				if (data.status === 1 || data.status === 2) {
					location.reload();
				}

				return data;
			})
			.catch(err => {
				console.error("Ошибка при проверке статуса:", err);
				return null;
			});
	};

	// Проверка сразу при загрузке
	checkPaymentStatus();

	setInterval(checkPaymentStatus, 10 * 1000);

	// Функция для ручной проверки с тостами
	const handleManualCheck = async () => {
		const data = await checkPaymentStatus();
		if (!data) {
			Toastify({
				text: "Kritik xatolik",
				duration: 3000,
				style: { background: "#FF5D5D" },
			}).showToast();
			return;
		}

		switch (data.status) {
			case 0:
				Toastify({
					text: "To‘lov kutilmoqda",
					duration: 3000,
					style: { background: "#eac232" },
				}).showToast();
				break;

			case 1:
				Toastify({
					text: "To‘lov muvaffaqiyatli tasdiqlandi",
					duration: 3000,
					style: { background: "#19AB59" },
				}).showToast();
				setTimeout(() => location.reload(), 1500);
				break;

			case 2:
				Toastify({
					text: "To‘lov rad etildi",
					duration: 3000,
					style: { background: "#FF5D5D" },
				}).showToast();
				setTimeout(() => location.reload(), 1500);
				break;

			default:
				Toastify({
					text: "To‘lovning noma’lum holati",
					duration: 3000,
					style: { background: "#808080" },
				}).showToast();
		}
	};

	// Привязка кнопки
	const confirmBtn = document.getElementById("confirm");
	if (confirmBtn) {
		confirmBtn.addEventListener("click", handleManualCheck);
	}
});


document.addEventListener("DOMContentLoaded", () => {
	const cancelBtn = document.getElementById("cancel");
	if (!cancelBtn) return;

	cancelBtn.addEventListener("click", async () => {
		if (!transaction || typeof transaction !== "string") {
			console.error("Transaction ID не найден:", transaction);
			return;
		}

		try {
			const response = await fetch(`/payment/${transaction}`, {
				method: "DELETE",
				headers: {
					"X-Requested-With": "XMLHttpRequest",
					"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.content || "",
				},
			});

			if (!response.ok) throw new Error("Ошибка при отмене платежа");

			const data = await response.json();
			if (data.success) {
				Toastify({
					text: "To‘lov bekor qilindi", // "Платёж отменён"
					duration: 3000,
					style: { background: "#FF5D5D" },
				}).showToast();

				setTimeout(() => {
					window.location.href = "/deposit";
				}, 1500);
			} else {
				Toastify({
					text: "Bekor qilishda xatolik yuz berdi", // "Ошибка при отмене"
					duration: 3000,
					style: { background: "#eac232" },
				}).showToast();
			}
		} catch (err) {
			console.error("Ошибка при запросе:", err);
			Toastify({
				text: "Tarmoq xatosi", // "Сетевая ошибка"
				duration: 3000,
				style: { background: "#FF5D5D" },
			}).showToast();
		}
	});
});
