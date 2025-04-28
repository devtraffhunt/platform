<div class="wrapper">
	<style>
		.providersSlots {
		  background: #20273a;
		  border-radius: 15px;
		  margin-top: -40px;
		  padding: 40px 15px 70px 15px;
		  margin-bottom: 15px;
		  display: grid;
		  grid-template-columns: repeat(6,1fr);
		  grid-column-gap: 10px;
		  grid-row-gap: 10px;
		  z-index: 1;
		  position: relative;
		}
		@media (max-width: 1200px) {
		  .providersSlots {
		      grid-template-columns: repeat(5,1fr);
		  }}
		@media (max-width: 650px) {
		  .providersSlots {
		  grid-template-columns: repeat(4,1fr);
		}}
		@media (max-width: 450px) {
		  .providersSlots {
		    grid-template-columns: repeat(3,1fr);
		}}
		@media (max-width: 370px) {
		  .providersSlots {
		    grid-template-columns: repeat(2,1fr);
		}}
		.slots--notFound {
		  grid-column: 1 / -1;
		  text-align: center;
		  padding: 40px;
		  font-weight: 600;
		  font-size: 18px;
		}
		.providersSlots::after {
		  content: '';
		  position: absolute;
		  width: 100%;
		  height: 55px;
		  background: url(../images/shape-2.svg) no-repeat center center/contain;
		  -webkit-transform: rotate(180deg);
		  transform: rotate(360deg);
		  bottom: 0;
		}
		.providersSlots .provider {
		  background: #1b2030;
		  border-radius: 10px;
		  display: flex;
		  align-items: center;
		  justify-content: center;
		  padding: 10px;
		  height: 75px;
		  cursor: pointer;
		}
		.providersSlots .provider img {
		  width: 100%;
		  height: 100%;
		  transition: .2s;
		  object-fit: contain;
		  filter: grayscale(3);
		  opacity: .4;
		}
        .provider.active img {
            filter: grayscale(0);
            opacity: 1;
        }
		@media (max-width: 725px) {
		  .btn-up {
		    right: 20px;
		  }
		}
		.slots__container {
		  background: #20273a;
		  border-radius: 15px;
		}
		.slotsLeftBox {
		  display: flex;
		  margin: 10px;
		  align-content: center;
		  align-items: center;
		}
		.slotsLeftBox img{
		  width: 100%;
		  height: 100%;
		  border-radius: 15px;
		  object-fit: cover;
		}
		.slotsLeftBox span {
		  font-size: 1.25rem;
		  font-weight: 700;
		  margin-left: 10px;
		}
		.slotsLoad {
		  grid-column: 1 / -1;
		  height: 200px;
		  display: flex;
		  justify-content: center;
		  align-items: center;
		}
		.headSlots {
		  margin-bottom: 15px;
		  display: flex;
		  align-items: center;
		  background: #20273a;
		  justify-content: space-between;
		  border-radius: 15px;
		  height: 70px;
		  padding: 10px;
		  position: relative;
		  z-index: 2;
		}
		.searchSlots {
		  display: flex;
		  align-items: center;
		  width: 220px;
		  justify-content: space-between;
		  height: 50px;
		  border-radius: 15px;
		  padding: 0 20px;
		  background-color: #1b2030;
		}

		.searchSlots input {
		  height: 40px;
		  width: calc(100% - 35px);
		  border: 0px;
		  font-weight: 600;
          color: #fff;
		  background-color: transparent;
		}
		.slotsLoad .wave {
		  width: 2px;
		  height: 100px;
		  background: linear-gradient(45deg, #6080b0, #b7cdef);
		  margin: 10px;
		  animation: wave 1s linear infinite;
		  /* border-radius: 20px; */
		}
		.slotsLoad .wave:nth-child(2) {
		  animation-delay: 0.1s;
		}
		.slotsLoad .wave:nth-child(3) {
		  animation-delay: 0.2s;
		}
		.slotsLoad .wave:nth-child(4) {
		  animation-delay: 0.3s;
		}
		.slotsLoad .wave:nth-child(5) {
		  animation-delay: 0.4s;
		}
		.slotsLoad .wave:nth-child(6) {
		  animation-delay: 0.5s;
		}
		.slotsLoad .wave:nth-child(7) {
		  animation-delay: 0.6s;
		}
		.slotsLoad .wave:nth-child(8) {
		  animation-delay: 0.7s;
		}
		.slotsLoad .wave:nth-child(9) {
		  animation-delay: 0.8s;
		}
		.slotsLoad .wave:nth-child(10) {
		  animation-delay: 0.9s;
		}

		.btnSlots {
		  cursor: pointer;
		  border: 0px;
		  height: 50px;
		  border-radius: 15px;
		  padding: 0 20px;
		  width: 180px;
		  font-weight: 600;
		  font-size: 14px;
		  margin-left: 10px;
		  color: #fff;
		  display: flex;
		  align-items: center;
		  justify-content: center;
		  transition: .25s ease;
		}
		.btnSlots.active svg {
		  transform: rotate(180deg);
		}
		.slots {
		    display: -ms-grid;
		    display: grid;
		    -ms-grid-columns: (1fr)[5];
		    grid-template-columns: repeat(5, 1fr);
		    grid-gap: 16px;
		    position: relative;
		    margin-bottom: 25px;
		    padding: 80px 25px 25px 25px;
		    border-radius: 15px;
		    background: #20273a;
		}

		@media (max-width: 945px) {
		.slots {
		    -ms-grid-columns: (1fr)[3];
		    grid-template-columns: repeat(3, 1fr);
		}}
		@media (max-width: 580px) {
		.slots {
		    -ms-grid-columns: (1fr)[2];
		    grid-template-columns: repeat(2, 1fr);
		}}
		.slots_game {
		  height: 100%;
		  width: 100%;
		  max-height: 280px;
		  background: #1b2030;
		  position: relative;
		  border-radius: 15px;
		  overflow: hidden;
		  color: #fff;
		  transition: all .3s cubic-bezier(0.39, 0.58, 0.57, 1);
		}
		.slot__animation__play svg {
		  height: 60px;
		  width: 60px;
		  padding: 10px;
		  position: absolute;
		  top: 50%;
		  left: 50%;
		  margin-right: -50%;
		  transform: translate(-50%, -50%);
		}
		.slot__title {
		  font-weight: 700;
		  text-align: center;
		  left: 50%;
		  display: block;
		  color: #fff;
		  margin-top: 15px;
		  font-size: 19px;
		  position: absolute;
		  top: 18%;
		  margin-right: -50%;
		  transform: translate(-50%, -50%);
		}
		.slot__titleProvider {
		  font-weight: 700;
		  text-align: center;
		  left: 50%;
		  display: block;
		  color: #fff;
		  margin-top: 15px;
		  font-size: 19px;
		  position: absolute;
		  top: 68%;
		  margin-right: -50%;
		  transform: translate(-50%, -50%);
		}
		.slots_game:hover {
		  transform: scaleX(1.05) scaleY(1.05);
		}
		.slots_game:hover .slot__animation__play {
		  opacity: 1;
		}
		.slot__animation__play {
		  position: absolute;
		  left: 0;
		  right: 0;
		  top: 0;
		  bottom: 0;
		  opacity: 0;
		  backdrop-filter: blur(3px);
		  text-align: center;
		  transition: all .2s ease;
		  background-color: rgba(0,0,0,.3);
		}
		.slots_game img {
		  pointer-events: none;
		  height: 100%;
		    width: 100%;
		    border-radius: 15px;
		}
		.shape {
		  position: relative;
		}
		.shape span {
		  margin: 0;
		    position: absolute;
		    top: 20px;
		    left: 50%;
		    color: #6a809f;
		    font-size: 20px;
		    font-weight: 900;
		    text-transform: uppercase;
		    z-index: 1;
		    margin-right: -50%;
		    transform: translate(-50%, -50%);
		}
	</style>
	<div class="slots__container">
		<div class="default-screen-slot" style="display: block">
			<iframe style="width: 100%; border-radius: 0px 0px 15px 15px; border-color: rgb(27, 32, 48);" id="frameslot" webkitallowfullscreen="true" mozallowfullscreen="true" allowfullscreen="true" align="center" height="769.6">
				Ваш браузер не поддерживает плавающие фреймы!
			</iframe>
		</div>
	</div>
	<script type="text/javascript">
		loadSlots();		
	</script>	
	@if(isset($_GET['12281']) && isset($_GET['type']))
	<script type = "text/javascript">
		if (USER_ID == 0) {
			var originalUrl = window.location.href;
			var newUrl = originalUrl.substring(0, originalUrl.indexOf('?'));
			history.pushState({}, '', newUrl);
		} else {
			$('.slot_game_panel').show();
			$('.slots_main').hide();
			$('.header__user-b').hide()
			$('#none_balance').show()
			$('.head_nme_slot_game').html("")
			$('.demo_slot_button').hide()
			$('.mobile-menu d-flex align-center').hide()
			$('#header').hide()	
			playSlot("{{$_GET['game_id=']}}", "{{$_GET['type']}}", "0")
		}
	</script>
	@endif
	<div class="btn-up" style="display:none">
		<div class="btn__ico d-flex align-center justify-center">
			<svg class="icon">
				<use xlink:href="../symbols.svg#arrow-up"></use>
			</svg>
		</div>
	</div>
</div>