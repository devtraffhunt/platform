@extends('admin.layouts.master')

@section('title') @lang('translation.Dashboards') @endsection

@section('content')

@component('admin.components.breadcrumb')
@slot('li_1') UPWIN @endslot
@slot('title') Пользователь @endslot
@endcomponent

@php
$user = $data['user'];
@endphp

@php
$ip = $user->ip ?? null;
$countryData = null;

if ($ip) {
    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://ipwho.is/{$ip}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response !== false) {
            $ipApiData = json_decode($response, true);
            if (isset($ipApiData['success']) && $ipApiData['success'] === true) {
                $countryData = [
                    'country_code' => $ipApiData['country_code'],
                    'country_name' => $ipApiData['country'],
                ];
            }
        }
    } catch (\Exception $e) {
        $countryData = null;
    }
}


$firstDeposit = \App\Payment::where('user_id', $user->id)
    ->where('status', 1)
    ->orderBy('created_at', 'asc')
    ->first();

@endphp

<div class="row">
    <div class="col-xl-4">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title mb-0">Аккаунт #{{$user->id}}</h4>
          <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
      </div>
      <div class="card-body">
          <form>
            <div class="row mb-2">
              <div class="profile-title">
                <div class="media" style="align-items: center;">      
                    <div><img class="img-70 rounded-circle" style="width: 100px;height: 100px;" alt="" src="{{$user->avatar}}"></div>                  

                    <div class="media-body ms-3">
                        <h5 class="mb-1">{{$user->email}} </h5>
                        <h5 class="mb-1">{{$user->phone}} </h5>
                        <p>@if($user->admin == 1) Администратор @else Пользователь @endif  @if($u->ban == 0 && $u->frozen == 0)
        <span class="badge badge-pill badge-soft-success font-size-11">Активный</span>
    @elseif($u->ban == 0 && $u->frozen == 1)
        <span class="badge badge-pill badge-soft-warning font-size-11">Заморожен</span>
    @elseif($u->ban == 1)
        <span class="badge badge-pill badge-soft-danger font-size-11">Забанен</span>
    @else
        <span class="badge badge-pill badge-soft-secondary font-size-11">Неизвестный статус</span>
    @endif</p> <div>
    @if(isset($countryData['country_code']) && isset($countryData['country_name']))
    <img src="https://flagcdn.com/48x36/{{ strtolower($countryData['country_code']) }}.png" style="width: 24px; height: 18px; vertical-align: middle;">
    <span>{{ $countryData['country_name'] }}</span>
@else
    <span>Страна не определена</span>
@endif
  </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Баланс</label>
            <input class="form-control" disabled id="balance_2" value="{{number_format($user->balance, 2, ',', ' ')}}">
        </div>
      <div class="mb-3">
      <label class="form-label">IP Регистрации </label>
  <input class="form-control" disabled value="{{$user->ip}}">
</div>


      <div class="mb-3">
          <label class="form-label">External ID</label>
          <input class="form-control" disabled value="{{$user->external_id}}">
      </div>

      <div class="mb-3">
          <label class="form-label">Сумма первого депозита</label>
          <input class="form-control" disabled value="{{ $firstDeposit ? number_format($firstDeposit->sum, 2, ',', ' ') : 'Нет депозитов' }}">
      </div>

      <div class="mb-3">
          <label class="form-label">Дата первого депозита</label>
          <input class="form-control" disabled value="{{ $firstDeposit ? date('d.m.y в H:i:s', strtotime($firstDeposit->created_at)) : 'Нет депозитов' }}">
      </div>

      <div class="mb-3">
          <label class="form-label">Минимальная сумма вывода</label>
          <input class="form-control" disabled value="{{ $firstDeposit ? number_format($firstDeposit->sum * 40, 2, ',', ' ') : 'Нет депозитов' }}">
      </div>

      <div class="mb-3">
          <label class="form-label">Лимит баланса</label>
          <input class="form-control" disabled value="{{ $firstDeposit ? number_format($firstDeposit->sum * 100, 2, ',', ' ') : 'Нет депозитов' }}">
      </div>

      <div class="mb-3">
          <label class="form-label">Процент комиссии</label>
          <input class="form-control" disabled value="10%">
      </div>

      <div class="mb-3">
          <label class="form-label">Сумма депозитов</label>
          <input class="form-control" disabled value="{{$user->deps}}">
      </div>

      <div class="mb-3">
          <label class="form-label">Дата регистрации</label>
          <input class="form-control" disabled value="{{date('d.m.y в H:i:s', strtotime($user->created_at))}}">
      </div>

      <div class="mb-3">
          <label class="form-label">Причина блокировки (ID)</label>
          <input class="form-control" disabled value="{{$user->ban_type_id}}">
      </div>


      <div class="row">
      <div class="col-6">
    @if(Auth::user()->admin == 1 || $user->admin != 1)
        @if($user->ban == 1)
            <button type="button" onclick="changeBan({{$user->id}})" class="btn btn-success w-100">Разблокировать</button>
        @else
            <button type="button" onclick="changeBan({{$user->id}}, 1)" class="btn btn-danger w-100">Заблокировать</button>
        @endif
    @endif
</div>

<div class="col-6">
    @if(Auth::user()->admin == 1 || $user->admin != 1)
        @if($user->frozen == 1)
            <button type="button" onclick="changeFrozen({{$user->id}})" class="btn btn-success w-100">Разморозить</button>
        @else
            <button type="button" onclick="changeFrozen({{$user->id}}, 1)" class="btn btn-warning w-100">Заморозить</button>
        @endif
    @endif
</div>

<div class="col-12">
    @if(Auth::user()->admin == 1 || $user->admin != 1)
        <button style="margin-top:10px;" type="button" onclick="resetPassword({{$user->id}})" class="btn btn-primary w-100">
            Сбросить пароль
        </button>
    @endif
</div>
    </div>

</form>
</div>
</div>
</div>
@if(Auth::user()->admin == 1)
<div class="col-xl-8">
  <form class="card">
    <div class="card-header">
      <h4 class="card-title mb-0">Финансы</h4>
      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
  </div>
  <div class="card-body">
      <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Баланс</label>
                <input class="form-control" type="text" value="{{$user->balance}}" id="balance" placeholder="Баланс">
            </div>
        </div>

    <div class="col-md-6">
      <div class="mb-3">
        <label class="form-label">Роль</label>
        <select class="form-control" id="admin" value="{{$user->admin}}"> 
            <option value="0" {{ $user->admin == 0 ? 'selected' : ''}}>Пользователь</option>     
            <option value="1" {{ $user->admin == 1 ? 'selected' : ''}}>Администратор</option>                               
            <option value="2" {{ $user->admin == 2 ? 'selected' : ''}}>Модератор</option> 
            <option value="3" {{ $user->admin == 3 ? 'selected' : ''}}>Ютубер</option> 
            <option value="4" {{ $user->admin == 4 ? 'selected' : ''}}>Партнер</option> 
            <option value="5" {{ $user->admin == 5 ? 'selected' : ''}}>Fake</option> 
        </select>
    </div>
</div>
@endif
</div>
</div>
<div class="card-footer text-end">
  <button class="btn btn-primary" onclick="saveUser({{$user->id}})" type="button">Сохранить</button>
</div>
</form>
<div class="card">
    <div class="card-header">
      <h4 class="card-title mb-0">Аккаунты</h4>
      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
  </div>
  <div class="card-body">
  <div class="table-responsive add-project">

<table class="table "  style="margin-bottom: 20px;"> 

  <thead>
      <tr>
          <th scope="col">#</th>
          <th scope="col">Email</th>
          <th scope="col">Баланс</th>
          <th scope="col">Дата регистрации</th>

      </tr>
  </thead>
  <tbody>
      @foreach($data['accounts'] as $acc)
      <tr>
          <th scope="row"><a href="/admin/user/{{$acc->id}}" target="_blank">{{$acc->id}}</a></th>
          <td>{{$acc->email}}</td>        
          <td>{{$acc->balance}}</td>     
          <td>{{date('d.m.y в H:i:s', strtotime($acc->created_at))}}</td>
       

      </tr>
      @endforeach

  </tbody>
</table>

<div style="margin-bottom: 5px;">
  {{ $data['accounts']->appends(request()->input())->links() }}
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title mb-0">Депозиты</h4>
      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
  </div>
  <div class="table-responsive add-project">

      <table class="table "  style="margin-bottom: 20px;"> 

        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ORDER ID</th>
                <th scope="col">EXTERNAL ID</th>
                <th scope="col">Сумма INR</th>
                <th scope="col">Дата</th>
                <th scope="col">Статус</th>
                <th scope="col">Метод</th>
                <th scope="col">Система</th>
                <!--<th scope="col">Действия</th>!-->

            </tr>
        </thead>
        <tbody>
        <form method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Поиск по Order ID или External ID">
        <button class="btn btn-primary" type="submit">Поиск</button>
    </div>
</form>
            @foreach($data['deps'] as $d)
            @php
            $u = \App\User::where('id', $d->user_id)->first();
            @endphp
            <tr>
                <th scope="row">{{$d->id}}</th>
                <td>{{$d->transaction}}</td>
                <td>{{ $d->external_id ?? '-' }}</td>
                                        <td>{{number_format($d->sum, 2, ',', ' ')}}</td>
                                        <td>{{$d->data}}</td>
                                        <td> @if($d->status == 0)
        <span class="badge badge-pill badge-soft-warning font-size-11">Ожидание</span>
    @elseif($d->status == 1)
        <span class="badge badge-pill badge-soft-success font-size-11">Успешно</span>
    @elseif($d->status == 2)
        <span class="badge badge-pill badge-soft-danger font-size-11">Не успешно</span>
    @else
        <span class="badge badge-pill badge-soft-secondary font-size-11">Неизвестно</span>
    @endif</td>
                                        <td><img height="20"  src="../{{$d->img_system}}"></td>
                                        <td>{{$d->ps_system_id}}</td>

            </tr>
            @endforeach

        </tbody>
    </table>

    <div style="margin-bottom: 5px;">
        {{ $data['deps']->links() }}
    </div>
</div>
</div>
</div>
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title mb-0">Выводы</h4>
      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
  </div>
  <div class="table-responsive add-project">

      <table class="table "  style="margin-bottom: 20px;"> 

        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Сумма INR</th>
                <th scope="col">Комиссия INR</th>
                <th scope="col">Метод</th>
                <th scope="col">Данные</th>
                <th scope="col">Дата</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['withdraws'] as $w)
            @php
            $u = \App\User::where('id', $w->user_id)->first();
            @endphp
            <tr>
                <th scope="row">{{$w->id}}</th>
                <th scope="row">{{$w->amount}}</th>
                <th scope="row">{{$w->amount * 0.10}}</th>
                <td><img height="20"  src="/../{{$w->system_img}}"></td>
                @php
    $details = json_decode($w->details, true);
@endphp

<td>
    @if(!empty($details))
        <div style="font-size: 10px; line-height: 1.2; display: flex; flex-wrap: wrap; gap: 5px; max-width: 700px;">
            @foreach($details as $key => $value)
                <span style="background: #f0f0f0; padding: 3px 8px; border-radius: 12px; display: inline-block; white-space: nowrap;">
                    {{ ucfirst(str_replace('_', ' ', $key)) }}: {{ $value ?? '-' }}
                </span>
            @endforeach
        </div>
    @else
        <small>Нет данных</small>
    @endif
</td>
                <td>{{date('d.m.y в H:i:s', strtotime($w->created_at))}}</td>

            </tr>
            @endforeach

        </tbody>
    </table>

    <div style="margin-bottom: 5px;">
        {{ $data['withdraws']->links() }}
    </div>
</div>
</div>
</div>

<!--<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title mb-0">История баланса</h4>
      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
  </div>
  <div class="table-responsive add-project">

      <table class="table "  style="margin-bottom: 20px;"> 

        <thead>
            <tr>
                <th scope="col">Тип</th>
                <th scope="col">Действие</th>
                <th scope="col">Баланс до</th>
                <th scope="col">Баланс после</th>
                <th scope="col">Изменение баланса</th>
                <th scope="col">Дата</th>

            </tr>
        </thead>
        <tbody>
            @foreach($data['history'] as $h)
            <tr>
                <td>{{$h->type}}</td>
                <td></td>
                <td>{{number_format($h->balance_before, 2, ',', ' ')}}</td>
                <td>{{number_format($h->balance_after, 2, ',', ' ')}}</td>
                <td>{{number_format(($h->balance_before - $h->balance_after), 2, ',', ' ')}}</td>
                <td>{{date('d.m.y в H:i:s', strtotime($h->date))}}</td>

             
            </tr>
            @endforeach

        </tbody>
    </table>

    <div style="margin-bottom: 5px;">
        {{ $data['history']->links() }}
    </div>
</div>
</div>
</div>!-->

</div>
@endsection
@section('script')

<!-- apexcharts -->
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- dashboard init -->
<script src="/assets/js/pages/dashboard.init.js?v={{time()}}"></script>
@endsection
