@auth
@php
$userStatus = \Auth::user()->status;
$name_surname = explode(' ', \Auth::user()->name);
if($userStatus != 0){
	$status = \App\Status::where('id', $userStatus)->first();
	
}
$gamesAll = round(\Auth::user()->win_games + \Auth::user()->lose_games);

@endphp

  <style>
    .up_input-group.error {
      border: 1px solid red;
    }
  </style>
  <!-- Анимация переключения окон -->
  <style>
    .screenWrapper {
      position: relative;
	  width: 100%;
      max-width: 430px;
      height: 850px;
      overflow: hidden;
      margin: 0 auto;
    }
    .screen {
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      transition: transform 0.3s ease;
    }
    #methodsWindow { transform: translateX(0); }
    #topupWindow  { transform: translateX(100%); }
    .screenWrapper.show-topup #methodsWindow { transform: translateX(-100%); }
    .screenWrapper.show-topup #topupWindow  { transform: translateX(0); }
  </style>

  <div class="screenWrapper">

    <!-- Окно 1: выбор метода -->
    <div id="methodsWindow" class="screen">
      <div class="up_main">
        <div class="up_header">
          <button onclick="window.location.href='/'" class="up_back_button">
            <img src="./modals/img/arrow.svg" alt="">Casino
          </button>
          <div class="up_h1">Top up</div>
        </div>
        <div class="up_container">
          <div class="up_h2">All methods</div>
          <div class="up_methods_pay">


			@php $systemDeps = \App\SystemDep::orderBy('sort', 'asc')->orderBy('id', 'asc')->where('off', 0)->get(); @endphp @foreach($systemDeps as $s)
            <a href="#" class="up_item_pay" data-method-id="{{$s->id}}"  data-method-name="{{$s->name}}">
              <img src="{{$s->img}}"><span>{{$s->name}}</span>
            </a>
			@endforeach

          </div>
        </div>
      </div>
    </div>

    <!-- Окно 2: ввод суммы -->
    <div id="topupWindow" class="screen">
      <div class="up_main">
        <div class="up_header">
          <button class="up_back_button">
            <img src="./modals/img/arrow.svg" alt="">Back
          </button>
          <div class="up_h1">Top up</div>
        </div>
        <div class="up_container">
          <div class="up_pay_change_container">
            <div class="up_pay_change_method">
              <img src="./modals/img/gpay.svg" alt="">
              <span class="selected-method">Google Pay</span>
            </div>
            <button class="up_pay_change_button">Change</button>
          </div>

          <div class="up_pay_amount_container">
            <div class="up_h3">Enter the top up amount</div>
            <div class="up_input up_input-group up_bold_input" id="amountGroup">
              <div class="up_icon-wrapper">
                <img class="up_icon_15" src="./modals/img/inr.svg" alt="">
              </div>
              <input
                type="text"
                id="amountInput"
                placeholder="Amount"
                value="1500"
                required
              >
            </div>
            <div class="up_text_input_small">
              <div class="up_h4">Amount of one deposit</div>
              <div class="up_h4">from ₹ 1 500 to ₹ 50 000</div>
            </div>
          </div>

          <div class="up_amounts_select_container">
            <button type="button" class="up_amounts_select_item">₹ 3 000</button>
            <button type="button" class="up_amounts_select_item">₹ 5 000</button>
            <button type="button" class="up_amounts_select_item">₹ 10 000</button>
            <button type="button" class="up_amounts_select_item">₹ 20 000</button>
          </div>

          <div class="up_pay_amount_container">
            <div class="up_h3">Enter the Promo code</div>
            <div class="up_up_input up_input-group up_input_pay_promo" id="promoGroup">
              <input type="text" id="promoInput" placeholder="Promo code" value="">
            </div>
            <div class="up_promo_container">
              <div class="up_promo_text" id="bonusText">BONUS 0%</div>
              <div class="up_promo_text" id="totalText">TOTAL ₹ 0</div>
            </div>
          </div>

          

          <button
            type="button"
            class="up_pay_button_learn"
            id="howToBtn"
          >
            <img src="./modals/img/play.svg" alt="">How to deposit?
          </button>
          <button
            type="button"
            class="up_pay_button"
            id="depositBtn"
            disabled
          >
            Deposit
          </button>
        </div>
      </div>
    </div>

  </div><!-- /.screenWrapper -->

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const wrapper       = document.querySelector('.screenWrapper');
      const itemPays      = document.querySelectorAll('#methodsWindow .up_item_pay');
      const backButtons   = document.querySelectorAll('#methodsWindow .up_back_button, #topupWindow .up_back_button');
      const changeButton  = document.querySelector('#topupWindow .up_pay_change_button');
      const howToBtn      = document.getElementById('howToBtn');
      const depositBtn    = document.getElementById('depositBtn');
      const selImg        = document.querySelector('#topupWindow .up_pay_change_method img');
      const selSpan       = document.querySelector('#topupWindow .selected-method');
      const amountInput   = document.getElementById('amountInput');
      const amountGroup   = document.getElementById('amountGroup');
      const presetBtns    = document.querySelectorAll('.up_amounts_select_item');
      const promoInput    = document.getElementById('promoInput');
      const promoGroup    = document.getElementById('promoGroup');
      const bonusText     = document.getElementById('bonusText');
      const totalText     = document.getElementById('totalText');

      let selectedMethodId   = null;
      let selectedMethodName = null;
      let bonusPercent       = 0;

      // Формат числа с пробелами
      function formatNum(n) {
        return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
      }

      // Пересчитать бонус и total
      function updateBonusAndTotal() {
        const amount = parseInt(amountInput.value, 10) || 0;
        const bonus  = bonusPercent;
        const total  = Math.floor(amount * (1 + bonus / 100));
        bonusText.textContent = `BONUS ${bonus}%`;
        totalText.textContent = `TOTAL ₹ ${formatNum(total)}`;
      }

      // Проверка суммы и установка ошибки
      function validateAmount() {
        amountGroup.classList.remove('error');
        let v = amountInput.value.replace(/\D/g, '');
        amountInput.value = v;
        const num = parseInt(v, 10);
        if (num >= 1500) {
          depositBtn.disabled = false;
          amountGroup.classList.remove('error');
        } else {
          depositBtn.disabled = true;
          amountGroup.classList.add('error');
        }
        updateBonusAndTotal();
      }

      // Проверка промо‑кода
      function validatePromo() {
        const code = promoInput.value.trim().toUpperCase();
        if (code === 'WELCOME') {
          bonusPercent = 500;
          promoGroup.classList.remove('error');
        } else {
          bonusPercent = 0;
          if (code.length > 0) promoGroup.classList.add('error');
          else promoGroup.classList.remove('error');
        }
        updateBonusAndTotal();
      }

      // Выбор метода
      itemPays.forEach(el => {
        el.addEventListener('click', e => {
          e.preventDefault();
          selectedMethodId   = el.dataset.methodId;
          selectedMethodName = el.dataset.methodName;
          selImg.src         = el.querySelector('img').src;
          selSpan.textContent= selectedMethodName;
          wrapper.classList.add('show-topup');
          validateAmount();
          validatePromo();
        });
      });

      // Назад и Change
      [...backButtons, changeButton].forEach(btn => {
        btn.addEventListener('click', e => {
          e.preventDefault();
          wrapper.classList.remove('show-topup');
        });
      });

      // Пресеты сумм
      presetBtns.forEach(btn => {
        btn.addEventListener('click', () => {
          const num = btn.textContent.replace(/\D/g, '');
          amountInput.value = num;
          validateAmount();
        });
      });

      // Ввод вручную
      amountInput.addEventListener('input', validateAmount);

      // Промо‑код
      promoInput.addEventListener('input', validatePromo);

      // How to deposit?
      howToBtn.addEventListener('click', e => {
        e.preventDefault();
        if (!selectedMethodId)      return alert('Сначала выберите метод оплаты');
        if (depositBtn.disabled)    return alert('Сумма должна быть не менее 1500');
        console.log(
          'How to deposit? Метод:', selectedMethodId, selectedMethodName,
          'Сумма:', amountInput.value,
          'Бонус:', bonusPercent + '%',
          'Итог:', totalText.textContent
        );
      });

      // Deposit
      depositBtn.addEventListener('click', e => {
        e.preventDefault();
        if (!selectedMethodId)      return alert('Сначала выберите метод оплаты');
        console.log(
          'Deposit. Метод:', selectedMethodId, selectedMethodName,
          'Сумма:', amountInput.value,
          'Бонус:', bonusPercent + '%',
          'Итог:', totalText.textContent
        );
      });

      // Инициализация
      bonusPercent = 0;
      updateBonusAndTotal();
      validateAmount();
    });
  </script>


@else
<script type="text/javascript">location.href='/';</script>
@endauth
