<div class="header">
	<div class="wrapper d-flex align-center justify-space-between">


		<nav class="header__links d-flex align-center">
			<a href="/" style="margin-right:40px;">
				<img width="150px" src="/img/logo2.svg">
			</a>
			<li class="{{ request()->is('/') ? 'active' : '' }}">
				<a href="javascript:void(0)" onclick="load(''); return false;" class="d-flex align-center">
					<svg class="icon" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="20">
						<path d="m18 12a6 6 0 1 0 -6 6 6.006 6.006 0 0 0 6-6zm-6 4-3-4 3-4 3 4zm4.391-15.157a12.054 12.054 0 0 1 6.766 6.766l-3.847 1.154a8.048 8.048 0 0 0 -4.073-4.073zm-6.869-.583a11.939 11.939 0 0 1 4.956 0l-1.158 3.858a7.442 7.442 0 0 0 -2.64 0zm10.36 13.06a7.442 7.442 0 0 0 0-2.64l3.858-1.158a11.939 11.939 0 0 1 0 4.956zm-15.764 0-3.858 1.158a11.939 11.939 0 0 1 0-4.956l3.858 1.158a7.442 7.442 0 0 0 0 2.64zm10.36 10.42a11.939 11.939 0 0 1 -4.956 0l1.158-3.858a7.442 7.442 0 0 0 2.64 0zm8.679-7.349a12.054 12.054 0 0 1 -6.766 6.766l-1.154-3.847a8.048 8.048 0 0 0 4.073-4.073zm-22.313-8.782a12.049 12.049 0 0 1 6.765-6.766l1.154 3.847a8.042 8.042 0 0 0 -4.072 4.073zm6.765 15.548a12.049 12.049 0 0 1 -6.765-6.766l3.847-1.154a8.042 8.042 0 0 0 4.072 4.073z" />
					</svg>
					<span>Casino</span>
				</a>
			</li>
			<li class="{{ request()->is('crash') ? 'active' : '' }}">
				<a href="/crash" class="d-flex game-bar">
					<img data-v-59450424="" src="/img/aviator-game-logo.svg" height="20" width="75">
				</a>
			</li>

			<li class="{{ request()->is('chicken_road') ? 'active' : '' }}">
				<a href="/games/chicken-road" class="d-flex game-bar">
					<img data-v-59450424="" src="/img/icons/chicken-road.svg" height="20" width="75">
				</a>
			</li>

			<li class="{{ request()->is('slots') ? 'active' : '' }}">
				<a href="/games" return false;" class="d-flex align-center">
					<svg class="icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
						<path d="M23,3.723v5.277c0,2.209-1.791,4-4,4h-1v2h-5v-6h5v2h1c1.105,0,2-.895,2-2V3.723c-.727-.423-1.169-1.28-.938-2.224,.176-.72,.781-1.301,1.506-1.453,1.294-.271,2.433,.709,2.433,1.955,0,.738-.405,1.376-1,1.723ZM9,0C4.725,0,1.145,2.998,.232,7H17.768C16.855,2.998,13.275,0,9,0ZM4,24H14c2.209,0,4-1.791,4-4v-3H0v3c0,2.209,1.791,4,4,4Zm7-9v-6H7v6h4Zm-6-6H0v6H5v-6Z" />
					</svg>
					<span>Games</span>
				</a>
			</li>
			<!--<li class="{{ request()->is('mines') ? 'active' : '' }}">
								<a  onclick="load('mines'); return false;" class="d-flex align-center">
                                <svg class="icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" id="Layer_1" viewBox="0 0 25 25" data-name="Layer 1"><path d="m6 9.145c.378 0 .725-.214.894-.552.13-.26.238-.516.332-.768.083-.218.235-.371.449-.452.256-.096.513-.204.772-.334.338-.169.552-.516.552-.894s-.214-.725-.552-.894c-.26-.13-.516-.238-.768-.332-.218-.083-.371-.235-.452-.451-.096-.255-.203-.511-.333-.771-.339-.677-1.449-.677-1.788 0-.13.26-.238.516-.333.768-.083.218-.235.371-.449.452-.256.096-.513.204-.772.334-.338.169-.552.516-.552.894s.214.725.552.894c.26.13.516.238.768.332.218.083.371.235.452.449.096.256.204.513.334.772.169.338.516.552.894.552z"/><path d="m10.663 4.846c.909-.447 3.462-.846 4.837-.846 1.865 0 2.537 1.398 2.614 1.573.239.577.797.927 1.387.927.186 0 .374-.035.557-.108.769-.308 1.143-1.181.835-1.95-.511-1.279-2.223-3.443-5.393-3.443-1.561 0-4.653.411-6.163 1.154-.743.366-1.049 1.265-.683 2.008.366.744 1.266 1.048 2.008.683z"/><path d="m20.125 12.257.129-.129c.033-.034.064-.069.092-.106.417-.555.719-1.901-.797-3.427-1.519-1.531-2.872-1.223-3.433-.801-.037.028-.072.059-.104.091l-.131.131c-2.76-1.629-5.367-.996-8.354 1.99-3.285 3.284-3.166 6.734.354 10.253 1.683 1.683 3.287 2.573 4.903 2.72.156.014.312.021.467.021 1.656 0 3.296-.801 4.882-2.387 2.996-2.996 3.631-5.605 1.992-8.355z"/></svg>
									<span>Mines</span>
								</a>
							</li>!-->

			<li>
				<a href="{{ $setting->support_contact }}" target="_blank" class="d-flex align-center">
					<svg class="icon">
						<use xlink:href="images/symbols.svg?v=29#support"></use>
					</svg>
					<span>Support</span>
				</a>
			</li>


		</nav>
		<div class="header__right d-flex align-center">
			<div class="sidebar__logotype flare">
				<img onclick="load('')" width="100px" src="/img/logo2.svg">
			</div>
			@auth
			<div class="header__user d-flex align-center justify-space-between">
				<div class="header__user-balance d-flex align-center">
					<div class="header__user-b d-flex align-center" style="gap: 5px;">
						<svg class="icon" width="15px" height="15px" viewBox="-96 0 512 512">
							<path xmlns="http://www.w3.org/2000/svg" d="M308 96c6.627 0 12-5.373 12-12V44c0-6.627-5.373-12-12-12H12C5.373 32 0 37.373 0 44v44.748c0 6.627 5.373 12 12 12h85.28c27.308 0 48.261 9.958 60.97 27.252H12c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h158.757c-6.217 36.086-32.961 58.632-74.757 58.632H12c-6.627 0-12 5.373-12 12v53.012c0 3.349 1.4 6.546 3.861 8.818l165.052 152.356a12.001 12.001 0 0 0 8.139 3.182h82.562c10.924 0 16.166-13.408 8.139-20.818L116.871 319.906c76.499-2.34 131.144-53.395 138.318-127.906H308c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12h-58.69c-3.486-11.541-8.28-22.246-14.252-32H308z" />
						</svg>
						<span id="balance">{{ str_replace(',', ' ', number_format($user->balance_real, 2, '.', ',')) }}</span>
					</div>
					<div class="header__user-balance-add">
						<a href="/deposit"

							style="gap: 5px; background: #2BB865;"
							class="btn is-ripples flare d-flex align-center btn_custom_dep">
							<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 21 18" fill="none">
								<path
									fill-rule="evenodd"
									clip-rule="evenodd"
									d="M5.85428 3.76001e-05C5.90212 5.70907e-05 5.95068 7.68496e-05 5.99998 7.68496e-05H12C12.0492 7.68496e-05 12.0978 5.70907e-05 12.1456 3.76001e-05C13.0498 -0.000330934 13.6991 -0.000595582 14.263 0.134773C16.0455 0.562721 17.4373 1.95448 17.8652 3.73701C17.9471 4.07797 17.9789 4.44474 17.9914 4.87153C19.1855 5.36642 20.1342 6.31527 20.6288 7.50946C20.8378 8.01396 20.922 8.54138 20.9616 9.12162C20.9999 9.68307 20.9999 10.3705 20.9999 11.2109V11.2891C20.9999 12.1296 20.9999 12.817 20.9616 13.3784C20.922 13.9587 20.8378 14.4861 20.6288 14.9906C20.134 16.1851 19.185 17.1341 17.9905 17.6289C17.486 17.8379 16.9586 17.9221 16.3783 17.9617C15.8169 18 15.1295 18 14.2891 18H7.07782C6.06777 18 5.24172 18 4.57038 17.9452C3.87549 17.8884 3.24789 17.7673 2.66178 17.4687C1.7445 17.0013 0.998722 16.2555 0.531342 15.3382C0.232704 14.7521 0.111603 14.1245 0.0548288 13.4296C-2.21281e-05 12.7583 -1.27386e-05 11.9322 4.04175e-07 10.9222L0.000217841 5.623C0.00162269 4.85395 0.00749679 4.26684 0.134697 3.73701C0.562645 1.95448 1.95441 0.562721 3.73694 0.134773C4.30079 -0.000595582 4.95011 -0.000330934 5.85428 3.76001e-05ZM15.7178 4.50988C15.7075 4.41082 15.6943 4.33279 15.6774 4.26226C15.447 3.30244 14.6976 2.55303 13.7377 2.3226C13.4683 2.2579 13.1108 2.25007 12 2.25007H5.99998C4.88911 2.25007 4.53166 2.2579 4.26219 2.3226C3.30236 2.55303 2.55295 3.30244 2.32252 4.26226C2.30629 4.32988 2.2934 4.405 2.28327 4.50006H14.2499C14.285 4.50006 14.3197 4.50005 14.3543 4.50005C14.8573 4.5 15.3095 4.49996 15.7178 4.50988ZM2.24999 6.75005V10.875C2.24999 11.9437 2.25087 12.6775 2.29735 13.2464C2.34275 13.8021 2.42601 14.1007 2.5361 14.3167C2.78776 14.8107 3.18934 15.2122 3.68326 15.4639C3.89932 15.574 4.19785 15.6572 4.7536 15.7027C5.32248 15.7491 6.05631 15.75 7.12497 15.75H14.2499C15.139 15.75 15.7494 15.7494 16.2252 15.7169C16.6909 15.6852 16.9448 15.6267 17.1295 15.5502C17.7727 15.2838 18.2837 14.7728 18.5501 14.1296C18.6266 13.9449 18.6851 13.691 18.7169 13.2253C18.7493 12.7495 18.7499 12.1391 18.7499 11.25C18.7499 10.361 18.7493 9.75057 18.7169 9.27478C18.6851 8.8091 18.6266 8.55514 18.5501 8.3705C18.2837 7.7273 17.7727 7.21628 17.1295 6.94986C17.0193 6.90421 16.8835 6.86481 16.6937 6.83385C16.2023 6.7537 15.5182 6.75005 14.2499 6.75005H2.24999ZM12 10.5C12 9.87871 12.5036 9.37504 13.1249 9.37504H15.3749C15.9963 9.37504 16.4999 9.87871 16.4999 10.5C16.4999 11.1213 15.9963 11.625 15.3749 11.625H13.1249C12.5036 11.625 12 11.1213 12 10.5Z"
									fill="white" />
							</svg>
							<span> Deposit</span>
						</a>
					</div>
				</div>

				<div class="header__user-profile d-flex align-center" id="dropdownUser" style="display:none">
					<div class="user-split">
						<div class="user-avatar" style="background: url({{\Auth::user()->avatar}}) no-repeat center center / cover;"></div>
						<span>{{$user->id}}</span>
					</div>

					<div class="header__user-dropdown d-flex flex-column">
						<a href="javascript:void(0)" class="header__user-dropdown--id d-flex align-center">
							<span>ID: <b>{{$user->id}}</b></span>
						</a>
						<!--<a href="#" onclick="load('profile')" class="d-flex align-center">
											<svg class="icon"><use xlink:href="images/symbols.svg#user"></use></svg>
											<span>Profile</span>
										</a>!-->
						<!--<a href="#" rel="popup" data-popup="popup--coupon" onclick="return false;" class="d-flex align-center">
											<svg class="icon"><use xlink:href="images/symbols.svg#coupon"></use></svg>
											<span>Promo codes</span>
										</a>!-->
						<a onclick="location.href='deposit'" href="/deposit" class="d-flex align-center">
							<svg class="icon" width="24" height="24" viewBox="0 0 24 24">
								<path d="M22.5 18V19.875C22.5 20.9092 21.6585 21.75 20.625 21.75H4.5C2.8455 21.75 1.5 20.4045 1.5 18.75C1.5 18.75 1.5 6.01125 1.5 6C1.5 4.3455 2.8455 3 4.5 3H18.375C18.9967 3 19.5 3.504 19.5 4.125C19.5 4.746 18.9967 5.25 18.375 5.25H4.5C4.08675 5.25 3.75 5.586 3.75 6C3.75 6.414 4.08675 6.75 4.5 6.75H20.625C21.6585 6.75 22.5 7.59075 22.5 8.625V10.5H18.75C16.6823 10.5 15 12.1823 15 14.25C15 16.3177 16.6823 18 18.75 18H22.5Z"></path>
								<path d="M22.5 12V16.5H18.75C17.5073 16.5 16.5 15.4927 16.5 14.25C16.5 13.0073 17.5073 12 18.75 12H22.5Z"></path>
							</svg>
							<span>Deposit</span>
						</a>
						<a onclick="location.href='withdrawal'" href="/withdrawal" class="d-flex align-center">


							<svg class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" id="Layer_1" viewBox="0 0 64 64" xml:space="preserve">
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
							</svg>
							<span>Withdrawal</span>
						</a>

						<!-- <a href="#" id="darkTheme" onclick="return false;" class="d-flex align-center">
                                        <svg class="icon"><use xlink:href="images/symbols.svg?v=1#dark"></use></svg>
                                        <span>Темная тема</span>
                                        <em>new</em>
                                    </a>
                                    <a href="#" id="lightTheme" onclick="return false;" class="d-flex align-center">
                                        <svg class="icon"><use xlink:href="images/symbols.svg?v=1#light"></use></svg>
                                        <span>Светлая тема</span>
                                    </a> -->

						<a href="logout" onclick="location.href='logout'" class="d-flex align-center">
							<svg class="icon">
								<use xlink:href="images/symbols.svg#exit"></use>
							</svg>
							<span>Exit</span>
						</a>
					</div>
				</div>

				<script>
					document.addEventListener("DOMContentLoaded", function() {
						const dropdownUser = document.getElementById("dropdownUser");
						if (dropdownUser && window.innerWidth > 700) {
							dropdownUser.style.display = "flex"; // или "block", если layout другой
						}
					});
				</script>

				@else

				<div class="auth_block">
					<a href="javascript:void(0)" class="openLoginModal btn is-ripples btn--blue d-flex align-center flare has-ripple">
						<span>
							Login
							<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="15" height="15" fill="white">
								<path d="M18.589,0H5.411A5.371,5.371,0,0,0,0,5.318V7.182a1.5,1.5,0,0,0,3,0V5.318A2.369,2.369,0,0,1,5.411,3H18.589A2.369,2.369,0,0,1,21,5.318V18.682A2.369,2.369,0,0,1,18.589,21H5.411A2.369,2.369,0,0,1,3,18.682V16.818a1.5,1.5,0,1,0-3,0v1.864A5.371,5.371,0,0,0,5.411,24H18.589A5.371,5.371,0,0,0,24,18.682V5.318A5.371,5.371,0,0,0,18.589,0Z" />
								<path d="M3.5,12A1.5,1.5,0,0,0,5,13.5H5l9.975-.027-3.466,3.466a1.5,1.5,0,0,0,2.121,2.122l4.586-4.586a3.5,3.5,0,0,0,0-4.95L13.634,4.939a1.5,1.5,0,1,0-2.121,2.122l3.413,3.412L5,10.5A1.5,1.5,0,0,0,3.5,12Z" />
							</svg>
						</span>
						<span
							class="ripple ripple-animate"
							style="height: 143.806px; width: 143.806px; animation-duration: 0.3s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -59.4586px; left: -29.9308px;">
						</span>
					</a>
					<a href="javascript:void(0)" style="background: #2BB865; position: relative; z-index: 1; border: 1px solid #2BB865; animation: pulse 1.5s infinite;" class="openRegModal btn is-ripples btn--blue d-flex align-center flare has-ripple">
						<span>
							Registration
							<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" height="15" viewBox="0 0 24 24" width="15" data-name="Layer 1">
								<path fill="white" d="m12 0a12 12 0 1 0 12 12 12.013 12.013 0 0 0 -12-12zm0 21a9 9 0 1 1 9-9 9.01 9.01 0 0 1 -9 9zm5-9a1.5 1.5 0 0 1 -1.5 1.5h-2v2a1.5 1.5 0 0 1 -3 0v-2h-2a1.5 1.5 0 0 1 0-3h2v-2a1.5 1.5 0 0 1 3 0v2h2a1.5 1.5 0 0 1 1.5 1.5z" />
							</svg>
						</span>
						<span
							class="ripple ripple-animate"
							style="height: 143.806px; width: 143.806px; animation-duration: 0.3s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -59.4586px; left: -29.9308px;"></span>
					</a>
				</div>

				@endauth

				<style>
					.auth_block {
						display: flex;
						justify-content: space-between;
						flex-direction: row;
						gap: 10px;
					}

					@media screen and (max-width: 500px) {

						.auth_block a {
							height: 45px;
						}

						.header__right .sidebar__logotype {
							width: 100px !important;
							height: 24px !important;
						}


					}

					@media screen and (max-width: 400px) {


						.auth_block svg {
							display: none;
						}

						.theme--dark .header__user-profile:before {
							height: 39px;
							width: 39px;
						}

						.header__user-profile {
							height: 38px;
							padding-right: 50px;
						}

						.btn_custom_dep {
							padding: 0px 10px;
							height: 39px;

						}

						#app>.main>.header {
							min-height: 70px;
						}

						.header__user-b span {
							font-size: 14px;
							font-weight: 700;
						}

						.header__user-b.d-flex.align-center {
							padding: 0px 5px 0 0px !important;
						}

						.mobile-navbar {
							margin-top: 70px;
						}

					}

					@media screen and (max-width: 360px) {

						.btn_custom_dep svg {
							display: none;
						}


					}
				</style>
			</div>
		</div>
	</div>
	@auth
</div>@endauth