@extends('admin.layouts.master')

@section('title') @lang('translation.Dashboards') @endsection

@section('content')

@component('admin.components.breadcrumb')
@slot('li_1') UPWIN @endslot
@slot('title') Депозиты @endslot
@endcomponent



<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<!-- Форма поиска -->
				<form method="GET" action="" style="margin-bottom: 20px;">
					<div class="row">
						<div class="col-md-4">
							<input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Поиск по ORDER ID, EXTERNAL ID или USER ID">
						</div>
						<div class="col-md-2">
							<button type="submit" class="btn btn-primary">Поиск</button>
						</div>
					</div>
				</form>

				<div class="table-responsive">
					<table class="table "  style="margin-bottom: 20px;"> 

						<thead>
							<tr>
								<th class="align-middle">ID</th>
                                <th class="align-middle">USER ID</th>
                                <th class="align-middle">ORDER ID</th>
                                <th class="align-middle">EXTERNAL ID</th>
                                <th class="align-middle">Сумма INR</th>
                                <th class="align-middle">Дата</th>
                                <th class="align-middle">Статус</th>
                                <th class="align-middle">Метод</th>
                                <th class="align-middle">Система</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data['deps'] as $d)
							@php
								$u = \App\User::where('id', $d->user_id)->first();
							@endphp
							<tr>
							<td><a href="javascript: void(0);" class="text-body fw-bold">#{{$d->id}}</a> </td>
                                        <td><a href="/admin/user/{{$d->user_id}}" class="text-body fw-bold">#{{$d->user_id}}</a> </td>
                                        <td>{{$d->transaction}}</td>
                                        <td>{{ $d->external_id ?? '-' }}</td>
                                        <td>{{number_format($d->sum, 2, ',', ' ')}}</td>
                                        <td>{{$d->data}}</td>
                                        <td>
    @if($d->status == 0)
        <span class="badge badge-pill badge-soft-warning font-size-11">Ожидание</span>
    @elseif($d->status == 1)
        <span class="badge badge-pill badge-soft-success font-size-11">Успешно</span>
    @elseif($d->status == 2)
        <span class="badge badge-pill badge-soft-danger font-size-11">Не успешно</span>
    @else
        <span class="badge badge-pill badge-soft-secondary font-size-11">Неизвестно</span>
    @endif
</td>
                                        <td><img height="20" src="/{{$d->img_system}}"></td>
                                        <td>{{$d->ps_system_id}}</td>
							</tr>
							@endforeach

						</tbody>
					</table>

					<div style="margin-bottom: 5px;">
					{{ $data['deps']->appends(request()->input())->links() }}
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
