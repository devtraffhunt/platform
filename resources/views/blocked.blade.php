@auth
@php
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
            points: @if (!empty($banRules))
        @foreach($banRules as $ruleData)
            <a href="#">{{ $ruleData['rule'] }}</a>@if (!$loop->last), @endif
        @endforeach
    @else
        <span>unknown</span>
    @endif of our rules,
            therefore it was permanently blocked.</p>
          <div class="up_buttons_row">
            <button onclick="window.location.href='https://t.me/upwin_support'" type="button" class="up_login-btn">
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
          @foreach($banRules as $ruleData)
        <div class="up_info_item">
            <div class="up_info_counter">{{ $ruleData['rule'] }}</div>
            <p class="up_min-text">{{ $ruleData['content']['en'] }}</p> <!-- или ['ru'], если хочешь на русском -->
        </div>
    @endforeach
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