@php
$query = \App\User::query();

if (request()->filled('search')) {
    $search = request()->input('search');
    $query->where(function ($q) use ($search) {
        $q->where('id', $search)
          ->orWhere('external_id', 'like', "%$search%")
          ->orWhere('email', 'like', "%$search%"); // добавили сюда поиск по email
    });
}

$users = $query->paginate(15);
@endphp

@extends('admin.layouts.master')

@section('title') @lang('translation.Dashboards') @endsection

@section('content')

@component('admin.components.breadcrumb')
@slot('li_1') UPWIN @endslot
@slot('title') Пользователи @endslot
@endcomponent


<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
      <form method="GET" action="" class="mb-4">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Поиск по ID, External ID, email ">
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
                <th scope="col">#</th>
                <th scope="col">External ID</th>
                <th scope="col">IP</th>
                <th scope="col">Баланс</th>
                <th scope="col">Депозитов</th>
                <th scope="col">Дата регистрации</th>
                <th scope="col">Статус</th>
                <th scope="col">Действия</th>
            </tr>
        </thead>
        <tbody>
          @foreach($users as $u)
          @php
          $deps = \App\Payment::where('user_id', $u->id)->where('status', 1)->sum('sum');
          $withdraws = \App\Withdraw::where('user_id', $u->id)->where('status', 1)->sum('sum');
          @endphp
          <tr>
            <th scope="row">{{$u->id}}</th>
            <td>{{ $u->external_id ?? '-' }}</td>
            <td>{{$u->ip}}</td>
            <td>{{number_format($u->balance, 2, ',', ' ')}}</td>
            <td>{{number_format($deps, 2, ',', ' ')}}</td>
            <td>{{date('d.m.y в H:i:s', strtotime($u->created_at))}}</td>
            <td>
    @if($u->ban == 0 && $u->frozen == 0)
        <span class="badge badge-pill badge-soft-success font-size-11">Активный</span>
    @elseif($u->ban == 0 && $u->frozen == 1)
        <span class="badge badge-pill badge-soft-warning font-size-11">Заморожен</span>
    @elseif($u->ban == 1)
        <span class="badge badge-pill badge-soft-danger font-size-11">Забанен</span>
    @else
        <span class="badge badge-pill badge-soft-secondary font-size-11">Неизвестный статус</span>
    @endif
</td>
            <td id="btns_bun_id_{{$u->id}}"><a href="user/{{$u->id}}" class="btn btn-primary btn-sm me-2">Перейти</a></td>
        </tr>
        @endforeach

    </tbody>
</table>

<div style="margin-bottom: 5px;">
    {{ $users->links() }}
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
