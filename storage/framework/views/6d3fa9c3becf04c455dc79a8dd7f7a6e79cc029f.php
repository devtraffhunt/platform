<?php if(!Auth::check()): ?>
    <script>
        window.location.href = '/?modal=regquick';
    </script>
<?php endif; ?>

<?php if(Auth::check() && Auth::user()->ban && request()->path() !== 'blocked'): ?>
    <?php echo $__env->make('blocked', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
<?php if(auth()->guard()->check()): ?>

  <link rel="stylesheet" href="./styles/withdrawals.css?v=44" />
  <div class="globalContainer globalContainer_output">
    <div class="screenWrapper">
      <!-- Окно 1: Выбор метода -->
      <div class="pagesContainer">
        <div class="up_page">
          <div class="up_header">
            <button onclick="window.location.href='/withdrawal'" class="up_back_button">
              <img src="./img/arrow.svg" alt=""><?php echo e(__('common.back')); ?>

            </button>
            <div class="up_h1"><?php echo e(__('common.withdrawal')); ?></div>
          </div>

          <div class="up_container">
            <div class="up_warning-title">
              <div class="up_warning-indicator"></div>
              <?php echo e(__('common.important-notice-title')); ?>

              <p><?php echo e(__('common.important-notice-text')); ?></p>
            </div>

            <div class="up_subTitle"><?php echo e(__('common.your-withdrawals')); ?></div>
            <div class="up_elements">

<?php
$userId = Auth::user()->id;
$shiftMins = \Carbon\Carbon::now('Europe/Kyiv')->offsetMinutes;

$updated = \DB::affectingStatement("
    UPDATE withdraws_frozen wf
    LEFT JOIN users u ON u.id = wf.user_id
    SET wf.status = 2
    WHERE wf.user_id = ?
      AND wf.status = 0
      AND wf.created_at <= (UTC_TIMESTAMP() + INTERVAL ? MINUTE - INTERVAL COALESCE(u.hold_time,0) MINUTE)
", [$userId, $shiftMins]);
?>

<?php
    $withdrawals = \App\WithdrawFrozen::where('user_id', \Illuminate\Support\Facades\Auth::id())
        ->orderByDesc('id')->get();

    function inr($n) {
    $parts = explode('.', (string)$n);
    $int = number_format($parts[0], 0, '', ',');
    return isset($parts[1]) ? $int . '.' . $parts[1] : $int;
}


    function in_time($dt) {
        return \Carbon\Carbon::parse($dt)->setTimezone('Asia/Kolkata')->format('d M, Y | h:i A');
    }

    $S = [
        0 => ['pending',   __('common.status.pending'),   false],
        1 => ['completed', __('common.status.completed'), false],
        2 => ['hold',      __('common.status.hold'),      true],
    ];
?>

<?php $__currentLoopData = $withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
    [$cls, $txt, $btn] = $S[(int)$w->status] ?? ['pending', __('common.status.pending'), false];
?>

<div class="up_element">
  <div class="up_method">
    <img src="<?php echo e($w->system_img); ?>" alt="">
    <div class="up_time"><span><?php echo e(in_time($w->created_at)); ?></span></div>
  </div>
  <div class="up_metrics">
    <span class="up_id">#<?php echo e($w->id); ?></span>
    <div class="up_cashAndStatus">
      <span class="up_cash"><?php echo e(\App\Setting::first()->currency); ?> <?php echo e(inr($w->amount)); ?></span>
      <span class="up_status <?php echo e($cls); ?>"><?php echo e($txt); ?></span>
    </div>
  </div>

  <?php if($btn): ?>
    <button onclick="window.location.href='/issue?id=<?php echo e($w->id); ?>'" type="button" class="up_logout-btn" style="margin-top:10px;color:rgba(9,15,30,1);font-weight:700;">
      <?php echo e(__('common.resolve-issue')); ?>

    </button>
  <?php endif; ?>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php else: ?>
  <script type="text/javascript">location.href = '/';</script>
<?php endif; ?>
<?php endif; ?>
<?php /**PATH /var/www/product/resources/views/withdrawals.blade.php ENDPATH**/ ?>