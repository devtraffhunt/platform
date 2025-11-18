<?php if(auth()->guard()->check()): ?>
<?php
    $user = \Auth::user();
    $settings = \App\Setting::first();

 

    // Подставляем реальные значения в текст перевода
    $frozenText = __('common.account-frozen-text');
    $frozenText = str_replace(
        ['%id%', '%limit%'],
        [$user->id, number_format($settings->frozen_amount, 0, '.', ',')],
        $frozenText
    );
?>

<link rel="stylesheet" href="/styles/importantNoties.css" />

<div class="globalContainer globalContainer_importantNotice">
  <div class="screenWrapper">
    <div class="pagesContainer">
      <div class="up_page up_page_1">
        <div class="up_header">
          <a href="/" class="up_back_button">
            <img src="/img/arrow.svg" alt=""><?php echo e(__('common.casino')); ?>

          </a>
          <div class="up_h1"><?php echo e(__('common.important-notice-title')); ?></div>
        </div>

        <div class="up_container">
          <div class="up_balance-box">
            <p class="up_balance-label"><?php echo e(__('common.available-balance')); ?></p>
            <p class="up_balance-amount" data-balance="<?php echo e($user->balance); ?>"><?php echo e(\App\Setting::first()->currency); ?> <?php echo e($user->balance); ?></p>
          </div>

          <div class="up_warning-title">
            <div class="up_primary-indicator"></div>
            <?php echo e(__('common.account-frozen')); ?>

          </div>

          <p class="up_text_info"><?php echo $frozenText; ?></p>

          <div class="up_buttons_row">
            <a href="<?php echo e($settings->support_contact); ?>" class="up_login-btn">
              <?php echo e(__('common.support')); ?>

            </a>
            <a href="/withdrawal" class="up_reg-btn">
              <?php echo e(__('common.withdrawal')); ?>

            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const balanceFromBackend = document.querySelector(`[data-balance]`).dataset.balance;

  const updateBalanceUI = balance => {
    const formatted = `<?php echo e(\App\Setting::first()->currency); ?> ${balance.toLocaleString("en-EN", { minimumFractionDigits: 2 })}`;
    document.querySelectorAll(".up_balance-amount").forEach(el => (el.textContent = formatted));
  };

  updateBalanceUI(+balanceFromBackend);
</script>

<?php else: ?>
<script type="text/javascript">
  location.href = '/';
</script>
<?php endif; ?>
<?php /**PATH /var/www/product/resources/views/frozen.blade.php ENDPATH**/ ?>