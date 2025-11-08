<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <link rel="stylesheet" href="/payment/styles/globals.css" />
  <link rel="stylesheet" href="/payment/styles/style.css" />
</head>

<body data-page="payment">
  <div id="loader">
    <div class="circle"></div>
  </div>
  <div class="container">
    <div class="contentWrapper">
      <section class="titleWrapper">
        <span>Top up</span>
      </section>
      <section class="paymethodWrapper">
        <div class="paymethodContainer">
          <img src="/payment/img/google.png" alt="">
          <span class="text">Google Pay</span>
        </div>
        <div class="timer" id="timer">00:31</div>
      </section>
      <section class="amount_container">
        <div class="h3">Enter the top up amount</div>
        <div class="input-group input">
          <div class="icon-wrapper">
            <img class="icon_15" src="/payment/img/inr.svg" alt="">
          </div>
          <input class="input-bold" type="text" id="amountInput" placeholder="Amount" value="11 267 INR"
            data-copy="11 267 INR" required disabled>
          <div class="icon-wrapper" style="background-color: transparent; cursor: pointer;"
            onclick="copyDataAttributeById(`amountInput`)">
            <img class="icon_15" src="/payment/img/copy.svg" alt="">
          </div>
        </div>
        <div class="text_input_small">
          <div class="h4">Amount of one payment</div>
          <div class="h4">Copy the amount</div>
        </div>
      </section>
      <section class="step">
        <div class="num">2</div>
        <p class="text">Copy the UPI address below to make a transfer, or scan the QR code</p>
      </section>
      <section class="amount_container">
        <div class="h3">Identifier</div>
        <div class="input-group input">
          <input class="input-bold" type="text" id="emailInput" data-copy="designmax@iob" value="designmax@iob" required
            disabled>
          <div class="icon-wrapper" style="background-color: transparent; cursor: pointer; width: 20px;"
            onclick="copyDataAttributeById(`emailInput`)">
            <img class="icon_15" src="/payment/img/copy.svg" alt="">
          </div>
          <div class="icon-wrapper"
            style="background-color: transparent; cursor: pointer; width: 20px; margin-right: 12px;">
            <img class="icon_15" src="/payment/img/question.svg" alt="">
          </div>
        </div>
      </section>
      <section class="qrCodeWrapper">
        <img src="/payment/img/qrCode.svg" alt="">
      </section>
      <section class="step">
        <div class="num">3</div>
        <p class="text">Transfer funds to the wallet in your UPI mobile app</p>
      </section>
      <section class="step" style="margin-top: 0;">
        <div class="num">4</div>
        <p class="text">Confirm the payment by entering the UTR of the transaction in the Transaction UTR field.</p>
      </section>
      <section class="amount_container">
        <div class="input-group input">
          <div class="icon-wrapper" style="width: fit-content; padding: 8px;">
            <img class="icon_15" src="/payment/img/utr.svg" alt="" style="width: 50px;">
          </div>
          <input class="input-bold" type="text" id="amountUTR" placeholder="Enter your UTR" required>
          <div class="icon-wrapper" style="background-color: transparent; cursor: pointer;">
            <img class="icon_15" src="/payment/img/question.svg" alt="">
          </div>
        </div>
      </section>
      <section class="actions">
        <button class="reg-btn" id="confirm">Confirm</button>
        <button class="login-btn">Support</button>
        <button class="pay_button_learn">Cancel</button>
      </section>
    </div>
  </div>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script src="/payment/scripts/loadingPage.js"></script>
  <script src="/payment/scripts/copyText.js"></script>
  <script src="/payment/scripts/timer.js"></script>
  <script src="/payment/scripts/form.js"></script>
</body>

</html>