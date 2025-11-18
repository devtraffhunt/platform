<?php
$settings = \App\Setting::first();
?>

<?php
    use Carbon\Carbon;

    $id = request()->route('id');

    $deposit = \App\Payment::query()
        ->where('payments.id', $id)
        ->where('payments.user_id', auth()->id())
        ->where('payments.ps_system_id', 2)
        ->where('payments.status', 0)
        ->join('system_dep', 'system_dep.number_ps', '=', 'payments.id_system')
        ->select('payments.*', 'system_dep.name as system_name', 'system_dep.img')
        ->first();

    if (!$deposit) {
        echo 'error';
        return;
    }

    // Таймер
    $createdAt = $deposit->created_at instanceof Carbon
        ? $deposit->created_at
        : Carbon::parse($deposit->created_at);

    $elapsedSec = max(0, $createdAt->diffInSeconds(now(), false));
    $ttlSec = max(0, 1800 - $elapsedSec);
    $ttl = gmdate('i:s', $ttlSec);

    // Разбор JSON details
    $details = json_decode($deposit->details, true);

    $bank = $details['bank'] ?? '—';
    $holder = $details['holder'] ?? '—';
    $card = $details['card'] ?? null;

    // форматируем номер карты
    if ($card) {
        $card = preg_replace('/\D/', '', $card);
        $cardFormatted = trim(chunk_split($card, 4, ' '));
    } else {
        $cardFormatted = '—';
    }
?>


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
  <!--<div id="loader">
    <div class="circle"></div>
  </div>!-->
  <div class="container">
    <div class="contentWrapper">
      <section class="titleWrapper">
        <span>To‘lov</span>
      </section>
      <section class="paymethodWrapper">
        <div class="paymethodContainer">
          <img src="<?php echo e($deposit->img_system); ?>" alt="">
          <span class="text"><?php echo e($deposit->system_name); ?></span>
        </div>
        <div class="timer" id="timer"><?php echo e($ttl); ?></div>
      </section>
      <section class="amount_container">
        <div class="h3">To‘ldirish summasi</div>
        <div class="input-group input">
          <div class="icon-wrapper">
            <div style="color: #77829b;
    font-family: Inter;
    font-size: 14px;
    font-weight: 800;" class="up_icon-wrapper">
                <?php echo e(\App\Setting::first()->currency); ?>

                
              </div>
          </div>
          <input class="input-bold" type="text" id="amountInput" placeholder="Amount" value="<?php echo e($deposit->sum); ?>"
            data-copy="<?php echo e($deposit->sum); ?>" required disabled>
          <div class="icon-wrapper" style="background-color: transparent; cursor: pointer;"
            onclick="copyDataAttributeById(`amountInput`)">
            <img class="icon_15" src="/payment/img/copy.svg" alt="">
          </div>
        </div>
        <div class="text_input_small">
          <div class="h4">Bitta to‘lov miqdori</div>
          <div class="h4">Summani nusxa ko‘chiring</div>
        </div>
      </section>
      <section class="step">
        <div class="num">2</div>
        <p class="text">O‘tkazma qilish uchun pastdagi karta raqamini va boshqa rekvizitlarni nusxa ko‘chiring.</p>
      </section>
      <section class="amount_container">
        <div class="h3">Karta raqami</div>
        <div class="input-group input">
          <input class="input-bold" type="text" id="emailInput" data-copy="<?php echo e($card); ?>" value="<?php echo e($cardFormatted); ?>" required disabled>
          <div class="icon-wrapper" style="background-color: transparent; cursor: pointer; width: 20px;"
            onclick="copyDataAttributeById(`emailInput`)">
            <img class="icon_15" src="/payment/img/copy.svg" alt="">
          </div>
          <div class="icon-wrapper"
            style="background-color: transparent; cursor: pointer; width: 20px; margin-right: 12px;">
            <img class="icon_15" src="/payment/img/question.svg" alt="">
          </div>
        </div>
      </section>

      <section class="amount_container">
        <div class="h3">Karta egasi</div>
        <div class="input-group input">
          <input class="input-bold" type="text" id="emailInput" data-copy="<?php echo e($holder); ?>" value="<?php echo e($holder); ?>" required disabled>
          <div class="icon-wrapper" style="background-color: transparent; cursor: pointer; width: 20px;"
            onclick="copyDataAttributeById(`emailInput`)">
            <img class="icon_15" src="/payment/img/copy.svg" alt="">
          </div>
          <div class="icon-wrapper"
            style="background-color: transparent; cursor: pointer; width: 20px; margin-right: 12px;">
            <img class="icon_15" src="/payment/img/question.svg" alt="">
          </div>
        </div>
      </section>

      <section class="amount_container">
        <div class="h3">Bank</div>
        <div class="input-group input">
          <input class="input-bold" type="text" id="emailInput" data-copy="<?php echo e($bank); ?>" value="<?php echo e($bank); ?>" required disabled>
          <div class="icon-wrapper" style="background-color: transparent; cursor: pointer; width: 20px;"
            onclick="copyDataAttributeById(`emailInput`)">
            <img class="icon_15" src="/payment/img/copy.svg" alt="">
          </div>
          <div class="icon-wrapper"
            style="background-color: transparent; cursor: pointer; width: 20px; margin-right: 12px;">
            <img class="icon_15" src="/payment/img/question.svg" alt="">
          </div>
        </div>
      </section>
    
      <section class="step">
        <div class="num">3</div>
        <p class="text">Yuqorida ko‘rsatilgan aniq summani yuqorida ko‘rsatilgan kartaga o‘tkazing.</p>
      </section>
      <!--<section class="step" style="margin-top: 0;">
        <div class="num">4</div>
        <p class="text">To‘lovni tasdiqlash uchun jo‘natuvchining ismi va familiyasini kiriting.</p>
      </section>
      <section class="amount_container">
        <div class="input-group input">
          
          <input class="input-bold" type="text" id="amountUTR" placeholder="Jo‘natuvchining ismi va familiyasini kiriting" required>
          <div class="icon-wrapper" style="background-color: transparent; cursor: pointer;">
            <img class="icon_15" src="/payment/img/question.svg" alt="">
          </div>
        </div>
      </section>!-->
      <section class="actions">
        <button class="reg-btn" id="confirm">Tasdiqlash</button>
<a target="_blank" style="text-decoration:none;" href="https://t.me" class="login-btn">Yordam</a>
<button class="pay_button_learn">Bekor qilish</button>

      </section>
    </div>
  </div>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script src="/payment/scripts/loadingPage.js"></script>
  <script src="/payment/scripts/copyText.js"></script>
  <script src="/payment/scripts/timer.js"></script>
  <script src="/payment/scripts/form.js"></script>
</body>

</html><?php /**PATH /var/www/product/resources/views/payments.blade.php ENDPATH**/ ?>