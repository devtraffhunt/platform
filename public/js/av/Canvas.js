// ================================
// 1. Ініціалізація та глобальні змінні
// ================================

// Шляхи до зображень літака
const planeFrames = [
	"/img/av/plane-0.svg",
	"/img/av/plane-1.svg",
	"/img/av/plane-2.svg",
	"/img/av/plane-3.svg",
];

// DOM-елементи
const container = document.getElementById("av_gameContainer");
const multiplierEl = document.getElementById("av_multiplier");
const flewAway = document.getElementById("av_flewAway");

// Створення PIXI-додатку
const app = new PIXI.Application({
    resizeTo: container,
    backgroundAlpha: 0,
    antialias: true,
});

container.appendChild(app.view);
app.view.style.zIndex = 1;
app.view.style.display = "none"; // приховуємо канвас до старту гри
app.stage.sortableChildren = true;

// Графічні елементи для траєкторії
const trajectory = new PIXI.Graphics();
const fill = new PIXI.Graphics();

// Глобальні змінні для гри
let loadedResources = null;
let airplane, background;
let glowOverlay = null;
let airplaneTextures = [];
let animationFrame = 0;
let animationTimer = 0;
const animationSpeed = 6;

let points = []; // точки траєкторії
let time = 0; // час для розрахунку траєкторії
let multiplier = 1.01; // стартове значення коефіцієнта, але при старті гри воно скидається на 1.00
const speedX = 3.5;
let drawing = true;
let oscillationTime = 0;
let currentColor = [52, 180, 255]; // стартовий колір для glow

// Стани гри:
// "idle"    – нічого не відбувається
// "loading" – режим завантаження (показується оверлей завантаження)
// "playing" – активна гра
// "stopped" – гра зупинена (літак відлітає, коефіцієнт стає червоним)
let currentState = "idle";

// Змінні для оверлею завантаження
let loadingContainer = null;
let loadingProgressBar = null;

// ================================
// 2. Завантаження ресурсів та налаштування спрайтів
// ================================

const loader = PIXI.Loader.shared;
planeFrames.forEach((frame, index) => loader.add(`plane${index}`, frame, {
    resourceOptions: {
        scale: window.devicePixelRatio // <<< Добиавляем!
    }
}));
loader.add("bg", "img/av/bg-sun.svg", {
    resourceOptions: {
        scale: window.devicePixelRatio // <<< И тут!
    }
});

loader
  .add('loadImage', 'img/av/load.svg', { resourceOptions: { scale: window.devicePixelRatio } })
  .add('vImage', 'img/av/v.svg', { resourceOptions: { scale: window.devicePixelRatio } });

// Функції перетворення розмірів
const scaleValue = (value, min1, max1, min2, max2) => {
	return min1 + ((value - min2) / (max2 - min2)) * (max1 - min1);
};

const calculateSize = (windowWidth, widthRanges, heightRatio) => {
	for (const range of widthRanges) {
		if (windowWidth >= range.min && windowWidth < range.max) {
			const width = range.width ?? scaleValue(windowWidth, ...range.scale, range.min, range.max);
			return {
				width,
				height: (heightRatio * width) / 100,
			};
		}
	}
};

const windowWidth = window.innerWidth;

//функція створення градієнтного шару
function createGlowOverlay(app, color = currentColor) {
	const size = 512; // розмір текстури
	const canvas = document.createElement("canvas");
	canvas.width = size;
	canvas.height = size;

	const ctx = canvas.getContext("2d");
	const gradient = ctx.createRadialGradient(size / 2, size / 2, 0, size / 2, size / 2, size / 2);
	gradient.addColorStop(0, `rgba(${color[0]}, ${color[1]}, ${color[2]}, 0.5)`);
	gradient.addColorStop(0.8, "rgba(0, 0, 0, 0)");
	ctx.fillStyle = gradient;
	ctx.fillRect(0, 0, size, size);

	const texture = PIXI.Texture.from(canvas);
	const sprite = new PIXI.Sprite(texture);

	sprite.anchor.set(0.5);
	sprite.x = app.screen.width / 2;
	sprite.y = app.screen.height / 2;
	sprite.width = app.screen.width * 1.3;
	sprite.height = app.screen.height * 1.3;
	sprite.alpha = 1;
	sprite.zIndex = 0.8;
	sprite.blendMode = PIXI.BLEND_MODES.SCREEN;

	const blurFilter = new PIXI.filters.BlurFilter(0);
	sprite.filters = [blurFilter];

	app.stage.addChild(sprite);
	return sprite;
}

loader.load((loader, resources) => {
    loadedResources = resources;
	// Створення фону гри
	background = new PIXI.Sprite(resources.bg.texture);
	background.anchor.set(0.5, 0.5);
	background.x = 0;
	background.y = app.renderer.height;
	background.width = 3700;
	background.height = 3700;
	background.zIndex = 0;
	app.stage.addChild(background);

	//додаємо ефект світіння
	glowOverlay = createGlowOverlay(app, currentColor);
	glowOverlay.alpha = 0;

	// Налаштування текстур та спрайту літака
	airplaneTextures = planeFrames.map((_, i) => resources[`plane${i}`].texture);
	airplane = new PIXI.Sprite(airplaneTextures[0]);
	airplane.anchor.set(0.15, 0.9);

	// Налаштування розмірів літака залежно від ширини екрану
	const widthRanges = [
		{ min: 0, max: 610, width: 96 },
		{ min: 610, max: 990, scale: [96, 144] },
		{ min: 990, max: 1199, scale: [106.7, 138.7] },
		{ min: 1199, max: 1400, scale: [129.3, 144] },
		{ min: 1400, max: Infinity, width: 144 },
	];
	const { width, height } = calculateSize(windowWidth, widthRanges, 50);
	airplane.width = width;
	airplane.height = height;

	// Коректне накладання об'єктів (zIndex)
	fill.zIndex = 2;
	trajectory.zIndex = 2;
	airplane.zIndex = 2;

	app.stage.addChild(fill);
	app.stage.addChild(trajectory);
	app.stage.addChild(airplane);

	// На початку гри приховуємо усі ігрові об'єкти (режим "idle")
	cancelPlaying();

	// Запускаємо основний цикл анімації
	app.ticker.add(update);

	// Запуск симуляції послідовності подій (від завантаження до зупинки гри)
	//simulateSocketCycle();
});

// ================================
// 3. Основний цикл оновлення (update)
// ================================

function update(delta) {
	if(currentState === "playing") {
		// Анімація обертання фону

		if (background) {
			background.rotation += 0.0015 * delta;
		}

		// Визначення параметрів траєкторії польоту
		const flightDuration = 3; // час польоту
		const targetXPercent = 0.75; // кінцева позиція по X (80% ширини)
		const targetYPercent = 0.2; // кінцева позиція по Y (20% висоти)
		const totalFrames = flightDuration * 60;
		const startX = 0;
		const startY = container.clientHeight; // старт знизу контейнера
		const targetX = app.renderer.width * targetXPercent;
		const targetY = container.clientHeight * targetYPercent;
		const curveStrength = 300; // вигин траєкторії

		// Функція для easeInExpo
		function easeInExpoFixed(t, strength = 4) {
			const min = Math.pow(2, -strength);
			const max = 1;
			const raw = Math.pow(2, strength * (t - 1));
			return (raw - min) / (max - min);
		}

		// Розрахунок траєкторії: малюємо криву або здійснюємо коливання
		if (drawing) {
			time += delta;
			const t = Math.min(time / totalFrames, 1);
			const newX = startX + (targetX - startX) * t;
			const progress = easeInExpoFixed(t);
			const newY = startY + (targetY - startY) * progress;
			points.push({ x: newX, y: newY });

			if (time >= totalFrames) {
				drawing = false;
				oscillationTime = 0;
				// Запам'ятовуємо початкові координати для подальших коливань
				points.forEach(p => {
					p.oy = p.y;
					p.ox = p.x;
				});
			}
		} else {
			// Коливання траєкторії після завершення малювання
			oscillationTime += delta / 30;
			const angle = Math.PI / 4;
			const baseOscillation = Math.sin(oscillationTime) * 30;
			const offsetX = Math.cos(angle) * baseOscillation;
			const offsetY = Math.sin(angle) * baseOscillation;

			// Застосовуємо корекцію до точок траєкторії
			points[0].x = points[0].ox;
			points[0].y = points[0].oy;
			for (let i = 1; i < points.length; i++) {
				const factor = i / (points.length - 1);
				points[i].x = points[i].ox + offsetX * factor;
				points[i].y = points[i].oy + offsetY * factor;
			}
		}
		if (points.length > 10000) points.shift();
		drawPath();

		// Переміщення літака по останній точці траєкторії
		const last = points[points.length - 1];
		if (last) {
			airplane.x = last.x;
			airplane.y = last.y;
		}
		// Анімація кадрів літака
		animationTimer += delta;
		if (animationTimer >= animationSpeed) {
			animationTimer = 0;
			animationFrame = (animationFrame + 1) % airplaneTextures.length;
			airplane.texture = airplaneTextures[animationFrame];
		}
	} else if (currentState === "stopped") {
		// Режим "stopped": літак відлітає вправо, очищається траєкторія
		const exitSpeed = 20;
		airplane.x += exitSpeed * delta;
		trajectory.clear();
		fill.clear();
	}
	// У режимі "loading" оновлення ігрових об'єктів не проводиться
}

// Функція малювання траєкторії
function drawPath() {
	trajectory.clear();
	fill.clear();
	trajectory.lineStyle(4, 0xe50439, 1);
	fill.beginFill(0xff0000, 0.4);
	if (points.length < 2) return;
	trajectory.moveTo(points[0].x, points[0].y);
	fill.moveTo(points[0].x, app.renderer.height);
	for (let p of points) {
		trajectory.lineTo(p.x, p.y);
		fill.lineTo(p.x, p.y);
	}
	const last = points[points.length - 1];
	fill.lineTo(last.x, app.renderer.height);
	fill.lineTo(points[0].x, app.renderer.height);
	fill.endFill();
}

// ================================
// 4. Допоміжні функції (утиліти)
// ================================

// Лінійна інтерполяція для плавної зміни кольору
function lerp(a, b, t) {
	return a + (b - a) * t;
}

// Оновлення відображення коефіцієнта в режимі гри
function updateGameWithCoefficient(newCoefficient) {
	multiplier = newCoefficient;
	multiplierEl.innerText = multiplier.toFixed(2) + "x";

	// Зміна кольору залежно від значення коефіцієнта
	let targetColor;
	if (multiplier < 2) targetColor = [52, 180, 255];
	else if (multiplier < 10) targetColor = [145, 62, 248];
	else if (multiplier < 100) targetColor = [192, 23, 180];
	else targetColor = [243, 195, 37];

	currentColor = currentColor.map((c, i) => lerp(c, targetColor[i], 0.05));
	const [r, g, b] = currentColor.map(Math.round);

	if (glowOverlay) {
		const hex = (r << 16) + (g << 8) + b;
		// перегенеруємо текстуру з новим кольором
		app.stage.removeChild(glowOverlay);
		glowOverlay.destroy(true);

		glowOverlay = createGlowOverlay(app, [r, g, b]);
	}
}

// ================================
// 5. Логіка ігрових етапів
// ================================

// --- Етап 1: Завантаження ---
// Відображення оверлею завантаження, прогрес-бар та супровідні зображення
function startLoadingBar() {
	if (loadingContainer) {
        app.stage.removeChild(loadingContainer);
        loadingContainer.destroy({ children: true });
        loadingContainer = null;
        loadingProgressBar = null; // !!! Обнуляем прогресс-бар
    }

	startRows();
	currentState = "loading";
	// Ховаємо ігрові об'єкти
	if (airplane) {
		airplane.visible = false;
		airplane.alpha = 0;
	}
	trajectory.visible = false;
	fill.visible = false;
	multiplierEl.style.display = "none";
	multiplierEl.style.visibility = "hidden";

	app.view.style.display = "block";

	trajectory.clear();
	fill.clear();

	// Створення контейнера завантаження
	loadingContainer = new PIXI.Container();
	loadingContainer.zIndex = 100;
	app.stage.addChild(loadingContainer);

	// Завантаження зображення load.svg (верхній елемент)
	const loadImage = new PIXI.Sprite(loadedResources.loadImage.texture);
	loadImage.anchor.set(0.5, 0.9);
	const widthRangesLoadImage = [
		{ min: 0, max: 990, width: 150 },
		{ min: 990, max: Infinity, width: 300 },
	];
	const loadImageMetrics = calculateSize(windowWidth, widthRangesLoadImage, 40);
	loadImage.width = loadImageMetrics.width;
	loadImage.height = loadImageMetrics.height;
	loadImage.x = app.renderer.width / 2;
	loadImage.y = app.renderer.height / 2 - (windowWidth < 990 ? 20 : 35);
	loadingContainer.addChild(loadImage);

	// Створення прогрес-бару
	loadingProgressBar = new PIXI.Graphics();
    loadingContainer.addChild(loadingProgressBar);

	// Завантаження зображення v.svg (розташоване під прогрес-баром)
	const vImage = new PIXI.Sprite(loadedResources.vImage.texture);
	vImage.anchor.set(0.5, -0.1);
	const widthRangesVImage = [{ min: 0, max: Infinity, width: 106 }];
	const vImageMetrics = calculateSize(windowWidth, widthRangesVImage, 70);
	vImage.width = vImageMetrics.width;
	vImage.height = vImageMetrics.height;
	vImage.x = app.renderer.width / 2;
	vImage.y = app.renderer.height / 2 + (windowWidth < 990 ? 6 : 15);
	loadingContainer.addChild(vImage);

	loadingStartTime = null;
}

// Функція оновлення відображення завантаження (прогрес-бар)
function updateLoadingDisplay(fraction) {
	if (!loadingProgressBar) return;
	const fullBarWidth = 200;
	const barHeight = 5;
	const radius = barHeight / 2;
	const centerX = app.renderer.width / 2;
	const centerY = app.renderer.height / 2;
	const leftEdge = centerX - fullBarWidth / 2;

	loadingProgressBar.clear();
	// Малюємо фон прогрес-бару (сірий, з округленими кутами)
	loadingProgressBar.beginFill(0x444444);
	loadingProgressBar.drawRoundedRect(
		leftEdge,
		centerY - barHeight / 2,
		fullBarWidth,
		barHeight,
		radius,
	);
	loadingProgressBar.endFill();

	// Малюємо червону частину, що поступово зменшується
	const redWidth = fullBarWidth * (1 - fraction);
	if (redWidth > 0) {
		loadingProgressBar.beginFill(0xe50539);
		if (redWidth === fullBarWidth) {
			loadingProgressBar.drawRoundedRect(
				leftEdge,
				centerY - barHeight / 2,
				fullBarWidth,
				barHeight,
				radius,
			);
		} else {
			loadingProgressBar.moveTo(leftEdge + radius, centerY - barHeight / 2);
			loadingProgressBar.arcTo(
				leftEdge,
				centerY - barHeight / 2,
				leftEdge,
				centerY - barHeight / 2 + radius,
				radius,
			);
			loadingProgressBar.lineTo(leftEdge, centerY + barHeight / 2 - radius);
			loadingProgressBar.arcTo(
				leftEdge,
				centerY + barHeight / 2,
				leftEdge + radius,
				centerY + barHeight / 2,
				radius,
			);
			loadingProgressBar.lineTo(leftEdge + redWidth, centerY + barHeight / 2);
			loadingProgressBar.lineTo(leftEdge + redWidth, centerY - barHeight / 2);
			loadingProgressBar.closePath();
		}
		loadingProgressBar.endFill();
	}
}

let loadingStartTime = null;



// --- Етап 2: Визначення коефіцієнта ---
// Емуляція отримання даних від серверу
/*function determineCoefficient() {
	return parseFloat((Math.random() * (10.99 - 1) + 1).toFixed(2));
}*/

// --- Етап 3: Режим гри ("playing") ---
// Запуск гри з початковим коефіцієнтом 1.00 і налаштування ігрових об'єктів
function startPlaying(determinedCoefficient) {
	stopRows();
	cancelLoading(); // прибираємо оверлей завантаження
	currentState = "playing";
	app.view.style.display = "block";

	if (airplane) {
		airplane.visible = true;
		airplane.alpha = 1;
	}
	trajectory.visible = true;
	fill.visible = true;
	multiplierEl.style.display = "block";
	multiplierEl.style.visibility = "visible";

	if (glowOverlay) glowOverlay.alpha = 1;

	// Скидання ігрових значень
	points = [];
	time = 0;
	multiplier = 1.0;
	drawing = true;
	currentColor = [0, 123, 255];
	multiplierEl.style.color = "white";
	updateGameWithCoefficient(1.0);

	// Запуск тікання коефіцієнта
	//simulateGameCoefficientTicks(determinedCoefficient);
}

// Функція симуляції збільшення коефіцієнта
// Кожні 100 мс збільшується значення на 0.01 до досягнення визначеного значення
/*function simulateGameCoefficientTicks(determinedCoefficient) {
	let currentGameCoefficient = 1.0;
	const tickInterval = setInterval(() => {
		currentGameCoefficient = parseFloat((currentGameCoefficient + 0.01).toFixed(2));
		updateGameWithCoefficient(currentGameCoefficient);
		markUsersByCoefficient(currentGameCoefficient); //шукаємо юзерів
		if (currentGameCoefficient >= determinedCoefficient) {
			clearInterval(tickInterval);
			stopGame();
			console.log("Остановка гри, коефіцієнт =", currentGameCoefficient);
			// Через 3 сек. перезапускаємо повний цикл
			setTimeout(simulateSocketCycle, 3000);
		}
	}, 100);
}*/

// --- Етап 4: Зупинка гри ("stopped") ---
// Встановлюємо стан "stopped": змінюємо колір тексту, приховуємо glow та запускаємо анімацію відльоту літака
function stopGame(coeff) {
  currentState = "stopped";
  multiplierEl.textContent = `${coeff}x`
  multiplierEl.style.color = "red";
  multiplierEl.style.display = "block";
	multiplierEl.style.visibility = "visible";

	if (glowOverlay) glowOverlay.alpha = 0;
	flewAway.style.display = "block";
}

// --- Допоміжні функції для скидання/приховування ігрових елементів ---
function cancelPlaying() {
	currentState = "idle";
	if (airplane) {
		airplane.visible = false;
		airplane.alpha = 0;
	}
	trajectory.visible = false;
	fill.visible = false;
	multiplierEl.style.display = "none";
	multiplierEl.style.visibility = "hidden";
}

function cancelLoading() {
	if (loadingContainer) {
		app.stage.removeChild(loadingContainer);
		loadingContainer.destroy({ children: true });
		loadingContainer = null;
	}
	currentState = "idle";
}

// --- Етап 5: Головний цикл симуляції (socket cycle) ---
// Повний цикл: завантаження → визначення коефіцієнта → гра → зупинка гри → повторення циклу через 3 сек.
/*function simulateSocketCycle() {
	flewAway.style.display = "none";
	startLoadingBar();

	const loadingDuration = 3000;
	const loadStart = performance.now();
	function animateLoading() {
		const now = performance.now();
		let elapsed = now - loadStart;
		if (elapsed > loadingDuration) elapsed = loadingDuration;
		const fraction = elapsed / loadingDuration;
		updateLoadingDisplay(fraction);
		if (elapsed < loadingDuration) {
			requestAnimationFrame(animateLoading);
		} else {
			const determinedCoefficient = determineCoefficient();
			console.log("Визначено коефіцієнт:", determinedCoefficient);
			startPlaying(determinedCoefficient);
		}
	}
	requestAnimationFrame(animateLoading);
}*/

const playing = coeff => {
	flewAway.style.display = "none";
	if (currentState === "playing") {
		updateGameWithCoefficient(coeff);
		markUsersByCoefficient(coeff); 
	} else {
		stopRows();
		cancelLoading(); // прибираємо оверлей завантаження
		currentState = "playing";
		app.view.style.display = "block";

		if (airplane) {
			airplane.visible = true;
			airplane.alpha = 1;
		}
		trajectory.visible = true;
		fill.visible = true;
		multiplierEl.style.display = "block";
		multiplierEl.style.visibility = "visible";

		if (glowOverlay) glowOverlay.alpha = 1;

		// Скидання ігрових значень
		points = [];
		time = 0;
		multiplier = 1.0;
		drawing = true;
		currentColor = [0, 123, 255];
		multiplierEl.style.color = "white";
		updateGameWithCoefficient(1.00);
	}
};

// lading(3000, 5000);

function loading(time = 9, duration = 10) {
	flewAway.style.display = "none";

	if (currentState !== "loading") {
		startLoadingBar();

	if (!loadingProgressBar) return;
	console.log('loading')
	// Запам'ятовуємо час запуску лише один раз
	if (loadingStartTime === null) {
		loadingStartTime = performance.now();
	}

	const startFrom = duration - time;

	const fullBarWidth = 200;
	const barHeight = 5;
	const radius = barHeight / 2;
	const centerX = app.renderer.width / 2;
	const centerY = app.renderer.height / 2;
	const leftEdge = centerX - fullBarWidth / 2;

	const loadingBufferSeconds = 2;

	function animate() {
		if (!loadingProgressBar) {
			return; // нет прогресс-бара — прерываем анимацию
		}

		const now = performance.now();
		const elapsed = (startFrom * 1000 + (now - loadingStartTime)) / 1000; // Перевёл в секунды
		const effectiveDuration = duration - loadingBufferSeconds; // === Добавлено: правильная длительность без буфера
		const clampedElapsed = Math.min(elapsed, effectiveDuration); // === Изменено: clamp по новой effectiveDuration
		const fraction = clampedElapsed / effectiveDuration;

		loadingProgressBar.clear();

		// Сірий фон
		loadingProgressBar.beginFill(0x444444);
		loadingProgressBar.drawRoundedRect(
			leftEdge,
			centerY - barHeight / 2,
			fullBarWidth,
			barHeight,
			radius,
		);
		loadingProgressBar.endFill();

		// Червона частина
		const redWidth = fullBarWidth * (1 - fraction);
		if (redWidth > 0) {
			loadingProgressBar.beginFill(0xe50539);
			if (redWidth === fullBarWidth) {
				loadingProgressBar.drawRoundedRect(
					leftEdge,
					centerY - barHeight / 2,
					fullBarWidth,
					barHeight,
					radius,
				);
			} else {
				loadingProgressBar.moveTo(leftEdge + radius, centerY - barHeight / 2);
				loadingProgressBar.arcTo(
					leftEdge,
					centerY - barHeight / 2,
					leftEdge,
					centerY - barHeight / 2 + radius,
					radius,
				);
				loadingProgressBar.lineTo(leftEdge, centerY + barHeight / 2 - radius);
				loadingProgressBar.arcTo(
					leftEdge,
					centerY + barHeight / 2,
					leftEdge + radius,
					centerY + barHeight / 2,
					radius,
				);
				loadingProgressBar.lineTo(leftEdge + redWidth, centerY + barHeight / 2);
				loadingProgressBar.lineTo(leftEdge + redWidth, centerY - barHeight / 2);
				loadingProgressBar.closePath();
			}
			loadingProgressBar.endFill();
		}

		// Рекурсія
		if (elapsed < duration) {
			requestAnimationFrame(animate);
		} else {
			loadingStartTime = null; // скидаємо, щоб можна було запустити знову
		}
	}

	requestAnimationFrame(animate);
	}
}


function startPrepare() {
    stopRows();
    cancelLoading(); // на всякий случай

    currentState = "prepare";

    app.view.style.display = "block";

    if (airplane) {
        airplane.visible = true;
        airplane.alpha = 1;
    }
    trajectory.visible = false;
    fill.visible = false;
    multiplierEl.style.display = "none";
    multiplierEl.style.visibility = "hidden";

    points = [];
    time = 0;
    multiplier = 1.0;
    drawing = false; // самолет не должен лететь

    // Начальная позиция самолёта за пределами экрана слева
    const startX = -airplane.width;
    const targetX = 0;
    airplane.x = startX;
    airplane.y = container.clientHeight;

    background.rotation = 0;

    // === Плавная анимация прибытия ===
    let startTime = null;
    const duration = 800; // длительность анимации в мс (0.8 сек)

    function animateArrival(timestamp) {
        if (currentState !== "prepare") return; // если сменился этап — стоп

        if (!startTime) startTime = timestamp;
        const elapsed = timestamp - startTime;

        const progress = Math.min(elapsed / duration, 1); // от 0 до 1
        const easeProgress = 1 - Math.pow(1 - progress, 3); // easeOutCubic

        airplane.x = startX + (targetX - startX) * easeProgress;

        if (progress < 1) {
            requestAnimationFrame(animateArrival);
        } else {
            airplane.x = targetX; // фиксируем точно
        }
    }

    requestAnimationFrame(animateArrival);
}

