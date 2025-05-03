<?php if(!Auth::check()): ?>
    <script>
        window.location.href = '/?modal=regquick';
    </script>
<?php endif; ?>
<?php if(Auth::check()): ?>
    <?php if(Auth::user()->ban && request()->path() !== 'blocked'): ?>
        <?php echo $__env->make('blocked', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php elseif(Auth::user()->frozen && request()->path() !== 'frozen'): ?>
        <?php echo $__env->make('frozen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>

<?php if(auth()->guard()->check()): ?>
  <?php
  $userStatus = \Auth::user()->status;
  $name_surname = explode(' ', \Auth::user()->name);
  if ($userStatus != 0) {
  $status = \App\Status::where('id', $userStatus)->first();

  }
  $gamesAll = round(\Auth::user()->win_games + \Auth::user()->lose_games);
  $settings = \App\Setting::first();
  ?>

  <link rel="stylesheet" href="./styles/deposit.css?v=4" />




  <div class="globalContainer globalContainer_deposit">
    <!--Відео-->
    <div class="up_video_container" id="up_video_container">
    <div class="up_video_wrapper">
      <div class="up_video_header">
      <span class="up_video_header_label">Instruction</span>
      <button class="up_close-btn up_video_close_global">
        <img class="up_icon_15" src="./img/close.svg" alt="Close">
      </button>
      </div>
      <div class="up_video_block">
      <iframe id="up_video" src="https://www.youtube.com/embed/LXb3EKWsInQ" title="YouTube video" frameborder="0"
        allowfullscreen>
      </iframe>
      </div>
      <button type="button" class="up_login-btn up_video_back up_video_close_global" style="margin-top: 25px;">
      Back
      </button>
    </div>
    </div>
    <div class="screenWrapper">
    <!-- Окно 1: выбор метода -->
    <div id="methodsWindow" class="screen">
      <div class="up_main">
      <div class="up_header">
        <button onclick="window.location.href='/'" class="up_back_button">
        <img src="./img/arrow.svg" alt="">Casino
        </button>
        <div class="up_h1">Top up</div>
      </div>
      <div class="up_container">
        <div class="up_h2">All methods</div>
        <div class="up_methods_pay">

        <?php $systemDeps = \App\SystemDep::orderBy('sort', 'asc')->orderBy('id', 'asc')->where('off', 0)->get(); ?>
        <?php $__currentLoopData = $systemDeps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <a href="javascript:void(0)" class="up_item_pay" data-method-id="<?php echo e($s->id); ?>" data-method-name="<?php echo e($s->name); ?>"
        data-from="1500" data-to="50000" data-recommended="1500">
        <img src="<?php echo e($s->img); ?>" alt=""><span><?php echo e($s->name); ?></span>
      </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
      </div>
    </div>

    <!-- Окно 2: ввод суммы -->
    <div id="topupWindow" class="screen">
      <div class="up_main">
      <div class="up_header up_header_secondScreen">
        <button class="up_back_button">
        <img src="./img/arrow.svg" alt="">Back
        </button>
        <div class="up_h1">Top up</div>
      </div>
      <div class="up_container">
        <div class="up_pay_change_container">
        <div class="up_pay_change_method">
          <img src="./img/google.svg" alt="">
          <span class="selected-method">Google Pay</span>
        </div>
        <button class="up_pay_change_button">Change</button>
        </div>

        <div class="up_pay_amount_container">
        <div class="up_h3">Enter the top up amount</div>
        <div class="up_input-group up_input" id="amountGroup">
          <div class="up_icon-wrapper">
          <img class="up_icon_15" src="./img/inr.svg" alt="">
          </div>
          <input class="up_input-bold" type="text" id="amountInput" placeholder="Amount" value="1500" required>
        </div>
        <div class="up_text_input_small">
          <div class="up_h4">Amount of one deposit</div>
          <div class="up_h4">from ₹ <span class="up_from"></span> to ₹ <span class="up_to"></span></div>
        </div>
        </div>

        <div class="up_amounts_select_container">
        <button type="button" class="up_amounts_select_item">₹ 3 000</button>
        <button type="button" class="up_amounts_select_item">₹ 5 000</button>
        <button type="button" class="up_amounts_select_item">₹ 10 000</button>
        <button type="button" class="up_amounts_select_item">₹ 20 000</button>
        </div>

        <div class="up_pay_amount_container">
        <div class="up_h3">Enter the Promo code</div>
        <div class="up_input up_input-group" id="promoGroup" style="margin-bottom: 0;">
          <input type="text" id="promoInput" placeholder="Promo code" value="">
        </div>
        <div class="up_promo_container">
          <div class="up_promo_text" id="bonusText">BONUS 0%</div>
          <div class="up_promo_text" id="totalText">TOTAL ₹ 0</div>
        </div>
        </div>

        <button style="display: none;" type="button" class="up_pay_button_learn up_video_show_global" id="howToBtn">
        <img src="./img/play.svg" alt="">How to deposit?
        </button>
        <a class="up_pay_button_learn" target="_blank" href="<?php echo e($settings->support_contact); ?>" style="margin-top: 10px;">
        Support
</a>
        <button type="button" class="up_reg-btn" style="margin-top: 10px;" id="depositBtn" disabled>
        Deposit
        </button>
      </div>
      </div>
    </div>
    </div>
  </div>

  <script src="./scripts/showVideo.js"></script>
  <script src="./scripts/deposit.js?v=72222"></script>


<?php else: ?>
  <script type="text/javascript">location.href = '/';</script>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?><?php /**PATH /var/www/product/resources/views/deposit.blade.php ENDPATH**/ ?>