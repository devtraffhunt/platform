@extends('layouts.app')

@section('title', 'Games')
@section('content')
<style>
  .name_slot_game {
    font-family: 'Inter', sans-serif !important;
  }

  .slot_games_content {
    font-family: 'Inter', sans-serif !important;
  }

  .demo_slot_game {
    font-family: 'Inter', sans-serif !important;
  }

  .head_name_slot_game {
    font-family: 'Inter', sans-serif !important;
  }


  html,
  body {
    margin: 0;
    padding: 0;
    height: 100%;
    overflow: hidden;
  }

  .body_slot_game {
    height: calc(var(--vh, 1vh) * 80);
    /* ← эквивалент 80vh */
    width: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    background: #11182a;
    /* желательно фиксированный фон */
  }


  #iframe_slot {
    flex: 1;
    /* занимает всю доступную высоту родителя */
    width: 100%;
    border: none;
    display: block;
    background: transparent;
  }
</style>
<div class="wrapper">
  <div class="slot_game_panel">
    <div class="head_slot_game">
      <div class="buttons_slot_game">
        <button onclick="window.location.href = '/slots'">
          <svg class="icon" style="transform: rotate(90deg);">
            <use xlink:href="/symbols.svg?v=8#arrow"></use>
          </svg>
        </button>
      </div>
      <div class="head_name_slot_game">
        <div class="head_name_slot_game">{{ $title }}</div>
      </div>
      <div class="buttons_slot_game right">
        <button class="demo_slot_button" style="display: none;">DEMO</button>
        <button onclick="refreshSlots()">
          <svg class="icon icon_button_slot">
            <use xlink:href="/symbols.svg?v=8#refresh_slot"></use>
          </svg>
        </button>
      </div>
    </div>

    <div class="body_slot_game">
      @if ($url)
      <iframe id="iframe_slot"
        src="{{ $url }}"
        frameborder="0"
        allow="autoplay *; screen-wake-lock *; fullscreen *"
        allowfullscreen
        webkitallowfullscreen
        mozallowfullscreen>
      </iframe>
      @else
      <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; text-align: center; color: white;">
        <p style="font-size: 18px; margin-bottom: 20px;">This game is temporarily unavailable</p>
        <button onclick="location.reload()" style="padding: 10px 20px; font-size: 16px; background-color: #ff9800; color: white; border: none; border-radius: 6px; cursor: pointer;">
          Refresh
        </button>
      </div>
<style>
       .body_slot_game {
    padding-top: 0%;
  }
</style>
      @endif
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const userBlock = document.querySelector(".header__user-b.d-flex.align-center");
    if (userBlock) {
        userBlock.style.display = "none";
    }
});
</script>


<script>
  
  const vh = window.innerHeight * 0.01;
  document.documentElement.style.setProperty('--vh', `${vh}px`);
</script>

<script>
  window.addEventListener('DOMContentLoaded', () => {
    if (window.innerWidth <= 768) {
      const header = document.querySelector('header') || document.querySelector('.header');
      if (header) header.style.display = 'none';

      const mobileMenu = document.querySelector('.mobile-menu');
      if (mobileMenu) {
        mobileMenu.style.setProperty('display', 'none', 'important');
      }
    }
  });
</script>

@endsection
