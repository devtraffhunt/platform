<?php if(!Auth::check()): ?>
<script>
  window.location.href = '/?modal=regquick';
</script>
<?php endif; ?>

<?php if(Auth::check() && Auth::user()->ban && request()->path() !== 'blocked'): ?>
<?php echo $__env->make('blocked', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
<?php if(auth()->guard()->check()): ?>

<?php
$settings = \App\Setting::first();
$min_with = $settings->min_withdrawal_amount;

if (\Auth::user()->balance < $settings->frozen_amount && \Auth::user()->frozen == 1) {
  $min_with = 60000;
}

if(\Auth::user()->balance < 1500){
  $min_with = 1500;
}
?>

<?php
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: /withdrawals");
    exit;
}

$withdrawal = \App\WithdrawFrozen::where('id', $id)
    ->where('user_id', auth()->id())
    ->first();

if (!$withdrawal) {
    header("Location: /withdrawals");
    exit;
}
?>

<?php
function inr($n) {
    $n = number_format((float)$n, 2, '.', '');
    [$i, $d] = explode('.', $n);
    return (strlen($i) > 3)
        ? preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', substr($i, 0, -3)) . ',' . substr($i, -3) . '.' . $d
        : $i . '.' . $d;
}

function safe_div($a, $b, $precision = 2) {
    if (empty($b) || $b == 0) {
        return 0;
    }
    return round($a / $b, $precision);
}
?>

<link rel="stylesheet" href="./styles/output.css?v=2" />
<div class="globalContainer globalContainer_output">
  <div class="screenWrapper">
    <div class="pagesContainer">
      <div class="up_page up_page_1">
        <div class="up_header">
          <button onclick="window.location.href='/withdrawals'" class="up_back_button">
            <img src="./img/arrow.svg" alt=""><?php echo e(__('common.back')); ?>

          </button>
          <div class="up_h1"><?php echo e(__('common.withdrawal')); ?></div>
        </div>

        <div class="up_container">
          <div class="up_balance-box">
            <p class="up_balance-label"><?php echo e(__('common.available-balance')); ?></p>
            <p class="up_balance-amount">₹ <?php echo e(inr($withdrawal->amount)); ?></p>
          </div>

          <div class="up_warning-title">
            <div class="up_warning-indicator"></div>
            <?php echo e(__('common.frozen-warning')); ?>

          </div>

          <div id="goPayBlock" class="up_alert" style="margin-top: 25px;">
            <div class="up_flex-row" style="justify-content: space-between;">
              <p class="up_text-muted"><?php echo e(__('common.amount-to-pay')); ?></p>
              <p class="up_text-muted"><?php echo e(__('common.tax-percentage')); ?></p>
            </div>
            <div class="up_flex-row" style="justify-content: space-between;">
              <p class="up_text-dark up_res_10" style="font-weight: 700; font-size: 18px;">
                ₹ <?php echo e(inr(safe_div($withdrawal->amount, 10))); ?>

              </p>
              <p class="up_text-dark" style="font-weight: 700; font-size: 18px;">10.00%</p>
            </div>
          </div>

          <div class="up_text-start up_text-dark"
            style="margin-top: 25px; display: flex; align-items: center; gap: 10px; font-weight: 700;">
            <div class="up_success-indicator"></div>
            <div>
              <?php echo e(__('common.after-payment')); ?> <span class="up_green-text up_balance-amount">₹ <?php echo e(inr($withdrawal->amount)); ?></span>.
            </div>
          </div>

          <p class="up_info-section-title"><?php echo e(__('common.select-payment-method')); ?></p>

          <div class="up_methods_pay">
            <?php 
              $systemDeps = \App\SystemDep::orderBy('sort', 'asc')->orderBy('id', 'asc')->where('off', 0)->get(); 
            ?>
            <?php $__currentLoopData = $systemDeps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <a href="javascript:void(0)" class="up_item_pay_other" data-method-id="<?php echo e($s->id); ?>" data-method-name="<?php echo e($s->name); ?>">
                <img src="<?php echo e($s->img); ?>" alt=""><span><?php echo e($s->name); ?></span>
              </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

          <button type="button" class="up_reg-btn" style="margin-top: 25px;" id="btn-pay" disabled>
            <?php echo e(__('common.pay')); ?>

          </button>

          <div>
            <p class="up_info-section-title"><?php echo e(__('common.how-to-withdraw')); ?></p>
            <p class="up_min-text"><?php echo e(__('common.frozen-explanation')); ?></p>
            <br />
            <p class="up_min-title"><?php echo e(__('common.what-we-do')); ?></p>
            <p class="up_min-text"><?php echo e(__('common.we-cover-half')); ?></p>
            <br />
            <p class="up_min-title"><?php echo e(__('common.what-you-do')); ?></p>
            <p class="up_min-text"><?php echo e(__('common.pay-10-percent')); ?></p>
            <br />
            <p class="up_min-title"><?php echo e(__('common.why-needed')); ?></p>
            <ul class="up_min-text" style="padding-left: 15px;">
              <li><?php echo e(__('common.legality')); ?></li>
              <li><?php echo e(__('common.transparency')); ?></li>
              <li><?php echo e(__('common.security')); ?></li>
            </ul>
            <br />
            <p class="up_min-text"><?php echo e(__('common.support-info')); ?></p>
          </div>

          <a href="#goPayBlock" class="up_pay_button_learn" style="color: #19AB59;">
            <?php echo e(__('common.ready-to-pay')); ?>

          </a>

          <a target="_blank" href="<?php echo e($settings->support_contact); ?>" class="up_login-btn" style="margin-top: 10px;">
            <?php echo e(__('common.support')); ?>

          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const amount_full = <?php echo json_encode(safe_div($withdrawal->amount, 10), 512) ?>;
</script>
<script src="./scripts/output.js?v=2032222222222222222222222222"></script>

<?php else: ?>
<script type="text/javascript">
  location.href = '/';
</script>
<?php endif; ?>
<?php endif; ?>
<?php /**PATH /var/www/product/resources/views/issue.blade.php ENDPATH**/ ?>