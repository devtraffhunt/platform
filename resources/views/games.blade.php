@extends('layouts.app')

@section('title', 'Games')
@section('content')
<div class="wrapper">

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

@vite(['resources/css/pages/games.css', 'resources/js/pages/games.js'])
@endsection