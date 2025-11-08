@if(!Auth::check())
<script>
  window.location.href = '/?modal=regquick';
</script>
@endif

@php

if (auth()->check()) {
$userFrozen = Auth::user();
$settingsN = \App\Setting::first();
// Если пользователь уже заморожен — ничего не делаем
if ($userFrozen->frozen != 1) {
if ($userFrozen->balance > $settingsN->min_withdrawal_amount && $userFrozen->admin == 0) {
$frozenLimit = $settingsN->frozen_amount;
if ($userFrozen->balance >= $frozenLimit && $frozenLimit != 0) {
$userFrozen->frozen = 1;
$userFrozen->save();
}
}
}
}
@endphp

@if(Auth::check())
@if(Auth::user()->ban && request()->path() !== 'blocked')
@include('blocked')
@elseif(Auth::user()->frozen && request()->path() !== 'frozen')
@include('frozen')
@else

@auth
@php
$settings = \App\Setting::first();
@endphp

<link rel="stylesheet" href="./styles/deposit.css?v=6" />




<div class="globalContainer globalContainer_deposit">
  <!--Відео-->
  <div class="up_video_container" id="up_video_container">
    <div class="up_video_wrapper">
      <div class="up_video_header">
        <span class="up_video_header_label">{{ __('common.instruction') }}</span>
        <button class="up_close-btn up_video_close_global">
          <img class="up_icon_15" src="./img/close.svg" alt="Close">
        </button>
      </div>
      <div class="up_video_block">
        <iframe id="up_video" src="https://www.youtube.com/embed/LXb3EKWsInQ" title="YouTube video" frameborder="0"
          allowfullscreen>
        </iframe>
      </div>
      <button type="button" class="up_login-btn up_video_back up_video_close_global" style="margin-top: 25px;">
        {{ __('common.back') }}
      </button>
    </div>
  </div>
  <div class="screenWrapper">
    <!-- Окно 1: выбор метода -->
    <div id="methodsWindow" class="screen">
      <div class="up_main">
        <div class="up_header">
          <button onclick="window.location.href='/'" class="up_back_button">
            <img src="./img/arrow.svg" alt="">{{ __('common.casino') }}
          </button>
          <div class="up_h1">{{ __('common.top-up') }}</div>
        </div>
        <div class="up_container">
          <div class="up_h2">{{ __('common.all-methods') }}</div>
          <div class="up_methods_pay">

            @php $systemDeps = \App\SystemDep::orderBy('sort', 'asc')->orderBy('id', 'asc')->where('off', 0)->get(); @endphp
            @foreach($systemDeps as $s)
            <a href="javascript:void(0)" class="up_item_pay" data-method-id="{{$s->id}}" data-ps-id="{{$s->ps}}" data-method-name="{{$s->name}}"
              data-from="150000" data-to="30000000" data-recommended="150000">
              <img src="{{$s->img}}" alt=""><span>{{$s->name}}</span>
            </a>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    <!-- Окно 2: ввод суммы -->
    <div id="topupWindow" class="screen">
      <div class="up_main">
        <div class="up_header up_header_secondScreen">
          <button class="up_back_button">
            <img src="./img/arrow.svg" alt="">{{ __('common.back') }}
          </button>
          <div class="up_h1">{{ __('common.top-up') }}</div>
        </div>
        <div class="up_container">
          <div class="up_pay_change_container">
            <div class="up_pay_change_method">
              <img src="./img/google.svg" alt="">
              <span class="selected-method">{{ __('common.тot-selected') }}</span>
            </div>
            <button class="up_pay_change_button">{{ __('common.сhange') }}</button>
          </div>

          <div class="up_pay_amount_container">
            <div class="up_h3">{{ __('common.enter-top-up-amount') }}</div>
            <div class="up_input-group up_input" id="amountGroup">
              <div style="color: #77829b;
    font-family: Inter;
    font-size: 14px;
    font-weight: 800;" class="up_icon-wrapper">
                {{ \App\Setting::first()->currency }}
                
              </div>
              <input class="up_input-bold" type="text" id="amountInput" placeholder="{{ __('common.amount') }}" value="150000" required>
            </div>
            <div class="up_text_input_small">
              <div class="up_h4">{{ __('common.amount-one-deposit') }}</div>
              <div class="up_h4">{{ __('common.from') }} {{ \App\Setting::first()->currency }} <span class="up_from"></span> {{ __('common.to') }} {{ \App\Setting::first()->currency }} <span class="up_to"></span></div>
            </div>
          </div>

          <div class="up_amounts_select_container">
            <button type="button" class="up_amounts_select_item">150,000</button>
            <button type="button" class="up_amounts_select_item">200,000</button>
            <button type="button" class="up_amounts_select_item">250,000</button>
            <button type="button" class="up_amounts_select_item">300,000</button>
          </div>

          <div class="up_pay_amount_container">
            <div class="up_h3">{{ __('common.enter-promo') }}</div>
            <div class="up_input up_input-group" id="promoGroup" style="margin-bottom: 0;">
              <input type="text" id="promoInput" placeholder="Promo code" value="">
            </div>
            <div class="up_promo_container">
              <div class="up_promo_text" id="bonusText">{{ __('common.bonus') }} 0%</div>
              <div class="up_promo_text" id="totalText">{{ __('common.total') }} {{ \App\Setting::first()->currency }} 0</div>
            </div>
          </div>

          <button style="display: none;" type="button" class="up_pay_button_learn up_video_show_global" id="howToBtn">
            <img src="./img/play.svg" alt="">{{ __('common.how-to-deposit') }}
          </button>
          <a class="up_pay_button_learn" target="_blank" href="{{$settings->support_contact}}" style="margin-top: 10px;">
            {{ __('common.support') }}
          </a>
          <button type="button" class="up_reg-btn" style="margin-top: 10px;" id="depositBtn" disabled>
            {{ __('common.deposit') }}
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="./scripts/showVideo.js"></script>
<!--<script src="./scripts/deposit.js?v=72464373333334332223">!-->
  <script>
  document.addEventListener("DOMContentLoaded", () => {
    const query = selector => document.querySelector(selector);
    const queryAll = selector => document.querySelectorAll(selector);


    const elements = {
      wrapper: query(".screenWrapper"),
      itemPays: queryAll("#methodsWindow .up_item_pay"),
      backButtons: queryAll("#methodsWindow .up_back_button, #topupWindow .up_back_button"),
      changeButton: query("#topupWindow .up_pay_change_button"),
      howToBtn: query("#howToBtn"),
      depositBtn: query("#depositBtn"),
      selImg: query("#topupWindow .up_pay_change_method img"),
      selSpan: query("#topupWindow .selected-method"),
      amountInput: query("#amountInput"),
      amountGroup: query("#amountGroup"),
      presetBtns: queryAll(".up_amounts_select_item"),
      promoInput: query("#promoInput"),
      promoGroup: query("#promoGroup"),
      bonusText: query("#bonusText"),
      totalText: query("#totalText"),
      from: query(`.up_from`),
      to: query(`.up_to`),
      videoContainer: query("#up_video_container"),
      video: query("#up_video"),
    };

    let state = {
      selectedMethodId: null,
      selectedMethodName: null,
      bonusPercent: 0,
      //суми
      recommended: 0,
      from: 0,
      to: 0,
      promo: null,
    };

    // Форматує число з пробілами для відображення
    const formatNum = n => n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");

    // Підрахунок бонусу і загальної суми з урахуванням бонусу
    const updateBonusAndTotal = () => {
      const amount = parseInt(elements.amountInput.value, 10) || 0;
      const total = Math.floor(amount * (1 + state.bonusPercent / 100));
      elements.bonusText.textContent = `{{ __('common.bonus') }} ${state.bonusPercent}%`;
      elements.totalText.textContent = `{{ __('common.total') }} {{ \App\Setting::first()->currency }} ${formatNum(total)}`;
    };

    // Перевірка введеної суми і активація кнопки депозиту
    const validateAmount = () => {
      elements.amountGroup.classList.remove("error");

      let v = elements.amountInput.value.replace(/\D/g, "");
      elements.amountInput.value = v;
      const num = parseInt(v, 10);

      let valid = num >= state.from && num <= state.to;

      // Сбрасываем ошибку с UPI
      const upiGroup = document.getElementById("upiGroup");
      if (upiGroup) {
        upiGroup.classList.remove("error");
      }

      // Если нужен UPI — проверяем отдельно
      if (state.selectedPsId == 14 && upiGroup) {
        const upiInputGroup = upiGroup.querySelector(".up_input-group");
        const upiValue = document.getElementById("upiInput").value.trim();
        const upiPattern = /^[\w.\-]+@[\w.\-]+$/; // name@bank

        upiInputGroup.classList.remove("error");

        if (!upiPattern.test(upiValue)) {
          valid = false;
          upiInputGroup.classList.add("error"); // красная рамка только у инпута
        }
      }


      // Дизейбл кнопки по общей проверке
      elements.depositBtn.disabled = !valid;

      // Если сумма невалидная — подсвечиваем сумму
      if (num < state.from || num > state.to) {
        elements.amountGroup.classList.add("error");
      }

      updateBonusAndTotal();
    };




    // Перевірка промокоду і оновлення бонусу
    const validatePromo = () => {
      const code = elements.promoInput.value.trim().toUpperCase();
      state.promo = code;
      if (code === "WELCOME") {
        state.bonusPercent = 500;
        elements.promoGroup.classList.remove("error");
      } else if (code === "7XVIP") {
        state.bonusPercent = 1000;
        elements.promoGroup.classList.remove("error");
      } else {
        state.bonusPercent = 0;
        elements.promoGroup.classList.toggle("error", code.length > 0);
      }
      updateBonusAndTotal();
    };

    // Обробка вибору платіжного методу
    const onMethodSelect = el => {
      // Убираем активный класс со всех и ставим на выбранный
      elements.itemPays.forEach(e => e.classList.remove("up_item_pay_active"));
      el.classList.add("up_item_pay_active");

      // Запоминаем выбранный метод
      state.selectedMethodId = el.dataset.methodId;
      state.selectedMethodName = el.dataset.methodName;
      state.selectedPsId = parseInt(el.dataset.psId, 10);

      // Обновляем выбранную картинку и название
      elements.selImg.src = el.querySelector("img").src;
      elements.selSpan.textContent = state.selectedMethodName;

      // Границы суммы и рекомендованная
      const from = parseInt(el.dataset.from, 10);
      const to = parseInt(el.dataset.to, 10);
      const recommended = parseInt(el.dataset.recommended, 10);

      setDepositData({
        from,
        to,
        recommended
      });

      // === UPI поле только для psId = 14 ===
      if (state.selectedPsId === 14) {
        if (!document.getElementById("upiInput")) {
          const html = `
				<div class="up_pay_amount_container" id="upiGroup">
					<div class="up_h3">Enter your UPI ID</div>
					<div class="up_input up_input-group">
						<input 
							type="text" 
							id="upiInput" 
							name="upi_id" 
							placeholder="example@upi" 
							autocomplete="off"
						>
					</div>
				</div>
			`;
          elements.promoGroup.parentNode.insertAdjacentHTML("beforebegin", html);
          document.getElementById("upiInput").addEventListener("input", validateAmount);
        }
      } else {
        const upiGroup = document.getElementById("upiGroup");
        if (upiGroup) upiGroup.remove();
      }

      // Переходим на экран пополнения
      elements.wrapper.classList.add("show-topup");

      // Запускаем валидацию и обновление бонуса
      validateAmount();
      validatePromo();
    };


    // Скидання стану форми при поверненні на вибір методу
    const resetToMethodScreen = () => {
      elements.wrapper.classList.remove("show-topup");
      elements.amountGroup.classList.remove("error");
      elements.promoGroup.classList.remove("error");
      elements.amountInput.value = state.recommended;
      elements.promoInput.value = "";
      state.bonusPercent = 0;
      updateBonusAndTotal();
      elements.depositBtn.disabled = true;
    };

    // Обробка натискання на швидкі суми
    const onPresetClick = btn => {
      const num = btn.textContent.replace(/\D/g, "");
      elements.amountInput.value = num;
      validateAmount();
    };


    // Клік по "How to deposit?" — показ інформації в консолі
    const handleHowToClick = () => {
      if (!state.selectedMethodId) return alert("Сначала выберите метод оплаты");
      if (elements.depositBtn.disabled) return alert(`Сумма должна быть не менее ${state.from}`);

      console.log("How to deposit?", {
        method: state.selectedMethodName,
        amount: elements.amountInput.value,
        bonus: `${state.bonusPercent}%`,
        total: elements.totalText.textContent,
      });
    };

    // Клік по "Deposit" — показ даних в консолі
    const handleDepositClick = () => {
      if (!state.selectedMethodId) return;

      goDeposit(
        state.selectedMethodId,
        elements.amountInput.value,
        state.promo,
        document.getElementById("upiInput")?.value.trim() || null
      );

    };

    //встановлюємо дані
    const setDepositData = data => {
      state = {
        ...state,
        ...data
      };
      elements.from.textContent = data.from;
      elements.to.textContent = data.to;
      elements.amountInput.value = data.recommended;
    };

    //Доступний баланс
    const updateBalanceUI = balance => {
      const formatted = `{{ \App\Setting::first()->currency }} ${balance.toLocaleString("en-EN", { minimumFractionDigits: 2 })}`;
      const balanceEls = document.querySelectorAll(".up_balance-amount");
      balanceEls.forEach(el => {
        el.textContent = formatted;
      });
    };

    // Події
    elements.itemPays.forEach(el =>
      el.addEventListener("click", e => {
        e.preventDefault();
        onMethodSelect(el);
      }),
    );

    [...elements.backButtons, elements.changeButton].forEach(btn =>
      btn.addEventListener("click", e => {
        e.preventDefault();
        resetToMethodScreen();
      }),
    );

    elements.presetBtns.forEach(btn => btn.addEventListener("click", () => onPresetClick(btn)));

    elements.amountInput.addEventListener("input", validateAmount);
    elements.promoInput.addEventListener("input", validatePromo);

    elements.howToBtn.addEventListener("click", e => {
      e.preventDefault();
      handleHowToClick();
    });

    elements.depositBtn.addEventListener("click", e => {
      e.preventDefault();
      handleDepositClick();
    });

    // Початкова ініціалізація значень, якщо ширина екрану > 800
    if (window.innerWidth > 800 && elements.itemPays.length > 0) {
      onMethodSelect(elements.itemPays[0]);
    }
    updateBonusAndTotal();
    validateAmount();
  });
</script>


@else
<script type="text/javascript">
  location.href = '/';
</script>
@endauth
@endif
@endif