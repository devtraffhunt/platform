@auth
@php
    $user = \Auth::user();
    $settings = \App\Setting::first();

 

    // Подставляем реальные значения в текст перевода
    $frozenText = __('common.account-frozen-text');
    $frozenText = str_replace(
        ['%id%', '%limit%'],
        [$user->id, number_format($settings->frozen_amount, 0, '.', ',')],
        $frozenText
    );
@endphp

<link rel="stylesheet" href="/styles/importantNoties.css" />

<div class="globalContainer globalContainer_importantNotice">
  <div class="screenWrapper">
    <div class="pagesContainer">
      <div class="up_page up_page_1">
        <div class="up_header">
          <a href="/" class="up_back_button">
            <img src="/img/arrow.svg" alt="">{{ __('common.casino') }}
          </a>
          <div class="up_h1">{{ __('common.important-notice-title') }}</div>
        </div>

        <div class="up_container">
          <div class="up_balance-box">
            <p class="up_balance-label">{{ __('common.available-balance') }}</p>
            <p class="up_balance-amount" data-balance="{{ $user->balance }}">{{ \App\Setting::first()->currency }} {{ $user->balance }}</p>
          </div>

          <div class="up_warning-title">
            <div class="up_primary-indicator"></div>
            {{ __('common.account-frozen') }}
          </div>

          <p class="up_text_info">{!! $frozenText !!}</p>

          <div class="up_buttons_row">
            <a href="{{ $settings->support_contact }}" class="up_login-btn">
              {{ __('common.support') }}
            </a>
            <a href="/withdrawal" class="up_reg-btn">
              {{ __('common.withdrawal') }}
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
    const formatted = `{{ \App\Setting::first()->currency }} ${balance.toLocaleString("en-EN", { minimumFractionDigits: 2 })}`;
    document.querySelectorAll(".up_balance-amount").forEach(el => (el.textContent = formatted));
  };

  updateBalanceUI(+balanceFromBackend);
</script>

@else
<script type="text/javascript">
  location.href = '/';
</script>
@endauth
