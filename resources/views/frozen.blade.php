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
          <a href="/" class="up_back_button">
            <img src="./img/arrow.svg" alt="">Casino
          </a>
          <div class="up_h1">Important Notice</div>
        </div>
        <div class="up_container">
          <div class="up_balance-box">
            <p class="up_balance-label">Available balance</p>
            <p class="up_balance-amount" data-balance="{{ auth()->user()->balance }}">₹ 00.00</p>
          </div>
          <div class="up_warning-title">
            <div class="up_primary-indicator"></div>
            Your account is frozen
          </div>
          <p class="up_text_info">
            Your account <span class="up_text_info_strong">ID:{{ auth()->user()->id }}</span> has been temporarily frozen. Don't
            worry, you need to withdraw your
            winnings. According to Indian regulatory laws, your balance cannot exceed more than x100 of the
            initial deposit amount. Withdraw your entire balance to continue using our casino.
          </p>
          <div class="up_buttons_row">
            <a href="https://t.me" class="up_login-btn">
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


@else
<script type="text/javascript">
  location.href = '/';
</script>
@endauth