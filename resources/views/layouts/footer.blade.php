@php $setting = \App\Setting::first(); @endphp

<style>
    .footer_wrapper {
        display: flex;
        flex-direction: column;
        

        @media (min-width: 1200px) {
           
            margin:0 auto;
        }
    }

    .block_footer {
        display: flex;
        flex-direction: column;
           
        @media (min-width: 1200px) {
            flex-direction: row;
            gap: 20px;
            align-items: center;
            justify-content: center;
        }
    }

    .support_item {
        border-radius: 100px;
        background-color: #11182A;
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        padding: 15px 20px;
        align-items: center;

        @media (min-width: 1200px) {
            border-radius: 10px;
        }
    }

    .support_title {
        font-size: 16px;
        font-family: Inter;
        font-weight: 600;
        color: #ffffff;
        align-items: center;
    }

    .support_chat_button {
        display: inline-flex;
        align-items: center;
        /* по вертикали */
        justify-content: center;
        /* по горизонтали */
        gap: 8px;
        /* отступ между иконкой и текстом */
        background: #1EADFF;
        border-radius: 100px;
        font-size: 16px;
        font-family: Inter, sans-serif;
        font-weight: 600;
        color: #ffffff;
        text-decoration: none;
        /* убирает подчеркивание */
        padding: 5px 10px;
        /* добавляет внутренний отступ */
    }

    .support_chat_button img {
        width: 16px;
        height: 16px;
    }

    .footer_item {
        border-radius: 10px;
        background-color: #11182A;
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        padding: 15px 20px;
        align-items: center;
        margin-top: 10px;

        @media (min-width: 1200px) {
            margin-top: 0px;
        }
    }

    .footer_logo {
        height: 28px;
    }

    .footer_desc {
        margin-left: 10px;
        font-size: 16px;
        font-family: Inter, sans-serif;
        font-weight: 400;
        color: #7482AE;

        
    }

    .footer_menu {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        font-size: 14px;
        color: #7482AE;
        gap: 10px;
    }

    .footer_methods_deposit {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 16px;
        /* равный отступ между всеми элементами */
        padding: 16px;
        /* необязательно, для отступа от краев */
        box-sizing: border-box;
    }


    .footer_methods_deposit img {
        width: 40px;
        /* или другой фиксированный размер */
        height: auto;
        display: block;
    }

    .footer_line {
        height: 1px;
        background-color: #11182A;
        width: 100%;
        margin: 10px 0;

        @media (min-width: 1200px) {
            display: none;
        }
    }

    .footer_title {
        align-items: left;
        font-size: 16px;
        font-family: Inter, sans-serif;
        font-weight: 700;
        color: rgb(255, 255, 255);
    }

    .footer_licenses {
        margin-top: 10px;
        flex-direction: row;
        justify-content: left;
        display: flex;
        gap: 10px;
        @media (min-width: 1200px) {
            margin-top: 0px;
        }
    }

    .footer_licenses a img {
        height: 35px;
    }

    .footer_copy_text {
        align-items: left;
        font-size: 12px;
        font-family: Inter, sans-serif;
        font-weight: 400;
        color: #7482AE;

        @media (min-width: 1200px) {
             align-items: center;
        }
    }

    .footer_copy_text span {
        font-weight: 700;
    }
</style>

<footer style="margin-top: 10px;" class="footer">
    <div class="wrapper footer_wrapper">
        <div class="block_footer">
            <div class="support_item">
                <div class="support_title">Support 24/7</div>
                <a target="_blank" href="{{$setting->support_contact}}" class="support_chat_button">
                    <img src="/img/icons/telegram.svg">Open Chat
                </a>
            </div>

            <div class="footer_item">
                <a href="/"><img class="footer_logo" src="/img/logo2.svg"></a>
                <div class="footer_desc">The Best Online Casino Site</div>
            </div>

            <div class="footer_item">
                <ul class="footer_menu">
                    <a class="footer_link" href="/terms">Terms</a>
                    <a class="footer_link" href="/policy">User Agreement</a>
                </ul>
                <div class="gx-con red">
                    <div class="icon"><span>18+</span></div>
                    <div class="title">Play responsibly</div>
                </div>
            </div>
        </div>
        <div class="block_footer">
            <div>
                <div class="footer_methods_deposit">
                    <img src="/img/wallet/vector/visa.svg" alt="visa" />
                    <img src="/img/wallet/vector/mastercard.svg" alt="mastercard" />
                    <img src="/img/wallet/vector/apple-pay.svg" alt="apple pay" />
                    <img src="/img/wallet/vector/gpay.svg" alt="gpay" />
                    <img src="/img/wallet/vector/tether.svg" alt="tether" />
                    <img src="/img/wallet/vector/usdc.svg" alt="usdc" />
                    <img src="/img/wallet/vector/upi.svg" alt="upi" />
                    <img src="/img/wallet/vector/phone_pe.svg" alt="phonepe" />
                    <img src="/img/wallet/vector/paytm.svg" alt="paytm" />
                    <img src="/img/wallet/vector/eth.svg" alt="eth" />
                    <img src="/img/wallet/vector/bitcoin.svg" alt="bitcoin" />
                </div>
            </div>

            <div class="footer_line"></div>

            <div class="footer_title">Licenses</div>
            <div class="footer_licenses">
                <a href="/gcb.html">
                    <img src="/img/licenses/gcb-green.svg" />
                </a>

                <a href="#">
                    <img src="/img/licenses/LIC_Stop.svg" />
                </a>
            </div>
            </div>
            <div class="footer_line"></div>

            <div class="footer_copy_text"><span>Copyright © 2025 UPWin</span> is owned and operated by UPWin LTD that is incorporated under the laws of Curacao with company registration number 172129 and having its registered address at Scharlooweg 39, Willemstad, Curaçao. UPWin LTD is operating under E-gaming license No. OGL/2020/101/0091 issued by Curaçao Gaming Control Board. </div>
        
    </div>
        </footer>