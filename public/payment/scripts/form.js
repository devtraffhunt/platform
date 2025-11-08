document.getElementById("amountUTR").addEventListener("input", function (e) {
	this.value = this.value.replace(/\D/g, "");
});

const sendAmount = () => {
	const input = document.getElementById("amountUTR");
	const amount = input.value.trim();

	if (!amount || !/^\d+$/.test(amount)) {
		error("Сannot be empty");
		return;
	}

	fetch("", {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify({ amount }),
	})
		.then(response => {
			if (!response.ok) throw new Error("Помилка від сервера");
			return response.json();
		})
		.then(data => {
			success("success");
		})
		.catch(error => {
			console.error("Помилка:", error);
			success("error");
		});
};

const success = text => {
	Toastify({ text, duration: 3000, style: { background: "#19AB59" } }).showToast();
};
const error = text => {
	Toastify({ text, duration: 3000, style: { background: "#FF5D5D" } }).showToast();
};
const warning = text => {
	Toastify({ text, duration: 3000, style: { background: "#eac232" } }).showToast();
};

document.getElementById("confirm").addEventListener("click", sendAmount);
