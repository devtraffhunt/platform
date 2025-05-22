<?php if(auth()->guard()->check()): ?>
<?php
$user = \Auth::user();
$userStatus = \Auth::user()->status;
$name_surname = explode(' ', \Auth::user()->name);
if ($userStatus != 0) {
$status = \App\Status::where('id', $userStatus)->first();
}

$status = null;
$banType = null;
$banRules = [];

// Проверяем есть ли бан
if ($user->ban_type_id) {
    $banType = \App\BanType::find($user->ban_type_id);
    if ($banType && $banType->rules_json) {
        $decodedJson = json_decode($banType->rules_json, true);
        if (isset($decodedJson['rules'])) {
            $banRules = $decodedJson['rules'];
        }
    }
}
$gamesAll = round(\Auth::user()->win_games + \Auth::user()->lose_games);

?>


<link rel="stylesheet" href="/styles/importantNoties.css" />




<div class="globalContainer globalContainer_importantNotice">
  <div class="screenWrapper">
    <!-- Вікно 1: Вибір методу -->
    <div class="pagesContainer">
      <div class="up_page up_page_1">
        <div class="up_header">
          
          <div class="up_h1">Important Notice</div>
        </div>
        <div class="up_container">
          <div class="up_balance-box">
            <p class="up_balance-label">Available balance</p>
            <p class="up_balance-amount" data-balance="0">₹ 00.00</p>
          </div>
          <div class="up_warning-title">
            <div class="up_warning-indicator"></div>
            Your account has been blocked
          </div>
          <p class="up_text_info">Your account <span class="up_text_info_strong">ID:<?php echo e(auth()->user()->id); ?></span> violated
            points: <?php if(!empty($banRules)): ?>
        <?php $__currentLoopData = $banRules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ruleData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="#"><?php echo e($ruleData['rule']); ?></a><?php if(!$loop->last): ?>, <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <span>unknown</span>
    <?php endif; ?> of our rules,
            therefore it was permanently blocked.</p>
          <div class="up_buttons_row">
            <button onclick="window.location.href='<?php echo e(\App\Setting::first()->support_contact); ?>'" type="button" class="up_login-btn">
              Support
            </button>
            <button onclick="window.location.href='logout'" type="button" class="up_logout-btn">
              Log out
            </button>
          </div>
          <div class="up_warning-title">
            Violated rules
          </div>
          <div class="up_info">
          <?php $__currentLoopData = $banRules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ruleData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="up_info_item">
            <div class="up_info_counter"><?php echo e($ruleData['rule']); ?></div>
            <p class="up_min-text"><?php echo e($ruleData['content']['en']); ?></p> <!-- или ['ru'], если хочешь на русском -->
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          <div class="up_footer_action">
            <button onclick="window.location.href='/terms'" type="button" class="up_pay_button_learn" style="color: var(--color-primary);">
              Our rules
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php else: ?>
<script type="text/javascript">
  location.href = '/';
</script>
<?php endif; ?><?php /**PATH /var/www/product/resources/views/blocked.blade.php ENDPATH**/ ?>