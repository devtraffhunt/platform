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
    $min_with = 120000;

    if (\Auth::user()->balance < 120000 && \Auth::user()->frozen == 1) {
        $min_with = 60000;
    }

    if(\Auth::user()->balance < 1500){
      $min_with = 1500;
    }
@endphp
  <link rel="stylesheet" href="./styles/output.css?v=2" />
  <div class="globalContainer globalContainer_output">
    <div class="screenWrapper">
    <!-- Вікно 1: Вибір методу -->
    <div class="pagesContainer">
      <div class="up_page up_page_1">
      <div class="up_header">
        <button class="up_back_button">
        <img src="./img/arrow.svg" alt="">Casino
        </button>
        <div class="up_h1">Withdrawal</div>
      </div>
      <div class="up_container">
        <div class="up_balance-box">
        <p class="up_balance-label">Available balance</p>
        <p class="up_balance-amount" data-balance="{{ auth()->user()->balance }}"></p>
        </div>
        <div class="up_blance-title" style="margin-bottom: 10px;">All methods:</div>
        <div class="up_methods_pay">
        @php $SystemWithraws = \App\SystemWithdraw::all(); @endphp 
        @foreach($SystemWithraws as $s)
    @if($s->off == 0)
        <a href="javascript:void(0)" class="up_item_pay" 
           data-method-id="{{ $s->id }}" 
           data-method-name="{{ $s->name }}"
           data-from="{{ $min_with }}" 
           data-to="500000.00" 
           data-recommended="{{ $min_with }}">
            <img src="{{ $s->img }}" alt=""><span>{{ $s->name }}</span>
        </a>
    @endif
@endforeach

        </div>
      </div>
      </div>
      <!-- Вікно 2: Форма виводу -->
      <div class="up_page up_page_2">
      <div class="up_header up_header_secondScreen">
        <button class="up_back_button">
        <img src="./img/arrow.svg" alt="">Back
        </button>
        <div class="up_h1">Withdrawal</div>
      </div>
      <div class="up_container up_withdraw-form">
        <div class="up_balance-box">
        <p class="up_balance-label">Available balance</p>
        <p class="up_balance-amount">₹ 0.00</p>
        </div>
        <div class="up_pay_change_container">
        <div class="up_pay_change_method">
          <img class="up_method-icon" src="./img/google.svg" alt="">
          <span class="selected-method">Google Pay</span>
        </div>
        <button class="up_pay_change_button">Change</button>
        </div>
        <div class="up_h3" style="margin-top: 25px;">Enter the withdrawal amount</div>
        <div class="up_input-group up_input" id="amountGroup">
        <div class="up_icon-wrapper">
          <img class="up_icon_15" src="./img/inr.svg" alt="">
        </div>
        <input type="text" class="up_input up_input-bold" placeholder="Amount" required>
        </div>
        <div class="up_text_input_small">
        <div class="up_h4">One withdrawal limits</div>
        <div class="up_h4">from ₹ <span class="up_from"></span> to ₹ <span class="up_to"></span></div>
        </div>
        <div class="up_amounts_select_container">
        <button type="button" class="up_amounts_select_item">₹ 3 000</button>
        <button type="button" class="up_amounts_select_item">₹ 5 000</button>
        <button type="button" class="up_amounts_select_item">₹ 10 000</button>
        <button type="button" class="up_amounts_select_item">₹ 20 000</button>
        </div>
        <label class="up_select-container" for="bank-01">
        <input type="checkbox" id="bank-01">
        <div class="up_select" id="bank">
          <span class="up_select_value">Select Bank</span>
          <div class="up_select_options">
          <span class="option" value="Allahabad Bank">Allahabad Bank</span>
          <span class="option" value="Andhra Bank">Andhra Bank</span>
          <span class="option" value="AU Small Finance Bank">AU Small Finance Bank</span>
          <span class="option" value="Axis Bank">Axis Bank</span>
          <span class="option" value="Bandhan Bank">Bandhan Bank</span>
          <span class="option" value="Bank of Baroda">Bank of Baroda</span>
          <span class="option" value="Bank of India">Bank of India</span>
          <span class="option" value="Bank of Maharashtra">Bank of Maharashtra</span>
          <span class="option" value="Bharat CoopBank">Bharat CoopBank</span>
          <span class="option" value="CITI BANK">CITI BANK</span>
          <span class="option" value="CSB Bank">CSB Bank</span>
          <span class="option" value="Canara Bank">Canara Bank</span>
          <span class="option" value="Catholic Syrian Bank">Catholic Syrian Bank</span>
          <span class="option" value="Central Bank Of India">Central Bank Of India</span>
          <span class="option" value="City Union Bank">City Union Bank</span>
          <span class="option" value="Corporation Bank">Corporation Bank</span>
          <span class="option" value="Cosmos Bank">Cosmos Bank</span>
          <span class="option" value="Dena Bank">Dena Bank</span>
          <span class="option" value="Deutsche Bank">Deutsche Bank</span>
          <span class="option" value="Development Credit Bank">Development Credit Bank</span>
          <span class="option" value="Dhanlaxmi Bank">Dhanlaxmi Bank</span>
          <span class="option" value="Federal Bank">Federal Bank</span>
          <span class="option" value="HDFC Bank">HDFC Bank</span>
          <span class="option" value="ICICI Bank">ICICI Bank</span>
          <span class="option" value="ICICI Bank Business">ICICI Bank Business</span>
          <span class="option" value="IDBI Bank">IDBI Bank</span>
          <span class="option" value="IDFC First Bank">IDFC First Bank</span>
          <span class="option" value="Indian Bank">Indian Bank</span>
          <span class="option" value="Indian Overseas Bank">Indian Overseas Bank</span>
          <span class="option" value="Indusind Bank">Indusind Bank</span>
          <span class="option" value="Industrial Development Bank Of India">Industrial Development Bank
            Of
            India
          </span>
          <span class="option" value="Jammu and Kashmir Bank">Jammu and Kashmir Bank</span>
          <span class="option" value="Karnataka Bank">Karnataka Bank</span>
          <span class="option" value="Kotak Mahindra Bank">Kotak Mahindra Bank</span>
          <span class="option" value="Lakshmi Vilas Bank NetBanking">Lakshmi Vilas Bank
            NetBanking</span>
          <span class="option" value="Oriental Bank Of Commerce">Oriental Bank Of Commerce</span>
          <span class="option" value="Punjab &amp; Sind Bank">Punjab &amp; Sind Bank</span>
          <span class="option" value="Punjab National Bank">Punjab National Bank</span>
          <span class="option" value="SBB">SBB</span>
          <span class="option" value="Shamrao Vithal Cooperative Bank">Shamrao Vithal Cooperative
            Bank</span>
          <span class="option" value="South Indian Bank">South Indian Bank</span>
          <span class="option" value="Standard Chartered Bank">Standard Chartered Bank</span>
          <span class="option" value="State Bank of Hyderabad">State Bank of Hyderabad</span>
          <span class="option" value="State Bank of India">State Bank of India</span>
          <span class="option" value="State Bank of Travancore">State Bank of Travancore</span>
          <span class="option" value="Syndicate Bank">Syndicate Bank</span>
          <span class="option" value="Tamilnad Mercantile Bank">Tamilnad Mercantile Bank</span>
          <span class="option" value="Tamilnadu Mercantile Bank">Tamilnadu Mercantile Bank</span>
          <span class="option" value="UCO BANK">UCO BANK</span>
          <span class="option" value="Union Bank of India">Union Bank of India</span>
          <span class="option" value="Vijaya Bank">Vijaya Bank</span>
          <span class="option" value="Yes Bank">Yes Bank</span>
          </div>
        </div>
        </label>
        <div class="up_input-group up_input" id="amountGroup">
        <input type="text" class="up_input" placeholder="Full Name">
        </div>
        <div class="up_input-group up_input" id="amountGroup">
        <input type="text" class="up_input" placeholder="IFSC Code">
        </div>
        <div class="up_input-group up_input" id="amountGroup">
        <input type="text" class="up_input" placeholder="IMPS Bank Account Number">
        </div>
        <!--<button type="button" class="up_pay_button_learn" id="howToBtn">
        <img src="./img/play.svg" alt="?">How to withdrawal?
        </button>!-->
        @auth
    @if (Auth::user()->admin != 3)
        <button type="button" class="up_login-btn" id="withdrawalBtn" style="margin-top: 10px;" disabled>
            Withdrawal
        </button>
    @endif
@endauth


        <a class="up_pay_button_learn" target="_blank" href="{{$settings->support_contact}}" style="margin-top: 10px;">
        Support
</a>
      </div>
      </div>

      <!-- Вікно 4: Інструкція до оплати -->
      <div class="up_page up_page_3">
      <div class="up_header up_header_secondScreen">
        <button class="up_back_button">
        <img src="./img/arrow.svg" alt="">Back
        </button>
        <div  class="up_h1">Withdrawal</div>
      </div>
      <div  class="up_container">
        <div class="up_balance-box">
        <p class="up_balance-label">Available balance</p>
        <p class="up_balance-amount">₹ 0.00</p>
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
          <p class="up_text-dark up_res_10" style="font-weight: 700; font-size: 18px;">₹ 00.00</p>
          <p class="up_text-dark" style="font-weight: 700; font-size: 18px;">10.00%</p>
        </div>
        </div>
        <div class="up_text-start up_text-dark"
        style="margin-top: 25px; display: flex; align-items: center; gap: 10px; font-weight: 700;">
        <div class="up_success-indicator"></div>
        <div>
          After payment, the entire balance of <span class="up_green-text up_balance-amount">₹
          00.00</span> will
          be withdrawn within
          30
          minutes
        </div>
        </div>
        <p class="up_info-section-title">Select payment method:</p>
        <div class="up_methods_pay">
        @php $systemDeps = \App\SystemDep::orderBy('sort', 'asc')->orderBy('id', 'asc')->where('off', 0)->get(); @endphp
        @foreach($systemDeps as $s)


      <a href="javascript:void(0)" class="up_item_pay_other" data-method-id="{{$s->id}}"
        data-method-name="{{$s->name}}">
        <img src="{{$s->img}}" alt=""><span>{{$s->name}}</span>
      </a>
    @endforeach
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
        <a target="_blank" href="{{$settings->support_contact}}" class="up_login-btn" style="margin-top: 10px;">Support</a>
      </div>
      </div>
    </div>
    </div>
  </div>





  <script src="./scripts/output.js?v=2032222222222222222"></script>




@else
  <script type="text/javascript">location.href = '/';</script>
@endauth
@endif