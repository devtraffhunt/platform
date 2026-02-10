import socket from './socket';

function balanceUpdate(oldVal, newVal) {
  const el = document.getElementById('balance');
  if (!el) return;

  $({ numberValue: oldVal }).animate({ numberValue: newVal }, {
    duration: 1000,
    easing: "linear",
    step: function (val) {
      el.textContent = parseFloat(val).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    }
  });
}

export function initBalanceUpdater() {
  socket.on('laravel_database_updateBalance', e => {
    e = JSON.parse(e);
    if (window.USER_ID && e.user_id == window.USER_ID) {
      balanceUpdate(e.lastbalance, e.newbalance);
    }
  });
}
