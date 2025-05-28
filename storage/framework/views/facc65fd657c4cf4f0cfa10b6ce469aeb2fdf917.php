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

		.name_slot_game{
			font-family: 'Inter', sans-serif !important;
		}

		.slot_games_content{
			font-family: 'Inter', sans-serif !important;
		}

		.demo_slot_game{
			font-family: 'Inter', sans-serif !important;
		}

		.head_name_slot_game{
			font-family: 'Inter', sans-serif !important;
		}
	</style>
	<div class="slot_game_panel" style="display:none">
		<div class="head_slot_game">
			<div class="buttons_slot_game">
				<button onclick="goHomeSlots();">
					<svg class="icon" style="transform: rotate(90deg);">
						<use xlink:href="/symbols.svg?v=8#arrow"></use>
					</svg>
				</button>
			</div>
			<div class="head_name_slot_game"></div>
			<div class="buttons_slot_game right">
				<button class="demo_slot_button" style="display: none; font-family: 'Inter', sans-serif;">DEMO</button>
				<button onclick="refreshSlots()">
					<svg class="icon icon_button_slot">
						<use xlink:href="/symbols.svg?v=8#refresh_slot"></use>
					</svg>
				</button>
				<button onclick="bigSlots()">
					<svg class="icon icon_button_slot">
						<use xlink:href="/symbols.svg?v=8#big_window"></use>
					</svg>
				</button>
			</div>
		</div>
		<div class="body_slot_game">
			<iframe id="iframe_slot" scrolling="no" frameborder="0" webkitallowfullscreen="true" allowfullscreen="true" mozallowfullscreen="true"></iframe>
		</div>
	</div>
	<div class="slots_main">
		<div class="headSlots">
			<div class="searchSlots">
				<input type="text" onkeyup="searchSlot(this)" id="search-slots" placeholder="Search..." />
			</div>
			<button class="btnSlots btn is-ripples flare d-flex align-center has-ripple" data-color="#fff"
				data-opacity="0.1" data-duration="0.3" onclick="toggleProviders()">
				Providers
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
					stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
					class="feather feather-chevron-down">
					<polyline points="6 9 12 15 18 9"></polyline>
				</svg>
			</button>
		</div>
		<div class="providersSlots" style="display: none">
			<div class="provider" data-provider="" onclick="slotProvider(this)" style="color: #3a7ce6;">
				<h4>All providers</h4>
			</div>
			<div class="provider" data-provider="pragmatic" onclick="slotProvider(this)">
				<h4>Pragmatic Play</h4>
			</div>
			<div class="provider" data-provider="hacksaw" onclick="slotProvider(this)">
				<h4>Hacksaw</h4>
			</div>
			<div class="provider" data-provider="redtiger" onclick="slotProvider(this)">
				<h4>Red Tiger</h4>
			</div>
			<div class="provider" data-provider="playngo" onclick="slotProvider(this)">
				<h4>Playngo</h4>
			</div>
			<div class="provider" data-provider="relax" onclick="slotProvider(this)">
				<h4>Relax Gaming</h4>
			</div>
			<div class="provider" data-provider="netent" onclick="slotProvider(this)">
				<h4>NetEnt</h4>
			</div>
			<div class="provider" data-provider="amatic" onclick="slotProvider(this)">
				<h4>Amatic</h4>
			</div>
			<div class="provider" data-provider="pushgaming" onclick="slotProvider(this)">
				<h4>Pushgaming</h4>
			</div>
			<div class="provider" data-provider="3oaks" onclick="slotProvider(this)">
				<h4>3oaks</h4>
			</div>
			<div class="provider" data-provider="spribe" onclick="slotProvider(this)">
				<h4>Spribe</h4>
			</div>
			<div class="provider" data-provider="igrosoft" onclick="slotProvider(this)">
				<h4>Igrosoft</h4>
			</div>
			<div class="provider" data-provider="pgsoft" onclick="slotProvider(this)">
				<h4>Pgsoft</h4>
			</div>
			<div class="provider" data-provider="spinomenal" onclick="slotProvider(this)">
				<h4>Spinomenal</h4>
			</div>
			<div class="provider" data-provider="playson" onclick="slotProvider(this)">
				<h4>Playson</h4>
			</div>
		</div>
		<div class="slot_games_content">
		</div>
	<div>
	<script type="text/javascript">
		loadSlots();
	</script>
	<?php if(isset($_GET['game_id']) && isset($_GET['type'])): ?>
	<script type = "text/javascript">
		if (USER_ID == 0) {
			var originalUrl = window.location.href;
			var newUrl = originalUrl.substring(0, originalUrl.indexOf('?'));
			history.pushState({}, '', newUrl);
		} else {
			$('.slot_game_panel').show();
			$('.slots_main').hide();
			$('.header__user-b').hide()
			$('#none_balance').show()
			$('.head_nme_slot_game').html("")
			$('.demo_slot_button').hide()
			playSlot("<?php echo e($_GET['game_id']); ?>", "<?php echo e($_GET['type']); ?>", "0")
		}
	</script>
	<?php endif; ?>
	<div class="btn-up" style="display:none">
		<div class="btn__ico d-flex align-center justify-center">
			<svg class="icon">
				<use xlink:href="../symbols.svg#arrow-up"></use>
			</svg>
		</div>
	</div>
</div>
<?php endif; ?>
<?php endif; ?><?php /**PATH /var/www/product/resources/views/games.blade.php ENDPATH**/ ?>