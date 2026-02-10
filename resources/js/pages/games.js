// resources/js/pages/games.js

import { fetchGames } from '../api/games';

let currentPage = 1;
let selectedProvider = '';
let searchValue = '';
let isLoading = false;
let isLastPage = false;
let searchDebounceTimeout = null;

const dropdown = document.querySelector('.select-dropdown');
const selectedSpan = document.querySelector('.selected-value span');
const hiddenInput = document.querySelector('#providerInput');
const selectWrapper = document.querySelector('#customSelect');
const input = document.querySelector('.slot-filters-input input');
const clearBtn = document.querySelector('.clear-btn');

let currentValue = "";
let currentLabel = "All providers";

// Очистка поля поиска
clearBtn?.addEventListener('click', () => {
  if (!input) return;
  input.value = '';
  searchValue = '';
  currentPage = 1;
  isLastPage = false;
  clearBtn.style.display = 'none';
  loadGames('search');
});

// Обработка поиска
input?.addEventListener('input', () => {
  const value = input.value.trim();
  searchValue = value;
  clearBtn.style.display = value ? 'flex' : 'none';

  if (searchDebounceTimeout) {
    clearTimeout(searchDebounceTimeout);
  }

  searchDebounceTimeout = setTimeout(() => {
    currentPage = 1;
    isLastPage = false;
    loadGames('search');
  }, 800);
});

// Переключение дропдауна
function toggleDropdown() {
  dropdown.classList.toggle('hidden');
}

function createListItem(value, label) {
  const li = document.createElement('li');
  li.dataset.value = value;
  li.textContent = label;
  return li;
}

dropdown?.addEventListener('click', function (e) {
  const li = e.target.closest('li');
  if (!li) return;

  const newValue = li.dataset.value;
  const newLabel = li.textContent.trim();

  li.remove();

  if (currentLabel !== "All providers") {
    dropdown.appendChild(createListItem(currentValue, currentLabel));
  }

  if (newLabel !== "All providers" && !dropdown.querySelector('li[data-value=""]')) {
    const allLi = createListItem("", "All providers");
    dropdown.insertBefore(allLi, dropdown.firstChild);
  }

  if (newLabel === "All providers") {
    const allLi = dropdown.querySelector('li[data-value=""]');
    if (allLi) allLi.remove();
  }

  selectedSpan.textContent = newLabel;
  hiddenInput.value = newValue;
  currentLabel = newLabel;
  currentValue = newValue;

  slotProvider({ value: newValue });

  setTimeout(() => {
    dropdown.classList.add('hidden');
  }, 0);
});

// Загрузка
async function loadGames(type = 'load') {
  if (isLoading || isLastPage) return;
  isLoading = true;

  const loadMoreBtn = document.querySelector('.load-more-btn');
  const loaderIcon = document.querySelector('.load-more-loader-icon');

  if (type !== 'load') {
    currentPage = 1;
    isLastPage = false;
  }

  if (loadMoreBtn) loadMoreBtn.disabled = true;
  if (loaderIcon) loaderIcon.style.display = 'inline-block';

  try {
    const data = await fetchGames({
      page: currentPage,
      provider_id: selectedProvider,
      search: searchValue
    });

    const grid = document.querySelector('.slot-page-grid');

    if (type !== 'load') {
      grid.innerHTML = '';
    }

    const skeletons = document.querySelectorAll('.slot-card.skeleton');
    const fragments = document.createDocumentFragment();

    const loadImages = data.slots.map((slot, index) => {
      return new Promise(resolve => {
        const href = `/games/${slot.id}`;

        const slotCard = document.createElement('a');
        slotCard.className = 'slot-card fade-in';
        slotCard.href = href;

        const img = new Image();
        img.src = slot.banner_img;
        img.alt = slot.title;

        img.onload = () => {
          slotCard.innerHTML = `
            <div class="slot-thumb">
              <img src="${slot.banner_img}" alt="${slot.title}">
            </div>
            <div class="slot-info">
              <div class="slot-provider">
                <img src="${slot.provider.icon}" alt="${slot.provider.name}">
                ${slot.provider.name}
              </div>
              <div class="slot-title">${slot.title}</div>
            </div>
          `;

          const skeleton = skeletons[index];
          if (skeleton) {
            skeleton.replaceWith(slotCard);
          } else {
            fragments.appendChild(slotCard);
          }
          resolve();
        };

        img.onerror = () => resolve();
      });
    });

    await Promise.all(loadImages);
    grid.appendChild(fragments);

    currentPage = data.pagination?.current_page + 1 || currentPage + 1;
    isLastPage = data.pagination?.current_page >= data.pagination?.last_page;

  } catch (error) {
    console.error('Ошибка при загрузке слотов:', error);
  } finally {
    if (loadMoreBtn) {
      loadMoreBtn.disabled = isLastPage;
      loadMoreBtn.style.display = isLastPage ? 'none' : 'inline-block';
    }
    if (loaderIcon) loaderIcon.style.display = 'none';
    isLoading = false;
  }
}

function slotProvider(el) {
  selectedProvider = el.value || '';
  currentPage = 1;
  isLastPage = false;
  loadGames('provider');
}

function manualLoadMore() {
  loadGames();
}

window.addEventListener('DOMContentLoaded', () => {
  const grid = document.querySelector('.slot-page-grid');
  if (!grid) return;

  const wrapper = document.createElement('div');
  wrapper.className = 'load-more-wrapper';
  wrapper.style.textAlign = 'center';
  wrapper.style.padding = '2rem';

  const loadMoreBtn = document.createElement('button');
  loadMoreBtn.textContent = 'Show more';
  loadMoreBtn.className = 'load-more-btn';
  loadMoreBtn.onclick = manualLoadMore;

  const loaderIcon = document.createElement('span');
  loaderIcon.className = 'load-more-loader-icon';
  loaderIcon.style.cssText = `
    display: none;
    width: 16px;
    height: 16px;
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-top: 3px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    position: absolute;
    right: 17px;
    top: 50%;
    transform: translateY(-50%);
  `;

  const style = document.createElement('style');
  style.textContent = `
    @keyframes spin {
      0% { transform: translateY(-50%) rotate(0deg); }
      100% { transform: translateY(-50%) rotate(360deg); }
    }

    .fade-in {
      opacity: 0;
      transform: translateY(20px);
      animation: fadeIn 0.5s ease forwards;
    }

    @keyframes fadeIn {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  `;
  document.head.appendChild(style);

  loadMoreBtn.appendChild(loaderIcon);
  wrapper.appendChild(loadMoreBtn);
  grid.insertAdjacentElement('afterend', wrapper);

  const selected = document.querySelector('.selected-value');
  selected?.addEventListener('click', toggleDropdown);

  loadGames();
});
