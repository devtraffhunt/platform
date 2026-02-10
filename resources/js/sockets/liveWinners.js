import socket from './socket';

function setSecret(str) {
  if (!str || str.length <= 4) return '****';
  const middle = Math.floor(str.length / 2);
  return str.substring(0, middle - 1) + '****' + str.substring(middle + 2);
}

function liveGamesItemHTML(item) {
  return `
    <div class="item new flex-start-between" data-a="${item.game_id}" data-b="${item.game_type}">
      <a onclick="load('slots'); goToSlots(${item.game_id}, 'real');">
        <img src="${item.game_img}" alt="" draggable="false">
      </a>
      <div class="texts">
        <p class="sum">${parseInt(item.user_win).toLocaleString('ru-RU')} INR</p>
        <p class="game_title">${item.game_name}</p>
        <p class="mail">${setSecret(item.user_name)}</p>
      </div>
    </div>
  `;
}

export function initLiveWinners() {
  // маскируем e-mail'ы по загрузке
  document.querySelectorAll('.home_live_wins .mail').forEach(el => {
    el.textContent = setSecret(el.textContent);
  });

  socket.on('usersOnline', data => {
    const el = document.querySelector('.online');
    if (el) el.textContent = Number(data);
  });

  socket.emit('getUsersOnline');

  socket.on('laravel_database_updateLiveGames', raw => {
    let data;
    try {
      data = JSON.parse(raw);
    } catch (e) {
      console.error('LiveGames JSON parse error:', e);
      return;
    }

    if (Array.isArray(data)) {
      const container = document.querySelector('.home_live_wins .list');
      if (!container) return;

      for (let item of data) {
        const html = liveGamesItemHTML(item);
        container.insertAdjacentHTML('afterbegin', html);
      }

      // удалить всё после 20-го элемента
      const items = container.querySelectorAll('.item');
      if (items.length > 20) {
        for (let i = 20; i < items.length; i++) {
          items[i].remove();
        }
      }
    }
  });
}
