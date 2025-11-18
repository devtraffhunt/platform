@php
    $details = $data['details'] ?? [];
    $transaction = $data['transaction'] ?? [];
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
  <title>UWin To‘lov</title>

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <link rel="stylesheet" href="/payment/styles/globals.css" />
  <link rel="stylesheet" href="/payment/styles/style.css" />
</head>

<body data-page="declined">
  <div class="container">
    <div class="contentWrapper">
      <section class="titleWrapper">
        <span>Hisobni to‘ldirish</span>
      </section>

      <section class="paymethodWrapper">
        <div class="paymethodContainer">
          <img src="{{ $data['img_system'] }}" alt="">
          <span class="text">{{ $data['name_system'] }}</span>
        </div>
        <div class="timer">00:00</div>
      </section>

      <section class="closeWrapper">
        <img src="/payment/img/close-circle.svg" alt="">
        <span class="titleInfo">Tranzaksiya rad etildi</span>
        <span class="cash" id="cash">
         {{ $data['sum'] ? number_format($data['sum'], 0, '.', ' ') . ' ' . \App\Setting::first()->currency : '—' }}
        </span>
      </section>

      <section class="details" id="details"
        data-copy="ID: {{ $transaction }}&#10;External ID: {{ $data['external_id'] }}&#10;User ID: {{ $data['user_id'] }}">
        <button class="copy" onclick="copyDataAttributeById(`details`)">
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

      <section class="warning-title">
        <div class="warning-indicator"></div>
        <p>
          <strong>Agar to‘lovni amalga oshirgan bo‘lsangiz</strong> va bu sahifa chiqsa,
          <strong>ekran rasmini oling yoki tafsilotlarni nusxa ko‘chirib, qo‘llab-quvvatlash xizmatiga yuboring</strong>,
          shunda biz to‘lovingizni topishda yordam bera olamiz.
        </p>
      </section>

      <section class="actions">
        <a style="text-decoration:none;" href="{{ route('home') }}" class="logout-btn">UWin’ga qaytish</a>
        <a style="text-decoration:none;" href="{{ \App\Setting::first()->support_contact}}" target="_blank" class="login-btn">Yordam</a>
      </section>
    </div>
  </div>


  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script src="/payment/scripts/loadingPage.js"></script>
  <script src="/payment/scripts/copyText.js"></script>
</body>
</html>
