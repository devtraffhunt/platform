<?php
    $details = $data['details'] ?? [];
    $transaction = $data['transaction'] ?? '—';
    $bank = $details['bank'] ?? '—';
    $holder = $details['holder'] ?? '—';
    $card = $details['card'] ?? null;
    $cardFormatted = $card ? trim(chunk_split(preg_replace('/\D/', '', $card), 4, ' ')) : '—';
?>

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
          <img src="<?php echo e($data['img_system']); ?>" alt="">
          <span class="text"><?php echo e($data['name_system']); ?></span>
        </div>
        <div class="timer">00:00</div>
      </section>

      <!-- Успешный блок -->
      <section class="closeWrapper">
        <img src="/payment/img/success-circle.svg" alt="">
        <span class="titleInfo">To‘lov muvaffaqiyatli amalga oshirildi</span>
        <span class="cash success" id="cash">
          <?php echo e($data['sum'] ? number_format($data['sum'], 0, '.', ' ') . ' ' . \App\Setting::first()->currency : '—'); ?>

        </span>
      </section>

      <!-- Детали -->
      <section class="details" id="details"
        data-copy="ID: <?php echo e($transaction); ?>&#10;External ID: <?php echo e($data['external_id']); ?>&#10;User ID: <?php echo e($data['user_id']); ?>">
        <button class="copy" onclick="copyDataAttributeById('details')">
          Tafsilotlar <img src="/payment/img/copy.svg" alt="">
        </button>

        <div class="list">
          <div class="item">
            <span class="label">ID:</span>
            <span class="value" id="id"><?php echo e($transaction); ?></span>
          </div>
          <div class="item">
            <span class="label">External ID:</span>
            <span class="value" id="externalId"><?php echo e($data['external_id']); ?></span>
          </div>
          <div class="item">
            <span class="label">User ID:</span>
            <span class="value" id="userId"><?php echo e($data['user_id']); ?></span>
          </div>
        </div>
      </section>

      <!-- Кнопки -->
      <section class="actions">
        <a href="<?php echo e(route('home')); ?>" class="reg-btn" style="text-decoration:none;">UWin’ga qaytish</a>
        <a href="<?php echo e(\App\Setting::first()->support_contact); ?>" target="_blank" class="login-btn" style="text-decoration:none;">Yordam</a>
      </section>
    </div>
  </div>

  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script src="/payment/scripts/loadingPage.js"></script>
  <script src="/payment/scripts/copyText.js"></script>
</body>
</html>
<?php /**PATH /var/www/product/resources/views/payments/success.blade.php ENDPATH**/ ?>