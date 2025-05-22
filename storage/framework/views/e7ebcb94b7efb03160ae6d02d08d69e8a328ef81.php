<?php if(!Auth::check()): ?>
<script>
	window.location.href = '/?modal=regquick';
</script>
<?php endif; ?>

<?php

if (auth()->check()) {
$userFrozen = Auth::user();

// Если пользователь уже заморожен — ничего не делаем
if ($userFrozen->frozen != 1 && $userFrozen->admin == 0) {
if ($userFrozen->balance > 100000) {
$firstDepositSum = \App\Payment::where('user_id', $userFrozen->id)
->where('status', 1)
->orderBy('created_at', 'asc')
->value('sum') ?? 0;

$frozenLimit = $firstDepositSum * 100;

if ($userFrozen->balance >= $frozenLimit && $frozenLimit != 0) {
$userFrozen->frozen = 1;
$userFrozen->save();
}
}
}
}
?>

<?php if(Auth::check()): ?>
<?php if(Auth::user()->ban && request()->path() !== 'blocked'): ?>
<?php echo $__env->make('blocked', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif(Auth::user()->frozen && request()->path() !== 'frozen'): ?>
<?php echo $__env->make('frozen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>

<?php
$operatorId = 2;
$secret = 'd9;o)o1JBVY;V-(\.z(JHQ:a6vW6c,@8t+-tym-OWQ.-WeaD8as"3mq[Dr:CE1O=f';
$user = Auth::user();
$userId = $user->id ?? 0;
$token = md5("{" . $userId . ":" . $operatorId . ":" . $secret . "}");
?>
<div class="wrapper">
	<style>
		.providersSlots {
			background: #11182a;
			border-radius: 15px;
			margin-top: -40px;
			padding: 40px 15px 70px 15px;
			margin-bottom: 15px;
			display: grid;
			grid-template-columns: repeat(6, 1fr);
			grid-column-gap: 10px;
			grid-row-gap: 10px;
			z-index: 1;
			position: relative;
			font-family: 'Inter', sans-serif;
		}

		@media (max-width: 1200px) {
			.providersSlots {
				grid-template-columns: repeat(5, 1fr);
			}
		}

		@media (max-width: 650px) {
			.providersSlots {
				grid-template-columns: repeat(4, 1fr);
			}
		}

		@media (max-width: 450px) {
			.providersSlots {
				grid-template-columns: repeat(3, 1fr);
			}
		}

		@media (max-width: 370px) {
			.providersSlots {
				grid-template-columns: repeat(2, 1fr);
			}
		}

		.slots--notFound {
			grid-column: 1 / -1;
			text-align: center;
			padding: 40px;
			font-weight: 600;
			font-size: 18px;
		}

		.providersSlots::after {
			content: '';
			position: absolute;
			width: 100%;
			height: 55px;
			background: url(../shape-2.svg) no-repeat center center/contain;
			-webkit-transform: rotate(180deg);
			transform: rotate(360deg);
			bottom: 0;
		}

		.providersSlots .provider {
			text-align: center;
			background: #1f273b;
			border-radius: 10px;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 10px;
			height: 75px;
			cursor: pointer;
		}

		.providersSlots .provider:hover {
			background: #313b56;
			color: #3a7ce6;
		}

		.providersSlots .provider h4 {
			cursor: pointer;
		}

		.providersSlots .provider img {
			width: 100%;
			height: 100%;
			transition: .2s;
			object-fit: contain;
			filter: grayscale(3);
			opacity: .4;
		}

		.provider.active img {
			filter: grayscale(0);
			opacity: 1;
		}

		@media (max-width: 725px) {
			.btn-up {
				right: 20px;
			}
		}

		.slots__container {
			background: #1b2030;
			border-radius: 15px;
		}

		.slotsLeftBox {
			display: flex;
			margin: 10px;
			align-content: center;
			align-items: center;
		}

		.slotsLeftBox img {
			width: 100%;
			height: 100%;
			border-radius: 15px;
			object-fit: cover;
		}

		.slotsLeftBox span {
			font-size: 1.25rem;
			font-weight: 700;
			margin-left: 10px;
		}

		.slotsLoad {
			grid-column: 1 / -1;
			height: 200px;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.headSlots {
			margin-bottom: 15px;
			display: flex;
			align-items: center;
			background: #11182a;
			justify-content: space-between;
			border-radius: 15px;
			height: 70px;
			padding: 10px;
			position: relative;
			z-index: 2;
		}

		.searchSlots {
			display: flex;
			align-items: center;
			width: 100%;
			justify-content: space-between;
			height: 50px;
			border-radius: 15px;
			padding: 0 20px;
			background-color: #1f273b;
		}

		.searchSlots input {
			height: 40px;
			width: calc(100% - 35px);
			border: 0px;
			font-weight: 600;
			color: #fff;
			background-color: transparent;
		}

		.searchSlots input::placeholder {
			color: #FFFFFF;
		}

		.name_slot_game {
			font-family: 'Inter', sans-serif !important;
		}

		.slot_games_content {
			font-family: 'Inter', sans-serif !important;
		}

		.demo_slot_game {
			font-family: 'Inter', sans-serif !important;
		}

		.head_name_slot_game {
			font-family: 'Inter', sans-serif !important;
		}


html, body {
  margin: 0;
  padding: 0;
  height: 100%;
  overflow: hidden;
}

.body_slot_game {
  height: calc(var(--vh, 1vh) * 80); /* ← эквивалент 80vh */
  width: 100%;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  background: #000; /* желательно фиксированный фон */
}


#iframe_slot {
  flex: 1; /* занимает всю доступную высоту родителя */
  width: 100%;
  border: none;
  display: block;
  background: transparent;
}



	</style>
	<div class="slot_game_panel">
		<div class="head_slot_game">
			<div class="buttons_slot_game">
				<button onclick="window.location.href = '/'">
					<svg class="icon" style="transform: rotate(90deg);">
						<use xlink:href="/symbols.svg?v=8#arrow"></use>
					</svg>
				</button>
			</div>
			<div class="head_name_slot_game">Chicken Road</div>
			<div class="buttons_slot_game right">
				<button class="demo_slot_button" style="display: none; font-family: 'Inter', sans-serif;">DEMO</button>
				<button onclick="refreshSlots()">
					<svg class="icon icon_button_slot">
						<use xlink:href="/symbols.svg?v=8#refresh_slot"></use>
					</svg>
				</button>
				<!--<button onclick="bigSlots()">
					<svg class="icon icon_button_slot">
						<use xlink:href="/symbols.svg?v=8#big_window"></use>
					</svg>
				</button>!-->
			</div>
		</div>
		<div class="body_slot_game">
			<iframe id="iframe_slot"
				src="https://qin.raulnk.com/api/modes/game.html?gameMode=chicken-road&operatorId=<?php echo e($operatorId); ?>&authToken=<?php echo e($token); ?>&currency=INR&lang=en&userId=<?php echo e($userId); ?>"
				frameborder="0" allow="autoplay *; screen-wake-lock *; fullscreen *" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true">
			</iframe>

		</div>
	</div>

	<script>
  // Ставим только один раз — при первом рендере
  const vh = window.innerHeight * 0.01;
  document.documentElement.style.setProperty('--vh', `${vh}px`);
</script>

<script>
  window.addEventListener('DOMContentLoaded', () => {
    // Проверка на мобильное устройство по ширине экрана
    if (window.innerWidth <= 768) {
      // Удаляем header по тегу или классу
      const header = document.querySelector('header') || document.querySelector('.header');
      if (header) {
        header.style.display = 'none';
      }

      // Скрываем блок с классом .mobile-menu
      const mobileMenu = document.querySelector('.mobile-menu');
      if (mobileMenu) {
        mobileMenu.style.setProperty('display', 'none', 'important');
      }
    }
  });
</script>


<script>
  function hideMobileMenuForce() {
    const el = document.querySelector('.mobile-menu');
    if (el) {
      el.style.setProperty('display', 'none', 'important');
    }
  }

  // Пробуем сразу скрыть
  hideMobileMenuForce();

  // Следим за DOM на случай, если .mobile-menu появится заново
  const observer = new MutationObserver(() => {
    hideMobileMenuForce();
  });

  observer.observe(document.body, {
    childList: true,
    subtree: true
  });
</script>

<script>
  function closeKeyboardOnEnter() {
    const input = document.querySelector('input[data-testid="bet-input"]');

    if (!input) return;

    // Закрытие по Enter (если сработает)
    input.addEventListener('keydown', function (e) {
      if (e.key === 'Enter') {
        input.blur();
      }
    });

    // Дополнительно: если поле теряет фокус после изменения
    input.addEventListener('change', function () {
      input.blur();
    });

    // Иногда помогает: по input (на случай Telegram WebApp на Android)
    input.addEventListener('input', function (e) {
      if (e.inputType === 'insertLineBreak') {
        input.blur();
      }
    });
  }

  // Подождать, пока поле появится в DOM (если рендерится динамически)
  const observer = new MutationObserver(() => {
    const input = document.querySelector('input[data-testid="bet-input"]');
    if (input) {
      closeKeyboardOnEnter();
      observer.disconnect(); // прекращаем наблюдение после инициализации
    }
  });

  observer.observe(document.body, { childList: true, subtree: true });
</script>



	<script type="text/javascript">
		
		loadSlots();
		
		$('#none_balance').show();
		$('.header__user-b').hide();
	</script>
	<?php if(isset($_GET['game_id']) && isset($_GET['type'])): ?>
	<script type="text/javascript">
		document.addEventListener("DOMContentLoaded", function() {

			if (USER_ID == 0) {
				var originalUrl = window.location.href;
				var newUrl = originalUrl.substring(0, originalUrl.indexOf('?'));
				history.pushState({}, '', newUrl);
			} else {
				$('.slot_game_panel').show();
				$('.slots_main').hide();
				$('.header__user-b').hide();
				$('#none_balance').show();
				$('.head_nme_slot_game').html("");
				$('.demo_slot_button').hide();
				playSlot("<?php echo e($_GET['game_id']); ?>", "<?php echo e($_GET['type']); ?>", "0");
			}
		});
	</script>
	<?php endif; ?>
	<div class="btn-up" style="display:block">
		<div class="btn__ico d-flex align-center justify-center">
			<svg class="icon">
				<use xlink:href="../symbols.svg#arrow-up"></use>
			</svg>
		</div>
	</div>
</div>
<?php endif; ?>
<?php endif; ?><?php /**PATH /var/www/product/resources/views/chicken_road.blade.php ENDPATH**/ ?>