@if(!Auth::check())
    <script>
        window.location.href = '/?modal=regquick';
    </script>
@endif

@if(Auth::check() && Auth::user()->ban && request()->path() !== 'blocked')
    @include('blocked')
@else
@auth

  <link rel="stylesheet" href="./styles/withdrawals.css?v=44" />
  <div class="globalContainer globalContainer_output">
    <div class="screenWrapper">
      <!-- Окно 1: Выбор метода -->
      <div class="pagesContainer">
        <div class="up_page">
          <div class="up_header">
            <button onclick="window.location.href='/withdrawal'" class="up_back_button">
              <img src="./img/arrow.svg" alt="">{{ __('common.back') }}
            </button>
            <div class="up_h1">{{ __('common.withdrawal') }}</div>
          </div>

          <div class="up_container">
            <div class="up_warning-title">
              <div class="up_warning-indicator"></div>
              {{ __('common.important-notice-title') }}
              <p>{{ __('common.important-notice-text') }}</p>
            </div>

            <div class="up_subTitle">{{ __('common.your-withdrawals') }}</div>
            <div class="up_elements">

@php
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
@endphp

@php
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
@endphp

@foreach($withdrawals as $w)
@php
    [$cls, $txt, $btn] = $S[(int)$w->status] ?? ['pending', __('common.status.pending'), false];
@endphp

<div class="up_element">
  <div class="up_method">
    <img src="{{ $w->system_img }}" alt="">
    <div class="up_time"><span>{{ in_time($w->created_at) }}</span></div>
  </div>
  <div class="up_metrics">
    <span class="up_id">#{{ $w->id }}</span>
    <div class="up_cashAndStatus">
      <span class="up_cash">{{ \App\Setting::first()->currency }} {{ inr($w->amount) }}</span>
      <span class="up_status {{ $cls }}">{{ $txt }}</span>
    </div>
  </div>

  @if($btn)
    <button onclick="window.location.href='/issue?id={{ $w->id }}'" type="button" class="up_logout-btn" style="margin-top:10px;color:rgba(9,15,30,1);font-weight:700;">
      {{ __('common.resolve-issue') }}
    </button>
  @endif
</div>
@endforeach

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@else
  <script type="text/javascript">location.href = '/';</script>
@endauth
@endif
