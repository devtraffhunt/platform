@auth
@php
$userStatus = \Auth::user()->status;
$name_surname = explode(' ', \Auth::user()->name);
if ($userStatus != 0) {
$status = \App\Status::where('id', $userStatus)->first();

}
$gamesAll = round(\Auth::user()->win_games + \Auth::user()->lose_games);

@endphp


<link rel="stylesheet" href="./styles/importantNoties.css" />




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
          <p class="up_text_info">Your account <span class="up_text_info_strong">ID:{{ auth()->user()->id }}</span> violated
            points: <a href="#">18.01</a>, <a href="#">19.02</a>, <a href="#">15.02</a> of our rules,
            therefore it was permanently blocked.</p>
          <div class="up_buttons_row">
            <button onclick="window.location.href='https://t.me'" type="button" class="up_login-btn">
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
            <div class="up_info_item">
              <div class="up_info_counter">15.1</div>
              <p class="up_min-text">Your account has been temporarily frozen in accordance with Indian legal
                requirements. As a resident of India, any funds received from a foreign company are subject to
                Tax Collected at Source (TCS) under Section 206C(1G) of the Income Tax Act, 1961. The current
                TCS rate is 20% of the payout.</p>
            </div>
            <div class="up_info_item">
              <div class="up_info_counter">15.1</div>
              <p class="up_min-text">Your account has been temporarily frozen in accordance with Indian legal
                requirements. As a resident of India, any funds received from a foreign company are subject to
                Tax Collected at Source (TCS) under Section 206C(1G) of the Income Tax Act, 1961. The current
                TCS rate is 20% of the payout.</p>
            </div>
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


@else
<script type="text/javascript">
  location.href = '/';
</script>
@endauth