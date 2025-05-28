    <style>
.mobile-navbar{
    position: fixed;          /* или например 80vh / 600px */
    overflow-y: auto;  
    padding-bottom: 200px;
    box-sizing: border-box;      /* ← скролл по вертикали, если контент не помещается */
}


        .menu_user_card{
            display: flex;
            width: 100%;
            padding: 15px;
            flex-direction: row;
            border-radius: 30px;
            background: linear-gradient(90deg, #11182A 0%, rgba(58, 82, 144, 0.18) 100%);
            justify-content: start;
            align-items: center;
            gap:10px;
            margin-bottom: 10px;
        }

        .user_avatar{
            border-radius: 100%;
            width: 60px;
            height: 60px;
        }

        .user_border_bronze{
            border: 2px #D18537 solid;
        }

        .user_border_gold{
            border: 2px #F8BE07 solid;
        }

        .user_border_silver{
            border: 2px #D4D4D4 solid;
        }


        .user_details{
            display: flex;
            flex-direction: column;        
            gap:6px;
            justify-content: center;
            overflow: hidden;
        }

        .user_name{
             display: block; 
            font-weight: 600;
            font-size: 16px;
            color: #fff;
            width: 100%;  /* ← ограничение ширины по пикселям */
    white-space: nowrap; /* текст в одну строку */
    overflow: hidden; /* скрываем всё, что не помещается */
    text-overflow: ellipsis; /* показываем "..." */
        }

        .user_id{
            font-weight: 400;
            font-size: 14px;
            color: #7482AE
        }

        .user_id span{
            font-weight: 600;
        }

        .user_status{
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 0px 100px 100px 100px;
color: #090F1E;
font-size: 12px;
font-weight: 600;
padding: 5px 10px;
width: fit-content; /* ← ключевой момент */
    max-width: 100%; 

        }

        .background_bronze{
            background: linear-gradient(90deg, #CD8032 0%, #F7AD62 100%);
        }

        .background_gold{
            background: linear-gradient(90deg, #DCB727 0%, #FFBF00 100%);

        }

        .background_silver{
            background: linear-gradient(90deg, #FFF 0%, #ABABAB 100%);
        }


        



    </style>

<?php
    $status = 'BRONZE';
    $backgroundClass = 'background_bronze';
    $borderClass = 'user_border_bronze';

    if (\Auth::check()) {
        switch (\Auth::user()->admin) {
            case 1:
                $status = 'GOLD';
                $backgroundClass = 'background_gold';
                $borderClass = 'user_border_gold';
                break;
            case 3:
                $status = 'SILVER';
                $backgroundClass = 'background_silver';
                $borderClass = 'user_border_silver';
                break;
        }
    }
?>


<div class="mobile-navbar d-flex flex-column">
    <?php if(auth()->guard()->check()): ?>
    <div class="menu_user_card">
        <img src="/img/avatar.svg" class="user_avatar <?php echo e($borderClass); ?>">
        <div class="user_details">
            <div class="user_name">
    <?php if(\Auth::user()->admin == 3): ?>
        *******
    <?php else: ?>
        <?php echo e(\Auth::user()->email); ?>

    <?php endif; ?>
</div>
            <div class="user_id">ID: <span><?php echo e(\Auth::user()->id); ?></span></div>


            <div class="user_status <?php echo e($backgroundClass); ?>"><?php echo e($status); ?></div>
        </div>
    </div>
    <?php endif; ?>

    <li class="d-flex flex-column">
        <a onclick="$('#moreBtn').click();load('')" href="javascript:void(0)">
            <svg class="icon mobilesli" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="20">
                <path d="m18 12a6 6 0 1 0 -6 6 6.006 6.006 0 0 0 6-6zm-6 4-3-4 3-4 3 4zm4.391-15.157a12.054 12.054 0 0 1 6.766 6.766l-3.847 1.154a8.048 8.048 0 0 0 -4.073-4.073zm-6.869-.583a11.939 11.939 0 0 1 4.956 0l-1.158 3.858a7.442 7.442 0 0 0 -2.64 0zm10.36 13.06a7.442 7.442 0 0 0 0-2.64l3.858-1.158a11.939 11.939 0 0 1 0 4.956zm-15.764 0-3.858 1.158a11.939 11.939 0 0 1 0-4.956l3.858 1.158a7.442 7.442 0 0 0 0 2.64zm10.36 10.42a11.939 11.939 0 0 1 -4.956 0l1.158-3.858a7.442 7.442 0 0 0 2.64 0zm8.679-7.349a12.054 12.054 0 0 1 -6.766 6.766l-1.154-3.847a8.048 8.048 0 0 0 4.073-4.073zm-22.313-8.782a12.049 12.049 0 0 1 6.765-6.766l1.154 3.847a8.042 8.042 0 0 0 -4.072 4.073zm6.765 15.548a12.049 12.049 0 0 1 -6.765-6.766l3.847-1.154a8.042 8.042 0 0 0 4.072 4.073z" />
            </svg>
            Casino
        </a>

        <a onclick="$('#moreBtn').click();load('slots')" href="javascript:void(0)">
            <svg class="icon mobilesli" width="20" height="20" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
                <path d="M23,3.723v5.277c0,2.209-1.791,4-4,4h-1v2h-5v-6h5v2h1c1.105,0,2-.895,2-2V3.723c-.727-.423-1.169-1.28-.938-2.224,.176-.72,.781-1.301,1.506-1.453,1.294-.271,2.433,.709,2.433,1.955,0,.738-.405,1.376-1,1.723ZM9,0C4.725,0,1.145,2.998,.232,7H17.768C16.855,2.998,13.275,0,9,0ZM4,24H14c2.209,0,4-1.791,4-4v-3H0v3c0,2.209,1.791,4,4,4Zm7-9v-6H7v6h4Zm-6-6H0v6H5v-6Z"></path>
            </svg>
            Slots
        </a>

        <a href="/crash" class="d-flex game-bar">
            <img data-v-59450424="" src="/img/aviator-game-logo.svg" height="20" width="75">
        </a>

        <a href="/games/chicken-road" class="d-flex game-bar">
            <img data-v-59450424="" src="/img/icons/chicken-road.svg" height="20">
        </a>

        <!--<a  <?php if(auth()->guard()->check()): ?> onclick="$('#moreBtn').click();load('bonus')" <?php else: ?> onclick="$('#moreBtn').click();" rel="popup" data-popup="popup--auth" <?php endif; ?>>
								<svg class="icon mobilesli"><use xlink:href="images/symbols.svg#gift"></use></svg> Bonus
							</a>!-->

        <?php if(auth()->guard()->check()): ?>
        <a href="/withdrawal">
            <svg class="icon mobilesli" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" id="Layer_1" viewBox="0 0 64 64" xml:space="preserve">
                <g>
                    <circle cx="32" cy="14" r="3" />
                    <path d="M4,25h56c1.794,0,3.368-1.194,3.852-2.922c0.484-1.728-0.242-3.566-1.775-4.497l-28-17   C33.438,0.193,32.719,0,32,0s-1.438,0.193-2.076,0.581l-28,17c-1.533,0.931-2.26,2.77-1.775,4.497C0.632,23.806,2.206,25,4,25z    M32,9c2.762,0,5,2.238,5,5s-2.238,5-5,5s-5-2.238-5-5S29.238,9,32,9z" />
                    <rect x="34" y="27" width="8" height="25" />
                    <rect x="46" y="27" width="8" height="25" />
                    <rect x="22" y="27" width="8" height="25" />
                    <rect x="10" y="27" width="8" height="25" />
                    <path d="M4,58h56c0-2.209-1.791-4-4-4H8C5.791,54,4,55.791,4,58z" />
                    <path d="M63.445,60H0.555C0.211,60.591,0,61.268,0,62v2h64v-2C64,61.268,63.789,60.591,63.445,60z" />
                </g>
            </svg> Withdrawal
        </a>

        <a href="/deposit">
            <svg class="icon mobilesli" width="24" height="24" viewBox="0 0 24 24">
                <path d="M22.5 18V19.875C22.5 20.9092 21.6585 21.75 20.625 21.75H4.5C2.8455 21.75 1.5 20.4045 1.5 18.75C1.5 18.75 1.5 6.01125 1.5 6C1.5 4.3455 2.8455 3 4.5 3H18.375C18.9967 3 19.5 3.504 19.5 4.125C19.5 4.746 18.9967 5.25 18.375 5.25H4.5C4.08675 5.25 3.75 5.586 3.75 6C3.75 6.414 4.08675 6.75 4.5 6.75H20.625C21.6585 6.75 22.5 7.59075 22.5 8.625V10.5H18.75C16.6823 10.5 15 12.1823 15 14.25C15 16.3177 16.6823 18 18.75 18H22.5Z"></path>
                <path d="M22.5 12V16.5H18.75C17.5073 16.5 16.5 15.4927 16.5 14.25C16.5 13.0073 17.5073 12 18.75 12H22.5Z"></path>
            </svg> Deposit
        </a>
        <?php else: ?>
        <a data-switch="loginphone" style="background: #397ce6;position: relative;" href="javascript:void(0)" class="btn is-ripples btn--blue d-flex align-center flare has-ripple">
            <span>
                Login
                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="15" height="15" fill="white">
                    <path d="M18.589,0H5.411A5.371,5.371,0,0,0,0,5.318V7.182a1.5,1.5,0,0,0,3,0V5.318A2.369,2.369,0,0,1,5.411,3H18.589A2.369,2.369,0,0,1,21,5.318V18.682A2.369,2.369,0,0,1,18.589,21H5.411A2.369,2.369,0,0,1,3,18.682V16.818a1.5,1.5,0,1,0-3,0v1.864A5.371,5.371,0,0,0,5.411,24H18.589A5.371,5.371,0,0,0,24,18.682V5.318A5.371,5.371,0,0,0,18.589,0Z"></path>
                    <path d="M3.5,12A1.5,1.5,0,0,0,5,13.5H5l9.975-.027-3.466,3.466a1.5,1.5,0,0,0,2.121,2.122l4.586-4.586a3.5,3.5,0,0,0,0-4.95L13.634,4.939a1.5,1.5,0,1,0-2.121,2.122l3.413,3.412L5,10.5A1.5,1.5,0,0,0,3.5,12Z"></path>
                </svg>
            </span>
            <span class="ripple ripple-animate" style="height: 143.806px; width: 143.806px; animation-duration: 0.3s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -59.4586px; left: -29.9308px;">
            </span>
        </a>

        <a href="javascript:void(0)" data-switch="regquick" style="background: #2BB865; position: relative; " class="btn is-ripples btn--blue d-flex align-center flare has-ripple">
            <span>
                Registration
                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" height="15" viewBox="0 0 24 24" width="15" data-name="Layer 1">
                    <path fill="white" d="m12 0a12 12 0 1 0 12 12 12.013 12.013 0 0 0 -12-12zm0 21a9 9 0 1 1 9-9 9.01 9.01 0 0 1 -9 9zm5-9a1.5 1.5 0 0 1 -1.5 1.5h-2v2a1.5 1.5 0 0 1 -3 0v-2h-2a1.5 1.5 0 0 1 0-3h2v-2a1.5 1.5 0 0 1 3 0v2h2a1.5 1.5 0 0 1 1.5 1.5z"></path>
                </svg>
            </span>
            <span class="ripple ripple-animate" style="height: 143.806px; width: 143.806px; animation-duration: 0.3s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -59.4586px; left: -29.9308px;"></span>
        </a>

        <?php endif; ?>
       
        <!--<a onclick="$('#moreBtn').click();load('faq')">
								<svg class="icon mobilesli"><use xlink:href="images/symbols.svg#faq"></use></svg> Faq
							</a>!-->

        <a target="_blank" href="<?php echo e(\App\Setting::first()->support_contact); ?>">
            <svg class="icon mobilesli">
                <use xlink:href="/images/symbols.svg#support"></use>
            </svg> Support
        </a>
         <?php if(auth()->guard()->check()): ?>
        <a href="/logout">
            
            <svg class="icon mobilesli" width="24" height="24"><use xlink:href="/images/symbols.svg#exit"></use></svg>Exit
        </a>
        <?php endif; ?>
    </li>
</div><?php /**PATH /var/www/product/resources/views/layouts/mobile_menu.blade.php ENDPATH**/ ?>