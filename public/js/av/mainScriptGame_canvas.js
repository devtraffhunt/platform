// ================================
// 1. Canvas Ініціалізація
// ================================
const container = document.getElementById("av_gameContainer"); // Контейнер для canvas
const multiplierEl = document.getElementById("av_multiplier"); // Елемент для відображення множника
const flewAway = document.getElementById("av_flewAway"); // Елемент «вилетів»

const canvas = document.createElement("canvas"); // Створюємо canvas
canvas.style.display = "none";
canvas.style.zIndex = 1;
canvas.style.background = "#000";
container.appendChild(canvas);

const ctx = canvas.getContext("2d"); // Контекст малювання

// Змінні для логічних (CSS) розмірів
let cw = 0;
let ch = 0;

function resizeCanvas() {
	const dpr = window.devicePixelRatio || 1; // учитываем Retina

	// Оновлюємо логічні розміри (CSS px)
	cw = container.clientWidth;
	ch = container.clientHeight;

	// Встановлюємо фізичну роздільну здатність
	canvas.width = cw * dpr;
	canvas.height = ch * dpr;

	// Встановлюємо CSS-розміри
	canvas.style.width = cw + "px";
	canvas.style.height = ch + "px";

	// Скидаємо трансформації та масштабуємо так, щоб 1 юніт = 1 CSS px
	ctx.setTransform(1, 0, 0, 1, 0, 0);
	ctx.scale(dpr, dpr);
}
resizeCanvas();
window.addEventListener("resize", resizeCanvas); // Перерахунок при зміні розміру вікна

// ================================
// 2. Завантаження ресурсів
// ================================
const backgroundImage = new Image(); // Фонова картинка
backgroundImage.src = "/img/av/bg-sun.svg";
let backgroundLoaded = false;
backgroundImage.onload = () => (backgroundLoaded = true);

const planeFrames = []; // Кадри літака
const planeFramesSrc = [
	"/img/av/plane-0.svg",
	"/img/av/plane-1.svg",
	"/img/av/plane-2.svg",
	"/img/av/plane-3.svg",
];
planeFramesSrc.forEach((src, index) => {
	const img = new Image();
	img.src = src;
	img.onload = () => (planeFrames[index] = img);
});

const loadImageLogo = new Image(); // Логотип для екрану завантаження
loadImageLogo.src = "/img/av/partners-logo.svg";
let loadImageLogoLoaded = false;
loadImageLogo.onload = () => (loadImageLogoLoaded = true);

const vImage = new Image(); // «v» для екрану завантаження
vImage.src = "/img/av/official.svg";
let vImageLoaded = false;
vImage.onload = () => (vImageLoaded = true);

// ================================
// 3. Глобальні змінні стану та параметри
// ================================
let currentState = ""; // Поточний стан гри: loading, prepare, playing, stopped
let lastTimestamp = 0; // Для анімаційних циклiв

const animationSpeed = 6; // Швидкість анімації кадрів

let points = []; // Траєкторія польоту
let time = 0; // Лічильник часу для побудови траєкторії
let drawing = true; // Чи ще малюємо траєкторію?
let oscillationTime = 0; // Таймер для коливань траєкторії

let backgroundRotation = 0; // Кут обертання фону

let multiplier = 1.0; // Поточний множник
let targetMultiplier = 5.0; // Цільовий множник

let currentColor = [52, 180, 255]; // Поточний колір сяйва
let targetColor = [52, 180, 255]; // Цільовий колір сяйва

let loadingProgress = 0; // Прогрес завантаження (0–1)
let loadingStartTime = null; // Момент старту завантаження
let loadingDuration = 5; // Тривалість екрану завантаження

//координати літака
const planeState = {
	x: 0,
	y: 0,
	frame: 0,
	animationTimer: 0,
};

// ================================
// 4. Допоміжні утиліти
// ================================
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

function getPlaneSize() {
	const windowWidth = window.innerWidth;
	const widthRanges = [
		{ min: 0, max: 610, width: 96 },
		{ min: 610, max: 990, scale: [96, 144] },
		{ min: 990, max: 1199, scale: [106.7, 138.7] },
		{ min: 1199, max: 1400, scale: [129.3, 144] },
		{ min: 1400, max: Infinity, width: 144 },
	];
	return calculateSize(windowWidth, widthRanges, 50);
}

function lerp(a, b, t) {
	return a + (b - a) * t;
}

function easeInExpoFixed(t, strength = 4) {
	const min = Math.pow(2, -strength);
	const max = 1;
	const raw = Math.pow(2, strength * (t - 1));
	return (raw - min) / (max - min);
}

// ================================
// 5. Функції малювання
// ================================
function drawBackground() {
	if (!backgroundLoaded) return;
	const w = 3700,
		h = 3700;
	ctx.save();
	ctx.translate(0, ch);
	ctx.rotate(backgroundRotation);
	ctx.drawImage(backgroundImage, -w / 2, -h / 2, w, h);
	ctx.restore();
}

const glowConfig = {
	xFactor: 0.5,
	yFactor: 0.5,
	radiusFactor: 1,
	stops: [
		{ offset: 0.0, alpha: 0.6 },
		{ offset: 0.05, alpha: 0.45 },
		{ offset: 0.1, alpha: 0.3 },
		{ offset: 0.15, alpha: 0.15 },
		{ offset: 0.2, alpha: 0.05 },
		{ offset: 0.25, alpha: 0 },
		{ offset: 1.0, alpha: 0 },
	],
	blendMode: "screen",
	stretchX: 2,
};

function drawGlow(config = glowConfig) {
	const { xFactor, yFactor, radiusFactor, stops, blendMode, stretchX } = config;
	const cx = cw * xFactor;
	const cy = ch * yFactor;
	const maxDim = Math.max(cw, ch);
	const radius = maxDim * radiusFactor;

	const gradient = ctx.createRadialGradient(0, 0, 0, 0, 0, radius);
	stops.forEach(({ offset, alpha }) => {
		const [r, g, b] = currentColor;
		gradient.addColorStop(offset, `rgba(${r},${g},${b},${alpha})`);
	});

	ctx.save();
	ctx.translate(cx, cy);
	ctx.scale(stretchX, 1);
	ctx.globalCompositeOperation = blendMode;
	ctx.fillStyle = gradient;
	ctx.fillRect(-cw, -ch, cw * 3, ch * 3);
	ctx.restore();
}

function drawPlane(deltaTime) {
	if (planeFrames.length < 4) return;

	const frame = planeFrames[planeState.frame];
	const { width, height } = getPlaneSize();

	ctx.save();
	ctx.translate(planeState.x, planeState.y);
	ctx.translate(-width * 0.15, -height * 0.9);
	ctx.drawImage(frame, 0, 0, width, height);
	ctx.restore();

	planeState.animationTimer += deltaTime;
	if (planeState.animationTimer >= animationSpeed) {
		planeState.animationTimer = 0;
		planeState.frame = (planeState.frame + 1) % planeFrames.length;
	}
}

function drawTrajectory() {
	if (points.length < 2) return;
	ctx.beginPath();
	ctx.lineWidth = 4;
	ctx.strokeStyle = "#e50439";
	ctx.moveTo(points[0].x, points[0].y);
	points.forEach(p => ctx.lineTo(p.x, p.y));
	ctx.stroke();
	ctx.closePath();

	const last = points[points.length - 1];
	ctx.beginPath();
	ctx.moveTo(points[0].x, ch);
	points.forEach(p => ctx.lineTo(p.x, p.y));
	ctx.lineTo(last.x, ch);
	ctx.closePath();
	ctx.fillStyle = "rgba(255, 0, 0, 0.4)";
	ctx.fill();
}

function drawRoundedRect(x, y, w, h, r) {
	ctx.beginPath();
	ctx.moveTo(x + r, y);
	ctx.arcTo(x + w, y, x + w, y + h, r);
	ctx.arcTo(x + w, y + h, x, y + h, r);
	ctx.arcTo(x, y + h, x, y, r);
	ctx.arcTo(x, y, x + w, y, r);
	ctx.closePath();
	ctx.fill();
}

function drawCustomLoadingScreen(progress) {
	const logicalWidth = cw;
	const logicalHeight = ch;

	ctx.clearRect(0, 0, cw, ch);

	drawBackground();

	const centerX = logicalWidth / 2;
	const centerY = logicalHeight / 2;

	const fullBarWidth = 200;
	const barHeight = 5;
	const radius = barHeight / 2;
	const leftEdge = centerX - fullBarWidth / 2;

	ctx.save();

	// Логотип
	if (loadImageLogoLoaded) {
		const widthRangesLoadImage = [
			{ min: 0, max: 990, width: 150 },
			{ min: 990, max: Infinity, width: 300 },
		];
		const loadImageMetrics = calculateSize(logicalWidth, widthRangesLoadImage, 40);
		ctx.drawImage(
			loadImageLogo,
			centerX - loadImageMetrics.width / 2,
			centerY - loadImageMetrics.height - (logicalWidth < 990 ? 20 : 15),
			loadImageMetrics.width,
			loadImageMetrics.height,
		);
	}

	// Фон бару
	ctx.fillStyle = "#444";
	drawRoundedRect(leftEdge, centerY, fullBarWidth, barHeight, radius);

	// Заповнена частина прогрес-бара
	const redWidth = fullBarWidth * (1 - progress);
	if (redWidth > 0) {
		ctx.fillStyle = "#e50539";
		ctx.beginPath();
		ctx.moveTo(leftEdge + radius, centerY);
		ctx.arcTo(leftEdge, centerY, leftEdge, centerY + radius, radius);
		ctx.lineTo(leftEdge, centerY + barHeight - radius);
		ctx.arcTo(leftEdge, centerY + barHeight, leftEdge + radius, centerY + barHeight, radius);
		ctx.lineTo(leftEdge + redWidth, centerY + barHeight);
		ctx.lineTo(leftEdge + redWidth, centerY);
		ctx.closePath();
		ctx.fill();
	}

	// Наклейка "v"
	if (vImageLoaded) {
		const widthRangesVImage = [{ min: 0, max: Infinity, width: 106 }];
		const vImageMetrics = calculateSize(logicalWidth, widthRangesVImage, 70);
		ctx.drawImage(
			vImage,
			centerX - vImageMetrics.width / 2,
			centerY + (logicalWidth < 990 ? 25 : 25),
			vImageMetrics.width,
			vImageMetrics.height,
		);
	}

	ctx.restore();
}

// ================================
// 6. Оновлення стану (логіка оновлення)
// ================================
function updateGlowColor() {
	currentColor = currentColor.map((c, i) => lerp(c, targetColor[i], 0.0075));
}

function updateTrajectory(deltaTime) {
	const frames = 2 * 60;
	const startX = 0;
	const startY = ch;
	const targetX = cw * 0.8;
	const targetY = ch * 0.2;

	if (drawing) {
		time += deltaTime;
		const t = Math.min(time / frames, 1);
		points.push({
			x: startX + (targetX - startX) * t,
			y: startY + (targetY - startY) * easeInExpoFixed(t),
		});

		if (time >= frames) {
			drawing = false;
			points.forEach(p => {
				p.ox = p.x;
				p.oy = p.y;
			});
		}
	} else {
		oscillationTime += deltaTime / 30;
		const angle = Math.PI / 4;
		const baseOscillation = Math.sin(oscillationTime) * 30;
		const offsetX = Math.cos(angle) * baseOscillation;
		const offsetY = Math.sin(angle) * baseOscillation;

		points.forEach((p, i) => {
			if (i === 0) return;
			const factor = i / (points.length - 1);
			p.x = p.ox + offsetX * factor;
			p.y = p.oy + offsetY * factor;
		});
	}
}

// ================================
// 7. Управління станами гри
// ================================

function updateGameWithCoefficient(newCoefficient) {
	multiplier = newCoefficient;
	multiplierEl.innerText = multiplier.toFixed(2) + "x";

	if (multiplier < 2) targetColor = [52, 180, 255];
	else if (multiplier < 10) targetColor = [145, 62, 248];
	else if (multiplier < 100) targetColor = [192, 23, 180];
	else targetColor = [243, 195, 37];
}

function resetGame() {
	// Скинути стан гри
	currentState = "";
	lastTimestamp = 0;

	// Скинути всі лічильники та параметри
	points = [];
	time = 0;
	drawing = true;
	oscillationTime = 0;
	backgroundRotation = 0;

	// Скинути множники й колір
	multiplier = 1.0;
	targetMultiplier = 5.0;
	currentColor = [52, 180, 255];
	targetColor = [52, 180, 255];

	// Скинути прогрес завантаження
	loadingProgress = 0;
	loadingStartTime = null;
	loadingDuration = 5;

	// Скинути стан літака
	planeState.x = 0;
	planeState.y = 0;
	planeState.frame = 0;
	planeState.animationTimer = 0;

	// Приховати елементи інтерфейсу
	// canvas.style.display = "none";
	multiplierEl.style.display = "none";
	flewAway.style.display = "none";
}

// ================================
// 8. Цикли анімації
// ================================
function animateGlow() {
	if (currentState !== "playing") return;
	currentColor = currentColor.map((c, i) => lerp(c, targetColor[i], 0.05));
	ctx.clearRect(0, 0, cw, ch);
	drawBackground();
	drawGlow();
	drawTrajectory();
	drawPlane(0);
	requestAnimationFrame(animateGlow);
}

function animateFlightFrame(timestamp) {
	if (currentState !== "playing") return;

	const deltaTime = (timestamp - lastTimestamp) / (1000 / 60);
	lastTimestamp = timestamp;

	updateTrajectory(deltaTime);

	if (points.length > 0) {
		const lastPoint = points[points.length - 1];
		planeState.x = lastPoint.x;
		planeState.y = lastPoint.y;
	}

	backgroundRotation += 0.002 * deltaTime;

	ctx.clearRect(0, 0, cw, ch);
	drawBackground();
	updateGlowColor();
	drawGlow();
	drawTrajectory();
	drawPlane(deltaTime);

	requestAnimationFrame(animateFlightFrame);
}

function animateExitRight(timestamp) {
	if (currentState !== "stopped") return;

	const deltaTime = (timestamp - lastTimestamp) / (1000 / 60);
	lastTimestamp = timestamp;

	planeState.x += 20 * deltaTime;

	ctx.clearRect(0, 0, cw, ch);
	drawBackground();
	updateGlowColor();
	drawTrajectory();
	drawPlane(deltaTime);

	// Летить поки не вийде за праву межу
	if (planeState.x < cw + getPlaneSize().width) {
		requestAnimationFrame(animateExitRight);
	}
}

// ================================
// 9. Ігрові функції (API для зовнішніх викликів)
// ================================
function loading(timeLeft = 0, totalDuration = 5, loadingBufferSeconds = 2, onFinish = () => {}) {
resetGame();
  if (currentState === "loading") return;
  startRows();
	currentState = "loading";

	canvas.style.display = "block";
	flewAway.style.display = "none";
	multiplierEl.style.display = "none";

	const startTime = performance.now();
	let isRunning = true;

	// Тривалість анімації заповнення бару без «буферу»
	const fillDuration = totalDuration - loadingBufferSeconds;
	// Звідки починати, якщо передано timeLeft
	const startOffset = totalDuration - timeLeft;

	function update() {
		if (!isRunning) return;

		const now = performance.now();
		// elapsed — скільки «бару» вже пройшло, в секундах
		const elapsed = startOffset + (now - startTime) / 1000;
		// fraction рахуємо від 0 до 1 за fillDuration
		const clamped = Math.min(elapsed, fillDuration);
		const fraction = clamped / fillDuration;

		drawCustomLoadingScreen(fraction);

		if (elapsed < fillDuration) {
			requestAnimationFrame(update);
		} else {
			isRunning = false;
			onFinish(); // викликаємо одразу, як бар заповнився
		}
	}

	requestAnimationFrame(update);
}

function startPrepare() {
	resetGame();
  if (currentState === "prepare") return;
  stopRows();
	currentState = "prepare";

	flewAway.style.display = "none";
	canvas.style.display = "block";
	multiplierEl.style.display = "none";
	multiplierEl.style.visibility = "hidden";

	points = [];
	time = 0;
	multiplier = 1.0;
	drawing = false;
	backgroundRotation = 0;

	const planeSize = getPlaneSize();
	const startX = -planeSize.width;
	const targetX = 0;
	const startY = ch;

	planeState.x = startX;
	planeState.y = startY;
	planeState.frame = 0;
	planeState.animationTimer = 0;

	let startTime = null;
	const duration = 800;

	function animateArrival(timestamp) {
		if (currentState !== "prepare") return; // цикл зупиниться, щойно ви перейдете в інший стан
		if (!startTime) startTime = timestamp;

		const elapsed = timestamp - startTime;
		const progress = Math.min(elapsed / duration, 1);
		const easeProgress = 1 - Math.pow(1 - progress, 3);

		planeState.x = startX + (targetX - startX) * easeProgress;
		planeState.y = startY;

		const deltaTime = (timestamp - lastTimestamp) / (1000 / 60);
		lastTimestamp = timestamp;
		planeState.animationTimer += deltaTime;

		if (planeState.animationTimer >= animationSpeed) {
			planeState.animationTimer = 0;
			planeState.frame = (planeState.frame + 1) % planeFrames.length;
		}

		ctx.clearRect(0, 0, cw, ch);
		drawBackground();
		updateGlowColor();
		drawPlane(0);

		// if (progress < 1) {
		requestAnimationFrame(animateArrival);
		// }
	}

	lastTimestamp = performance.now();
	requestAnimationFrame(animateArrival);
}

function playing(coeff) {
	if (currentState === "playing") {
    updateGameWithCoefficient(coeff);
    markUsersByCoefficient(coeff);
  } else {
	resetGame();
    stopRows();
		currentState = "playing";

		flewAway.style.display = "none";
		canvas.style.display = "block";
		multiplierEl.style.display = "block";
		multiplierEl.style.visibility = "visible";

		points = [];
		time = 0;
		multiplier = 1.0;
		drawing = true;
		currentColor = [52, 180, 255];
		targetColor = [52, 180, 255];
		multiplierEl.style.color = "white";
		backgroundRotation = 0;

		planeState.frame = 0;
		planeState.animationTimer = 0;

		updateGameWithCoefficient(1.0);
		lastTimestamp = performance.now();
		requestAnimationFrame(animateFlightFrame);
	}
}

function stopGame(coeff) {
	resetGame();
	currentState = "stopped";

	multiplier = coeff;
	multiplierEl.textContent = `${multiplier.toFixed(2)}x`;
	multiplierEl.style.color = "red";
	multiplierEl.style.display = "block";
	multiplierEl.style.visibility = "visible";

	flewAway.style.display = "block";

	currentColor = [0, 0, 0];
	targetColor = [0, 0, 0];

	points = [];

	lastTimestamp = performance.now();
	requestAnimationFrame(animateExitRight);
}

// ================================
// 10. Початковий виклик: завантаження та симуляція раунду
// ================================
// loading(1, 1, 0, () => {
// 	console.log("Завантаження завершено");
// 	startPrepare();

// 	setTimeout(() => {
// 		let coeff = 1;
// 		const interval = setInterval(() => {
// 			coeff += 0.01;
// 			playing(coeff);
// 		}, 10);

// 		setTimeout(() => {
// 			stopGame(coeff);
// 			clearInterval(interval);
// 		}, 10000);
// 	}, 1000);
// });
