 @extends('admin.layouts.master')

@section('title') @lang('translation.Dashboards') @endsection

@section('content')

@component('admin.components.breadcrumb')
@slot('li_1') UPWIN @endslot
@slot('title') Настройки @endslot
@endcomponent

@php
$setting = \App\Setting::first();
@endphp



<div class="row">
	
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<h3>Настройки сайта</h3>
				<div class="row">
					<div class="col-lg-3 mb-3">
						<label>Название сайта</label>
						<input type="" class="form-control" id="name" value="{{$setting->name}}" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Контакт саппорта</label>
						<input type="" class="form-control" id="support_contact" value="{{$setting->support_contact}}" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Состояние сайта</label>
						<select class="form-select" id="status_site">
                            <option value="1" @if($setting->status == 1) selected="selected" @endif>Активен</option>
                            <option value="0" @if($setting->status == 0) selected="selected" @endif>Технические работы</option>
                        </select>
						
					</div>
			
					<div class="col-lg">
						<label>Действие</label>
						<button onclick="saveSetting(1)" class="btn btn-info btn-block w-100">Сохранить</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<h3>Настройки платежной системы Payou</h3>
				<div class="row">
					<div class="col-lg-3 mb-3">
						<label>ID Кассы</label>
						<input type="" class="form-control" id="payou_merchant_id" value="{{$setting->payou_merchant_id}}" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Секретный ключ</label>
						<input type="" class="form-control" id="payou_secret" value="{{$setting->payou_secret}}" name="">
					</div>
					<div class="col-lg">
						<label>Действие</label>
						<button onclick="saveSetting(2)" class="btn btn-info btn-block w-100">Сохранить</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<h3>Настройки платежной системы Pear2Pay</h3>
				<div class="row">
					<div class="col-lg-3 mb-3">
						<label>API Key</label>
						<input type="" class="form-control" id="pear2pay_api" value="{{$setting->pear2pay_api}}" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Secret Key</label>
						<input type="" class="form-control" id="pear2pay_secret" value="{{$setting->pear2pay_secret}}" name="">
					</div>
					<div class="col-lg">
						<label>Действие</label>
						<button onclick="saveSetting(3)" class="btn btn-info btn-block w-100">Сохранить</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<h3>Настройки платежной системы Kassify</h3>
				<div class="row">
					<div class="col-lg-3 mb-3">
						<label>Merchant ID</label>
						<input type="" class="form-control" id="kassify_merchant_id" value="{{$setting->kassify_merchant_id}}" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Secret Key</label>
						<input type="" class="form-control" id="kassify_secret" value="{{$setting->kassify_secret}}" name="">
					</div>
					<div class="col-lg">
						<label>Действие</label>
						<button onclick="saveSetting(4)" class="btn btn-info btn-block w-100">Сохранить</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<h3>Настройки платежной системы PayHub24</h3>
				<div class="row">
					<div class="col-lg-3 mb-3">
						<label>Public Key (API)</label>
						<input type="" class="form-control" id="payhub24_public_key" value="{{$setting->payhub24_public_key}}" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Private Key</label>
						<input type="" class="form-control" id="payhub24_private_key" value="{{$setting->payhub24_private_key}}" name="">
					</div>
					<div class="col-lg">
						<label>Действие</label>
						<button onclick="saveSetting(5)" class="btn btn-info btn-block w-100">Сохранить</button>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>


@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- dashboard init -->
<script src="/assets/js/pages/dashboard.init.js?v={{time()}}"></script>
@endsection
