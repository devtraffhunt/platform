@if(!Auth::check())
<script>
	window.location.href = '/?modal=regquick';
</script>
@endif

@php

if (auth()->check()) {
    $userFrozen = Auth::user();

    // Если пользователь уже заморожен — ничего не делаем
    if ($userFrozen->frozen != 1) {
        if ($userFrozen->balance > 100000 && $userFrozen->admin == 0) {
            $frozenLimit = 300000;
            if ($userFrozen->balance >= $frozenLimit && $frozenLimit != 0) {
                $userFrozen->frozen = 1;
                $userFrozen->save();
            }
        }
    }
}
@endphp

@if(Auth::check())
@if(Auth::user()->ban && request()->path() !== 'blocked')
@include('blocked')
@elseif(Auth::user()->frozen && request()->path() !== 'frozen')
@include('frozen')
@else

<div class="wrapper">
	<style>
		html {
			font-size: calc(100vw / 100);
		}

		body {
			margin: 0;
			background: #0e1323;
			font-family: 'Inter', sans-serif;
		}

		.slot-page-grid {
			display: grid;
			 grid-template-columns: repeat(auto-fit, minmax(12rem, 1fr));
			gap: 5rem 2rem;
			max-width: 100rem;
			margin: 20px auto;
			  justify-items: center;
  align-items: start;

		}

		.slot-card {
			display: flex;
			flex-direction: column;
			text-decoration: none;
			color: inherit;
			gap: 1.4rem;
			width: 100%;
  max-width: none;

			@media screen and (min-width: 800px) {
				gap: 0.5rem;
			}
		}

		@media screen and (max-width: 768px) {
  .slot-page-grid {
    grid-template-columns: repeat(3, 1fr);
  }

  .slot-card {
    max-width: none;
  }
}

		.slot-thumb {
			aspect-ratio: 130 / 164;
			border-radius: 1.6rem;
			overflow: hidden;
			background: #000;


			@media screen and (min-width: 800px) {
				border-radius: 1.0rem;
			}
		}

		.slot-thumb img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			display: block;
		}

		.slot-info {
			display: flex;
			flex-direction: column;
		}

		.slot-provider {
			display: flex;
			align-items: center;
			font-size: 3rem;
			color: #95A5CF;
			letter-spacing: 0.1rem;

			@media screen and (min-width: 800px) {
				font-size: 0.9rem;
				margin-top: 0.2rem;
			}
		}

		.slot-provider img {
			width: 4rem;
			height: 4rem;
			margin-right: 0.6rem;
			display: block;

			@media screen and (min-width: 800px) {
				width: 1.5rem;
				height: 1.5rem;
				margin-right: 0.1rem;
			}
		}

		.slot-title {
			font-size: 3rem;
			font-weight: 600;
			color: #fff;
			line-height: 1.2;
			margin-top: 0.5rem;
			word-break: break-word;

			@media screen and (min-width: 800px) {
				font-size: 0.9rem;
				margin-top: 0.2rem;
			}
		}

		.load-more-btn {
			position: relative;
			padding: 10px 40px;
			background: linear-gradient(135deg, #3a7ce6, #1f4ed8);
			color: #fff;
			font-size: 16px;
			font-weight: 600;
			border: none;
			border-radius: 10rem;
			cursor: pointer;
			transition: background 0.3s ease;
		}

		.load-more-btn:hover {
			background: linear-gradient(135deg, #4e8eff, #2a5ff0);
		}

		.slot-thumb-skeleton {
			aspect-ratio: 130 / 164;
			border-radius: 1.6rem;
			overflow: hidden;
			background: #11182A;
		}

		.slot-provider-skeleton {
			background: #11182A;
			width: 100%;
			height: 15px;
			margin-bottom: 5px;
			border-radius: 5px;
		}

		.slot-title-skeleton {
			background: #11182A;
			width: 100%;
			height: 20px;
			border-radius: 5px;
		}

		@keyframes skeleton-loading {
			0% {
				background-position: -200px 0;
			}

			100% {
				background-position: calc(200px + 100%) 0;
			}
		}

		.skeleton-loading {
			background: linear-gradient(90deg,
					#11182a 0px,
					#1a2238 40px,
					#11182a 80px);
			background-size: 200px 100%;
			animation: skeleton-loading 2.2s infinite linear;
		}

		.slot-filters {
			display: flex;
			width: 100%;
			flex-direction: column;
			gap: 10px;

			@media screen and (min-width: 800px) {
				flex-direction: row;
			}
		}

		.slot-filters-input {
			display: flex;
			align-items: center;
			background-color: #0d1326;
			/* темно-синий фон */
			border-radius: 12px;
			padding: 8px 12px;
			gap: 8px;
			width: 100%;
			height: 44px;
		}

		.slot-filters-input img {
			width: 23px;
			height: 23px;
			opacity: 0.6;
		}

		.slot-filters-input input {
			flex: 1;
			background: transparent;
			border: none;
			outline: none;
			color: #fff;
			font-size: 16px;
			font-weight: 600;
			padding: 0;
		}

		.slot-filters-input input::placeholder {
			font-size: 16px;
			font-weight: 300;
		}

		.clear-btn {
			border: none;
			border-radius: 50%;
			width: 23px;
			height: 23px;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 0;
			cursor: pointer;
			transition: background 0.2s ease-in-out;
		}


		.clear-btn img {
			width: 23px;
			height: 23px;
		}

		.slot-filters-select-wrapper {
  position: relative;
  background-color: #0d1326;
  border-radius: 12px;
  width: 100%;
  cursor: pointer;
  padding: 0px 5px;
}

.selected-value {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px;
  font-weight: 600;
  font-size: 16px;
  color: #fff;
}

.selected-value img {
  width: 18px;
  height: 18px;
  opacity: 0.6;
}

.select-dropdown {
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  margin-top: 4px;
  background-color: #0d1326;
  border-radius: 12px;
  max-height: 250px;
  overflow-y: auto;
  padding: 8px 0;
  z-index: 99;
}

.select-dropdown li {
  padding: 10px 16px;
  font-size: 15px;
  color: #aab4d4;
  display: flex;
  justify-content: space-between;
  align-items: center;
  cursor: pointer;
}

.select-dropdown li.active {
  font-weight: 600;
  color: #ffffff;
}

.select-dropdown li img {
  width: 18px;
  height: 18px;
}
	</style>

	<div class="slot-filters">
		<div class="slot-filters-input">
			<img src="/img/icons/search.svg">
			<input type="text" placeholder="Search" oninput="searchSlot(this)" />
			<button class="clear-btn" type="button"><img src="/img/icons/cross.svg"></button>
		</div>

		<div class="slot-filters-select-wrapper" onclick="toggleDropdown()">
			<div class="selected-value">
				<span>All providers</span>
				<img src="/img/icons/arrows.svg" alt="arrow" />
			</div>
			<ul class="select-dropdown hidden">
				<li data-value="pragmatic">Pragmatic</li>
<li data-value="spribe">Spribe</li>
<li data-value="relax">Relax</li>
<li data-value="redtiger">Red Tiger</li>
<li data-value="spinomenal">Spinomenal</li>
<li data-value="hacksaw">Hacksaw</li>
<li data-value="pgsoft">PGsoft</li>
<li data-value="3oaks">3 Oaks</li>
<li data-value="inout">InOut</li>
<li data-value="netent">NetEnt</li>
<li data-value="playngo">Playngo</li>
<li data-value="playson">Playson</li>
<li data-value="nolimit">Nolimit City</li>
<li data-value="bgaming">BGaming</li>
<li data-value="amatic">Amatic</li>
<li data-value="pushgaming">Push Gaming</li>

			
			</ul>
		</div>

		<!-- скрытое поле для value -->
		<input type="hidden" id="providerInput" name="provider" value="" />
	</div>

	<div class="slot-page-grid">


		@for ($i = 0; $i < 12; $i++)
			<div class="slot-card skeleton">
			<div class="slot-thumb-skeleton skeleton-loading"></div>
			<div class="slot-info">
				<div class="slot-provider-skeleton skeleton-loading"></div>
				<div class="slot-title-skeleton skeleton-loading"></div>
			</div>
	</div>
	@endfor







</div>

<script>
let searchDebounceTimeout = null;

document.querySelector('.clear-btn')?.addEventListener('click', () => {
  const input = document.querySelector('.slot-filters-input input');
  if (!input) return;

  input.value = '';
  searchValue = '';
  currentPage = 1;
  isLastPage = false;
  loadGames('search');
});

function searchSlot(input) {
  const clearBtn = document.querySelector('.clear-btn');
  const value = input.value.trim();
  searchValue = value;

  // Показываем или скрываем кнопку
  clearBtn.style.display = value ? 'flex' : 'none';

  // Если таймер уже был — сбрасываем его
  if (searchDebounceTimeout) {
    clearTimeout(searchDebounceTimeout);
  }

  // Устанавливаем новый таймер на 1000 мс
  searchDebounceTimeout = setTimeout(() => {
    currentPage = 1;
    isLastPage = false;
    loadGames('search');
  }, 1000);
}





const dropdown = document.querySelector('.select-dropdown');
const selectedSpan = document.querySelector('.selected-value span');
const hiddenInput = document.querySelector('#providerInput');
const selectWrapper = document.querySelector('#customSelect');

let currentValue = "";
let currentLabel = "All providers";

function toggleDropdown() {
  dropdown.classList.toggle('hidden');
}

function createListItem(value, label) {
  const li = document.createElement('li');
  li.dataset.value = value;
  li.textContent = label;
  return li;
}

dropdown.addEventListener('click', function (e) {
  const li = e.target.closest('li');
  if (!li) return;

  const newValue = li.dataset.value;
  const newLabel = li.textContent.trim();

  // Удаляем выбранный пункт
  li.remove();

  // Возвращаем предыдущий (если был и не "All providers")
  if (currentLabel !== "All providers") {
    dropdown.appendChild(createListItem(currentValue, currentLabel));
  }

  // Добавляем "All providers" в начало
  if (newLabel !== "All providers" && !dropdown.querySelector('li[data-value=""]')) {
    const allLi = createListItem("", "All providers");
    dropdown.insertBefore(allLi, dropdown.firstChild);
  }

  // Если выбрали "All providers", удалить его из списка
  if (newLabel === "All providers") {
    const allLi = dropdown.querySelector('li[data-value=""]');
    if (allLi) allLi.remove();
  }

  // Обновляем отображение
  selectedSpan.textContent = newLabel;
  hiddenInput.value = newValue;
  currentLabel = newLabel;
  currentValue = newValue;

  // Вызов фильтрации
  slotProvider({ value: newValue });

  // ⬇️ Закрытие с небольшой задержкой
  setTimeout(() => {
    dropdown.classList.add('hidden');
  }, 0);
});





	// ✅ Константы
	let currentPage = 1;
	let selectedProvider = '';
	let searchValue = '';
	let isLoading = false;
	let isLastPage = false;

	// ✅ Загружаем игры постранично
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
			const params = new URLSearchParams({
				page: currentPage,
				provider_id: selectedProvider,
				search: searchValue
			});

			const response = await fetch(`/slots/getGames?${params.toString()}`, {
				headers: {
					'X-CSRF-TOKEN': csrf_token
				},
			});

			const data = await response.json();
			console.log(`🔄 Page ${data.pagination?.current_page} of ${data.pagination?.last_page}`);
			console.log('🔽 Loaded slots:', data.slots);

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



	// ✅ Смена провайдера
	function slotProvider(el) {
		selectedProvider = el.value || '';
		currentPage = 1;
		isLastPage = false;
		loadGames('provider');
	}

	// ✅ Загрузка по кнопке
	function manualLoadMore() {
		loadGames();
	}

	// ✅ Первая загрузка + отрисовка кнопки и лоадера
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

		loadGames();
	});
</script>

@endif
@endif