<?php $setting = \App\Setting::first(); $snow = 0; ?> <?php if(\Auth::guest()): ?> <?php $snow = 0; ?> <?php endif; ?> <?php if(\Auth::user() && \Auth::user()->admin != 1): ?> <?php $snow = 0; ?> <?php endif; ?> <?php $snow = $setting->theme; ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<script src="https://telegram.org/js/telegram-web-app.js?57"></script>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title><?php echo e($setting->name); ?></title>
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

	<?php echo $setting->meta_tags; ?>

	<!-- <link rel="icon" type="image/png" href="images/favicon.png" sizes="64x64" /> -->
	<!-- <meta name="msapplication-TileImage" content="images/favicon.png"> -->
	<link rel="apple-touch-icon" sizes="64x64" href="/img/fav.png" />
	<link rel="icon" sizes="64x64" href="/img/fav.png" />
	<link href="https://fonts.googleapis.com/css?family=Inter:400,500,700&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="/css/main.css?v=222222322222222222222222" />
	<link rel="stylesheet" href="/css/new/footer.css?v=1" />
	<link rel="stylesheet" href="/styles/globals.css?v=63728">
	<link rel="stylesheet" href="/styles/login.css?v=11">
	<style>
		.spinner {
			animation: spinner .75s infinite linear;
			border: 3px solid #1863d1;
			border-radius: 50%;
			border-right-color: transparent;
			border-top-color: transparent;
			box-sizing: border-box;
			height: 25px;
			pointer-events: none;
			width: 25px;
			margin: 25px auto;
		}

		@keyframes  spinner {
			100% {
				transform: rotate(1turn)
			}
		}

		.btn-busy {
			pointer-events: none;
			opacity: .85
		}
	</style>



	<script src="https://cdn.socket.io/4.8.1/socket.io.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>

	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

	<script>
		(function() {
			function getBotIdFromHash() {
				const hashParams = new URLSearchParams(location.hash.slice(1));
				return hashParams.get('bot_id');
			}

			function safeSetItem(key, value) {
				if (value !== null && value !== undefined && value !== '') {
					localStorage.setItem(key, value);
					console.log(`✅ ${key} сохранён:`, value);
				}
			}

			function safeSetCookie(name, value, days = 30) {
				if (value !== null && value !== undefined && value !== '') {
					try {
						const expires = new Date(Date.now() + days * 864e5).toUTCString();
						document.cookie = `${name}=${encodeURIComponent(value)}; expires=${expires}; path=/`;
						console.log(`🍪 ${name} кука установлена:`, value);
					} catch (e) {
						console.warn(`⚠️ Cookie ${name} не установлена:`, e);
					}
				}
			}

			// --- Telegram ID из localStorage или Telegram WebApp ---
			const tgIdFromStorage = localStorage.getItem('telegram_id');
			const tgIdFromTelegram = window.Telegram?.WebApp?.initDataUnsafe?.user?.id;

			if (tgIdFromTelegram && tgIdFromTelegram !== tgIdFromStorage) {
				safeSetItem('telegram_id', tgIdFromTelegram);
				safeSetCookie('telegram_id', tgIdFromTelegram);
			}

			// --- Bot ID из #hash или localStorage ---
			const botIdFromStorage = localStorage.getItem('bot_id');
			const botIdFromHash = getBotIdFromHash();

			if (botIdFromHash && botIdFromHash !== botIdFromStorage) {
				safeSetItem('bot_id', botIdFromHash);
				safeSetCookie('bot_id', botIdFromHash);
			}

			console.log('📦 Telegram ID (final):', localStorage.getItem('telegram_id') || 'не найден');
			console.log('📦 Bot ID (final):', localStorage.getItem('bot_id') || 'не найден');
		})();


		function getCookie(name) {
			const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
			return match ? decodeURIComponent(match[2]) : null;
		}



		document.addEventListener('DOMContentLoaded', function() {
			setTimeout(function() {
				saveTelegramIdSimple();
			}, 300); // Даем время Telegram.WebApp загрузиться
		});


		activeLinks();

		$(document).ready(function() {
			// Сохраняем оригинальную функцию load, если она уже существует
			var originalLoad = window.load || function(page) {};


			// Переопределяем функцию load
			window.load = function(page) {
				// Обновляем активное состояние меню
				setActiveMenu(page);
				// Затем вызываем оригинальную логику загрузки
				originalLoad(page);
			};

			// Функция для обновления активного пункта меню
			function setActiveMenu(page) {
				// Убираем класс active у всех пунктов меню
				$('.header__links li').removeClass('active');

				if (page === '' || page === 'casino') {
					$(".header__links li a span").filter(function() {
						return $(this).text().trim() === "Casino";
					}).closest("li").addClass("active");
				} else if (page === 'crash') {
					$(".header__links li a img").filter(function() {
						return $(this).attr("src") && $(this).attr("src").indexOf("aviator-game-logo.svg") !== -1;
					}).closest("li").addClass("active");
				} else if (page === 'chicken_road') {
					$(".header__links li a img").filter(function() {
						return $(this).attr("src") && $(this).attr("src").indexOf("chicken-road.svg") !== -1;
					}).closest("li").addClass("active");
				} else if (page === 'slots') {
					$(".header__links li a span").filter(function() {
						return $(this).text().trim() === "Slots";
					}).closest("li").addClass("active");
				} else if (page === 'mines') {
					$(".header__links li a span").filter(function() {
						return $(this).text().trim() === "Mines";
					}).closest("li").addClass("active");
				} else {
					// По умолчанию активным остается пункт "Casino"
					$(".header__links li a span").filter(function() {
						return $(this).text().trim() === "Casino";
					}).closest("li").addClass("active");
				}
			}
		});

		// Функция для обновления активного пункта меню
		function setActiveMenu(page) {
			// Убираем класс active у всех пунктов меню
			$('.header__links li').removeClass('active');

			if (page === '' || page === 'casino') {
				$(".header__links li a span").filter(function() {
					return $(this).text().trim() === "Casino";
				}).closest("li").addClass("active");
			} else if (page === 'crash') {
				$(".header__links li a img").filter(function() {
					return $(this).attr("src") && $(this).attr("src").indexOf("aviator-game-logo.svg") !== -1;
				}).closest("li").addClass("active");
			} else if (page === 'chicken_road') {
				$(".header__links li a img").filter(function() {
					return $(this).attr("src") && $(this).attr("src").indexOf("chicken-road.svg") !== -1;
				}).closest("li").addClass("active");
			} else if (page === 'slots') {
				$(".header__links li a span").filter(function() {
					return $(this).text().trim() === "Slots";
				}).closest("li").addClass("active");
			} else if (page === 'mines') {
				$(".header__links li a span").filter(function() {
					return $(this).text().trim() === "Mines";
				}).closest("li").addClass("active");
			} else {
				// По умолчанию активным остается пункт "Casino"
				$(".header__links li a span").filter(function() {
					return $(this).text().trim() === "Casino";
				}).closest("li").addClass("active");
			}
		}
		});
	</script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-scrollbar@latest/simple-scrollbar.css" />
	<script src="https://cdn.jsdelivr.net/npm/simple-scrollbar@latest/simple-scrollbar.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<script src="/js/ripple.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/css/ripple.css" />
	<link rel="stylesheet" href="/css/index.css?v=12" />
	<script src="/js/countup.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pixi.js/6.5.8/browser/pixi.min.js"></script>
	<script src="https://hcaptcha.com/1/api.js?render=explicit" async defer></script>

	<!-- <script async src="https://telegram.org/js/telegram-widget.js?21" data-telegram-login="betusxbot" data-size="large" data-auth-url="https://betusx.pro/tg/auth/callback" data-request-access="write"></script>
    <script src="https://telegram.org/js/widget-frame.js?60" data-telegram-login="betusxbot" data-size="large" data-auth-url="https://betusx.pro/tg/auth/callback" data-request-access="write"></script> -->
</head>


<body class="theme--dark">
	<div class="preloader d-flex align-center justify-center">
		<div class="preloader__lift d-flex align-center justify-center">
			<div class="preloader__lift-container d-flex align-center justify-space-between">
				<div class="preloader__loader">
					<img width="250px" src="/logo.svg">
					<div class="spinner"></div>
				</div>
			</div>
		</div>
	</div>

	<div id="app">


		<div class="main">
			<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<div class="gx-s">
				<script src="/scripts/login.js?v=674722227"></script>
				<script src="/js/script.js?v=1221223237242222232334323223223221" type="text/javascript"></script>

				<main id="_ajax_content_">
					<?php echo $__env->yieldContent('content'); ?>
					<?php echo html_entity_decode($page); ?>


				</main>
				<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php echo $__env->make('layouts.mobile_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
		</div>
	</div>

	<?php if(auth()->guard()->guest()): ?>

	<?php echo $__env->make('layouts.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<?php endif; ?>


	<script>
		function copyText(that) {
			var $temp = $("<input>");
			$("body").append($temp);
			$temp.val($(that).text()).select();
			document.execCommand("copy");
			$temp.remove();

			notification('success', 'Copy!')
		}
	</script>

	<script>
		<?php if(auth()->guard()->check()): ?>

		balanceUpdate(0, <?php echo e(Auth::user()-> type_balance == 0 ? Auth::user()-> balance : Auth::user()->demo_balance); ?>, 1);

		<?php endif; ?>



		$('#dropdownUser').click(function(e) {
			e.preventDefault()
			$(this).toggleClass('dropdown');
		});


		$(document).on('click', function(e) {
			if (!$(e.target).closest("#dropdownUser").length) {
				$('.header__user-dropdown').parent().removeClass('dropdown');
			}
			e.stopPropagation();
		});
	</script>

	<?php if(auth()->guard()->check()): ?>
	<?php if(Auth::user()->id != 0): ?>
	<script type="text/javascript">
		socket.emit('subscribe', 'roomUser_<?php echo e(Auth::user()->id); ?>');
	</script>
	<?php endif; ?>
	<?php endif; ?>

	<?php if(session('error')): ?>
	<script>
		notification('error', "<?php echo e(session('error')); ?>")
	</script>
	<?php endif; ?>



	<script>
		document.addEventListener("DOMContentLoaded", () => {
			const globalContainerAll = document.querySelectorAll(".globalContainer");

			globalContainerAll.forEach(container => {
				container.addEventListener("keydown", event => {
					const active = document.activeElement;
					const isInputFocused =
						container.contains(active) && ["INPUT", "TEXTAREA"].includes(active.tagName);
					if (isInputFocused && event.key === "Enter") {
						event.preventDefault();
						active.blur();
					}
				});
			});

		});


		document.addEventListener('DOMContentLoaded', () => {
			const sidebarGames = document.querySelectorAll('.sidebar__game');
			const buttons = document.querySelectorAll('.btn_active');

			// Снимаем активные состояния
			sidebarGames.forEach(el => el.classList.remove('sidebar__game--active'));
			buttons.forEach(el => el.classList.remove('active'));

			// Получаем последнюю часть URL
			let path = window.location.pathname; // например: "/slots"
			let url = path.replace(/^\/+|\/+$/g, ''); // убираем / в начале и конце

			// Для главной страницы
			if (url === '/') url = 'index'; // или 'home', как у тебя в классах

			// Добавляем активные классы
			const activeBtn = document.querySelector(`.btn_active.btn_${url}`);
			const activeGame = document.querySelector(`.game_${url}`);

			if (activeBtn) activeBtn.classList.add('active');
			if (activeGame) activeGame.classList.add('sidebar__game--active');

			// Просто для проверки
			console.log('Текущая страница:', url);
		});
	</script>


</body>

</html>

<style type="text/css">
	@media(max-width: 475px) {
		.toast-top-right {
			margin-top: 60px !important;
		}
	}
</style><?php /**PATH /var/www/product/resources/views/layouts/app.blade.php ENDPATH**/ ?>