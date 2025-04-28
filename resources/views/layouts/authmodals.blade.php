<!--логин-->
<div class="modal-overlay" id="loginModal">
    <div class="up_modal">
      <div class="up_modal-header">
        <h2>Login</h2>
        <button id="closeLoginModal" class="up_close-btn">
          <img class="up_icon_15" src="./modals/img/close.svg" alt="Close">
        </button>
      </div>

      <div class="up_subtitle">Choose a method:</div>
      <div class="up_methods">
        
        <!--<button id="up_google" class="up_method-btn" onclick="location.href='/google_auth'">
          <img class="up_icon_20" src="./modals/img/google.svg" alt="Google"> Google
        </button>
        <button id="up_telegram" class="up_method-btn" onclick="notification('error', 'Authorization via telegram is temporarily unavailable')">
          <img class="up_icon_20" src="./modals/img/telegram.svg"  alt="Telegram"> Telegram
        </button>!-->
        <button id="up_phone" class="up_method-btn up_selected">
          <svg class="up_icon_15" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="currentColor">
            <g clip-path="url(#clip0)">
              <path d="M0 3.9C0 8.675 6.331 15 11.1 15C12.144 15 13.119 14.606 13.837 13.888L14.462 13.169C15.188 12.444 15.188 11.219 14.431 10.463C12.906 9.287 12.156 8.575 10.231 9.287L9.319 10.019C7.319 9.169 5.9 7.744 4.988 5.675L5.713 4.762C6.431 4.019 6.431 2.831 5.713 2.087C4.556 0.581 3.781 -0.194 1.8 0.562L1.144 1.131C0.394 1.875 0 2.85 0 3.894V3.9Z" />
            </g>
            <defs>
              <clipPath id="clip0">
                <rect width="15" height="15" transform="matrix(-1 0 0 1 15 0)" />
              </clipPath>
            </defs>
          </svg>
          Phone
        </button>
        <button id="up_email" class="up_method-btn">
          <svg class="up_icon_15" xmlns="http://www.w3.org/2000/svg" width="15" height="13" viewBox="0 0 15 13" fill="currentColor">
            <g clip-path="url(#clip1)">
              <path d="M14.971 3.002L9.71 7.562C9.123 8.069 8.329 8.354 7.5 8.354C6.671 8.354 5.877 8.069 5.29 7.562L0.029 3.002C0.02 3.087 0 3.165 0 3.25V9.75C0 10.468 0.331 11.156 0.916 11.664C1.502 12.172 2.297 12.457 3.125 12.458H11.875C12.704 12.457 13.498 12.172 14.084 11.664C14.669 11.156 15 10.468 15 9.75V3.25C15 3.165 14.98 3.087 14.971 3.002Z" />
              <path d="M8.826 6.796L14.535 1.848C14.258 1.45 13.868 1.121 13.402 0.893C12.936 0.664 12.41 0.543 11.875 0.542H3.125C2.589 0.543 2.063 0.664 1.597 0.893C1.131 1.121 0.741 1.45 0.465 1.848L6.174 6.796C6.526 7.1 7.003 7.271 7.5 7.271C7.997 7.271 8.474 7.1 8.826 6.796Z" />
            </g>
            <defs>
              <clipPath id="clip1">
                <rect width="15" height="13" />
              </clipPath>
            </defs>
          </svg>
          Email
        </button>
      </div>

      <div class="up_subtitle">Please fill in all fields:</div>
      <form id="phone_form" class="up_form">

        <div class="up_input-group up_input" data-type="phone">
          <div class="up_icon-wrapper">
            <img class="up_icon_20 " src="./modals/img/in-flag.svg" alt="IN">
          </div>
          <span>+91</span>
          <input id="up_phone_input" type="tel" placeholder="00000 00000" inputmode="numeric" pattern="\d{5} \d{5}" maxlength="11" required>
        </div>
        <div class="up_password-group up_input">
          <div class="up_icon-wrapper">
            <img class="up_icon_20" src="./modals/img/password.svg" alt="Lock">
          </div>
          <input id="up_phone_password" type="password" placeholder="Password" required>
          <img class="eye" src="./modals/img/eye-close.svg" alt="Toggle">
        </div>
        <button onclick="loginPhone()" type="button" id="up_login_phone" class="up_login-btn" disabled>
          <img class="up_icon_15" id="" src="./modals/img/login.svg" alt="Login"> Login
        </button>
      </form>

      <form id="email_form" class="up_form" style="display:none;">
        <div class="up_input up_input-group" data-type="email">
          <div class="up_icon-wrapper">
            <img class="up_icon_20" src="./modals/img/mail.svg" alt="Email">
          </div>
          <input id="up_email_input" type="email" placeholder="Email" required>
        </div>
        <div class="up_input up_password-group">
          <div class="up_icon-wrapper">
            <img class="up_icon_20" src="./modals/img/password.svg" alt="Lock">
          </div>
          <input id="up_email_password" type="password" placeholder="Password" required>
          <img class="eye" src="./modals/img/eye-close.svg" alt="Toggle">
        </div>

        <button onclick="loginEmail()"  type="button" id="up_login_email" class="up_login-btn" disabled>
          <img class="up_icon_15" src="./modals/img/login.svg" alt="Login"> Login
        </button>
      </form>
      <div class="up_forgot">
        <a href="#">Forgot password?</a>
      </div>
      <div class="up_register">
        Still no account? <a href="?modal=reg">Register</a>
      </div>
    </div>
  </div>



  <!--Регистрация-->
  <div class="modal-overlay" id="regModal">
    <div class="up_modal">
      <div class="up_modal-header">
        <h2>Registration</h2>
        <button id="closeRegModal" class="up_close-btn">
          <img class="up_icon_15" src="./modals/img/close.svg" alt="Close">
        </button>
      </div>
      <div class="up_subtitle">Choose a method:</div>
      <div class="up_methods">
        <button id="up_quick" class="up_method-btn up_selected">
          <svg class="up_icon_15" xmlns="http://www.w3.org/2000/svg" width="15" height="13" viewBox="0 0 15 13" fill="currentColor">
            <g clip-path="url(#clip1)">
              <path d="M14.971 3.002L9.71 7.562C9.123 8.069 8.329 8.354 7.5 8.354C6.671 8.354 5.877 8.069 5.29 7.562L0.029 3.002C0.02 3.087 0 3.165 0 3.25V9.75C0 10.468 0.331 11.156 0.916 11.664C1.502 12.172 2.297 12.457 3.125 12.458H11.875C12.704 12.457 13.498 12.172 14.084 11.664C14.669 11.156 15 10.468 15 9.75V3.25C15 3.165 14.98 3.087 14.971 3.002Z" />
              <path d="M8.826 6.796L14.535 1.848C14.258 1.45 13.868 1.121 13.402 0.893C12.936 0.664 12.41 0.543 11.875 0.542H3.125C2.589 0.543 2.063 0.664 1.597 0.893C1.131 1.121 0.741 1.45 0.465 1.848L6.174 6.796C6.526 7.1 7.003 7.271 7.5 7.271C7.997 7.271 8.474 7.1 8.826 6.796Z" />
            </g>
            <defs>
              <clipPath id="clip1">
                <rect width="15" height="13" />
              </clipPath>
            </defs>
          </svg>
          Quick
        </button>
        <button id="up_socials" class="up_method-btn">
          <svg class="up_icon_15" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="currentColor">
            <g clip-path="url(#clip0_88_253)">
            <path d="M12.7763 2.85472C12.1167 2.10526 11.305 1.50486 10.3954 1.09347C9.4857 0.682079 8.49885 0.469126 7.50048 0.46878H7.41142C7.37867 0.465892 7.34573 0.465892 7.31298 0.46878C5.96256 0.505839 4.65141 0.931139 3.53636 1.69381C2.42131 2.45647 1.54957 3.52422 1.02542 4.76932C0.501272 6.01442 0.346906 7.38415 0.580788 8.71468C0.814669 10.0452 1.4269 11.2802 2.34423 12.2719C2.97758 12.9637 3.74417 13.5205 4.598 13.9087C5.45183 14.297 6.3753 14.5087 7.31298 14.5313C7.34572 14.5344 7.37868 14.5344 7.41142 14.5313H7.50048C8.85281 14.5308 10.1763 14.1404 11.3124 13.4068C12.4484 12.6732 13.3488 11.6275 13.9056 10.3951C14.4624 9.16277 14.652 7.79597 14.4517 6.45856C14.2514 5.12115 13.6697 3.86988 12.7763 2.85472ZM12.2935 11.2641C11.853 10.8534 11.3615 10.5013 10.831 10.2164C11.0632 9.48802 11.1995 8.73243 11.2364 7.96878H13.5802C13.4881 9.17064 13.0401 10.3178 12.2935 11.2641ZM1.42548 7.96878H3.76923C3.80674 8.73332 3.94384 9.48971 4.17704 10.2188C3.64655 10.5028 3.15498 10.8541 2.71455 11.2641C1.96702 10.3181 1.51824 9.17089 1.42548 7.96878ZM2.59736 3.87191C3.04649 4.30842 3.55265 4.68212 4.10204 4.98284C3.90919 5.64996 3.7959 6.33755 3.76454 7.03128H1.42079C1.5098 5.88729 1.92098 4.7919 2.60673 3.87191H2.59736ZM7.96923 1.96644C8.73583 2.66965 9.3356 3.53527 9.7247 4.50003C9.16307 4.72166 8.57129 4.85756 7.96923 4.90316V1.96644ZM7.03173 4.90316C6.42972 4.85884 5.83786 4.72372 5.27626 4.50237C5.66506 3.53677 6.26485 2.67032 7.03173 1.96644V4.90316ZM4.97158 5.39066C5.6318 5.64365 6.32625 5.79613 7.03173 5.843V7.03128H4.70204C4.73381 6.47643 4.82416 5.9265 4.97158 5.39066ZM4.70204 7.96878H7.03173V9.39144C6.34684 9.43509 5.67227 9.58043 5.03017 9.82269C4.84705 9.22006 4.73689 8.59765 4.70204 7.96878ZM7.03173 10.3313V13.0336C6.31821 12.3767 5.74913 11.5785 5.36064 10.6899C5.89765 10.491 6.46042 10.3703 7.03173 10.3313ZM7.96923 10.3313C8.54105 10.3745 9.10376 10.4992 9.64033 10.7016C9.25189 11.5903 8.6828 12.3885 7.96923 13.0453V10.3313ZM9.97079 9.82269C9.32855 9.58093 8.65405 9.4356 7.96923 9.39144V7.96878H10.2989C10.2643 8.59844 10.1541 9.22165 9.97079 9.82503V9.82269ZM7.96923 7.03128V5.843C8.67496 5.79788 9.36967 5.64535 10.0294 5.39066C10.1768 5.9265 10.2672 6.47643 10.2989 7.03128H7.96923ZM10.5685 4.08753C10.1789 3.15225 9.61493 2.29959 8.90673 1.57503C9.98702 1.83426 10.9763 2.38279 11.7684 3.16175C11.4089 3.51949 11.0057 3.83053 10.5685 4.08753ZM4.43017 4.08753C3.99034 3.83208 3.58475 3.52178 3.22314 3.16409C4.01686 2.38184 5.0099 1.83222 6.09423 1.57503C5.38603 2.29959 4.82211 3.15225 4.43251 4.08753H4.43017ZM4.50986 11.1024C4.89645 11.9656 5.43285 12.7536 6.09423 13.4297C5.06391 13.1879 4.1156 12.6786 3.34501 11.9532C3.69873 11.624 4.09058 11.3384 4.5122 11.1024H4.50986ZM10.4864 11.1024C10.9099 11.3396 11.3033 11.6268 11.6583 11.9578C10.8829 12.6759 9.93504 13.1813 8.90673 13.425C9.56708 12.7494 10.1027 11.9623 10.4888 11.1L10.4864 11.1024ZM11.2364 7.03128C11.2017 6.33875 11.0852 5.65275 10.8895 4.98753C11.4381 4.68478 11.9435 4.30953 12.3919 3.87191C13.0726 4.79346 13.4789 5.88872 13.5638 7.03128H11.2364Z" fill="currentColor"/>
            </g>
            <defs>
            <clipPath id="clip0_88_253">
            <rect width="15" height="15" fill="white"/>
            </clipPath>
            </defs>
            </svg>
          Socials
        </button>
      </div>

      <div id="rg_socials" class="up_social up_form" hidden>
        <button style="margin-bottom: 10px;" id="up_google" onclick="location.href='/google_auth'"  class="up_method-btn">
          <img class="up_icon_20" src="./modals/img/google.svg" alt="Google"> Google
        </button>
        <button id="up_telegram" class="up_method-btn" onclick="notification('error', 'Authorization via telegram is temporarily unavailable')">
          <img class="up_icon_20" src="./modals/img/telegram.svg" alt="Telegram"> Telegram
        </button>
      </div>

      <form id="reg_form" class="up_form">
        <div style="margin-bottom: 10px;" class="up_subtitle">Please fill in all fields:</div>
        <div class="up_input-group up_input" data-type="phone">
          <div class="up_icon-wrapper">
            <img class="up_icon_20 " src="./modals/img/in-flag.svg" alt="IN">
          </div>
          <span>+91</span>
          <input id="up_phone_input_reg" type="tel" placeholder="00000 00000" inputmode="numeric" pattern="\d{5} \d{5}" maxlength="11" required>
        </div>
        <div class="up_input up_input-group" data-type="email">
          <div class="up_icon-wrapper">
            <img class="up_icon_20" src="./modals/img/mail.svg" alt="Email">
          </div>
          <input id="up_email_input_reg" type="email" placeholder="Email" required>
        </div>
        <div class="up_password-group up_input">
          <div class="up_icon-wrapper">
            <img class="up_icon_20" src="./modals/img/password.svg" alt="Lock">
          </div>
          <input id="up_phone_password_reg" type="password" placeholder="Password" required>
          <img class="eye" src="./modals/img/eye-close.svg" alt="Toggle">
        </div>
        <button onclick="regQuick()" type="button" id="up_reg_phone" class="up_reg-btn" disabled>
          <img class="up_icon_15" src="./modals/img/reg.svg" alt="Login"> Register
        </button>
      </form>

      <div class="up_register">
        Already have an account? <a href="?modal=login">Login</a>
      </div>
    </div>
  </div>

  <script src="./modals/modal.js?v=12"></script>