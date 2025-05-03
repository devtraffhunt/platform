<?php if(Auth::check() && Auth::user()->ban && request()->path() !== 'blocked'): ?>
    <?php echo $__env->make('blocked', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
<div class="wrapper mb">
    <div class="gx-row flex-wrap gx-gap-lg">
        <div class="gx-w-box gx-col-x blue">
            <div class="gx-col mw-6">
                <h1>GAME OF THE MONTH <br>AVIATOR</h1>
                <p>Our players have won the most<br> in the game "Aviator" this month!</p>
                <div class="gx-row mt-1">
                
                    <a class="btn is-ripples d-flex align-center has-ripple" <?php if(auth()->guard()->check()): ?> href="/crash" <?php else: ?> data-switch="regquick" href="javascript:void(0)" <?php endif; ?>>
                        <span>PLAY NOW</span>
                    </a>
                </div>
            </div>
        </div>
      
                <div class="gx-w-box gx-col-x banner_2">
            <div class="gx-col mw-6">
                <h1>DEPOSIT BONUS <br>500%</h1>
                <p>Bonus for new players with a <br>promo code on the first deposit!</p>
                <div class="gx-row mt-1">
                                                        
                    
                <a class="btn is-ripples d-flex align-center has-ripple" style="background: linear-gradient(109.64deg, #e6d039 5.39%, #e68539 63.15%);" <?php if(auth()->guard()->check()): ?> href="/deposit" <?php else: ?> data-switch="regquick" href="javascript:void(0)" <?php endif; ?>>
                        <span>DEPOSIT<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 21 18" fill="none">
												<path fill-rule="evenodd" clip-rule="evenodd" d="M5.85428 3.76001e-05C5.90212 5.70907e-05 5.95068 7.68496e-05 5.99998 7.68496e-05H12C12.0492 7.68496e-05 12.0978 5.70907e-05 12.1456 3.76001e-05C13.0498 -0.000330934 13.6991 -0.000595582 14.263 0.134773C16.0455 0.562721 17.4373 1.95448 17.8652 3.73701C17.9471 4.07797 17.9789 4.44474 17.9914 4.87153C19.1855 5.36642 20.1342 6.31527 20.6288 7.50946C20.8378 8.01396 20.922 8.54138 20.9616 9.12162C20.9999 9.68307 20.9999 10.3705 20.9999 11.2109V11.2891C20.9999 12.1296 20.9999 12.817 20.9616 13.3784C20.922 13.9587 20.8378 14.4861 20.6288 14.9906C20.134 16.1851 19.185 17.1341 17.9905 17.6289C17.486 17.8379 16.9586 17.9221 16.3783 17.9617C15.8169 18 15.1295 18 14.2891 18H7.07782C6.06777 18 5.24172 18 4.57038 17.9452C3.87549 17.8884 3.24789 17.7673 2.66178 17.4687C1.7445 17.0013 0.998722 16.2555 0.531342 15.3382C0.232704 14.7521 0.111603 14.1245 0.0548288 13.4296C-2.21281e-05 12.7583 -1.27386e-05 11.9322 4.04175e-07 10.9222L0.000217841 5.623C0.00162269 4.85395 0.00749679 4.26684 0.134697 3.73701C0.562645 1.95448 1.95441 0.562721 3.73694 0.134773C4.30079 -0.000595582 4.95011 -0.000330934 5.85428 3.76001e-05ZM15.7178 4.50988C15.7075 4.41082 15.6943 4.33279 15.6774 4.26226C15.447 3.30244 14.6976 2.55303 13.7377 2.3226C13.4683 2.2579 13.1108 2.25007 12 2.25007H5.99998C4.88911 2.25007 4.53166 2.2579 4.26219 2.3226C3.30236 2.55303 2.55295 3.30244 2.32252 4.26226C2.30629 4.32988 2.2934 4.405 2.28327 4.50006H14.2499C14.285 4.50006 14.3197 4.50005 14.3543 4.50005C14.8573 4.5 15.3095 4.49996 15.7178 4.50988ZM2.24999 6.75005V10.875C2.24999 11.9437 2.25087 12.6775 2.29735 13.2464C2.34275 13.8021 2.42601 14.1007 2.5361 14.3167C2.78776 14.8107 3.18934 15.2122 3.68326 15.4639C3.89932 15.574 4.19785 15.6572 4.7536 15.7027C5.32248 15.7491 6.05631 15.75 7.12497 15.75H14.2499C15.139 15.75 15.7494 15.7494 16.2252 15.7169C16.6909 15.6852 16.9448 15.6267 17.1295 15.5502C17.7727 15.2838 18.2837 14.7728 18.5501 14.1296C18.6266 13.9449 18.6851 13.691 18.7169 13.2253C18.7493 12.7495 18.7499 12.1391 18.7499 11.25C18.7499 10.361 18.7493 9.75057 18.7169 9.27478C18.6851 8.8091 18.6266 8.55514 18.5501 8.3705C18.2837 7.7273 17.7727 7.21628 17.1295 6.94986C17.0193 6.90421 16.8835 6.86481 16.6937 6.83385C16.2023 6.7537 15.5182 6.75005 14.2499 6.75005H2.24999ZM12 10.5C12 9.87871 12.5036 9.37504 13.1249 9.37504H15.3749C15.9963 9.37504 16.4999 9.87871 16.4999 10.5C16.4999 11.1213 15.9963 11.625 15.3749 11.625H13.1249C12.5036 11.625 12 11.1213 12 10.5Z" fill="white"></path>
											</svg>

</span>
                    </a>
                                    </div>
            </div>
         
        </div>
       
    </div>
 </div>
 <div class="wrapper">
 <section class="home_live_wins" style="margin-top: 0;">
        <h2 class="title">
            <div class="img_wrap">
                <svg class="icon">
                    <use xlink:href="/images/symbols.svg#timer"></use>
                </svg>
            </div>
            Live Wins
        </h2>
        <div class="list_wrap">
            <div id="home_live_wins_line" class="list flex-start">            
                <div class="item flex-start-between filler">
                    <a href="#">
                        <img src="/img/slots/aviator.jpg" alt="" draggable="false">
                    </a>
                    <div class="texts">
                        <p class="sum">9999 INR</p>
                        <p class="game_title">filler game name</p>
                        <p class="mail">filler ****r name</p>
                    </div>
                </div>
                <div class="item flex-start-between filler">
                    <a href="#">
                        <img src="/img/slots/aviator.jpg" alt="" draggable="false">
                    </a>
                    <div class="texts">
                        <p class="sum">9999 ₽</p>
                        <p class="game_title">filler game name</p>
                        <p class="mail">filler ****r name</p>
                    </div>
                </div>
                <div class="item flex-start-between filler">
                    <a href="#">
                        <img src="/img/slots/aviator.jpg" alt="" draggable="false">
                    </a>
                    <div class="texts">
                        <p class="sum">9999 ₽</p>
                        <p class="game_title">filler game name</p>
                        <p class="mail">filler ****r name</p>
                    </div>
                </div>
                <div class="item flex-start-between filler">
                    <a href="#">
                        <img src="/img/slots/aviator.jpg" alt="" draggable="false">
                    </a>
                    <div class="texts">
                        <p class="sum">9999 ₽</p>
                        <p class="game_title">filler game name</p>
                        <p class="mail">filler ****r name</p>
                    </div>
                </div>
                <div class="item flex-start-between filler">
                    <a href="#">
                        <img src="/img/slots/aviator.jpg" alt="" draggable="false">
                    </a>
                    <div class="texts">
                        <p class="sum">9999 ₽</p>
                        <p class="game_title">filler game name</p>
                        <p class="mail">filler ****r name</p>
                    </div>
                </div>
                <div class="item flex-start-between filler">
                    <a href="#">
                        <img src="/img/slots/aviator.jpg" alt="" draggable="false">
                    </a>
                    <div class="texts">
                        <p class="sum">9999 ₽</p>
                        <p class="game_title">filler game name</p>
                        <p class="mail">filler ****r name</p>
                    </div>
                </div>
                <div class="item flex-start-between filler">
                    <a href="#">
                        <img src="/img/slots/aviator.jpg" alt="" draggable="false">
                    </a>
                    <div class="texts">
                        <p class="sum">9999 ₽</p>
                        <p class="game_title">filler game name</p>
                        <p class="mail">filler ****r name</p>
                    </div>
                </div>
                <div class="item flex-start-between filler">
                    <a href="#">
                        <img src="/img/slots/aviator.jpg" alt="" draggable="false">
                    </a>
                    <div class="texts">
                        <p class="sum">9999 ₽</p>
                        <p class="game_title">filler game name</p>
                        <p class="mail">filler ****r name</p>
                    </div>
                </div>
                <div class="item flex-start-between filler">
                    <a href="#">
                        <img src="/img/slots/aviator.jpg" alt="" draggable="false">
                    </a>
                    <div class="texts">
                        <p class="sum">9999 ₽</p>
                        <p class="game_title">filler game name</p>
                        <p class="mail">filler ****r name</p>
                    </div>
                </div>
                <div class="item flex-start-between filler">
                    <a href="#">
                        <img src="/img/slots/aviator.jpg" alt="" draggable="false">
                    </a>
                    <div class="texts">
                        <p class="sum">9999 ₽</p>
                        <p class="game_title">filler game name</p>
                        <p class="mail">filler ****r name</p>
                    </div>
                </div>
            </div>
                            
            <div class="veil"></div>
        </div>
    </section>
    <br>    
    <!--<div class="gx-row">
         <div class="gx-con">
             <div class="icon lg text-warn">
                
                
                 <svg class="icon" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="M15.091,15.997c6.571-.033,8.909-3.513,8.909-6.497,0-1.677-1.188-3.08-2.765-3.419,.136-.386,.254-.741,.333-1.01,.353-1.193,.125-2.453-.626-3.458-.766-1.024-1.937-1.612-3.214-1.612H6.271c-1.277,0-2.449,.588-3.215,1.612-.751,1.005-.979,2.266-.626,3.458,.08,.269,.197,.624,.334,1.011-1.577,.339-2.764,1.742-2.764,3.419,0,2.984,2.339,6.464,8.909,6.497,.056,.302,.091,.61,.091,.924v3.079c0,1.826-1.536,1.992-2,2h-1c-.553,0-1,.447-1,1s.447,1,1,1h12c.553,0,1-.447,1-1s-.447-1-1-1h-.992c-.472-.008-2.008-.174-2.008-2v-3.08c0-.313,.035-.621,.091-.923Zm5.361-8.007c.017,0,.031,.01,.048,.01,.827,0,1.5,.673,1.5,1.5,0,2.034-1.609,4.197-6.036,4.47,.221-.299,.474-.576,.762-.821,1.739-1.478,2.933-3.453,3.726-5.159ZM2,9.5c0-.827,.673-1.5,1.5-1.5,.017,0,.031-.009,.047-.01,.794,1.706,1.988,3.681,3.727,5.159,.288,.245,.541,.521,.762,.821-4.427-.273-6.036-2.436-6.036-4.47Zm7.792,.263c-.264-.182-.375-.518-.27-.822l.519-1.606-1.366-1c-.327-.24-.398-.699-.158-1.026,.138-.188,.358-.3,.591-.3h1.681l.511-1.593c.129-.387,.547-.595,.934-.466,.22,.073,.393,.246,.466,.466l.51,1.593h1.681c.405,0,.734,.328,.734,.734,0,.235-.112,.455-.301,.593l-1.366,1,.519,1.606c.124,.386-.088,.8-.475,.925-.224,.072-.469,.032-.659-.107l-1.343-.988-1.344,.987c-.256,.191-.606,.192-.864,.004Z"/></svg>
                
                </div>
             <div class="title">
                 <span>TOP Games</span>
             </div>
         </div>
     </div>!-->

    <!--<div class="games">!-->

         <!--a onclick="load('shoot')" class="gx-game-item flare">
            <div class="gx-game-item-bk">
                <img class="left" src="/assets/images/image_20.png">
                <img class="center" src="/assets/images/d01893f2a6e0a98eb000ed26780ff952.png">
                <img class="right" src="/assets/images/image_20.png">
            </div>
            <div class="gx-game-item-pl">
                <div class="gx-row gx-gap-sm align-center text-gray">
                    <svg class="icon"><use xlink:href="/images/symbols.svg#users"></use></svg>
                    <p class="online--shoot">-1</p>
                </div>
            </div>
            <div class="gx-game-item-tl">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="2" viewBox="0 0 80 2" fill="none" class="gx-clip clip-b">
                    <path d="M0 0H80C80 1.10457 79.1046 2 78 2H2C0.895429 2 0 1.10457 0 0Z" fill="#3B7BE6"/>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="140" height="48" viewBox="0 0 140 48" fill="none" class="gx-clip clip-a">
                    <path d="M7.6782 11.1446C9.03072 4.65256 14.7525 0 21.3839 0H118.616C125.248 0 130.969 4.65257 132.322 11.1446L140 48H0L7.6782 11.1446Z" fill="#212739"/>
                </svg>
                <span>Shoot</span>
            </div>
         </a-->
        <!-- <a <?php if(auth()->guard()->check()): ?> onclick="load('slots')" <?php else: ?> onclick="load('')" rel="popup" data-popup="popup--auth" <?php endif; ?> class="gx-game-item flare">
            <div class="gx-game-item-bk">
                <img class="center" src="/assets/images/ic_slots.svg" draggable="false">
            </div>
            <div class="gx-game-item-pl">
                <div class="gx-row gx-gap-sm align-center text-gray">
                </div>
            </div>
            <div class="gx-game-item-tl">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="2" viewBox="0 0 80 2" fill="none" class="gx-clip clip-b">
                    <path d="M0 0H80C80 1.10457 79.1046 2 78 2H2C0.895429 2 0 1.10457 0 0Z" fill="#3B7BE6"></path>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="140" height="48" viewBox="0 0 140 48" fill="none" class="gx-clip clip-a">
                    <path d="M7.6782 11.1446C9.03072 4.65256 14.7525 0 21.3839 0H118.616C125.248 0 130.969 4.65257 132.322 11.1446L140 48H0L7.6782 11.1446Z" fill="#212739"></path>
                </svg>
                <span>slots</span>
            </div>
         </a>
         <a href="/crash"  class="gx-game-item flare">
            <div class="gx-game-item-bk">
                <img class="center" src="/aviator1.png" draggable="false">
            </div>
            <div class="gx-game-item-pl">
                <div class="gx-row gx-gap-sm align-center text-gray">
                </div>
            </div>
            <div class="gx-game-item-tl">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="2" viewBox="0 0 80 2" fill="none" class="gx-clip clip-b">
                    <path d="M0 0H80C80 1.10457 79.1046 2 78 2H2C0.895429 2 0 1.10457 0 0Z" fill="#3B7BE6"></path>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="140" height="48" viewBox="0 0 140 48" fill="none" class="gx-clip clip-a">
                    <path d="M7.6782 11.1446C9.03072 4.65256 14.7525 0 21.3839 0H118.616C125.248 0 130.969 4.65257 132.322 11.1446L140 48H0L7.6782 11.1446Z" fill="#212739"></path>
                </svg>
                <span>Crash</span>
            </div>
         </a>
         <a onclick="load('dice')" class="gx-game-item flare">
            <div class="gx-game-item-bk">
                <img class="center" src="/assets/images/ic_dice.svg" draggable="false">
            </div>
            <div class="gx-game-item-pl">
                <div class="gx-row gx-gap-sm align-center text-gray">
                </div>
            </div>
            <div class="gx-game-item-tl">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="2" viewBox="0 0 80 2" fill="none" class="gx-clip clip-b">
                    <path d="M0 0H80C80 1.10457 79.1046 2 78 2H2C0.895429 2 0 1.10457 0 0Z" fill="#3B7BE6"></path>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="140" height="48" viewBox="0 0 140 48" fill="none" class="gx-clip clip-a">
                    <path d="M7.6782 11.1446C9.03072 4.65256 14.7525 0 21.3839 0H118.616C125.248 0 130.969 4.65257 132.322 11.1446L140 48H0L7.6782 11.1446Z" fill="#212739"></path>
                </svg>
                <span>Dice</span>
            </div>
         </a>
         <a onclick="load('mines')" class="gx-game-item flare">
            <div class="gx-game-item-bk">
                <img class="center" src="/assets/images/ic_mines.svg" draggable="false">
            </div>
            <div class="gx-game-item-pl">
                <div class="gx-row gx-gap-sm align-center text-gray">
                </div>
            </div>
            <div class="gx-game-item-tl">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="2" viewBox="0 0 80 2" fill="none" class="gx-clip clip-b">
                    <path d="M0 0H80C80 1.10457 79.1046 2 78 2H2C0.895429 2 0 1.10457 0 0Z" fill="#3B7BE6"></path>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="140" height="48" viewBox="0 0 140 48" fill="none" class="gx-clip clip-a">
                    <path d="M7.6782 11.1446C9.03072 4.65256 14.7525 0 21.3839 0H118.616C125.248 0 130.969 4.65257 132.322 11.1446L140 48H0L7.6782 11.1446Z" fill="#212739"></path>
                </svg>
                <span>Mines</span>
            </div>
         </a>
         <a onclick="load('coinflip')" class="gx-game-item flare">
            <div class="gx-game-item-bk">
                <img class="center" src="/assets/images/ic_coinflip.svg" draggable="false">
            </div>
            <div class="gx-game-item-pl">
                <div class="gx-row gx-gap-sm align-center text-gray">
                </div>
            </div>
            <div class="gx-game-item-tl">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="2" viewBox="0 0 80 2" fill="none" class="gx-clip clip-b">
                    <path d="M0 0H80C80 1.10457 79.1046 2 78 2H2C0.895429 2 0 1.10457 0 0Z" fill="#3B7BE6"></path>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="140" height="48" viewBox="0 0 140 48" fill="none" class="gx-clip clip-a">
                    <path d="M7.6782 11.1446C9.03072 4.65256 14.7525 0 21.3839 0H118.616C125.248 0 130.969 4.65257 132.322 11.1446L140 48H0L7.6782 11.1446Z" fill="#212739"></path>
                </svg>
                <span>Coinflip</span>
            </div>
         </a>
         <a onclick="load('x100')" class="gx-game-item flare">
            <div class="gx-game-item-bk">
                <img class="center" src="/assets/images/ic_x100.svg" draggable="false">
            </div>
            <div class="gx-game-item-pl">
                <div class="gx-row gx-gap-sm align-center text-gray">
                </div>
            </div>
            <div class="gx-game-item-tl">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="2" viewBox="0 0 80 2" fill="none" class="gx-clip clip-b">
                    <path d="M0 0H80C80 1.10457 79.1046 2 78 2H2C0.895429 2 0 1.10457 0 0Z" fill="#3B7BE6"></path>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="140" height="48" viewBox="0 0 140 48" fill="none" class="gx-clip clip-a">
                    <path d="M7.6782 11.1446C9.03072 4.65256 14.7525 0 21.3839 0H118.616C125.248 0 130.969 4.65257 132.322 11.1446L140 48H0L7.6782 11.1446Z" fill="#212739"></path>
                </svg>
                <span>x100</span>
            </div>
         </a>
         <a onclick="load('x30')" class="gx-game-item flare">
            <div class="gx-game-item-bk">
                <img class="center" src="/assets/images/ic_x30.svg" draggable="false">
            </div>
            <div class="gx-game-item-pl">
                <div class="gx-row gx-gap-sm align-center text-gray">
                </div>
            </div>
            <div class="gx-game-item-tl">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="2" viewBox="0 0 80 2" fill="none" class="gx-clip clip-b">
                    <path d="M0 0H80C80 1.10457 79.1046 2 78 2H2C0.895429 2 0 1.10457 0 0Z" fill="#3B7BE6"></path>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="140" height="48" viewBox="0 0 140 48" fill="none" class="gx-clip clip-a">
                    <path d="M7.6782 11.1446C9.03072 4.65256 14.7525 0 21.3839 0H118.616C125.248 0 130.969 4.65257 132.322 11.1446L140 48H0L7.6782 11.1446Z" fill="#212739"></path>
                </svg>
                <span>x30</span>
            </div>
         </a>
         <a onclick="load('keno')" class="gx-game-item flare">
            <div class="gx-game-item-bk">
                <img class="center" src="/assets/images/ic_keno.svg" draggable="false">
            </div>
            <div class="gx-game-item-pl">
                <div class="gx-row gx-gap-sm align-center text-gray">
                </div>
            </div>
            <div class="gx-game-item-tl">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="2" viewBox="0 0 80 2" fill="none" class="gx-clip clip-b">
                    <path d="M0 0H80C80 1.10457 79.1046 2 78 2H2C0.895429 2 0 1.10457 0 0Z" fill="#3B7BE6"></path>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="140" height="48" viewBox="0 0 140 48" fill="none" class="gx-clip clip-a">
                    <path d="M7.6782 11.1446C9.03072 4.65256 14.7525 0 21.3839 0H118.616C125.248 0 130.969 4.65257 132.322 11.1446L140 48H0L7.6782 11.1446Z" fill="#212739"></path>
                </svg>
                <span>keno</span>
            </div>
         </a>
         <a <?php if(auth()->guard()->check()): ?> href="/slots?game_id=12281&type=real" <?php else: ?> onclick="load('')" rel="popup" data-popup="popup--auth" <?php endif; ?> class="gx-game-item flare">
            <div class="gx-game-item-bk">
                <img class="center" src="/dealer.svg" draggable="false">
            </div>
            <div class="gx-game-item-pl">
                <div class="gx-row gx-gap-sm align-center text-gray">
                </div>
            </div>
            <div class="gx-game-item-tl">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="2" viewBox="0 0 80 2" fill="none" class="gx-clip clip-b">
                    <path d="M0 0H80C80 1.10457 79.1046 2 78 2H2C0.895429 2 0 1.10457 0 0Z" fill="#3B7BE6"></path>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="140" height="48" viewBox="0 0 140 48" fill="none" class="gx-clip clip-a">
                    <path d="M7.6782 11.1446C9.03072 4.65256 14.7525 0 21.3839 0H118.616C125.248 0 130.969 4.65257 132.322 11.1446L140 48H0L7.6782 11.1446Z" fill="#212739"></path>
                </svg>
                <span>LiveDealers</span>
            </div>
         </a>
         <a <?php if(auth()->guard()->check()): ?> onclick="load('shoot')" <?php else: ?> onclick="load('')" rel="popup" data-popup="popup--auth" <?php endif; ?> class="gx-game-item flare">
            <div class="gx-game-item-bk">
                <img class="center" src="/aim-2.svg" draggable="false">
            </div>
            <div class="gx-game-item-pl">
                <div class="gx-row gx-gap-sm align-center text-gray">
                </div>
            </div>
            <div class="gx-game-item-tl">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="2" viewBox="0 0 80 2" fill="none" class="gx-clip clip-b">
                    <path d="M0 0H80C80 1.10457 79.1046 2 78 2H2C0.895429 2 0 1.10457 0 0Z" fill="#3B7BE6"></path>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="140" height="48" viewBox="0 0 140 48" fill="none" class="gx-clip clip-a">
                    <path d="M7.6782 11.1446C9.03072 4.65256 14.7525 0 21.3839 0H118.616C125.248 0 130.969 4.65257 132.322 11.1446L140 48H0L7.6782 11.1446Z" fill="#212739"></path>
                </svg>
                <span>Crazy Shoot</span>
            </div>
         </a>        

<div style="display: none;">
         <a <?php if(auth()->guard()->check()): ?> onclick="load('slots')" <?php else: ?> onclick="load('')" rel="popup" data-popup="popup--auth" <?php endif; ?> class="games__item games__item--slots flare d-flex align-end">
             <div class="games__item-text d-flex flex-column">
                 <span>SLOTS</span>
                 <p>? человек</p>
             </div>
         </a>

         <a href="crash" class="games__item  games__item--crash flare d-flex align-end">

             <div class="games__item-text d-flex flex-column">
                 <span>Crash</span>
                 <p>? человека</p>
             </div>
         </a>!-->

         <!---a href="shoot" class="games__item games__item--shoot flare d-flex align-end">
        <div class="games__item-text d-flex flex-column">
            <span>Crazy <br> Shoot</span>
            <p>? человек</p>
        </div>
    </a---->


        <!-- <a onclick="load('x100')" class="games__item games__item--x100 flare d-flex align-end">
             <div class="games__item-text d-flex flex-column">
                 <span>X100</span>
                 <p>? человек</p>
             </div>
         </a>

         <a onclick="load('x30')" class="games__item games__item--x30 flare d-flex align-end">
             <div class="games__item-text d-flex flex-column">
                 <span>X30</span>
                 <p>? человек</p>
             </div>
         </a>

         <a onclick="load('dice')" class="games__item games__item--dice flare d-flex align-end">
             <div class="games__item-text d-flex flex-column">
                 <span>Dice</span>
                 <p>? человек</p>
             </div>
         </a>


         <a onclick="load('mines')" class="games__item games__item--mines  flare d-flex align-end">
             <div class="games__item-text d-flex flex-column">
                 <span>Mines</span>
                 <p>? человек</p>
             </div>
         </a>

         <a onclick="load('coinflip')" class="games__item games__item--coin flare d-flex align-end">

             <div class="games__item-text d-flex flex-column">
                 <span>Coin Flip</span>
                 <p>? человека</p>
             </div>
         </a>

         <a onclick="load('keno')" class="games__item games__item--kenox flare d-flex align-end">
             <div class="games__item-text d-flex flex-column">
                 <span>KENO</span>
                 <p>? человек</p>
             </div>
         </a>

         <a onclick="load('lives')" class="games__item games__item--kenox flare d-flex align-end">
             <div class="games__item-text d-flex flex-column">
                 <span>Live-Dealers</span>
                 <p>? человек</p>
             </div>
         </a>        
         </div>
</div>!-->
<div class="wrapper">
     <div style="display:flex; flex-direction: row; justify-content: space-between;" class="gx-row">
         <div class="gx-con">
            <div class="icon lg text-warn">
                
                
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="M15.091,15.997c6.571-.033,8.909-3.513,8.909-6.497,0-1.677-1.188-3.08-2.765-3.419,.136-.386,.254-.741,.333-1.01,.353-1.193,.125-2.453-.626-3.458-.766-1.024-1.937-1.612-3.214-1.612H6.271c-1.277,0-2.449,.588-3.215,1.612-.751,1.005-.979,2.266-.626,3.458,.08,.269,.197,.624,.334,1.011-1.577,.339-2.764,1.742-2.764,3.419,0,2.984,2.339,6.464,8.909,6.497,.056,.302,.091,.61,.091,.924v3.079c0,1.826-1.536,1.992-2,2h-1c-.553,0-1,.447-1,1s.447,1,1,1h12c.553,0,1-.447,1-1s-.447-1-1-1h-.992c-.472-.008-2.008-.174-2.008-2v-3.08c0-.313,.035-.621,.091-.923Zm5.361-8.007c.017,0,.031,.01,.048,.01,.827,0,1.5,.673,1.5,1.5,0,2.034-1.609,4.197-6.036,4.47,.221-.299,.474-.576,.762-.821,1.739-1.478,2.933-3.453,3.726-5.159ZM2,9.5c0-.827,.673-1.5,1.5-1.5,.017,0,.031-.009,.047-.01,.794,1.706,1.988,3.681,3.727,5.159,.288,.245,.541,.521,.762,.821-4.427-.273-6.036-2.436-6.036-4.47Zm7.792,.263c-.264-.182-.375-.518-.27-.822l.519-1.606-1.366-1c-.327-.24-.398-.699-.158-1.026,.138-.188,.358-.3,.591-.3h1.681l.511-1.593c.129-.387,.547-.595,.934-.466,.22,.073,.393,.246,.466,.466l.51,1.593h1.681c.405,0,.734,.328,.734,.734,0,.235-.112,.455-.301,.593l-1.366,1,.519,1.606c.124,.386-.088,.8-.475,.925-.224,.072-.469,.032-.659-.107l-1.343-.988-1.344,.987c-.256,.191-.606,.192-.864,.004Z"/></svg>
               
               </div>
             <div class="title">
                 <span>TOP Games</span>
             </div>
         </div>

         <div class="gx-con">
            <a <?php if(auth()->guard()->check()): ?> href="/slots" <?php else: ?> data-switch="regquick" <?php endif; ?>>All games</a>
         </div>
     </div>

     <style>
  .games {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 12px;
    width: 100%;
    margin: 12px 0 35px;
  }

  .games__item {
    /* всегда 250×333 по пропорции, но может ужиматься до 150 по ширине */
    width: 100%;
    max-width: 250px;
    aspect-ratio: 250 / 333;
    overflow: hidden;
    border-radius: 16px;
    background: #000;
    position: relative;
  }
  .games__item img {
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .games__overlay {
    position: absolute;
    top: 0; right: 0; bottom: 0;
    width: 120px;
    pointer-events: none;
    background: linear-gradient(to right, transparent, rgb(9 15 30));
    z-index: 200;
  }
</style>

<div class="games">



  <a <?php if(auth()->guard()->check()): ?> href="/crash" <?php else: ?> data-switch="regquick" <?php endif; ?> class="games__item">
    <img src="/games/img/aviator.svg" alt="Aviator">
  </a>
  <a <?php if(auth()->guard()->check()): ?> onclick="load('slots'); goToSlots(3, 'real');" <?php else: ?> data-switch="regquick" <?php endif; ?> class="games__item">
    <img src="/games/img/gates-of-olympus.svg" alt="Gates of Olympus">
  </a>
  <a <?php if(auth()->guard()->check()): ?> onclick="load('slots'); goToSlots(10, 'real');" <?php else: ?> data-switch="regquick" <?php endif; ?> class="games__item">
    <img src="/games/img/the-dog-house.svg" alt="The Dog House">
  </a>
  <a <?php if(auth()->guard()->check()): ?> onclick="load('slots'); goToSlots(627, 'real');" <?php else: ?> data-switch="regquick" <?php endif; ?> class="games__item">
    <img src="/games/img/plinko.svg" alt="Plinko">
  </a>
  <a <?php if(auth()->guard()->check()): ?> onclick="load('slots'); goToSlots(21, 'real');" <?php else: ?> data-switch="regquick" <?php endif; ?> class="games__item">
    <img src="/img/slots/buffalo_king_megaways.svg" alt="Buffalo King Megaways">
  </a>
  <a <?php if(auth()->guard()->check()): ?> onclick="load('slots'); goToSlots(697, 'real');" <?php else: ?> data-switch="regquick" <?php endif; ?> class="games__item">
    <img src="/img/slots/sugar_rush.svg" alt="Sugar Rash">
  </a>


</div>









 <!--<div class="wrapper">
     <div class="gx-row">
         <div class="gx-con">
             <div class="icon lg"><svg class="icon" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="20"><path d="m18 12a6 6 0 1 0 -6 6 6.006 6.006 0 0 0 6-6zm-6 4-3-4 3-4 3 4zm4.391-15.157a12.054 12.054 0 0 1 6.766 6.766l-3.847 1.154a8.048 8.048 0 0 0 -4.073-4.073zm-6.869-.583a11.939 11.939 0 0 1 4.956 0l-1.158 3.858a7.442 7.442 0 0 0 -2.64 0zm10.36 13.06a7.442 7.442 0 0 0 0-2.64l3.858-1.158a11.939 11.939 0 0 1 0 4.956zm-15.764 0-3.858 1.158a11.939 11.939 0 0 1 0-4.956l3.858 1.158a7.442 7.442 0 0 0 0 2.64zm10.36 10.42a11.939 11.939 0 0 1 -4.956 0l1.158-3.858a7.442 7.442 0 0 0 2.64 0zm8.679-7.349a12.054 12.054 0 0 1 -6.766 6.766l-1.154-3.847a8.048 8.048 0 0 0 4.073-4.073zm-22.313-8.782a12.049 12.049 0 0 1 6.765-6.766l1.154 3.847a8.042 8.042 0 0 0 -4.072 4.073zm6.765 15.548a12.049 12.049 0 0 1 -6.765-6.766l3.847-1.154a8.042 8.042 0 0 0 4.072 4.073z"></path></svg></div>
             <div class="title">
                 <span>Crash</span>
             </div>
         </div>
     </div>

     <div class="games">
    
    <a  onclick="load('slots'); goToSlots(626, 'real');"  class="games__item games__item--shoot flare d-flex align-end" style="background-image: url(../newgame/aviator.png);"></a>
    <a  onclick="load('slots'); goToSlots(627, `real`);"  class="games__item games__item--x100 flare d-flex align-end" style="background-image: url(../newgame/plinko.png);"></a>
    <a  onclick="load('slots'); goToSlots(634, `real`);"  class="games__item games__item--x30 flare d-flex align-end" style="background-image: url(../newgame/roulette.png);"></a>
    <a  onclick="load('slots'); goToSlots(629, `real`);"  class="games__item games__item--dice flare d-flex align-end" style="background-image: url(../newgame/hilo.png);"></a>
    <a  onclick="load('slots'); goToSlots(631, `real`);"  class="games__item games__item--mines  flare d-flex align-end" style="background-image: url(../newgame/hotline.png);"></a>
    <a  onclick="load('slots'); goToSlots(633, `real`);"  class="games__item  games__item--crash flare d-flex align-end" style="background-image: url(../newgame/keno.png);"></a>


     </div>
 </div>!-->
<!--<div class="wrapper">
     <div class="gx-row">
         <div class="gx-con">
             <div class="icon lg"><svg class="icon">
                     <use xlink:href="/images/symbols.svg#game_menu"></use>
                 </svg></div>
             <div class="title">
                 <span>Slots</span>
             </div>
         </div>
     </div>

     <div class="games">
    
    <a  onclick="load('slots'); goToSlots(17, 'real');"  class="games__item games__item--shoot flare d-flex align-end" style="background-image: url(../img/slots/SweetBonanza.jpg);"></a>
    <a  onclick="load('slots'); goToSlots(414, 'real');"  class="games__item games__item--x100 flare d-flex align-end" style="background-image: url(../img/slots/TheDogHouseMegaways.jpg);"></a>
    <a  onclick="load('slots'); goToSlots(413, 'real');"  class="games__item games__item--x30 flare d-flex align-end" style="background-image: url(../img/slots/WildWildRiches.jpg);"></a>
    <a  onclick="load('slots'); goToSlots(26, 'real');"  class="games__item games__item--dice flare d-flex align-end" style="background-image: url(../img/slots/Cleocatra.jpg);"></a>
    <a  onclick="load('slots'); goToSlots(14, 'real');"  class="games__item games__item--mines  flare d-flex align-end" style="background-image: url(../img/slots/FruitParty.jpg);"></a>
    <a  onclick="load('slots'); goToSlots(37, 'real');"  class="games__item  games__item--crash flare d-flex align-end" style="background-image: url(../img/slots/777Strike.jpg);"></a>


     </div>
 </div>!-->
 <div class="wrapper">
     <div style="display:flex; flex-direction: row; justify-content: space-between;" class="gx-row">
         <div class="gx-con">
         <div class="icon lg">
                
                
                
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="20"><path d="m18 12a6 6 0 1 0 -6 6 6.006 6.006 0 0 0 6-6zm-6 4-3-4 3-4 3 4zm4.391-15.157a12.054 12.054 0 0 1 6.766 6.766l-3.847 1.154a8.048 8.048 0 0 0 -4.073-4.073zm-6.869-.583a11.939 11.939 0 0 1 4.956 0l-1.158 3.858a7.442 7.442 0 0 0 -2.64 0zm10.36 13.06a7.442 7.442 0 0 0 0-2.64l3.858-1.158a11.939 11.939 0 0 1 0 4.956zm-15.764 0-3.858 1.158a11.939 11.939 0 0 1 0-4.956l3.858 1.158a7.442 7.442 0 0 0 0 2.64zm10.36 10.42a11.939 11.939 0 0 1 -4.956 0l1.158-3.858a7.442 7.442 0 0 0 2.64 0zm8.679-7.349a12.054 12.054 0 0 1 -6.766 6.766l-1.154-3.847a8.048 8.048 0 0 0 4.073-4.073zm-22.313-8.782a12.049 12.049 0 0 1 6.765-6.766l1.154 3.847a8.042 8.042 0 0 0 -4.072 4.073zm6.765 15.548a12.049 12.049 0 0 1 -6.765-6.766l3.847-1.154a8.042 8.042 0 0 0 4.072 4.073z"></path></svg>
               </div>
             <div class="title">
                 <span>Games</span>
             </div>
         </div>

         <div class="gx-con">
            <a <?php if(auth()->guard()->check()): ?> href="/slots" <?php else: ?> data-switch="regquick" <?php endif; ?>>All games</a>
         </div>
     </div>


  <!-- Пример игровых блоков -->



  <div class="games">
  <a <?php if(auth()->guard()->check()): ?> onclick="load('slots'); goToSlots(469, 'real');" <?php else: ?> data-switch="regquick" <?php endif; ?> class="games__item">
    <img src="/games/img/tigger-jungle.svg" alt="Tigger Jungle">
  </a>
  <a <?php if(auth()->guard()->check()): ?> onclick="load('slots'); goToSlots(855, 'real');" <?php else: ?> data-switch="regquick" <?php endif; ?> class="games__item">
    <img src="/games/img/wanted-dead-or-a-wind.svg" alt="Wanted dead or a wind">
  </a>
  <a <?php if(auth()->guard()->check()): ?> onclick="load('slots'); goToSlots(724, 'real');" <?php else: ?> data-switch="regquick" <?php endif; ?> class="games__item">
    <img src="/games/img/sugar-rush-1000.svg" alt="Sugar Rush 1000">
  </a>
  <a <?php if(auth()->guard()->check()): ?> onclick="load('slots'); goToSlots(22, 'real');" <?php else: ?> data-switch="regquick" <?php endif; ?> class="games__item">
    <img src="/img/slots/bigger_bass_bonanza.svg" alt="Bigger Bass Bonanza">
  </a>
  <a <?php if(auth()->guard()->check()): ?> onclick="load('slots'); goToSlots(17, 'real');" <?php else: ?> data-switch="regquick" <?php endif; ?> class="games__item">
    <img src="/games/img/sweet-bonanza.svg" alt="Sweet Bonanza">
  </a>
  <a <?php if(auth()->guard()->check()): ?> onclick="load('slots'); goToSlots(838, 'real');" <?php else: ?> data-switch="regquick" <?php endif; ?> class="games__item">
    <img src="/games/img/rip-city.svg" alt="Rip City">
  </a>


</div>

 <script type="text/javascript">
     $('.close').click(function(e) {
         setTimeout(() => {
             $('.overlayed, .popup, body').removeClass('active');
         }, 100)
         $('.overlayed').addClass('animation-closed')
         return false;
     });
     $('.overlayed').click(function(e) {
         var target = e.target || e.srcElement;
         if (!target.className.search('overlay')) {
             setTimeout(() => {
                 $('.overlayed, .popup, body').removeClass('active');
             }, 100)
             $('.overlayed').addClass('animation-closed')
         }
     });
     $('[rel=popup]').click(function(e) {
         showPopup($(this).attr('data-popup'));
         return false;
     });

     function showPopup(el) {
         if ($('.popup').is('.active')) {
             $('.popup').removeClass('active');
         }
         $('.overlayed, body, .popup.' + el).addClass('active');
         $('.overlayed').removeClass('animation-closed');
     }
 </script>
 <?php endif; ?><?php /**PATH /var/www/product/resources/views/welcome.blade.php ENDPATH**/ ?>