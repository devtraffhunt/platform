<?php if(auth()->guard()->check()): ?>
<?php
$userStatus = \Auth::user()->status;
$name_surname = explode(' ', \Auth::user()->name);
if ($userStatus != 0) {
$status = \App\Status::where('id', $userStatus)->first();

}
$gamesAll = round(\Auth::user()->win_games + \Auth::user()->lose_games);
$userF = \Auth::user();
$settingsN = \App\Setting::first();
?>

<link rel="stylesheet" href="/styles/importantNoties.css" />




<div class="globalContainer globalContainer_importantNotice">
  <div class="screenWrapper">
    <!-- Вікно 1: Вибір методу -->
    <div class="pagesContainer">
      <div class="up_page up_page_1">
        <div class="up_header">
          <a href="/" class="up_back_button">
            <img src="/img/arrow.svg" alt="">Casino
          </a>
          <div class="up_h1">Important Notice</div>
        </div>
        <div class="up_container">
          <div class="up_balance-box">
            <p class="up_balance-label">Available balance</p>
            <p class="up_balance-amount"  data-balance="<?php echo e($userF->balance); ?>">₹ <?php echo e($userF->balance); ?></p>
          </div>
          <div class="up_warning-title">
            <div class="up_primary-indicator"></div>
            Your account is frozen
          </div>
          <p class="up_text_info">
            Your account <span class="up_text_info_strong">ID:<?php echo e(auth()->user()->id); ?></span>  has been temporarily frozen.
No worries — this happens when your balance reaches the <?php echo e(number_format($settingsN->frozen_amount, 0, '.', ',')); ?> INR limit or during a withdrawal attempt.
<br><br>
As per our platform rules and Indian regulations, Bronze accounts can't hold more than this amount.
<br><br>
 Please withdraw your full balance to restore access.
Details about limits and statuses are available in Section 33 of the VIP Program in our Terms.
<br><br> You can find more information on the official <a href="/sbi.html">State Bank of India</a> website in Section 16.
          </p>
          <div class="up_buttons_row">
            
            <a href="<?php echo e(\App\Setting::first()->support_contact); ?>" class="up_login-btn">
              Support
            </a>
            <a href="/withdrawal" class="up_reg-btn">
              Withdrawal
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
    const formatted = `₹ ${balance.toLocaleString("en-EN", { minimumFractionDigits: 2 })}`;
    document.querySelectorAll(".up_balance-amount").forEach(el => (el.textContent = formatted));
  };

  updateBalanceUI(+balanceFromBackend);
</script>


<?php else: ?>
<script type="text/javascript">
  location.href = '/';
</script>
<?php endif; ?><?php /**PATH /var/www/product/resources/views/frozen.blade.php ENDPATH**/ ?>