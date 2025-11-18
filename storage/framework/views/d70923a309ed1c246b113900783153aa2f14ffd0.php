<?php
    $details = $data['details'] ?? [];
    $transaction = $data['transaction'] ?? [];
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
          <img src="<?php echo e($data['img_system']); ?>" alt="">
          <span class="text"><?php echo e($data['name_system']); ?></span>
        </div>
        <div class="timer">00:00</div>
      </section>

      <section class="closeWrapper">
        <img src="/payment/img/close-circle.svg" alt="">
        <span class="titleInfo">Tranzaksiya rad etildi</span>
        <span class="cash" id="cash">
         <?php echo e($data['sum'] ? number_format($data['sum'], 0, '.', ' ') . ' ' . \App\Setting::first()->currency : '—'); ?>

        </span>
      </section>

      <section class="details" id="details"
        data-copy="ID: <?php echo e($transaction); ?>&#10;External ID: <?php echo e($data['external_id']); ?>&#10;User ID: <?php echo e($data['user_id']); ?>">
        <button class="copy" onclick="copyDataAttributeById(`details`)">
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

      <section class="warning-title">
        <div class="warning-indicator"></div>
        <p>
          <strong>Agar to‘lovni amalga oshirgan bo‘lsangiz</strong> va bu sahifa chiqsa,
          <strong>ekran rasmini oling yoki tafsilotlarni nusxa ko‘chirib, qo‘llab-quvvatlash xizmatiga yuboring</strong>,
          shunda biz to‘lovingizni topishda yordam bera olamiz.
        </p>
      </section>

      <section class="actions">
        <a style="text-decoration:none;" href="<?php echo e(route('home')); ?>" class="logout-btn">UWin’ga qaytish</a>
        <a style="text-decoration:none;" href="<?php echo e(\App\Setting::first()->support_contact); ?>" target="_blank" class="login-btn">Yordam</a>
      </section>
    </div>
  </div>


  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script src="/payment/scripts/loadingPage.js"></script>
  <script src="/payment/scripts/copyText.js"></script>
</body>
</html>
<?php /**PATH /var/www/product/resources/views/payments/failed.blade.php ENDPATH**/ ?>