@php
    $details = $data['details'] ?? [];
    $transaction = $data['transaction'] ?? '—';
    $bank = $details['bank'] ?? '—';
    $holder = $details['holder'] ?? '—';
    $card = $details['card'] ?? null;
    $cardFormatted = $card ? trim(chunk_split(preg_replace('/\D/', '', $card), 4, ' ')) : '—';
@endphp

<!DOCTYPE html>
<html lang="uz">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UWin To‘lov muvaffaqiyatli</title>

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <link rel="stylesheet" href="/payment/styles/globals.css" />
  <link rel="stylesheet" href="/payment/styles/style.css" />
</head>

<body data-page="successful">
  <div id="loader">
    <div class="circle"></div>
  </div>

  <div class="container">
    <div class="contentWrapper">

      <!-- Заголовок -->
      <section class="titleWrapper">
        <span>Hisobni to‘ldirish</span>
      </section>

      <!-- Система и таймер -->
      <section class="paymethodWrapper">
        <div class="paymethodContainer">
          <img src="{{ $data['img_system'] }}" alt="">
          <span class="text">{{ $data['name_system'] }}</span>
        </div>
        <div class="timer">00:00</div>
      </section>

      <!-- Успешный блок -->
      <section class="closeWrapper">
        <img src="/payment/img/success-circle.svg" alt="">
        <span class="titleInfo">To‘lov muvaffaqiyatli amalga oshirildi</span>
        <span class="cash success" id="cash">
          {{ $data['sum'] ? number_format($data['sum'], 0, '.', ' ') . ' ' . \App\Setting::first()->currency : '—' }}
        </span>
      </section>

      <!-- Детали -->
      <section class="details" id="details"
        data-copy="ID: {{ $transaction }}&#10;External ID: {{ $data['external_id'] }}&#10;User ID: {{ $data['user_id'] }}">
        <button class="copy" onclick="copyDataAttributeById('details')">
          Tafsilotlar <img src="/payment/img/copy.svg" alt="">
        </button>

        <div class="list">
          <div class="item">
            <span class="label">ID:</span>
            <span class="value" id="id">{{ $transaction }}</span>
          </div>
          <div class="item">
            <span class="label">External ID:</span>
            <span class="value" id="externalId">{{ $data['external_id'] }}</span>
          </div>
          <div class="item">
            <span class="label">User ID:</span>
            <span class="value" id="userId">{{ $data['user_id'] }}</span>
          </div>
        </div>
      </section>

      <!-- Кнопки -->
      <section class="actions">
        <a href="{{ route('home') }}" class="reg-btn" style="text-decoration:none;">UWin’ga qaytish</a>
        <a href="{{ \App\Setting::first()->support_contact}}" target="_blank" class="login-btn" style="text-decoration:none;">Yordam</a>
      </section>
    </div>
  </div>

  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script src="/payment/scripts/loadingPage.js"></script>
  <script src="/payment/scripts/copyText.js"></script>
</body>
</html>
