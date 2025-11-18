<?php if(auth()->guard()->check()): ?>
<?php
    $user = Auth::user();
    $userStatus = $user->status;
    $name_surname = explode(' ', $user->name);
    $status = null;
    $banType = null;
    $banRules = [];

    // Получаем статус
    if ($userStatus != 0) {
        $status = \App\Status::find($userStatus);
    }

    // Проверяем бан
    if ($user->ban_type_id) {
        $banType = \App\BanType::find($user->ban_type_id);
        if ($banType && $banType->rules_json) {
            $decodedJson = json_decode($banType->rules_json, true);
            if (isset($decodedJson['rules'])) {
                $banRules = $decodedJson['rules'];
            }
        }
    }

    $gamesAll = round($user->win_games + $user->lose_games);
?>

<link rel="stylesheet" href="/styles/importantNoties.css" />

<div class="globalContainer globalContainer_importantNotice">
  <div class="screenWrapper">
    <div class="pagesContainer">
      <div class="up_page up_page_1">
        <div class="up_header">
          <div class="up_h1"><?php echo e(__('common.important-notice-title')); ?></div>
        </div>

        <div class="up_container">
          <div class="up_balance-box">
            <p class="up_balance-label"><?php echo e(__('common.available-balance')); ?></p>
            <p class="up_balance-amount" data-balance="0"><?php echo e(\App\Setting::first()->currency); ?> 00.00</p>
          </div>

          <div class="up_warning-title">
            <div class="up_warning-indicator"></div>
            <?php echo e(__('common.account-blocked')); ?>

          </div>

          <p class="up_text_info">
            <?php echo __('common.account-blocked-text', [
                'id' => auth()->user()->id,
                'rules' => !empty($banRules)
                    ? collect($banRules)->pluck('rule')->implode(', ')
                    : __('common.unknown'),
            ]); ?>

          </p>

          <div class="up_buttons_row">
            <button onclick="window.location.href='<?php echo e(\App\Setting::first()->support_contact); ?>'"
              type="button" class="up_login-btn">
              <?php echo e(__('common.support')); ?>

            </button>

            <button onclick="window.location.href='logout'" type="button" class="up_logout-btn">
              <?php echo e(__('common.logout')); ?>

            </button>
          </div>

          <?php if(!empty($banRules)): ?>
          <div class="up_warning-title"><?php echo e(__('common.violated-rules')); ?></div>

          <div class="up_info">
            <?php $__currentLoopData = $banRules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ruleData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="up_info_item">
                <div class="up_info_counter"><?php echo e($ruleData['rule']); ?></div>
                <p class="up_min-text">
                  <?php echo e($ruleData['content']['en'] ?? $ruleData['content']['ru'] ?? ''); ?>

                </p>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          <?php endif; ?>

          <div class="up_footer_action">
            <button onclick="window.location.href='/terms'" type="button"
              class="up_pay_button_learn" style="color: var(--color-primary);">
              <?php echo e(__('common.our-rules')); ?>

            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php else: ?>
<script>
  location.href = '/';
</script>
<?php endif; ?>
<?php /**PATH /var/www/product/resources/views/blocked.blade.php ENDPATH**/ ?>