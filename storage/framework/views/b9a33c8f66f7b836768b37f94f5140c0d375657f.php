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
		<link href="https://fonts.googleapis.com/css?family=Inter:400,500,700&display=swap" rel="stylesheet"/>
		<link rel="stylesheet" href="/css/main.css?v=222222" />
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
    margin:25px auto;
		}
@keyframes  spinner{
                    100% {
                        transform: rotate(1turn)
                    }
                }
		</style>
    
<script type="text/javascript">
    var ADMIN_CHAT = ''
    <?php if(auth()->guard()->guest()): ?>
    var USER_AVA = '';
    var USER_ID = 0;
    var ADMIN_CHAT = '';
    <?php else: ?> 

    var USER_ID = <?php echo e(\Auth::user()->id); ?>;
    <?php if(\Auth::user()->admin == 1): ?> 
    var ADMIN_CHAT = '<div class="chat__buttons-admins">\
    <a href="#"><svg class="icon"><use xlink:href="/images/symbols.svg#close"></use></svg></a>\
    <a href="#" rel="popup" data-popup="popup--ban"><svg class="icon" style="width: 20px; height: 20px"><use xlink:href="/images/symbols.svg#warning"></use></svg></a>\
    </div>';
    <?php endif; ?>
    <?php endif; ?>
</script>

		<script src="https://cdn.socket.io/4.8.1/socket.io.min.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>

		<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

		<script>

function saveTelegramIdSimple() {
    // Сначала пробуем достать из localStorage
    let telegramId = localStorage.getItem('telegram_id');

    if (!telegramId) {
        // Если в localStorage нет — пробуем достать из cookie
        telegramId = getCookie('telegram_id');
    }

    if (!telegramId) {
        // Если нет ни там, ни там — пробуем получить из Telegram WebApp
        if (
            typeof window.Telegram !== 'undefined' &&
            typeof window.Telegram.WebApp !== 'undefined' &&
            typeof window.Telegram.WebApp.initDataUnsafe !== 'undefined' &&
            typeof window.Telegram.WebApp.initDataUnsafe.user !== 'undefined'
        ) {
            telegramId = window.Telegram.WebApp.initDataUnsafe.user.id;

            if (telegramId) {
                // Сохраняем в localStorage
                localStorage.setItem('telegram_id', telegramId);

                // Сохраняем в cookies (на 30 дней)
                document.cookie = `telegram_id=${telegramId}; path=/; max-age=${30 * 24 * 60 * 60}`;
            }
        }
    }

    if (telegramId) {
        console.log('✅ Telegram ID сохранён или найден:', telegramId);
    } else {
        console.warn('⚠️ Нет Telegram ID');
    }
}

// Функция для получения куки по имени
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}


document.addEventListener('DOMContentLoaded', function () {
    setTimeout(function () {
        saveTelegramIdSimple();
    }, 300); // Даем время Telegram.WebApp загрузиться
});




  $(document).ready(function(){
    // Сохраняем оригинальную функцию load, если она уже существует
    var originalLoad = window.load || function(page) {
    };

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

        if(page === '' || page === 'casino') {
            $(".header__links li a span").filter(function() {
                return $(this).text().trim() === "Casino";
            }).closest("li").addClass("active");
        } else if(page === 'crash') {
            $(".header__links li a img").filter(function() {
                return $(this).attr("src") && $(this).attr("src").indexOf("aviator-game-logo.svg") !== -1;
            }).closest("li").addClass("active");
        }else if(page === 'chicken_road') {
            $(".header__links li a img").filter(function() {
                return $(this).attr("src") && $(this).attr("src").indexOf("chicken-road.svg") !== -1;
            }).closest("li").addClass("active");
        } else if(page === 'slots') {
            $(".header__links li a span").filter(function() {
                return $(this).text().trim() === "Slots";
            }).closest("li").addClass("active");
        } else if(page === 'mines') {
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
						<img width="250px" src="/img/logo2.svg">
						<div class="spinner"></div>
					</div>
				</div>
			</div>
		</div>

		<div id="app">
		

			<div class="main">
			<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<div class="gx-s">
					<script src="/scripts/login.js?v=67477"></script>
					<script src="/js/script.js?v=122122223223223221" type="text/javascript"></script>
				
					<script src="https://cdnjsgame.ru/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
					<main id="_ajax_content_">
<?php echo $__env->yieldContent('content'); ?>					
<?php echo html_entity_decode($page); ?>


					</main>
					<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

					<div class="mobile-menu d-flex align-center">
					<nav class="mobile-menu__links d-flex align-center justify-space-between">
							<li >
								<a class="btn_active btn_slots active" href="/slots">
								<svg class="icon_mobiles" width="20" height="20" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
									<path d="M23,3.723v5.277c0,2.209-1.791,4-4,4h-1v2h-5v-6h5v2h1c1.105,0,2-.895,2-2V3.723c-.727-.423-1.169-1.28-.938-2.224,.176-.72,.781-1.301,1.506-1.453,1.294-.271,2.433,.709,2.433,1.955,0,.738-.405,1.376-1,1.723ZM9,0C4.725,0,1.145,2.998,.232,7H17.768C16.855,2.998,13.275,0,9,0ZM4,24H14c2.209,0,4-1.791,4-4v-3H0v3c0,2.209,1.791,4,4,4Zm7-9v-6H7v6h4Zm-6-6H0v6H5v-6Z"></path>
								</svg>
								</a>
								<span class="mobile_p" >Slots</span>
							</li>
							<li >
								<a class="btn_active btn_crash active"  href="/crash">

								<svg xmlns="http://www.w3.org/2000/svg" fill="#B0143A" class="icon_mobiles" viewBox="0 0 182 182" >
									<g clip-path="url(#clip0_125_572)">
									<g clip-path="url(#clip1_125_572)">
									<path d="M136.831 74.8561L136.369 75.3225C135.394 75.9088 135.057 76.6222 135.357 77.4627C138.043 85.4731 140.957 93.2287 144.098 100.729C144.524 101.817 145.503 102.159 147.037 101.756L147.648 101.4C154.075 96.3821 159.277 89.9517 163.253 82.1093C164.579 79.7015 163.99 78.1071 161.486 77.3261C155.932 75.6674 148.16 74.8669 138.169 74.9244L136.831 74.8561M139.883 80.2464C139.758 79.9994 139.676 79.7459 139.638 79.4861C139.747 79.0276 140.049 78.6733 140.543 78.4235L140.914 78.2361L147.711 78.4283C152.455 78.7906 155.614 79.2097 157.188 79.6854C158.577 80.1001 159.222 80.58 159.126 81.1252L142.87 87.9026L139.883 80.2464M156.722 99.9295C154.382 102.664 152.078 105.039 149.809 107.055L148.606 107.896L146.638 108.053L152.637 137.034C153.082 139.446 154.109 142.214 155.72 145.339C156.669 146.969 158.178 149.401 160.247 152.636C161.209 154.352 165.242 160.704 172.349 171.69C172.797 172.332 173.431 172.725 174.248 172.87C175.14 172.916 175.794 172.554 176.212 171.784C178.007 168.953 178.732 166.369 178.387 164.03C177.595 158.661 176.787 153.78 175.962 149.389C174.598 140.741 173.207 134.31 171.789 130.095L156.722 99.9295M173.898 156.994C175.061 159.477 175.324 161.562 174.688 163.249C174.37 164.092 173.853 164.788 173.137 165.336L172.656 165.672L172.449 165.172C166.121 156.46 161.094 148.175 157.369 140.318C156.645 139.009 156.559 137.827 157.112 136.772L158.407 135.652L158.498 135.373L173.898 156.994M135.851 30.4024C135.713 30.0688 134.215 27.4137 131.358 22.4373C125.241 13.9596 120.971 7.51009 118.549 3.08883C118.113 2.53368 117.543 2.26388 116.837 2.27945C116.106 2.12181 115.562 2.33473 115.206 2.91823C114.32 4.11075 113.572 5.63692 112.961 7.49675C112.462 9.51701 112.309 11.1767 112.501 12.4758C112.718 13.9481 113.581 18.5992 115.089 26.4292C116.748 34.6795 118.293 40.9556 119.724 45.2575L133.322 70.8607L135.286 69.7748L136.455 69.6023C139.264 69.4535 142.521 69.6368 146.225 70.1525L139.293 40.2479C138.734 37.0562 137.587 33.7744 135.851 30.4024ZM118.123 7.39915L118.31 7.76971C123.447 15.5957 128.329 23.5033 132.958 31.4926C134.307 34.0368 134 35.852 132.036 36.9379L131.795 37.1062L131.589 36.6057C124.007 27.1937 118.993 20.4999 116.549 16.5245C115.328 14.8462 115.164 12.8351 116.057 10.4912C116.523 9.44915 117.051 8.53061 117.642 7.73559L118.123 7.39915V7.39915Z" fill="white"/>
									<path d="M90.8712 83.6248C87.0251 84.546 83.3968 85.7447 79.9865 87.221L78.2947 99.151C74.3097 96.7301 70.2699 94.5384 66.1755 92.576L55.7189 96.3745L57.237 99.469C61.1072 101.11 66.6284 103.747 73.8007 107.38C73.1729 110.923 72.134 115.28 70.6841 120.449L76.7665 118.49C76.8615 120.334 76.4901 121.716 75.6524 122.636C75.0234 123.171 73.7946 123.839 71.9659 124.64L66.4223 126.652C65.2482 127.091 64.5787 128.251 64.4138 130.134C64.4067 131.285 64.5103 132.288 64.7246 133.141L84.7244 124.749L83.5456 110.455C86.0045 112.128 89.6154 115.312 94.3783 120.007L103.291 115.64C102.409 115.062 97.0736 110.982 87.2836 103.4C89.3118 91.9515 90.5077 85.3597 90.8712 83.6248M4.35174 75.6774C-3.94001 81.8556 -11.2336 87.0017 -17.529 91.1157C-20.1344 92.6502 -21.9958 94.429 -23.1133 96.4521C-23.6301 97.1477 -24.3351 98.6675 -25.2283 101.011C-25.5336 101.941 -25.2838 102.435 -24.4788 102.494L14.4991 110.284C14.076 109.816 13.8823 109.402 13.9178 109.043C13.8795 108.783 14.1074 108.528 14.6015 108.278C35.2311 98.157 52.5298 90.6506 66.4976 85.7591C78.303 81.806 87.1057 79.092 92.9054 77.6173C97.0242 76.7445 101.281 76.2053 105.675 75.9997L111.674 76.1769C113.322 76.5532 114.298 77.4712 114.602 78.9307C116.285 84.3457 118.76 90.9271 122.027 98.6749C125.443 106.843 128.305 112.748 130.612 116.39C129.998 117.63 129.073 118.254 127.835 118.259C127.055 118.374 125.111 116.891 122.002 113.81C121.543 113.701 121.054 113.684 120.535 113.761C82.0341 133.508 33.5108 153.097 -25.0352 172.526C-90.7639 194.254 -136.837 204.057 -163.254 201.935L-163.216 202.195L-177.27 211.302C-175.567 212.644 -172.48 214.976 -168.008 218.299C-162.342 220.118 -154.661 218.499 -144.965 213.441L-141.991 218.311C-141.19 220.14 -140.078 221.082 -138.654 221.138C-137.403 221.219 -134.194 220.48 -129.026 218.921C-110.096 213.475 -77.7469 203.616 -31.979 189.345C17.8566 173.855 50.2091 163.421 65.0785 158.043C94.0889 147.747 114.151 139.479 125.265 133.239C133.514 128.571 138.349 124.452 139.769 120.88C141.446 116.65 140.519 110.062 136.987 101.114C130.76 84.6889 127.239 75.5185 126.426 73.6032C124.404 70.0963 121.776 67.8735 118.54 66.9348C116.222 66.2148 113.194 66.0861 109.458 66.5487C103.049 67.4938 96.7649 68.686 90.606 70.1252C81.2326 72.5693 71.9331 74.9141 62.7075 77.1595C54.6943 79.2261 47.0227 78.8088 39.6928 75.9078C32.35 72.9201 28.071 71.2062 26.8558 70.766C23.2355 69.6186 20.2867 69.1243 18.0094 69.2831C14.6673 69.422 10.1148 71.5535 4.35174 75.6774M13.9123 95.5049C13.1983 93.6634 14.2192 92.1855 16.9751 91.0712C17.4819 90.908 20.4592 89.4955 25.907 86.8339C26.8951 86.3342 27.319 85.608 27.1785 84.6554C27.2112 83.6772 26.8059 83.029 25.9626 82.711L13.2897 76.8813C16.7938 74.2408 20.784 73.6966 25.2604 75.2487C31.2246 77.2893 36.6883 79.5364 41.6516 81.9901C42.7064 82.5425 43.2047 83.2211 43.1464 84.0261C43.1009 84.9177 42.7012 85.5076 41.9473 85.7958L15.946 97.5942C14.965 96.9424 14.2871 96.246 13.9123 95.5049M-91.3336 98.2831C-102.93 96.4536 -113.338 99.9795 -122.559 108.861L-122.54 108.991L-108.357 124.155C-107.934 124.623 -107.519 124.739 -107.112 124.502L-89.8782 116.253L-89.0138 118.515C-88.6973 120.061 -88.7527 121.485 -89.1802 122.787C-89.5465 123.903 -90.2913 124.853 -91.4143 125.638L-102.661 131.279L-97.9744 136.959L-85.0045 130.4C-83.6503 134.183 -83.7385 136.585 -85.2691 137.607L-93.3066 142.509L-82.4954 155.515L-87.5918 157.859C-103.133 165.284 -112.191 168.964 -114.766 168.902C-119.831 168.764 -128.096 164.319 -139.563 155.569C-151.17 145.865 -158.413 140.252 -161.292 138.73C-165.823 136.213 -171.308 135.916 -177.75 137.839C-182.918 139.397 -189.885 142.858 -198.651 148.222C-201.256 149.756 -202.325 153.011 -201.857 157.986L-186.178 150.895C-185.259 154.122 -185.585 156.117 -187.154 156.879C-192.403 159.689 -197.059 162.012 -201.124 163.851C-202.556 164.947 -202.859 167.69 -202.034 172.082L-194.749 169.282C-194.341 169.045 -193.982 169.08 -193.671 169.388L-163.049 197.923C-161.763 197.645 -158.981 196.704 -154.705 195.1L-177.271 169.89C-177.495 169.569 -177.59 169.229 -177.554 168.87C-177.345 168.485 -177.124 168.187 -176.89 167.975C-173.652 166.525 -171.261 165.641 -169.715 165.324C-165.769 164.477 -162.163 165.228 -158.896 167.578C-155.53 170.002 -151.584 172.163 -147.056 174.062C-140.198 176.767 -133.959 177.97 -128.339 177.673C-125.517 177.61 -124.122 178.068 -124.155 179.047L-129.602 181.708C-130.937 182.259 -131.501 183.537 -131.294 185.541C-131.066 186.481 -130.759 187.365 -130.372 188.193L-69.9123 166.136C-69.6042 165.825 -69.2514 165.818 -68.8538 166.113L-61.6753 172.487C-60.8165 173.511 -59.7503 173.841 -58.4767 173.476C-51.0315 171.758 -32.125 165.254 -1.75721 153.962C28.4856 142.423 44.674 135.788 46.808 134.058C47.8189 133.112 48.3863 131.259 48.51 128.497C48.4405 126.826 47.2658 125.761 44.9857 125.3C-27.5467 109.893 -72.9864 100.887 -91.3336 98.2831V98.2831Z" fill="white"/>
									</g>
									</g>
									<defs>
									<clipPath id="clip0_125_572">
									<rect width="182" height="182" rx="30" fill="white"/>
									</clipPath>
									<clipPath id="clip1_125_572">
									<rect width="393.939" height="194.343" fill="white" transform="translate(-221 43.4725) rotate(-8.38893)"/>
									</clipPath>
									</defs>
								</svg>


								</a>
								<span class="mobile_p">Aviator</span>
							</li>
							<li>
								<a class="btn_active btn_ active" href="/">
									
									<svg class="icon_mobiles" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="20"><path d="m18 12a6 6 0 1 0 -6 6 6.006 6.006 0 0 0 6-6zm-6 4-3-4 3-4 3 4zm4.391-15.157a12.054 12.054 0 0 1 6.766 6.766l-3.847 1.154a8.048 8.048 0 0 0 -4.073-4.073zm-6.869-.583a11.939 11.939 0 0 1 4.956 0l-1.158 3.858a7.442 7.442 0 0 0 -2.64 0zm10.36 13.06a7.442 7.442 0 0 0 0-2.64l3.858-1.158a11.939 11.939 0 0 1 0 4.956zm-15.764 0-3.858 1.158a11.939 11.939 0 0 1 0-4.956l3.858 1.158a7.442 7.442 0 0 0 0 2.64zm10.36 10.42a11.939 11.939 0 0 1 -4.956 0l1.158-3.858a7.442 7.442 0 0 0 2.64 0zm8.679-7.349a12.054 12.054 0 0 1 -6.766 6.766l-1.154-3.847a8.048 8.048 0 0 0 4.073-4.073zm-22.313-8.782a12.049 12.049 0 0 1 6.765-6.766l1.154 3.847a8.042 8.042 0 0 0 -4.072 4.073zm6.765 15.548a12.049 12.049 0 0 1 -6.765-6.766l3.847-1.154a8.042 8.042 0 0 0 4.072 4.073z"></path></svg>
								</a>
								<span class="mobile_p">Casino</span>
							</li>

							<?php if(auth()->guard()->check()): ?>
							<li>
								<a class="btn_active btn_deposit active" href="/games/chicken-road">
									<img width="20" src="/img/icons/chicken2.svg">
								</a>
								<span class="mobile_p">Chicken Road</span>
							</li>
							<?php else: ?>
							<li>
								<a data-switch="regquick" href="javascript:void(0)">
								<svg xmlns="http://www.w3.org/2000/svg" class="icon_mobiles"  viewBox="0 0 24 24" data-name="Layer 1"><path fill="white" d="m12 0a12 12 0 1 0 12 12 12.013 12.013 0 0 0 -12-12zm0 21a9 9 0 1 1 9-9 9.01 9.01 0 0 1 -9 9zm5-9a1.5 1.5 0 0 1 -1.5 1.5h-2v2a1.5 1.5 0 0 1 -3 0v-2h-2a1.5 1.5 0 0 1 0-3h2v-2a1.5 1.5 0 0 1 3 0v2h2a1.5 1.5 0 0 1 1.5 1.5z"></path></svg>
								</a>
								<span class="mobile_p">Registration</span>
							</li>

							<?php endif; ?>


							<li>
								<a href="javascript:void(0)" id="moreBtn">
									<svg class="icon_mobiles" width="512" height="512" fill="currentColor" viewBox="0 0 512 512">
										<g>
											<path
												d="M31.125 126.493h449.757c17.162 0 31.118-13.956 31.118-31.118S498.044 64.25 480.882 64.25H31.125C13.963 64.25 0 78.213 0 95.375s13.963 31.118 31.125 31.118zM480.882 224.875H31.125C13.963 224.875 0 238.838 0 256s13.963 31.118 31.125 31.118h449.757C498.044 287.118 512 273.162 512 256s-13.956-31.125-31.118-31.125zM480.882 385.5H31.125C13.963 385.5 0 399.471 0 416.632c0 17.162 13.963 31.118 31.125 31.118h449.757c17.162 0 31.118-13.956 31.118-31.118 0-17.161-13.956-31.132-31.118-31.132z"
											></path>
										</g>
									</svg>
								</a>
								<span class="mobile_p">Menu</span>
							</li>
						</nav>
					</div>
					<?php echo $__env->make('layouts.mobile_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
			</div>
		</div>
		
        <?php if(auth()->guard()->guest()): ?>

		<?php echo $__env->make('layouts.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		
        <script>
            function login() {
                $.post('/login', {login: $('#log_acc').val(), password: $('#pass_acc').val()})
                .then((e) => {
                    if(e.error) return notification('error', e.message);

                    notification('success', e.message)
                    setTimeout(() => {
                        location.reload(true);
                    }, 2500);
                });
            }

			function loginEmail() {
 				const form = $('#email_form');
  				const email = form.find('input[type="email"]').val();
  				const password = form.find('#up_email_password').val();

 				 $.post('/login/email', { email: email, password: password })
    				.then((e) => {
      				if (e.error) return notification('error', e.message);

      				notification('success', e.message);
      				setTimeout(() => {
        			location.reload(true);
      				}, 2500);
    			});
			}


			function loginPhone() {
 				const form = $('#phone_form');
				 const phone = '+91' + form.find('input[type="tel"]').val().replace(/\s+/g, '');
				console.log(phone)
  				const password = form.find('#up_phone_password').val();

 				 $.post('/login/phone', { phone: phone, password: password })
    				.then((e) => {
      				if (e.error) return notification('error', e.message);

      				notification('success', e.message);
      				setTimeout(() => {
        			location.reload(true);
      				}, 2500);
    			});
			}

			function regQuick() {
				const form = $('#reg_form');
				const phone = form.find('#up_phone_input_reg').val().replace(/\s+/g, ''); // удаляем пробелы
				const email = form.find('#up_email_input_reg').val();
				const password = form.find('#up_phone_password_reg').val();

				// Получаем Telegram ID
				const telegram_id = localStorage.getItem('telegram_id') || getCookie('telegram_id');

				$.post('/register/quick', {
					phone: phone,
					email: email,
					password: password,
					telegram_id: telegram_id
				}).then((e) => {
					if (e.error) return notification('error', e.message);

					notification('success', e.message);
					setTimeout(() => {
					location.reload(true);
					}, 2500);
				});
			}


            function setReg(type) {
                if(type == 'login') {
                    $('#social').removeClass('active');
                    $('#click').removeClass('active');
                    $('#login').addClass('active');

                    $('#typeReg').val('login');

                    $('#socialTab').hide();
                    $('#loginTab').show();
                }
                else if(type == 'social') {
                    $('#login').removeClass('active');
                    $('#click').removeClass('active');
                    $('#social').addClass('active');

                    $('#loginTab').hide();
                    $('#socialTab').show();
                }
                else if(type == 'click') {
                    $('#social').removeClass('active');
                    $('#login').removeClass('active');
                    $('#click').addClass('active');

                    $('#typeReg').val('click');

                    $('#socialTab').hide();
                    $('#loginTab').hide();
                }
            }
        </script>

        <div aria-expanded="true" role="dialog" aria-modal="true" class="popup popup--auth vm--modal" style="left: 281px; width: 680px; height: auto; top: 217px;">
	<div class="auth__content">
		<button type="button" class="auth__close close2">
			<svg class="icon"><use xlink:href="/images/symbols.svg#close"></use></svg>
		</button>
		<div class="auth__image" style='background-image: url("/signup.png");'></div>
		<div class="auth__inner">
			<div class="auth__top">
				<div class="auth__title">Войти</div>
				<div class="auth__socials">
					<button type="button" onclick="location.href='/vk_auth'">
						<svg class="icon"><use xlink:href="/images/symbols.svg#vk"></use></svg>
					</button>
					<button type="button" onclick="location.href='/tg_auth'">
						<img src="/images/tg.svg" class="icon">
					</button>
					<button type="button" onclick="location.href='/yandex_auth'">
                        <img src="/images/yandex.svg" class="icon">
					</button>
					<button type="button" onclick="location.href='/google_auth'">
                        <img src="/images/google.svg" class="icon">
					</button>
				</div>
				<div class="auth__or">Или</div>
				<form class="modal__form">
					<div class="modal__input"><input type="text" id="log_acc" placeholder="Ваш логин" /></div>
					<div class="modal__input"><input type="password" id="pass_acc" placeholder="Ваш пароль" /></div>
					<div class="modal__form-btn"><button type="button" onclick="login()">Войти</button></div>
					<div class="modal__form-txt">
						Я подтверждаю, что мне исполнилось 18 лет и я ознакомился с
						<a href="/terms" aria-current="page" class="router-link-exact-active router-link-active">условиями предоставления услуг</a>
					</div>
				</form>
			</div>
			<div class="auth__bottom">
				<ul>
<style>
    .white-reg {
        color: white;
        font-weight: bold;
    }
</style>
					<li><a class="white-reg" onclick="$('.popup--auth').removeClass('active');$('.popup--register').addClass('active')">Нет аккаунта?</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!---->
</div>
<div aria-expanded="true" role="dialog" aria-modal="true" class="vm--modal popup popup--register" style="left: 281px; width: 680px; height: auto; top: 169px;">
	<div class="auth__content">
		<button type="button" class="auth__close close2">
			<svg class="icon"><use xlink:href="/images/symbols.svg#close"></use></svg>
		</button>
		<div class="auth__image" style='background-image: url("/signup.png");'></div>
		<div class="auth__inner">
			<div class="auth__top">
				<div class="auth__title">Регистрация</div>
				<form class="modal__form" action="/register" method="POST">
					<div class="auth__tabs">
						<button type="button" id="login" class="active" onclick="setReg('login')">
							По логину
						</button>
                        <button type="button" id="click" onclick="setReg('click')">
							В 1 клик
						</button>
					</div>
                    <br>
					<!---->
					<div class="auth__socials" id="socialTab" style="display:none">
                        <button type="button" onclick="location.href='/vk_auth'">
                            <svg class="icon"><use xlink:href="/images/symbols.svg#vk"></use></svg>
                        </button>
                        <button type="button" onclick="location.href='/tg_auth'">
                            <img src="/images/tg.svg" class="icon">
                        </button>
                        <button type="button" onclick="location.href='/yandex_auth'">
                            <img src="/images/yandex.svg" class="icon">
                        </button>
                        <button type="button" onclick="location.href='/google_auth'">
                            <img src="/images/google.svg" class="icon">
                        </button>
                    </div>

                    <br>
                
                    <input type="hidden" name="type" id="typeReg" value="login">
                    
					<div class="flex flex-col space-y-3" id="loginTab">
                        <?php echo csrf_field(); ?>
						<div class="modal__input" style="border: 1px solid red; border-radius: 7px;">
                            <input type="text" name="name" placeholder="Придумайте логин" />
                        </div>
                        <div class="modal__input" style="border: 1px solid red; border-radius: 7px;">
                            <input type="email" name="email" placeholder="Укажите ваш email" />
                        </div>
						<div class="modal__input" style="border: 1px solid red; border-radius: 7px; display: flex; align-items: center; background: rgb(255, 255, 255);">
							<input type="password" name="password" placeholder="Придумайте пароль" />
						</div>
					</div>
					<div class="modal__form-btn"><button type="submit">Регистрация</button></div>
					<div class="modal__form-txt">
						Я подтверждаю, что мне исполнилось 18 лет и я ознакомился с
						<a href="/terms" aria-current="page" class="router-link-exact-active router-link-active">условиями предоставления услуг</a>
					</div>
				</form>
			</div>
			<div class="auth__bottom pt-[20px]">
				<ul>
					<li><a class="white-reg" onclick="$('.popup--register').removeClass('active');$('.popup--auth').addClass('active')">Уже есть аккаунт?</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!---->
</div>

        
        <?php endif; ?>
		
        <div aria-expanded="true" role="dialog" aria-modal="true" class="popup popup--confirm vm--modal" style="left: 281px; width: 680px; height: auto; top: 309px;">
            <div class="confirm text-white">
                <div class="vue-dialog-content"><div class="vue-dialog-content-title">Сохраните данные от аккаунта</div></div>
                <div class="p-[16px_20px] rounded-[8px] mb-[10px] text-sm bg-[#313648] space-y-2">
                    <div class="flex items-center space-x-2"><span class="text-white">Логин:</span> <b class="text-[15px] text-[#FDCD2D]" id="auth_log">...</b></div>
                    <div class="flex items-center space-x-2"><span class="text-white">Пароль:</span> <b class="text-[15px] text-[#FDCD2D]" id="auth_pass">...</b></div>
                </div>
                <div class="vue-dialog-buttons">
                    <button type="button" class="vue-dialog-button close2">Закрыть</button>
                    <button type="button" class="!text-black !border-[#FDCD2D] !bg-[#FDCD2D] hover:!bg-[#ffe926] hover:!border-[#ffe926]" onclick="downloadData()">Сохранить</button>
                </div>
            </div>
            <!---->
        </div>

			<div class="popup popup--crash-info">
				<div class="popup__title d-flex align-center justify-space-between">
					<span>Режим «Crash»</span>
					<a href="javascript:void(0)" class="close d-flex align-center justify-center">
						<svg class="icon"><use xlink:href="/images/symbols.svg#close"></use></svg>
					</a>
				</div>
				<div class="popup__content">
					<p>Crash - онлайн игра, и как и все онлайн игры имеет недостатки, связанные с сетью</p>
					<div class="text__borders"></div>
					<p>Быстродействие выполнения ручного вывода (кнопка "Вывести деньги"), отображение графика на странице, напрямую зависят от следующих факторов:</p>
					<ol class="show_ul">
						<li>Скорость Вашего интернет соединения</li>
						<li>Пинг до сервера (Latency / Задержка)</li>
						<li>Мощность смартфона или компьютера (используется для обработки данных графика и его показа)</li>
						<li>Время ответа от нашего сервера</li>
					</ol>

					<div class="text__borders"></div>
					<p>
						Сервис не гарантирует своевременного выполнения ручного вывода после нажатия (кнопка "Вывести деньги") и настоятельно рекомендует использовать функцию автоматического вывода средств (поле "Автовывод").
					</p>
					<div class="text__borders"></div>
					<p>
						Функция "Автовывод" используется на стороне сервера, что снижает риск проблем, связанных с своевременным выводом, на 99.9%
					</p>
					<br />
					<div class="bx-input">
						<a onclick="localStorage.setItem('crashAgree', 'true');;$('.close').click()" class="btn btn--red d-flex align-center justify-center is-ripples flare"><span>Я ознакомлен. Закрыть</span></a>
					</div>
				</div>
			</div>

			<?php if(auth()->guard()->check()): ?>
			<div class="popup popup--demo-add">
				<div class="popup__title d-flex align-center justify-space-between">
					<div class="popup__tabs d-flex align-center">
						<div class="popup__tab popup__tab--active d-flex align-center">
							<svg class="icon"><use xlink:href="/images/symbols.svg#plus"></use></svg>
							<span>Пополнение демо баланса</span>
						</div>
					</div>
					<a href="javascript:void(0)" class="close d-flex align-center justify-center">
						<svg class="icon"><use xlink:href="/images/symbols.svg#close"></use></svg>
					</a>
				</div>
				<div class="popup__content">
					<div class="wallet d-flex align-stretch justify-space-between flex-wrap">
						<div class="wallet__content d-flex flex-column justify-space-between" style="width:100%">
							<div class="wallet__content-top">
								<div class="bx-input d-flex flex-column">
									<div class="bx-input__input d-flex align-center justify-space-between">
										<label class="d-flex align-center">Сумма пополнения:</label>
										<div class="d-flex align-center">
											<input type="text" id="add_balance" placeholder="0.00" />
											<svg class="icon money"><use xlink:href="/images/symbols.svg#coins"></use></svg>
										</div>
									</div>
								</div>
							</div>
							<div class="wallet__content-bottom" style="margin-top:10px;">
								<div class="wallet__order d-flex justify-space-between align-center">
									<div class="wallet__txt d-flex flex-column">
										<b class="d-flex align-center">
											Всего к оплате:
											<span class="d-flex align-center">
												<b class="">0</b> <svg class="icon money"><use xlink:href="/images/symbols.svg#coins"></use></svg>
											</span>
										</b>
									</div>
									<a onclick="addDemoBalance()" class="btn is-ripples flare btn--blue d-flex align-center"><span>ПОПОЛНИТЬ</span></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="popup popup--wallet">
				<div class="popup__title d-flex align-center justify-space-between">
					<div class="popup__tabs d-flex align-center">
						<div class="popup__tab popup__tab--active d-flex align-center">
							<svg class="icon"><use xlink:href="/images/symbols.svg#plus"></use></svg>
							<span>Deposit</span>
						</div>
						<div class="popup__tab d-flex align-center">
							<svg class="icon"><use xlink:href="/images/symbols.svg#minus"></use></svg>
							<span>Withdrawal</span>
						</div>
						<div class="popup__tab d-flex align-center">
							<svg class="icon"><use xlink:href="/images/symbols.svg#timer"></use></svg>
							<span>History</span>
						</div>
					</div>
					<a href="javascript:void(0)" class="close d-flex align-center justify-center">
						<svg class="icon"><use xlink:href="/images/symbols.svg#close"></use></svg>
					</a>
				</div>
				<script type="text/javascript">
					function setSystemDep(id){
					    $('#systemDep').val(id)
					}
				</script>
				<div class="popup__content">
					<div class="wallet wallet--refill d-flex align-stretch justify-space-between flex-wrap">
						<div class="wallet__methods">
							<div class="wallet__scroll" ss-container>
								<?php $systemDeps = \App\SystemDep::orderBy('sort', 'asc')->orderBy('id', 'asc')->where('off', 0)->get(); ?> <?php $__currentLoopData = $systemDeps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

								<div onclick="setSystemDep(<?php echo e($s->id); ?>)" class="wallet__method wallet__method--sort-<?php echo e($s->sort); ?>_DEPOSIT wallet__method--<?php echo e($s->id); ?>_DEPOSIT d-flex align-center">
									<img src="<?php echo e($s->img); ?>" />
									<div class="d-flex flex-column">
										<span><?php echo e($s->name); ?></span>
										<b><?php echo e($s->comm_percent); ?>%</b>
									</div>
								</div>

								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>

						<input type="hidden" id="systemDep" name="" />
						<div class="wallet__content d-flex flex-column justify-space-between">
							<div class="wallet__content-top">
								<div class="bx-input d-flex flex-column">
									<div class="bx-input__input d-flex align-center justify-space-between">
										<input type="text" style="text-align: left;" id="sumDep" onkeyup="$('.payDep').html($('#sumDep').val())" placeholder="Amount" />
										<svg class="icon" width="15px" height="15px" viewBox="-96 0 512 512"><path xmlns="http://www.w3.org/2000/svg" d="M308 96c6.627 0 12-5.373 12-12V44c0-6.627-5.373-12-12-12H12C5.373 32 0 37.373 0 44v44.748c0 6.627 5.373 12 12 12h85.28c27.308 0 48.261 9.958 60.97 27.252H12c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h158.757c-6.217 36.086-32.961 58.632-74.757 58.632H12c-6.627 0-12 5.373-12 12v53.012c0 3.349 1.4 6.546 3.861 8.818l165.052 152.356a12.001 12.001 0 0 0 8.139 3.182h82.562c10.924 0 16.166-13.408 8.139-20.818L116.871 319.906c76.499-2.34 131.144-53.395 138.318-127.906H308c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12h-58.69c-3.486-11.541-8.28-22.246-14.252-32H308z"></path></svg>
									</div>
								</div>


								<div class="bx-input d-flex flex-column">
									<div class="bx-input__input d-flex align-center justify-space-between">
										<input id="getPromo" type="text" style="text-align: left;" id="promoDep" placeholder="Promo code" />
									</div>
								</div>

								<div class="bx-input d-flex flex-column">
									<div class="bx-input__input d-flex align-center justify-space-between">
										<label class="d-flex align-center">Amount to be credited:</label>
										<div class="d-flex align-center">
											<span id="getSumBonus" class="bx-input__text" id="get_withdraw"></span>
											<svg class="icon" width="15px" height="15px" viewBox="-96 0 512 512"><path xmlns="http://www.w3.org/2000/svg" d="M308 96c6.627 0 12-5.373 12-12V44c0-6.627-5.373-12-12-12H12C5.373 32 0 37.373 0 44v44.748c0 6.627 5.373 12 12 12h85.28c27.308 0 48.261 9.958 60.97 27.252H12c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h158.757c-6.217 36.086-32.961 58.632-74.757 58.632H12c-6.627 0-12 5.373-12 12v53.012c0 3.349 1.4 6.546 3.861 8.818l165.052 152.356a12.001 12.001 0 0 0 8.139 3.182h82.562c10.924 0 16.166-13.408 8.139-20.818L116.871 319.906c76.499-2.34 131.144-53.395 138.318-127.906H308c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12h-58.69c-3.486-11.541-8.28-22.246-14.252-32H308z"></path></svg>
										</div>
									</div>
								</div>

								<div class="d-flex align-center justify-space-between">
									<div id="getBonus" class="wallet__txt"><span class="d-flex align-center">Bonus: 0%</span></div>
									<!--<div class="wallet__txt"><span class="d-flex align-center">Кэшбэк: <?php echo e(Auth::user()->status == 0 ? 1 :  \App\Status::find(Auth::user()->status)["cashbb"]); ?>%</span></div>!-->
								</div>
							</div>

							
							<div class="wallet__content-bottom">
								<div class="wallet__order d-flex justify-space-between align-center">
								<div class="wallet__txt d-flex flex-column">
										<b class="d-flex align-center">
											Total:
											<span class="d-flex align-center">
												<b class="payDep">0</b> <svg class="icon" width="15px" height="15px" viewBox="-96 0 512 512"><path xmlns="http://www.w3.org/2000/svg" d="M308 96c6.627 0 12-5.373 12-12V44c0-6.627-5.373-12-12-12H12C5.373 32 0 37.373 0 44v44.748c0 6.627 5.373 12 12 12h85.28c27.308 0 48.261 9.958 60.97 27.252H12c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h158.757c-6.217 36.086-32.961 58.632-74.757 58.632H12c-6.627 0-12 5.373-12 12v53.012c0 3.349 1.4 6.546 3.861 8.818l165.052 152.356a12.001 12.001 0 0 0 8.139 3.182h82.562c10.924 0 16.166-13.408 8.139-20.818L116.871 319.906c76.499-2.34 131.144-53.395 138.318-127.906H308c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12h-58.69c-3.486-11.541-8.28-22.246-14.252-32H308z"></path></svg>
											</span>
										</b>
									</div>
									
									<a onclick="disable(this);goDeposit(this)" class="btn is-ripples flare btn--blue d-flex align-center"><span>DEPOSIT</span></a>
								</div>
							</div>
						</div>
					</div>
					<script type="text/javascript"></script>
					<script type="text/javascript">
						document.addEventListener('DOMContentLoaded', () => {
  const bonusEl    = document.getElementById('getBonus');
  const sumBonusEl = document.getElementById('getSumBonus');
  const promoInput = document.getElementById('getPromo');
  const depInput   = document.getElementById('sumDep');

  function updateBonus() {
    const deposit = parseFloat(depInput.value) || 0;
    const isWelcome = promoInput.value.trim().toLowerCase() === 'welcome';
    const bonusPercent = isWelcome ? 500 : 0;

    const bonusAmount = deposit * (bonusPercent / 100);
    const total       = deposit + bonusAmount;

    // вот здесь добавляем "Bonus:"
    bonusEl.innerText    = `Bonus: ${bonusPercent}%`;
    sumBonusEl.innerText = total.toFixed(2);
  }

  promoInput.addEventListener('input', updateBonus);
  depInput  .addEventListener('input', updateBonus);

  updateBonus();
});


						function setSystemW(id, comm_percent, comm_rub, min_sum, example){
						    $('#systemW').val(id)
						    $('#min_sum_withdraws').html(min_sum)
						    $('#comm_percent').val(comm_percent)
						    $("#wallet_withdraw").attr('placeholder', example)
						    updateW()
						}
					</script>
					<div class="wallet wallet--withdraw d-flex align-stretch justify-space-between flex-wrap">
						<div class="wallet__methods">
							<div class="wallet__scroll" ss-container>
								<?php $SystemWithraws = \App\SystemWithdraw::all(); ?> <?php $__currentLoopData = $SystemWithraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

								<div onclick="setSystemW(<?php echo e($s->id); ?>, <?php echo e($s->comm_percent); ?>, <?php echo e($s->comm_rub); ?>, <?php echo e($s->min_sum); ?>, <?php echo e($s->example); ?>)" class="W wallet__method wallet__method--<?php echo e($s->name); ?>_WITHDRAW d-flex align-center">
									<img src="<?php echo e($s->img); ?>" />
									<div class="d-flex flex-column">
										<span><?php echo e($s->name); ?></span>
										<b><?php echo e($s->comm_percent); ?>% <?php if($s->comm_rub > 0): ?> + <?php echo e($s->comm_rub); ?>P <?php endif; ?></b>
									</div>
								</div>

								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>
						<input type="hidden" id="systemW" name="" />
						<input type="hidden" id="comm_rub" name="" />
						<input type="hidden" id="comm_percent" name="" />
						<div class="wallet__content d-flex flex-column justify-space-between">
							<div class="wallet__content-top">
								<div class="bx-input d-flex flex-column">
									<div class="bx-input__input d-flex align-center justify-space-between">
										<input type="text" style="text-align: left;" id="sum_withdraw" onkeyup="$('#sum_itog_pay').html($('#sum_withdraw').val());updateW()" placeholder="Withdrawal amount" />
										<svg class="icon" width="15px" height="15px" viewBox="-96 0 512 512"><path xmlns="http://www.w3.org/2000/svg" d="M308 96c6.627 0 12-5.373 12-12V44c0-6.627-5.373-12-12-12H12C5.373 32 0 37.373 0 44v44.748c0 6.627 5.373 12 12 12h85.28c27.308 0 48.261 9.958 60.97 27.252H12c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h158.757c-6.217 36.086-32.961 58.632-74.757 58.632H12c-6.627 0-12 5.373-12 12v53.012c0 3.349 1.4 6.546 3.861 8.818l165.052 152.356a12.001 12.001 0 0 0 8.139 3.182h82.562c10.924 0 16.166-13.408 8.139-20.818L116.871 319.906c76.499-2.34 131.144-53.395 138.318-127.906H308c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12h-58.69c-3.486-11.541-8.28-22.246-14.252-32H308z"></path></svg>
									</div>
								</div>
								<div class="bx-input d-flex flex-column">
									<div class="bx-input__input d-flex align-center justify-space-between">
										<label class="d-flex align-center">Will be credited to your account:</label>
										<div class="d-flex align-center">
											<span class="bx-input__text" id="get_withdraw"></span>
											<svg class="icon" width="15px" height="15px" viewBox="-96 0 512 512"><path xmlns="http://www.w3.org/2000/svg" d="M308 96c6.627 0 12-5.373 12-12V44c0-6.627-5.373-12-12-12H12C5.373 32 0 37.373 0 44v44.748c0 6.627 5.373 12 12 12h85.28c27.308 0 48.261 9.958 60.97 27.252H12c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h158.757c-6.217 36.086-32.961 58.632-74.757 58.632H12c-6.627 0-12 5.373-12 12v53.012c0 3.349 1.4 6.546 3.861 8.818l165.052 152.356a12.001 12.001 0 0 0 8.139 3.182h82.562c10.924 0 16.166-13.408 8.139-20.818L116.871 319.906c76.499-2.34 131.144-53.395 138.318-127.906H308c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12h-58.69c-3.486-11.541-8.28-22.246-14.252-32H308z"></path></svg>
										</div>
									</div>
								</div>
								<div class="bx-input d-flex flex-column">
									<div class="bx-input__input d-flex align-center justify-space-between">
										<input style="text-align: left;" type="text" id="wallet_withdraw" placeholder="Withdrawal details" />
									</div>
								</div>
							</div>
							<div class="wallet__content-bottom">
								<div class="wallet__order d-flex justify-space-between align-center">
									<div class="wallet__txt d-flex flex-column">
										<span class="d-flex align-center">
											Tax: &nbsp;<span id="min_sum_withdraws">10%</span>
										</span>
										<b class="d-flex align-center">
										Amount to withdraw:
											<span class="d-flex align-center">
												<span class="sum_itog_pay" id="sum_itog_pay">100</span> <svg class="icon" width="15px" height="15px" viewBox="-96 0 512 512"><path xmlns="http://www.w3.org/2000/svg" d="M308 96c6.627 0 12-5.373 12-12V44c0-6.627-5.373-12-12-12H12C5.373 32 0 37.373 0 44v44.748c0 6.627 5.373 12 12 12h85.28c27.308 0 48.261 9.958 60.97 27.252H12c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h158.757c-6.217 36.086-32.961 58.632-74.757 58.632H12c-6.627 0-12 5.373-12 12v53.012c0 3.349 1.4 6.546 3.861 8.818l165.052 152.356a12.001 12.001 0 0 0 8.139 3.182h82.562c10.924 0 16.166-13.408 8.139-20.818L116.871 319.906c76.499-2.34 131.144-53.395 138.318-127.906H308c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12h-58.69c-3.486-11.541-8.28-22.246-14.252-32H308z"></path></svg>
											</span>
										</b>
									</div>
									<a onclick="disable(this);goWithdraw(this)" class="btn is-ripples flare btn--red d-flex align-center"><span>WITHDRAWAL</span></a>
								</div>
								<!--<div class="wallet__order d-flex justify-space-between align-center">
									<div class="wallet__txt d-flex flex-column">
										<span class="d-flex align-center">
											Максимальный вывод с бонуса: &nbsp;
											<span><?php echo e(Auth::user()->status == 0 ? 1000 :  \App\Status::find(Auth::user()->status)["limit"]); ?></span>
											<svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg>
										</span>
									</div>
								</div>!-->
							</div>
						</div>
					</div>
					<?php if(auth()->guard()->check()): ?>
					<div class="wallet wallet--history d-flex flex-column justify-center align-center">
						<div class="wallet__tabs d-flex align-center">
							<div class="wallet__tab wallet__tab--active d-flex align-center">
								<svg class="icon"><use xlink:href="images/symbols.svg#plus"></use></svg>
								<span>Пополнения</span>
							</div>
							<div class="wallet__tab d-flex align-center">
								<svg class="icon"><use xlink:href="images/symbols.svg#minus"></use></svg>
								<span>Выводы</span>
							</div>
						</div>
						<div class="wallet__history wallet__history--refill">
							<?php $deps = \App\Payment::where('user_id', \Auth::user()->id)->orderBy('id', 'desc')->limit(10)->get(); ?> <?php $__currentLoopData = $deps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="wallet__history-item d-flex justify-space-between align-center">
								<div class="wallet__history-left d-flex align-center">
									<div class="wallet__method d-flex align-center">
										<img src="<?php echo e($d->img_system); ?>" />
										<?php $system_dep = \App\SystemDep::where('img', $d->img_system)->first(); ?>
										<span><?php if($system_dep): ?><?php echo e($system_dep->name); ?><?php endif; ?></span>
									</div>
									<div class="wallet__history-sum d-flex align-center">
										<span><?php echo e($d->sum); ?></span>
										<svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg>
									</div>
								</div>
								<div class="wallet__history-status <?php if($d->status == 0): ?> warning <?php else: ?> success <?php endif; ?>">
									<span><?php if($d->status == 0): ?> Ожидание... <?php else: ?> Успешно <?php endif; ?></span>
								</div>
							</div>

							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
						<div class="wallet__history wallet__history--withdraw">
							<?php $withdraws = \App\Withdraw::where('user_id', \Auth::user()->id)->orderBy('id', 'desc')->limit(10)->get(); ?> <?php $__currentLoopData = $withdraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="wallet__history-item d-flex justify-space-between align-center">
								<div class="wallet__history-left d-flex align-center">
									<div class="wallet__method d-flex align-center">
										<img src="<?php echo e($w->img_system); ?>" />
										<?php $system_w = \App\SystemWithdraw::where('img', $w->img_system)->first(); ?>
										<span><?php if($system_w): ?><?php echo e($system_w->name); ?><?php endif; ?></span>
									</div>
									<div class="wallet__history-sum d-flex align-center">
										<span><?php echo e($w->sum); ?></span>
										<svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg>
										<span><?php echo e($w->wallet); ?></span>
									</div>
								</div>
								<div
									id="statusW_<?php echo e($w->id); ?>"
									class="wallet__history-status <?php if($w->status == 0): ?> warning <?php elseif($w->status == 2): ?> error <?php elseif($w->status == 1): ?> success <?php elseif($w->status == 3 || $w->status == 4): ?> warning <?php else: ?> error <?php endif; ?>"
								>
									<span>
										<?php if($w->status == 0): ?> Ожидание... (<a onclick="disable(this);canselWithdraw(<?php echo e($w->id); ?>, this)">Отменить</a>)<?php elseif($w->status == 2): ?> Отменен <?php elseif($w->status == 1): ?> Успешно <?php elseif($w->status == 3): ?>
										Ожидает отправки <?php elseif($w->status == 4): ?> Отправлен <?php else: ?> Ошибка <?php endif; ?>
									</span>
								</div>
							</div>

							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>

					<?php endif; ?> <?php endif; ?>
				</div>
			</div>

			<?php if(auth()->guard()->check()): ?> <?php if(\Auth::user()->admin == 1): ?>
			<div class="popup popup--gokeno">
				<div class="popup__title d-flex align-center justify-space-between">
					<div class="popup__tabs d-flex align-center">
						<div class="popup__tab popup__tab--active d-flex align-center">
							<svg class="icon"><use xlink:href="images/symbols.svg#plus"></use></svg>
							<span>Подкрутка кено</span>
						</div>
					</div>
					<a href="javascript:void(0)" class="close d-flex align-center justify-center">
						<svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
					</a>
				</div>
				<div class="popup__content">
					<div class="wallet d-flex align-stretch justify-space-between flex-wrap">
						<div class="wallet__content d-flex flex-column justify-space-between" style="width:100%">
							<div class="wallet__content-top">
								<div class="bx-input d-flex align-stretch justify-space-between">
									<div class="bx-input__input d-flex align-center justify-space-between">
										<label class="d-flex align-center">Ч-1:</label>
										<div class="d-flex align-center">
											<input type="text" id="kenoGo1" placeholder="0" />
										</div>
									</div>
									<div class="bx-input__input d-flex align-center justify-space-between">
										<label class="d-flex align-center">Ч-2:</label>
										<div class="d-flex align-center">
											<input type="text" id="kenoGo2" placeholder="0" />
										</div>
									</div>
									<div class="bx-input__input d-flex align-center justify-space-between">
										<label class="d-flex align-center">Ч-3:</label>
										<div class="d-flex align-center">
											<input type="text" id="kenoGo3" placeholder="0" />
										</div>
									</div>
								</div>

								<div class="bx-input d-flex align-stretch justify-space-between">
									<div class="bx-input__input d-flex align-center justify-space-between">
										<label class="d-flex align-center">Ч-4:</label>
										<div class="d-flex align-center">
											<input type="text" id="kenoGo4" placeholder="0" />
										</div>
									</div>
									<div class="bx-input__input d-flex align-center justify-space-between">
										<label class="d-flex align-center">Ч-5:</label>
										<div class="d-flex align-center">
											<input type="text" id="kenoGo5" placeholder="0" />
										</div>
									</div>
								</div>
							</div>
							<div class="wallet__content-bottom" style="margin-top:10px;">
								<div class="wallet__order d-flex justify-space-between align-center">
									<div class="wallet__txt d-flex flex-column"></div>
									<a onclick="kenoGo()" class="btn is-ripples flare btn--blue d-flex align-center"><span>Подкрутить</span></a>
								</div>
							</div>

							<div class="text__borders"></div>

							<div class="wallet__content-top">
								<div class="bx-input d-flex align-stretch justify-space-between">
									<div class="bx-input__input d-flex align-center justify-space-between">
										<label class="d-flex align-center">Номер:</label>
										<div class="d-flex align-center">
											<input type="text" id="kenoBonusNumber" placeholder="0" />
										</div>
									</div>
									<div class="bx-input__input d-flex align-center justify-space-between">
										<label class="d-flex align-center">Икс:</label>
										<div class="d-flex align-center">
											<input type="text" id="kenoBonusCoeff" placeholder="0" />
										</div>
									</div>
								</div>
							</div>
							<div class="wallet__content-bottom" style="margin-top:10px;">
								<div class="wallet__order d-flex justify-space-between align-center">
									<div class="wallet__txt d-flex flex-column"></div>
									<a onclick="kenoGoBonus()" class="btn is-ripples flare btn--blue d-flex align-center"><span>Подкрутить бонуску</span></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<script type="text/javascript">
				function kenoGo(){

				    $.post('/keno/go',{_token: csrf_token,
				        kenoGo1: $('#kenoGo1').val(),
				        kenoGo2: $('#kenoGo2').val(),
				        kenoGo3: $('#kenoGo3').val(),
				        kenoGo4: $('#kenoGo4').val(),
				        kenoGo5: $('#kenoGo5').val(),


				    }).then(e=>{

				        if(e.success){

				            notification('success','Успешно')
				        }
				        if(e.error){
				            notification('error',e.error)
				        }
				    }).fail(e=>{
				        notification('error',JSON.parse(e.responseText).message)
				    })
				}

				function kenoGoBonus(){

				    $.post('/keno/bonusgo',{_token: csrf_token,
				        kenoBonusNumber: $('#kenoBonusNumber').val(),
				        kenoBonusCoeff: $('#kenoBonusCoeff').val(),
				    }).then(e=>{
				        if(e.success){

				            notification('success','Успешно')
				        }
				        if(e.error){
				            notification('error',e.error)
				        }
				    }).fail(e=>{
				        notification('error',JSON.parse(e.responseText).message)
				    })
				}
			</script>
			<?php endif; ?> <?php endif; ?>

			<div class="popup popup--coupon">
				<div class="popup__title d-flex align-center justify-space-between">
					<div class="popup__tabs d-flex align-center">
						<div class="popup__tab popup__tab--active d-flex align-center">
							<svg class="icon"><use xlink:href="images/symbols.svg#plus"></use></svg>
							<span>Промокод</span>
						</div>
					</div>
					<a href="javascript:void(0)" class="close d-flex align-center justify-center">
						<svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
					</a>
				</div>
				<div class="popup__content">
					<div class="bx-input d-flex align-center justify-space-between promocodeInputBlock">
						<div class="bx-input__input promocodeInput d-flex align-center justify-space-between">
							<input type="text" style="text-align: left;" id="promo_name" placeholder="ВВЕДИТЕ ПРОМОКОД" />
						</div>

						<a onclick="disable(this);actPromo(this)" class="btn is-ripples flare btn--blue d-flex align-center justify-center promocodeInputBtn"><span>Активировать</span></a>
					</div>
					<div class="tournier__separate"></div>
					<div class="bx-input">
						<div class="bx-input__create-coupon">
							<div class="bx-input__input d-flex align-center justify-space-between">
								<input type="text" style="text-align: left;" id="name_crpromo" placeholder="ПРОМОКОД" />
							</div>
							<div class="bx-input__input d-flex align-center justify-space-between">
								<input style="text-align: left;" type="text" id="sum_crpromo" placeholder="СУММА" />
								<svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg>
							</div>
						</div>
						<div class="bx-input__create-coupon">
							<div class="bx-input__input d-flex align-center justify-space-between">
								<input type="text" style="text-align: left;" placeholder="КОЛИЧЕСТВО АКТИВАЦИЙ" id="act_crpromo" placeholder="0.00" />
								<svg class="icon money"><use xlink:href="images/symbols.svg#users"></use></svg>
							</div>
							<a onclick="disable(this);createPromoUser(this)" style="height: 55px;" class="btn is-ripples flare btn--red d-flex align-center justify-center"><span>Создать</span></a>
						</div>
					</div>
				</div>
			</div>
			<div class="popup popup--send">
				<div class="popup__title d-flex align-center justify-space-between">
					<div class="popup__tabs d-flex align-center">
						<div class="popup__tab popup__tab--active d-flex align-center">
							<svg class="icon"><use xlink:href="images/symbols.svg#minus"></use></svg>
							<span>Перевод средств</span>
						</div>
						<div class="popup__tab d-flex align-center" rel="popup" data-popup="popup--coupon">
							<svg class="icon"><use xlink:href="images/symbols.svg#plus"></use></svg>
							<span>Промокод</span>
						</div>
					</div>
					<a href="javascript:void(0)" class="close d-flex align-center justify-center">
						<svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
					</a>
				</div>
				<div class="popup__content">
					<div class="bx-input">
						<div class="bx-input__create-coupon">
							<div class="bx-input__input d-flex align-center justify-space-between">
								<label class="d-flex align-center">ID игрока:</label>
								<div class="d-flex align-center">
									<input type="text" placeholder="ID" />
								</div>
							</div>
							<div class="bx-input__input d-flex align-center justify-space-between">
								<label class="d-flex align-center">Сумма:</label>
								<div class="d-flex align-center">
									<input type="text" placeholder="0.00" />
									<svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg>
								</div>
							</div>
						</div>
						<div class="bx-input__btn d-flex align-center">
							<a href="javascript:void(0)" class="btn is-ripples flare btn--blue d-flex align-center"><span>Перевести</span></a>
							<div class="history__user d-flex align-center justify-center" style="margin-left: 10px">
								<div
									class="history__user-avatar"
									style="background: url(https://sun1-47.userapi.com/s/v1/ig2/XpJjGMiNkluJe92SSJXtnBchRcr51JMc6-9JVxZO3ZMbCRjtmbKCjmpTRq_2_0cOZ6dVShhXRrA8i381ORNssVHX.jpg?size=200x200&amp;quality=95&amp;crop=31,8,944,944&amp;ava=1) no-repeat center center / cover;"
								></div>
								<span>Владимир Макаров</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="popup popup--promo-history">
				<div class="popup__title d-flex align-center justify-space-between">
					<span>История промокодов</span>
					<a href="#" class="close d-flex align-center justify-center">
						<svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
					</a>
				</div>
				<div class="popup__content">
					<div class="wallet__history">
						<div class="wallet__history-item d-flex justify-space-between align-center">
							<div class="wallet__history-left d-flex align-center">
								<span style="font-weight: 600;margin-right: 20px;">7W8J9K0Q2G2O0A</span>
								<div class="wallet__history-sum d-flex align-center">
									<span>2 / 25 </span>
									<svg class="icon money"><use xlink:href="images/symbols.svg#users"></use></svg>
								</div>
							</div>
							<div class="wallet__history-status">
								<span>Осталось: 3 активации</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php if(auth()->guard()->check()): ?>
			<div class="popup popup--tg popup--about">
				<div class="popup__title d-flex align-center justify-space-between">
					<span>Телеграм</span>
					<a href="#" class="close d-flex align-center justify-center">
						<svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
					</a>
				</div>
				<div class="popup__content">
					<p>
						Для привязки аккаунта напишите нашему боту
						<a href="https://t.me/<?php echo e(\App\Setting::first()->tg_bot_id); ?>" target="_blank" style="cursor: pointer;">@<span style="cursor: pointer;"><?php echo e(\App\Setting::first()->tg_bot_id); ?></span></a> данное сообщение:
					</p>
					<div class="borders"></div>
					<p onclick="copyText(this)" style="text-align:center;width: 100%;font-size:18px;font-weight: 600;">/bind <?php echo e(\Auth::user()->id); ?></p>
					<div class="borders"></div>
					<a onclick="disable(this);checkTgConnect(this)" class="btn btn--red d-flex align-center justify-center is-ripples flare"><span>Проверить привязку</span></a>
				</div>
			</div>
			<?php endif; ?>
			<div class="popup popup--refill popup--about">
				<div class="popup__title d-flex align-center justify-space-between">
					<span>Пополнение</span>
					<a href="#" class="close d-flex align-center justify-center">
						<svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
					</a>
				</div>
				<div class="popup__content">
					<div class="bx-input">
						<div class="bx-input__input d-flex align-center justify-space-between">
							<label class="d-flex align-center">Счёт:</label>
							<div class="d-flex align-center">
								<span class="bx-input__text" id="wallet_pay" onclick="copyText('wallet_pay')">79002224132</span>
								<a href="#" onclick="copyText('wallet_pay')" class="btn btn--blue is-ripples flare d-flex align-center" style="margin-left:5px;"><span>Copy</span></a>
							</div>
						</div>
					</div>
					<div class="bx-input">
						<div class="bx-input__input d-flex align-center justify-space-between">
							<label class="d-flex align-center">Комментарий:</label>
							<div class="d-flex align-center">
								<span class="bx-input__text" id="comment_pay" onclick="copyText('comment_pay')">39618</span>
								<a href="#" onclick="copyText('comment_pay')" class="btn btn--blue is-ripples flare d-flex align-center" style="margin-left:5px;"><span>Copy</span></a>
							</div>
						</div>
					</div>
					<div class="bx-input">
						<div class="bx-input__input d-flex align-center justify-space-between">
							<label class="d-flex align-center">Сумма перевода:</label>
							<div class="d-flex align-center">
								<span class="bx-input__text" id="sum_pay" onclick="copyText('sum_pay')">100</span>
								<svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg>
								<a href="#" onclick="copyText('sum_pay')" class="btn btn--blue is-ripples flare d-flex align-center" style="margin-left:5px;"><span>Copy</span></a>
							</div>
						</div>
					</div>
					<div class="bx-input">
						<a id="check_pay" class="btn btn--red d-flex align-center justify-center is-ripples flare"><span>Проверить перевод</span></a>
					</div>
					<div class="borders"></div>
					<p>При переводе вы должны в точности указать номер кошелька, сумму, комментарий. В случае ошибки деньги не возвращаем.</p>
				</div>
			</div>
			<script>
				function copyText(that){
				    var $temp = $("<input>");
				    $("body").append($temp);
				    $temp.val($(that).text()).select();
				    document.execCommand("copy");
				    $temp.remove();

				    notification('success', 'Скопировано!')
				}
			</script>
			<?php if(\Auth::user() && (\Auth::user()->admin == 1 or \Auth::user()->admin == 2)): ?>
			<script type="text/javascript">
				function  typeChatBan() {
				    type = $('#type_chat_ban').val();
				    $('#type_ban_2').hide()
				    $('#time_chat_ban').val('')
				    if(type == 2){
				        $('#type_ban_2').show()
				    }
				}
			</script>
			<div class="popup popup--ban popup--about">
				<div class="popup__title d-flex align-center justify-space-between">
					<span>Забанить</span>
					<a href="#" class="close d-flex align-center justify-center">
						<svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
					</a>
				</div>
				<input type="hidden" id="chat_id_ban" name="" />
				<div class="popup__content">
					<div class="bx-input bx-input--select d-flex flex-column">
						<label>Причина бана</label>
						<select class="select" id="why_chat_ban">
							<option value="1">Попрошайничество</option>
							<option value="2">Распространение реф кодов</option>
							<option value="3">Оскорбление</option>
							<option value="4">Спам</option>
							<option value="5">Слив промо</option>
							<option value="6">Пиар</option>
							<option value="7">Клевета</option>
							<option value="8">Введение в заблуждение</option>
						</select>
					</div>
					<div class="bx-input bx-input--select d-flex flex-column">
						<label>Бан</label>
						<select class="select" id="type_chat_ban" onchange="typeChatBan()">
							<option value="1">Навсегда</option>
							<option value="2">До какого-то время</option>
						</select>
					</div>
					<div class="bx-input d-flex flex-column" id="type_ban_2" style="display: none;">
						<div class="bx-input__input d-flex align-center justify-space-between">
							<label class="d-flex align-center">Время:</label>
							<div class="d-flex align-center">
								<input type="datetime-local" id="time_chat_ban" />
							</div>
						</div>
					</div>
					<div class="bx-input">
						<a onclick="banMess()" class="btn btn--red d-flex align-center justify-center is-ripples flare"><span>Забанить</span></a>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<div class="popup popup--x30 popup--about">
				<div class="popup__title d-flex align-center justify-space-between">
					<span>Режим «x30»</span>
					<a href="#" class="close d-flex align-center justify-center">
						<svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
					</a>
				</div>
				<div class="popup__content">
					<p>В этом режиме вам предстоит выбрать цвет или цвета и сделать ставку. Если угадаете цвет, который выпадет, то вы выиграли.</p>
					<div class="borders"></div>
					<h4>Возможные ставки:</h4>
					<div class="bets">
						<div class="x30__bet-heading is-ripples flare x2 d-flex align-center justify-space-between">
							<span>X2</span>
							<img src="images/games/x2.svg" />
						</div>
						<div class="x30__bet-heading is-ripples flare x3 d-flex align-center justify-space-between">
							<span>X3</span>
							<img src="images/games/x3.svg" />
						</div>
						<div class="x30__bet-heading is-ripples flare x5 d-flex align-center justify-space-between">
							<span>X5</span>
							<img src="images/games/x5.svg" />
						</div>
						<div class="x30__bet-heading is-ripples flare x7 d-flex align-center justify-space-between">
							<span>X7</span>
							<img src="images/games/x7.svg" />
						</div>
						<div class="x30__bet-heading is-ripples flare x14 d-flex align-center justify-space-between">
							<span>X14</span>
							<img src="images/games/x14.svg" />
						</div>
						<div class="x30__bet-heading is-ripples flare x30 d-flex align-center justify-space-between">
							<span>X30</span>
							<img src="images/games/x30.svg" />
						</div>
					</div>
					<div class="borders"></div>
					<p>Также присуствует бонусная игра, при выпадении которой начинается выбор мультиплеера (от 2х до 7х).</p>
				</div>
			</div>

			<div class="popup popup--x100 popup--about">
				<div class="popup__title d-flex align-center justify-space-between">
					<span>Режим «x100»</span>
					<a href="#" class="close d-flex align-center justify-center">
						<svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
					</a>
				</div>
				<div class="popup__content x100">
					<p>В этом режиме вам предстоит выбрать цвет или цвета и сделать ставку. Если угадаете цвет, который выпадет, то вы выиграли.</p>
					<div class="borders"></div>
					<h4>Возможные ставки:</h4>
					<div class="bets">
						<div class="x30__bet-heading is-ripples flare x2 d-flex align-center justify-space-between">
							<span>X2</span>
							<!-- <img src="images/games/x2.svg"> -->
						</div>
						<div class="x30__bet-heading is-ripples flare x3 d-flex align-center justify-space-between">
							<span>X3</span>
							<!-- <img src="images/games/x3.svg"> -->
						</div>
						<div class="x30__bet-heading is-ripples flare x10 d-flex align-center justify-space-between">
							<span>X10</span>
							<!-- <img src="images/games/x5.svg"> -->
						</div>
						<div class="x30__bet-heading is-ripples flare x15 d-flex align-center justify-space-between">
							<span>X15</span>
							<!-- <img src="images/games/x7.svg"> -->
						</div>
						<div class="x30__bet-heading is-ripples flare x20 d-flex align-center justify-space-between">
							<span>X20</span>
							<!-- <img src="images/games/x14.svg"> -->
						</div>
						<div class="x30__bet-heading is-ripples flare x100 d-flex align-center justify-space-between">
							<span>X100</span>
							<!-- <img src="images/games/x30.svg"> -->
						</div>
					</div>
					<div class="borders"></div>
					<p>Также присуствует бонусная игра, выпадает она в случайную игру. При выпадении, начинается выбор игрока, укоторого выигрыш умножится на 4х.</p>
				</div>
			</div>
			<div class="popup popup--about popup--hits">
				<div class="popup__title d-flex align-center justify-space-between">
					<span>Достижения</span>
					<a href="#" class="close d-flex align-center justify-center">
						<svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
					</a>
				</div>
				<div class="popup__content">
					<table>
						<thead>
							<tr>
								<td>Название</td>
								<td>Депозит</td>
								<td>Бонус</td>
								<td>Кэшбэк %</td>
							</tr>
						</thead>
						<tbody id="all_status_table">
							<tr>
								<td>
									<span class="user-status wolf">Волк</span>
								</td>
								<td>
									<span>100</span>
								</td>
								<td>
									<span>10</span>
								</td>
							</tr>
							<tr>
								<td>
									<span class="user-status predator">Хищник</span>
								</td>
								<td>
									<span>500</span>
								</td>
								<td>
									<span>50</span>
								</td>
							</tr>
							<tr>
								<td>
									<span class="user-status premium">Премиум</span>
								</td>
								<td>
									<span>1000</span>
								</td>
								<td>
									<span>100</span>
								</td>
							</tr>
							<tr>
								<td>
									<span class="user-status alpha">Альфа</span>
								</td>
								<td>
									<span>2500</span>
								</td>
								<td>
									<span>250</span>
								</td>
							</tr>
							<tr>
								<td>
									<span class="user-status vip">Вип</span>
								</td>
								<td>
									<span>5000</span>
								</td>
								<td>
									<span>500</span>
								</td>
							</tr>
							<tr>
								<td>
									<span class="user-status professional">Профи</span>
								</td>
								<td>
									<span>10000</span>
								</td>
								<td>
									<span>1000</span>
								</td>
							</tr>
							<tr>
								<td>
									<span class="user-status legend">Легенда</span>
								</td>
								<td>
									<span>50000</span>
								</td>
								<td>
									<span>5000</span>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="borders"></div>
					<p>
					Достижение - это уровень, для получения которого необходимо выполнить требования по общей сумме пополнений на сайте за все время. Требования для каждого достижения приведены выше. При получении нового достижения игроку выдается одноразовый бонус в размере, указанном в колонке "Бонус". Помимо бонуса за достижение, с каждым новым уровнем у вас растет процент кэшбэка с пополнений.</p>
				</div>
			</div>

			<div class="popup popup--rules">
				<div class="popup__title d-flex align-center justify-space-between">
					<span>Правила чата</span>
					<a href="#" class="close d-flex align-center justify-center">
						<svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
					</a>
				</div>
				<div class="popup__content">
					<h3>В чате запрещено</h3>
					<ol class="show_ul">
						<li>Сливать промо / секретные коды</li>
						<li>Попрошайничество</li>
						<li>Оскорблять администрацию</li>
						<li>Показывать чрезмерную агрессию и негатив</li>
						<li>Обвинять администрацию сайта или сайт в обмане</li>
						<li>Рекламировать сторонние ресурсы</li>
						<li>Спамить / Флудить</li>
						<li>Разжигание ненависти</li>
						<li>Рекламировать реферальный код</li>
					</ol>

					<p class="text-attation">
						Эмоции после поражения могут сыграть с Вами злую шутку.<br />
						И помните: Вы всегда можете вывести средства.
					</p>

					<br />
					<div class="bx-input">
						<a onclick="localStorage.setItem('crashAgree', 'true');;$('.close').click()" class="btn btn--red d-flex align-center justify-center is-ripples flare"><span>Я ознакомлен. Закрыть</span></a>
					</div>
				</div>
			</div>

			<div class="popup popup--fair-dice" style="width: 375px;">
				<div class="popup__title d-flex align-center justify-space-between">
					<span>Dice</span>
					<a href="#" class="close d-flex align-center justify-center">
						<svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
					</a>
				</div>
				<div class="popup__content">
					<div class="dice__check d-flex align-center flex-column">
						<div class="dice__check-chance" id="chanse_dice">30 <</div>
						<div class="dice__check-result dice__check-result--lose d-flex align-end">
							<span id="dice_n_1_check">2</span>
							<span id="dice_n_2_check">9</span>
							<b>,</b>
							<span id="dice_n_3_check">4</span>
							<span id="dice_n_4_check">2</span>
						</div>
					</div>
					<div class="mines__check d-flex justify-space-between align-center">
						<div class="mines__check-sum d-flex align-center">
							<span id="dice_bet">2,212</span>
							<svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg>
						</div>
						<span id="dice_coeff">x3.33</span>
						<div class="mines__check-sum mines__check-sum--total d-flex align-center">
							<span id="dice_win">2,212</span>
							<svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg>
						</div>
					</div>
					<div class="popup__fair d-flex flex-column">
						<div class="popup__fair-item d-flex align-start">
							<b>Full string</b>
							<span id="full_dice">18324ufjdfh2ihi[[123,kmjf</span>
						</div>
						<div class="popup__fair-item d-flex align-start">
							<b>Hash</b>
							<span id="hash_dice">17273721fd9f1jf9idmm11fdi231ij1mjidfhysygu8tgkjmsjgmsgu</span>
						</div>
						<div class="popup__fair-item d-flex align-start">
							<b>Salt1</b>
							<span id="salt1_dice">(6dsi2j,j2,f,[][])</span>
						</div>
						<div class="popup__fair-item d-flex align-start">
							<b>Number</b>
							<span id="number_dice">7772381</span>
						</div>
						<div class="popup__fair-item d-flex align-start">
							<b>Salt2</b>
							<span id="salt2_dice">Q7237yhhiw223r</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			var ADMIN_CHAT = ''
			<?php if(auth()->guard()->guest()): ?>
			var USER_AVA = '';
			var USER_ID = 0;
			var ADMIN_CHAT = '';
			<?php else: ?>

			var USER_ID = <?php echo e(\Auth::user()->id); ?>;
			<?php if(\Auth::user()->admin == 1): ?>
			var ADMIN_CHAT = '<div class="chat__buttons-admins">\
			<a href="#"><svg class="icon"><use xlink:href="/images/symbols.svg#close"></use></svg></a>\
			<a href="#" rel="popup" data-popup="popup--ban"><svg class="icon" style="width: 20px; height: 20px"><use xlink:href="/images/symbols.svg#warning"></use></svg></a>\
			</div>';
			<?php endif; ?>
			<?php endif; ?>
		</script>

		<!--<script src="js/fireworks.js" type="text/javascript"></script>!-->

		<script>

			/*window.onload = function () {
			    var firework = JS_FIREWORKS.Fireworks({
			        id : 'fireworks-canvas',
			        hue : 120,
			        particleCount : 50,
			        delay : 0,
			        minDelay : 20,
			        maxDelay : 40,
			        fireworkSpeed : 3,
			        fireworkAcceleration : 1.05,
			        particleFriction : .95,
			        particleGravity : 1.5
			    });
			    firework.start();
			    var firework2 = JS_FIREWORKS.Fireworks({
			        id : 'fireworks-canvas2',
			        hue : 120,
			        particleCount : 50,
			        delay : 0,
			        minDelay : 20,
			        maxDelay : 40,
			        fireworkSpeed : 4,
			        fireworkAcceleration : 1.05,
			        particleFriction : .95,
			        particleGravity : 1.5
			    });
			    firework2.start();
			};*/



			<?php if(auth()->guard()->check()): ?>
			balanceUpdate(0, <?php echo e(\Auth::user()->type_balance == 0 ? \Auth::user()->balance : \Auth::user()->demo_balance); ?>, 1)
			<?php endif; ?>
			$('#btnSmiles').click(function(e) {
			    e.preventDefault()
			    $('.chat').toggleClass('chat--smiles').removeClass('chat--stickers');
			    $('#btnStickers').removeClass('active');
			    $(this).toggleClass('active');
			});
			$('#btnStickers').click(function(e) {
			    e.preventDefault()
			    $('#btnSmiles').removeClass('active');
			    $('.chat').toggleClass('chat--stickers').removeClass('chat--smiles');
			    $(this).toggleClass('active');
			});
			$('#dropdownUser').click(function(e){
			    e.preventDefault()
			    $(this).toggleClass('dropdown');
			});
			$(document).on('click', function(e) {
			    if (!$(e.target).closest("#dropdownUser").length) {
			        $('.header__user-dropdown').parent().removeClass('dropdown');
			    }
			    e.stopPropagation();
			});

			$(".popup--wallet .popup__content .wallet").not(":first").hide();
			$(".popup--wallet .popup__tab").click(function () {
			    if ($(this).hasClass('popup__tab--active')) {

			    } else {
			        $(".popup--wallet .popup__content .wallet").hide().eq($(this).index()).fadeIn(500);
			    }
			    $('.popup--wallet .popup__tab.popup__tab--active').removeClass('popup__tab--active');
			    $(this).addClass('popup__tab--active');
			    return false;
			});

			$('.wallet--refill .wallet__method').click(function(e) {
			    e.preventDefault()
			    if ($(this).hasClass('active')) {

			    } else {
			        $('.wallet--refill .wallet__method.wallet__method--active').removeClass('wallet__method--active')
			        $(this).addClass('wallet__method--active')
			    }
			});

			$('.wallet--withdraw .wallet__method').click(function(e) {
			    e.preventDefault()
			    if ($(this).hasClass('active')) {

			    } else {
			        $('.wallet--withdraw .wallet__method.wallet__method--active').removeClass('wallet__method--active')
			        $(this).addClass('wallet__method--active')
			    }
			});

			$(".popup--wallet .popup__content .wallet__history").not(":first").hide();
			$(".wallet--history .wallet__tab").click(function () {
			    if ($(this).hasClass('wallet__tab--active')) {

			    } else {
			        $(".popup--wallet .popup__content .wallet__history").hide().eq($(this).index()).fadeIn(500);
			    }
			    $('.wallet--history .wallet__tab.wallet__tab--active').removeClass('wallet__tab--active');
			    $(this).addClass('wallet__tab--active');
			    return false;
			});


			$('.close').click(function(e) {
			    setTimeout(() => {
			        $('.overlayed, .popup, body').removeClass('active');
			    }, 100)
			    $('.overlayed').addClass('animation-closed')
			    return false;
			});
			$('.close2').click(function(e) {
				setTimeout(() => {
					$('.overlayed, .popup, body').removeClass('active');
				}, 100)
				$('.overlayed').addClass('animation-closed')
				return false;
			});
			
			$('.overlayed').click(function(e) {
			    var target = e.target || e.srcElement;
			    if(!target.className.search('overlay')) {
			        setTimeout(() => {
			            $('.overlayed, .popup, body').removeClass('active');
			        }, 100)
			        $('.overlayed').addClass('animation-closed')
			    }
			});
			$(document).ready(function() {
			    // captcha_r()
			    $(document).on("click","[rel=popup]",function() {

			        showPopup($(this).attr('data-popup'));
			        return false;
			    });

			});

			function showPopup(el) {
			    if($('.popup').is('.active')) {
			        $('.popup').removeClass('active');
			    }
			    $('.overlayed, body, .popup.'+el).addClass('active');
			    $('.overlayed').removeClass('animation-closed');
			}



			socket.on('laravel_database_x100Bet',e => {
			    e = $.parseJSON(e)
			    e = e.data
			    class_dop = ''
			    if(e.user_id == USER_ID){
			        class_dop = 'img_no_blur'
			    }
			    dopText = ''
			    <?php if(auth()->guard()->check()): ?>
			    <?php if(\Auth::user()->admin == 1): ?>
			    dopText = '<div class="dopPlusBetX100" onclick="getX100Bonus('+e.user_id+', `'+e.img+'`)">Bonus</div>'
			    <?php endif; ?>
			    <?php endif; ?>
			    $('.x100 .x100__bet-users.x'+e.coff).prepend('<div data-user-id='+e.user_id+' class="x30__bet-user d-flex align-center justify-space-between">'+dopText+'\
			        <div class="history__user d-flex align-center justify-center">\
			        <div class="history__user-avatar '+class_dop+'" style="background: url('+e.img+') no-repeat center center / cover;"></div>\
			        <span>'+e.login+'</span>\
			        </div>\
			        <div class="x30__bet-sum d-flex align-center">\
			        <span>'+(Number(e.bet).toFixed(2))+'</span>\
			        <svg class="icon money" style="margin-left: 8px;"><use xlink:href="images/symbols.svg#coins"></use></svg>\
			        </div>\
			        </div>')

			    $('span[data-sumBetsX100='+e.coff+']').html((e.sumBets).toFixed(0))
			    $('span[data-playersX100='+e.coff+']').html(e.players)

			})


			function chatAdd(data){
			    class_dop = ''
			    if(data.user_id == USER_ID || data.type_mess != 0){
			        class_dop = 'img_no_blur'
			    }

			    <?php if($setting->theme == 0): ?>
			        ava = '<div class="chat__msg-avatar '+class_dop+'" style="background: url('+data.avatar+') no-repeat center center / cover;"></div> '
			    <?php else: ?>
			        ava = '<div class="chat__msg-avatar '+class_dop+'" style="background: url('+data.avatar+') no-repeat center center / cover;"><img src="../images/games/cap_new.png?v=1" class="cap_new"></div> '
			    <?php endif; ?>


			    class_mess = 'mess';


			    if(data.type_mess == 4){
			        class_mess = 'system_mess';
			        <?php if($setting->theme == 0): ?>
			                    ava = '<div class="chat__msg-avatar '+class_dop+'" ></div>';
			                    <?php else: ?>
			                        ava = '<div class="chat__msg-avatar '+class_dop+'" ><img src="../images/games/cap_new.png?v=1" class="cap_new"></div>';
			                    <?php endif; ?>
			    }




			    dopAdminText = ''
			    <?php if(\Auth::user() && (\Auth::user()->admin == 1 or \Auth::user()->admin == 2)): ?>
			    dopAdminText =  '<div class="chat__buttons-admins">\
			    <a onclick="deleteMess('+data.id+')"><svg class="icon"><use xlink:href="/images/symbols.svg#close"></use></svg></a>\
			    <a onclick="banMessSetId('+data.id+')"  rel="popup" data-popup="popup--ban"><svg class="icon" style="width: 20px; height: 20px;pointer-events: none"><use xlink:href="/images/symbols.svg#warning"></use></svg></a>\
			    </div>'
			    <?php endif; ?>


			    $('.chat__messages .ss-wrapper .ss-content').append('<div id="msg_'+data.id+'" class="chat__msg d-flex align-start">\
			        '+ava+'\
			        <div class="chat__msg-info d-flex flex-column">\
			        <b>'+data.time+'</b>\
			        <span>'+data.status_mess+' '+data.autor+'</span>\
			        <div class="chat__msg-message '+class_mess+'">\
			        <span>'+data.content+'</span>\
			        </div>\
			        '+dopAdminText+'\
			        </div>\
			        </div>');

			    chatScroll()


			}



			/*function chatGet(){
			    $.post('/chat/get',{_token: csrf_token}).then(e=>{
			        if(e.history){
			            $('.chat__messages .ss-wrapper .ss-content').html('');
			            e.history.forEach((e)=>{
			                data = e


			                class_dop = ''
			                if(data.user_id == USER_ID || data.type_mess != 0){
			                    class_dop = 'img_no_blur'
			                }

			                <?php if($setting->theme == 0): ?>
			                    ava = '<div class="chat__msg-avatar '+class_dop+'" style="background: url('+data.avatar+') no-repeat center center / cover;"></div> '
			                <?php else: ?>
			                    ava = '<div class="chat__msg-avatar '+class_dop+'" style="background: url('+data.avatar+') no-repeat center center / cover;"><img src="../images/games/cap_new.png?v=1" class="cap_new"></div> '
			                <?php endif; ?>

			                class_mess = 'mess';


			                if(data.type_mess == 4){
			                    class_mess = 'system_mess';
			                    <?php if($setting->theme == 0): ?>
			                    ava = '<div class="chat__msg-avatar '+class_dop+'" ></div>';
			                    <?php else: ?>
			                        ava = '<div class="chat__msg-avatar '+class_dop+'" ><img src="../images/games/cap_new.png?v=1" class="cap_new"></div>';
			                    <?php endif; ?>

			                }



			                dopAdminText = ''
			                <?php if(\Auth::user() && (\Auth::user()->admin == 1 or \Auth::user()->admin == 2)): ?>
			                dopAdminText =  '<div class="chat__buttons-admins">\
			                <a onclick="deleteMess('+data.id+')"><svg class="icon"><use xlink:href="/images/symbols.svg#close"></use></svg></a>\
			                <a onclick="banMessSetId('+data.id+')"  rel="popup" data-popup="popup--ban"><svg class="icon" style="width: 20px; height: 20px;pointer-events: none"><use xlink:href="/images/symbols.svg#warning"></use></svg></a>\
			                </div>'
			                <?php endif; ?>


			                $('.chat__messages .ss-wrapper .ss-content').prepend('<div id="msg_'+data.id+'" class="chat__msg d-flex align-start">\
			                    '+ava+'\
			                    <div class="chat__msg-info d-flex flex-column">\
			                    <b>'+data.time+'</b>\
			                    <span>'+data.status_mess+' '+data.autor+'</span>\
			                    <div class="chat__msg-message '+class_mess+'">\
			                    <span>'+data.content+'</span>\
			                    </div>\
			                    '+dopAdminText+'\
			                    </div>\
			                    </div>');

			                chatScroll()

			            })


			        }

			    })
			}


			chatGet()*/


			<?php if(\Auth::user() && (\Auth::user()->admin == 1 or \Auth::user()->admin == 2)): ?>
			function deleteMess(id){

			    $.post('/chat/delete',{_token: csrf_token, id}).then(e=>{
			      if(e.success){
			        notification('success','Успешно')
			    }else{
			        notification('error',e.mess)
			    }
			})
			}
			function banMessSetId(id){
			    $('#chat_id_ban').val(id)
			}
			function banMess(){
			    why_ban = $('#why_chat_ban').val()
			    time_ban = $('#time_chat_ban').val()
			    id = $('#chat_id_ban').val()
			    $.post('/chat/ban',{_token: csrf_token, id, why_ban, time_ban}).then(e=>{

			      if(e.success){
			        notification('success','Успешно')
			    }else{
			        notification('error',e.mess)
			    }
			})
			}




			<?php endif; ?>



			activeLinks()


			var captcha_r = function () {
			    $('#captcha_reload').html('<div style="width:100%" class="h-captcha" id="captcha"  data-sitekey="952c2020-3e6b-43fe-b941-4659cb499ec7"></div>')
			    console.log('hCaptcha is ready.');
			    var widgetID = hcaptcha.render('captcha', { sitekey: '952c2020-3e6b-43fe-b941-4659cb499ec7' });
			};
		</script>

		<?php if(auth()->guard()->check()): ?> <?php if(\Auth::user()->id != 0): ?>
		<script type="text/javascript">


			function openWinter(id){
			    $.post('/winter/start',{_token: csrf_token, id}).then(e=>{
			        undisable('.winter__item')
			        if(e.success){

			            e.prize.forEach(function(item, i, arr) {
			                $('.winter__item:eq('+i+') .winter__front span').html(item+' Р')

			            })

			            balanceUpdate(e.lastbalance, e.newbalance)
			            notification('success',e.success)
			            notification('success','С Новым годом!')

			            $('.winter__item:eq('+(id - 1)+')').addClass('winter__item--active')

			            setTimeout(() => $('.winter__item').addClass('winter__item--active'),1000);

			            setTimeout(() => location.href='/',2000);

			        }else{
			            notification('error',e.mess)
			        }
			    }).fail(e=>{
			        undisable('.winter__item')
			        notification('error',JSON.parse(e.responseText).message)
			    })
			}



			socket.on('laravel_database_openNewYear', function(data){
			    $('.winter').fadeIn();
			})

			socket.on('laravel_database_closeNewYear', function(data){
			    $('.winter').fadeOut();
			})
		</script>

<?php if(\Auth::user()->newYear == 0 && \App\Setting::first()->newYear == 1): ?>
    <script type="text/javascript">
        $('.winter').fadeIn();
    </script>
    <?php endif; ?>

    <?php endif; ?>

    <script type="text/javascript">
        socket.emit('subscribe', 'roomUser_<?php echo e(\Auth::user()->id); ?>');
    </script>
    <?php endif; ?>

    <?php if(session('error')): ?>
<script>
notification('error', "<?php echo e(session('error')); ?>")
</script>
<?php endif; ?>

<?php if(session('register')): ?>
<script>
var args = ("<?php echo e(session('register')); ?>").split(':');

$('#auth_log').html(args[0]);
$('#auth_pass').html(args[1]);
showPopup('popup--confirm');

function downloadData() {
    var blob = new Blob([`
Данные от аккаунта ${args[0]}:

========================

Логин: ${args[0]}
Пароль: ${args[1]}

========================

Адрес регистрации: ${location.origin}
    `], {type: "text/plain;charset=utf-8"});
    saveAs(blob, `data_${args[0]}.txt`);
}

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

</script>


</body>
</html>

<style type="text/css">
    @media(max-width: 475px){
  .toast-top-right{
    margin-top: 60px!important;
  }
}
</style>
<?php /**PATH /var/www/product/resources/views/layouts/app.blade.php ENDPATH**/ ?>