import './bootstrap';
import { initPreloader } from './utils/preloader';
import initRegisterModal from './modals/register';
import initLoginModal from './modals/login';
import { initRipple } from './utils/ripple';
import { CountUp } from './utils/countup';
import { initSocketConnection } from './sockets/socket';
import { initLiveWinners } from './sockets/liveWinners';
import { initBalanceUpdater } from './sockets/balance';

initSocketConnection();
initLiveWinners();
initBalanceUpdater();



document.addEventListener('DOMContentLoaded', () => {
  initPreloader();
  initRegisterModal();
  initLoginModal();
  initRipple('.ripple');

  document.querySelectorAll('.countup').forEach(el => {
    const target = parseFloat(el.dataset.target || '100');
    const decimals = parseInt(el.dataset.decimals || '0');
    const duration = parseFloat(el.dataset.duration || '2');
    const instance = new CountUp(el, 0, target, decimals, duration);
    instance.start();
  });
});
