@php
    $details = $data['details'] ?? [];
    $transaction = $data['transaction'] ?? [];
    $bank = $details['bank'] ?? '—';
    $holder = $details['holder'] ?? '—';
    $card = $details['card'] ?? null;
    $cardFormatted = $card ? trim(chunk_split(preg_replace('/\D/', '', $card), 4, ' ')) : '—';
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>uwin Payment</title>

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <link rel="stylesheet" href="/payment/styles/globals.css" />
  <link rel="stylesheet" href="/payment/styles/style.css" />
</head>

<body data-page="payment">
  <div id="loader">
    <div class="circle"></div>
  </div>
  <div class="container">
    <div class="contentWrapper">

      <!-- Заголовок -->
      <section class="titleWrapper">
        <span>To‘lov</span>
      </section>

      <!-- Платёжная система и таймер -->
      <section class="paymethodWrapper">
        <div class="paymethodContainer">
          <img src="{{ $data['img_system'] }}" alt="">
          <span class="text">{{ $data['name_system'] }}</span>
        </div>
        <div class="timer" id="timer">{{ $data['ttl'] }}</div>
      </section>

      <!-- Сумма -->
      <section class="amount_container">
        <div class="h3">To‘ldirish summasi</div>
        <div class="input-group input">
          <div class="icon-wrapper">
            <div class="up_icon-wrapper" style="color: #77829b; font-family: Inter; font-size: 14px; font-weight: 800;">
              {{ \App\Setting::first()->currency }}
            </div>
          </div>
          <input class="input-bold" type="text" id="amountInput" placeholder="Amount"
            value="{{ $data['sum'] }}" data-copy="{{ $data['sum'] }}" required disabled>
          <div class="icon-wrapper" style="background-color: transparent; cursor: pointer;"
            onclick="copyDataAttributeById('amountInput')">
            <img class="icon_15" src="/payment/img/copy.svg" alt="">
          </div>
        </div>
        <div class="text_input_small">
          <div class="h4">Bitta to‘lov miqdori</div>
          <div class="h4">Summani nusxa ko‘chiring</div>
        </div>
      </section>

      <!-- Инструкция -->
      <section class="step">
        <div class="num">2</div>
        <p class="text">
          O‘tkazma qilish uchun pastdagi karta raqamini va boshqa rekvizitlarni nusxa ko‘chiring.
        </p>
      </section>

      <!-- Карта -->
      <section class="amount_container">
        <div class="h3">Karta raqami</div>
        <div class="input-group input">
          <input class="input-bold" type="text" id="cardInput" data-copy="{{ $card }}"
            value="{{ $cardFormatted }}" required disabled>
          <div class="icon-wrapper" style="background-color: transparent; cursor: pointer; width: 20px;"
            onclick="copyDataAttributeById('cardInput')">
            <img class="icon_15" src="/payment/img/copy.svg" alt="">
          </div>
          <div class="icon-wrapper"
            style="background-color: transparent; cursor: pointer; width: 20px; margin-right: 12px;">
            <img class="icon_15" src="/payment/img/question.svg" alt="">
          </div>
        </div>
      </section>

      <!-- Владелец карты -->
      <section class="amount_container">
        <div class="h3">Karta egasi</div>
        <div class="input-group input">
          <input class="input-bold" type="text" id="holderInput" data-copy="{{ $holder }}"
            value="{{ $holder }}" required disabled>
          <div class="icon-wrapper" style="background-color: transparent; cursor: pointer; width: 20px;"
            onclick="copyDataAttributeById('holderInput')">
            <img class="icon_15" src="/payment/img/copy.svg" alt="">
          </div>
          <div class="icon-wrapper"
            style="background-color: transparent; cursor: pointer; width: 20px; margin-right: 12px;">
            <img class="icon_15" src="/payment/img/question.svg" alt="">
          </div>
        </div>
      </section>

      <!-- Банк -->
      <section class="amount_container">
        <div class="h3">Bank</div>
        <div class="input-group input">
          <input class="input-bold" type="text" id="bankInput" data-copy="{{ $bank }}"
            value="{{ $bank }}" required disabled>
          <div class="icon-wrapper" style="background-color: transparent; cursor: pointer; width: 20px;"
            onclick="copyDataAttributeById('bankInput')">
            <img class="icon_15" src="/payment/img/copy.svg" alt="">
          </div>
          <div class="icon-wrapper"
            style="background-color: transparent; cursor: pointer; width: 20px; margin-right: 12px;">
            <img class="icon_15" src="/payment/img/question.svg" alt="">
          </div>
        </div>
      </section>

      <!-- Инструкция 3 -->
      <section class="step">
        <div class="num">3</div>
        <p class="text">
          Yuqorida ko‘rsatilgan aniq summani yuqorida ko‘rsatilgan kartaga o‘tkazing.
        </p>
      </section>
      <input type="hidden" id="emailInput" value="dummy@example.com">

      <!-- Действия -->
      <section class="actions">
        <button class="reg-btn" id="confirm">To‘lovni tekshirish</button>
        <a target="_blank" style="text-decoration:none;" href="{{ \App\Setting::first()->support_contact}}" class="login-btn">Yordam</a>
        <button class="pay_button_learn" id="cancel" >Bekor qilish</button>
      </section>
    </div>
  </div>


   <script>
    const transaction = @json($transaction);
</script>
  <script src="/payment/scripts/checker.js?v=226224"></script>


  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script src="/payment/scripts/loadingPage.js"></script>
  <script src="/payment/scripts/copyText.js"></script>
  <script src="/payment/scripts/timer.js?v32"></script>

 
</body>

</html>
