

<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Dashboards'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startComponent('admin.components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> UPWIN <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Пользователь <?php $__env->endSlot(); ?>
<?php if (isset($__componentOriginal999d3f2766d34e8972bbdb0991849a3ad4492a55)): ?>
<?php $component = $__componentOriginal999d3f2766d34e8972bbdb0991849a3ad4492a55; ?>
<?php unset($__componentOriginal999d3f2766d34e8972bbdb0991849a3ad4492a55); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>

<?php
$user = $data['user'];
?>

<?php
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

?>

<div class="row">
    <div class="col-xl-4">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title mb-0">Аккаунт #<?php echo e($user->id); ?></h4>
          <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
      </div>
      <div class="card-body">
          <form>
            <div class="row mb-2">
              <div class="profile-title">
                <div class="media" style="align-items: center;">      
                    <div><img class="img-70 rounded-circle" style="width: 100px;height: 100px;" alt="" src="<?php echo e($user->avatar); ?>"></div>                  

                    <div class="media-body ms-3">
                        <h5 class="mb-1"><?php echo e($user->email); ?> </h5>
                        <h5 class="mb-1"><?php echo e($user->phone); ?> </h5>
                        <p><?php if($user->admin == 1): ?> Администратор <?php else: ?> Пользователь <?php endif; ?>  <?php if($u->ban == 0 && $u->frozen == 0): ?>
        <span class="badge badge-pill badge-soft-success font-size-11">Активный</span>
    <?php elseif($u->ban == 0 && $u->frozen == 1): ?>
        <span class="badge badge-pill badge-soft-warning font-size-11">Заморожен</span>
    <?php elseif($u->ban == 1): ?>
        <span class="badge badge-pill badge-soft-danger font-size-11">Забанен</span>
    <?php else: ?>
        <span class="badge badge-pill badge-soft-secondary font-size-11">Неизвестный статус</span>
    <?php endif; ?></p> <div>
    <?php if(isset($countryData['country_code']) && isset($countryData['country_name'])): ?>
    <img src="https://flagcdn.com/48x36/<?php echo e(strtolower($countryData['country_code'])); ?>.png" style="width: 24px; height: 18px; vertical-align: middle;">
    <span><?php echo e($countryData['country_name']); ?></span>
<?php else: ?>
    <span>Страна не определена</span>
<?php endif; ?>
  </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Баланс</label>
            <input class="form-control" disabled id="balance_2" value="<?php echo e(number_format($user->balance, 2, ',', ' ')); ?>">
        </div>
      <div class="mb-3">
      <label class="form-label">IP Регистрации </label>
  <input class="form-control" disabled value="<?php echo e($user->ip); ?>">
</div>


      <div class="mb-3">
          <label class="form-label">External ID</label>
          <input class="form-control" disabled value="<?php echo e($user->external_id); ?>">
      </div>

      <div class="mb-3">
          <label class="form-label">Сумма первого депозита</label>
          <input class="form-control" disabled value="<?php echo e($firstDeposit ? number_format($firstDeposit->sum, 2, ',', ' ') : 'Нет депозитов'); ?>">
      </div>

      <div class="mb-3">
          <label class="form-label">Дата первого депозита</label>
          <input class="form-control" disabled value="<?php echo e($firstDeposit ? date('d.m.y в H:i:s', strtotime($firstDeposit->created_at)) : 'Нет депозитов'); ?>">
      </div>

      <div class="mb-3">
          <label class="form-label">Минимальная сумма вывода</label>
          <input class="form-control" disabled value="<?php echo e($firstDeposit ? number_format($firstDeposit->sum * 40, 2, ',', ' ') : 'Нет депозитов'); ?>">
      </div>

      <div class="mb-3">
          <label class="form-label">Лимит баланса</label>
          <input class="form-control" disabled value="<?php echo e($firstDeposit ? number_format($firstDeposit->sum * 100, 2, ',', ' ') : 'Нет депозитов'); ?>">
      </div>

      <div class="mb-3">
          <label class="form-label">Процент комиссии</label>
          <input class="form-control" disabled value="10%">
      </div>

      <div class="mb-3">
          <label class="form-label">Сумма депозитов</label>
          <input class="form-control" disabled value="<?php echo e($user->deps); ?>">
      </div>

      <div class="mb-3">
          <label class="form-label">Дата регистрации</label>
          <input class="form-control" disabled value="<?php echo e(date('d.m.y в H:i:s', strtotime($user->created_at))); ?>">
      </div>

      <div class="mb-3">
          <label class="form-label">Причина блокировки (ID)</label>
          <input class="form-control" disabled value="<?php echo e($user->ban_type_id); ?>">
      </div>


      <div class="row">
      <div class="col-6">
    <?php if(Auth::user()->admin == 1 || $user->admin != 1): ?>
        <?php if($user->ban == 1): ?>
            <button type="button" onclick="changeBan(<?php echo e($user->id); ?>)" class="btn btn-success w-100">Разблокировать</button>
        <?php else: ?>
            <button type="button" onclick="changeBan(<?php echo e($user->id); ?>, 1)" class="btn btn-danger w-100">Заблокировать</button>
        <?php endif; ?>
    <?php endif; ?>
</div>

<div class="col-6">
    <?php if(Auth::user()->admin == 1 || $user->admin != 1): ?>
        <?php if($user->frozen == 1): ?>
            <button type="button" onclick="changeFrozen(<?php echo e($user->id); ?>)" class="btn btn-success w-100">Разморозить</button>
        <?php else: ?>
            <button type="button" onclick="changeFrozen(<?php echo e($user->id); ?>, 1)" class="btn btn-warning w-100">Заморозить</button>
        <?php endif; ?>
    <?php endif; ?>
</div>

<div class="col-12">
    <?php if(Auth::user()->admin == 1 || $user->admin != 1): ?>
        <button style="margin-top:10px;" type="button" onclick="resetPassword(<?php echo e($user->id); ?>)" class="btn btn-primary w-100">
            Сбросить пароль
        </button>
    <?php endif; ?>
</div>
    </div>

</form>
</div>
</div>
</div>
<?php if(Auth::user()->admin == 1): ?>
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
                <input class="form-control" type="text" value="<?php echo e($user->balance); ?>" id="balance" placeholder="Баланс">
            </div>
        </div>

    <div class="col-md-6">
      <div class="mb-3">
        <label class="form-label">Роль</label>
        <select class="form-control" id="admin" value="<?php echo e($user->admin); ?>"> 
            <option value="0" <?php echo e($user->admin == 0 ? 'selected' : ''); ?>>Пользователь</option>     
            <option value="1" <?php echo e($user->admin == 1 ? 'selected' : ''); ?>>Администратор</option>                               
            <option value="2" <?php echo e($user->admin == 2 ? 'selected' : ''); ?>>Модератор</option> 
            <option value="3" <?php echo e($user->admin == 3 ? 'selected' : ''); ?>>Ютубер</option> 
            <option value="4" <?php echo e($user->admin == 4 ? 'selected' : ''); ?>>Партнер</option> 
            <option value="5" <?php echo e($user->admin == 5 ? 'selected' : ''); ?>>Fake</option> 
        </select>
    </div>
</div>
<?php endif; ?>
</div>
</div>
<div class="card-footer text-end">
  <button class="btn btn-primary" onclick="saveUser(<?php echo e($user->id); ?>)" type="button">Сохранить</button>
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
      <?php $__currentLoopData = $data['accounts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
          <th scope="row"><a href="/admin/user/<?php echo e($acc->id); ?>" target="_blank"><?php echo e($acc->id); ?></a></th>
          <td><?php echo e($acc->email); ?></td>        
          <td><?php echo e($acc->balance); ?></td>     
          <td><?php echo e(date('d.m.y в H:i:s', strtotime($acc->created_at))); ?></td>
       

      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  </tbody>
</table>

<div style="margin-bottom: 5px;">
  <?php echo e($data['accounts']->appends(request()->input())->links()); ?>

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
        <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control" placeholder="Поиск по Order ID или External ID">
        <button class="btn btn-primary" type="submit">Поиск</button>
    </div>
</form>
            <?php $__currentLoopData = $data['deps']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            $u = \App\User::where('id', $d->user_id)->first();
            ?>
            <tr>
                <th scope="row"><?php echo e($d->id); ?></th>
                <td><?php echo e($d->transaction); ?></td>
                <td><?php echo e($d->external_id ?? '-'); ?></td>
                                        <td><?php echo e(number_format($d->sum, 2, ',', ' ')); ?></td>
                                        <td><?php echo e($d->data); ?></td>
                                        <td> <?php if($d->status == 0): ?>
        <span class="badge badge-pill badge-soft-warning font-size-11">Ожидание</span>
    <?php elseif($d->status == 1): ?>
        <span class="badge badge-pill badge-soft-success font-size-11">Успешно</span>
    <?php elseif($d->status == 2): ?>
        <span class="badge badge-pill badge-soft-danger font-size-11">Не успешно</span>
    <?php else: ?>
        <span class="badge badge-pill badge-soft-secondary font-size-11">Неизвестно</span>
    <?php endif; ?></td>
                                        <td><img height="20"  src="../<?php echo e($d->img_system); ?>"></td>
                                        <td><?php echo e($d->ps_system_id); ?></td>

            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
    </table>

    <div style="margin-bottom: 5px;">
        <?php echo e($data['deps']->links()); ?>

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
            <?php $__currentLoopData = $data['withdraws']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            $u = \App\User::where('id', $w->user_id)->first();
            ?>
            <tr>
                <th scope="row"><?php echo e($w->id); ?></th>
                <th scope="row"><?php echo e($w->amount); ?></th>
                <th scope="row"><?php echo e($w->amount * 0.10); ?></th>
                <td><img height="20"  src="/../<?php echo e($w->system_img); ?>"></td>
                <?php
    $details = json_decode($w->details, true);
?>

<td>
    <?php if(!empty($details)): ?>
        <div style="font-size: 10px; line-height: 1.2; display: flex; flex-wrap: wrap; gap: 5px; max-width: 700px;">
            <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span style="background: #f0f0f0; padding: 3px 8px; border-radius: 12px; display: inline-block; white-space: nowrap;">
                    <?php echo e(ucfirst(str_replace('_', ' ', $key))); ?>: <?php echo e($value ?? '-'); ?>

                </span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <small>Нет данных</small>
    <?php endif; ?>
</td>
                <td><?php echo e(date('d.m.y в H:i:s', strtotime($w->created_at))); ?></td>

            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
    </table>

    <div style="margin-bottom: 5px;">
        <?php echo e($data['withdraws']->links()); ?>

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
            <?php $__currentLoopData = $data['history']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($h->type); ?></td>
                <td></td>
                <td><?php echo e(number_format($h->balance_before, 2, ',', ' ')); ?></td>
                <td><?php echo e(number_format($h->balance_after, 2, ',', ' ')); ?></td>
                <td><?php echo e(number_format(($h->balance_before - $h->balance_after), 2, ',', ' ')); ?></td>
                <td><?php echo e(date('d.m.y в H:i:s', strtotime($h->date))); ?></td>

             
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
    </table>

    <div style="margin-bottom: 5px;">
        <?php echo e($data['history']->links()); ?>

    </div>
</div>
</div>
</div>!-->

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<!-- apexcharts -->
<script src="<?php echo e(URL::asset('/assets/libs/apexcharts/apexcharts.min.js')); ?>"></script>

<!-- dashboard init -->
<script src="/assets/js/pages/dashboard.init.js?v=<?php echo e(time()); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/product/resources/views/admin/user.blade.php ENDPATH**/ ?>