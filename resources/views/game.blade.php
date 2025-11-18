@extends('layouts.app')


@section('content')

@php

if (auth()->check()) {
    $userFrozen = Auth::user();
    $settingsN = \App\Setting::first();
    // Если пользователь уже заморожен — ничего не делаем
    if ($userFrozen->frozen != 1) {
        if ($userFrozen->balance > $settingsN->min_withdrawal_amount && $userFrozen->admin == 0) {
            $frozenLimit = $settingsN->frozen_amount;
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
<style>
  .providersSlots {
    background: #11182a;
    border-radius: 15px;
    margin-top: -40px;
    padding: 40px 15px 70px 15px;
    margin-bottom: 15px;
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    grid-column-gap: 10px;
    grid-row-gap: 10px;
    z-index: 1;
    position: relative;
    font-family: 'Inter', sans-serif;
  }

  @media (max-width: 1200px) {
    .providersSlots {
      grid-template-columns: repeat(5, 1fr);
    }
  }

  @media (max-width: 650px) {
    .providersSlots {
      grid-template-columns: repeat(4, 1fr);
    }
  }

  @media (max-width: 450px) {
    .providersSlots {
      grid-template-columns: repeat(3, 1fr);
    }
  }

  @media (max-width: 370px) {
    .providersSlots {
      grid-template-columns: repeat(2, 1fr);
    }
  }

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
    background: url(../shape-2.svg) no-repeat center center/contain;
    -webkit-transform: rotate(180deg);
    transform: rotate(360deg);
    bottom: 0;
  }

  .providersSlots .provider {
    text-align: center;
    background: #1f273b;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
    height: 75px;
    cursor: pointer;
  }

  .providersSlots .provider:hover {
    background: #313b56;
    color: #3a7ce6;
  }

  .providersSlots .provider h4 {
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
    background: #1b2030;
    border-radius: 15px;
  }

  .slotsLeftBox {
    display: flex;
    margin: 10px;
    align-content: center;
    align-items: center;
  }

  .slotsLeftBox img {
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
    background: #11182a;
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
    width: 100%;
    justify-content: space-between;
    height: 50px;
    border-radius: 15px;
    padding: 0 20px;
    background-color: #1f273b;
  }

  .searchSlots input {
    height: 40px;
    width: calc(100% - 35px);
    border: 0px;
    font-weight: 600;
    color: #fff;
    background-color: transparent;
  }

  .searchSlots input::placeholder {
    color: #FFFFFF;
  }

  .name_slot_game {
    font-family: 'Inter', sans-serif !important;
  }

  .slot_games_content {
    font-family: 'Inter', sans-serif !important;
  }

  .demo_slot_game {
    font-family: 'Inter', sans-serif !important;
  }

  .demo_slot_button{
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
        <div class="head_name_slot_game" style="font-family: 'Google Sans';">{{ $title }}</div>
      </div>
      <div class="buttons_slot_game right">
     @if(request()->is('games/chicken-road'))
    @if(request()->has('is_demo') && request()->get('is_demo') == 'true')
      
      <a href="{{ url('/games/chicken-road') }}">
            <button class="demo_slot_button" style="display: block;">REAL</button>
        </a>
    @else
         
        <a href="{{ url('/games/chicken-road?is_demo=true') }}">
            <button class="demo_slot_button" style="display: block;">DEMO</button>
        </a>
    @endif
@endif

        <button onclick="refreshSlots()">
          <svg class="icon icon_button_slot">
            <use xlink:href="/symbols.svg?v=8#refresh_slot"></use>
          </svg>
        </button>
      </div>
    </div>

    <div class="body_slot_game" data="{{ $url }}">
 
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

@endif
@endif
@endsection