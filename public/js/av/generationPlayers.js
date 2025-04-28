// Масив із шляхами до аватарок (відредагуй за своїми даними)
const avatarList = [
	"img/av/avatars/av-1.png",
	"img/av/avatars/av-2.png",
	"img/av/avatars/av-3.png",
	"img/av/avatars/av-5.png",
	"img/av/avatars/av-6.png",
	"img/av/avatars/av-7.png",
	"img/av/avatars/av-8.png",
	"img/av/avatars/av-9.png",
	"img/av/avatars/av-11.png",
	"img/av/avatars/av-14.png",
	"img/av/avatars/av-15.png",
	"img/av/avatars/av-17.png",
	"img/av/avatars/av-18.png",
	"img/av/avatars/av-19.png",
	"img/av/avatars/av-20.png",
	"img/av/avatars/av-24.png",
	"img/av/avatars/av-33.png",
	"img/av/avatars/av-53.png",
	"img/av/avatars/av-61.png",
	"img/av/avatars/av-62.png",
	"img/av/avatars/av-63.png",
	"img/av/avatars/av-68.png",
];

// Батьківський елемент, в який будемо додавати рядки
const playersContainer = document.getElementById("av_players");

// Змінна для інтервалу, щоб пізніше зупиняти
let rowsInterval = null;

/**
 * Функція, яка створює рядок <div class="row"> із структурою:
 */

function createRandomRow() {
	const row = document.createElement("div");
	row.className = "av_row";

	// Генеруємо випадковий коефіцієнт від 1.15 до 20.00
	const coefficient = (Math.random() * (20 - 1.15) + 1.15).toFixed(2);
	row.dataset.coefficient = coefficient;

	const userDiv = document.createElement("div");
	userDiv.className = "av_user";

	const img = document.createElement("img");
	const randomIndex = Math.floor(Math.random() * avatarList.length);
	img.src = avatarList[randomIndex];
	img.alt = "";

	const nameSpan = document.createElement("span");
	nameSpan.className = "av_name";
	const randomDigit = Math.floor(Math.random() * 10);
	nameSpan.textContent = `d***${randomDigit}`;

	userDiv.appendChild(img);
	userDiv.appendChild(nameSpan);

	const usdtDiv = document.createElement("div");
	usdtDiv.className = "av_usdt";
	usdtDiv.textContent = formatNumberToEN((Math.random() * (10000 - 10) + 10).toFixed(2));

	const xDiv = document.createElement("div");
	xDiv.className = "av_x";

	const winUsdtDiv = document.createElement("div");
	winUsdtDiv.className = "av_winUsdt";

	row.appendChild(userDiv);
	row.appendChild(usdtDiv);
	row.appendChild(xDiv);
	row.appendChild(winUsdtDiv);

	return row;
}

/**
 * Функція очищення контейнера
 */
function clearPlayers() {
	while (playersContainer.firstChild) {
		playersContainer.removeChild(playersContainer.firstChild);
	}
}

/**
 * Функція старту:
 * 1. Очищає #players
 * 2. Створює випадкову кількість рядків (від 67 до 136)
 * 3. Кожну секунду додає від 5 до 13 нових рядків
 */
function startRows() {
	stopRows(); // зупиняємо попередній інтервал, якщо існує
	clearPlayers();

	// Створення початкової кількості рядків (67–136)
	const initialCount = Math.floor(Math.random() * (136 - 38 + 1)) + 38;
	for (let i = 0; i < initialCount; i++) {
		const row = createRandomRow();
		playersContainer.appendChild(row);
	}

	// Додавання нових рядків щосекунди (від 5 до 13)
	rowsInterval = setInterval(() => {
		const count = Math.floor(Math.random() * (13 - 5 + 1)) + 5;
		for (let i = 0; i < count; i++) {
			const row = createRandomRow();
			playersContainer.prepend(row);
		}
	}, 300);
}

/**
 * Функція зупинки додавання рядків
 */
function stopRows() {
	if (rowsInterval) {
		clearInterval(rowsInterval);
		rowsInterval = null;
	}
}

// Функція, що повертає загальну кількість rows у контейнері
function getTotalRows() {
	return playersContainer.childElementCount;
}

// Функція для спостереження за змінами в контейнері "players"
// callback буде викликано щоразу при додаванні або видаленні дочірніх елементів,
// і в нього передається нова кількість рядків
function observeRowsUpdates(callback) {
	const observer = new MutationObserver(mutationsList => {
		// Викликаємо callback з актуальним числом рядків
		if (callback && typeof callback === "function") {
			callback(getTotalRows());
		}
	});

	// Налаштовуємо спостереження за змінами у списку дочірніх елементів
	observer.observe(playersContainer, { childList: true });
	return observer;
}

const totalPlayers = document.getElementById("av_totalPlayers");

// Приклад використання:
const rowsObserver = observeRowsUpdates(totalRows => {
	totalPlayers.textContent = totalRows;
});

const createWinnerUser = (coeff, row) => {
	row.classList.add("av_row_winner");
	const winDiv = row.querySelector(".av_winUsdt");
	const winUSD = row.querySelector(".av_usdt").textContent;
	const x = row.querySelector(".av_x");
	const cleanNum1 = parseFloat(winUSD.replace(/,/g, ""));
	const cleanNum2 = parseFloat(coeff);
  
	const result = cleanNum1 * cleanNum2;
  
	if (!x || x.textContent.trim() !== "") return;
  
	if (winDiv) {
	  const coef = document.createElement("div");
	  coef.className = "av_coeff";
	  coef.textContent = `${coeff.toFixed(2)}x`;
  
	  let targetColor;
  
	  if (coeff < 2) {
		targetColor = [52, 180, 255];
	  } else if (coeff < 10) {
		targetColor = [145, 62, 248];
	  } else if (coeff < 100) {
		targetColor = [192, 23, 180];
	  } else {
		targetColor = [243, 195, 37];
	  }
  
	  coef.style.color = `rgb(${targetColor.join(",")})`;
	  x.appendChild(coef);
  
	  winDiv.textContent = formatNumberToEN(result);
	  winDiv.classList.add("highlight");
	}
  };
  

//Додавання розмітки
function markUsersByCoefficient(targetCoeff, flag = false) {
	const allRows = playersContainer.querySelectorAll(".av_row");

	if (flag) {
		allRows.forEach(row => {
			console.log(row);
			const coeff = parseFloat(row.dataset.coefficient);
			if (coeff < parseFloat(targetCoeff)) {
				createWinnerUser(coeff, row);
			}
		});
		return;
	}

	allRows.forEach(row => {
		const coeff = parseFloat(row.dataset.coefficient);
		if (Math.abs(coeff - parseFloat(targetCoeff)) < 0.001) {
			createWinnerUser(coeff, row);
		}
	});
}

const getOnePortionRows = () => {
	stopRows(); // зупиняємо попередній інтервал, якщо існує
	clearPlayers();

	const initialCount = Math.floor(Math.random() * (136 - 38 + 1)) + 38;
	for (let i = 0; i < initialCount; i++) {
		const row = createRandomRow();
		playersContainer.appendChild(row);
	}
};

// getOnePortionRows();
// markUsersByCoefficient("5", true);

const getAllBetsAv = coeff => {
	if (playersContainer.children.length === 0) {
	  getOnePortionRows();
	  markUsersByCoefficient(coeff, true);
	}
  };
  