

<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Dashboards'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startComponent('admin.components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> Dashboards <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Dashboard <?php $__env->endSlot(); ?>
<?php if (isset($__componentOriginal999d3f2766d34e8972bbdb0991849a3ad4492a55)): ?>
<?php $component = $__componentOriginal999d3f2766d34e8972bbdb0991849a3ad4492a55; ?>
<?php unset($__componentOriginal999d3f2766d34e8972bbdb0991849a3ad4492a55); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>

<?php
$user = $data['user'];
?>
<div class="row">
    <div class="col-xl-4">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title mb-0">Profile №<?php echo e($user->id); ?></h4>
          <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
      </div>
      <div class="card-body">
          <form>
            <div class="row mb-2">
              <div class="profile-title">
                <div class="media" style="align-items: center;">      
                    <div><img class="img-70 rounded-circle" style="width: 100px;height: 100px;" alt="" src="<?php echo e($user->avatar); ?>"></div>                  

                    <div class="media-body ms-3">
                        <h5 class="mb-1"><?php echo e($user->name ?? $user->email); ?></h5>
                        <p><?php if($user->admin == 1): ?> Администратор <?php else: ?> Пользователь <?php endif; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Баланс</label>
            <input class="form-control" disabled id="balance_2" value="<?php echo e(number_format($user->balance, 2, ',', ' ')); ?>">
        </div>
      <div class="mb-3">
          <label class="form-label">IP</label>
          <input class="form-control" disabled value="<?php echo e($user->ip); ?>">
      </div>

      <div class="mb-3">
          <label class="form-label">ВК</label>
          <input class="form-control" disabled value="<?php echo e($user->social); ?>">
      </div>
      <div class="mb-3">
          <label class="form-label">Статус</label>
          <input class="form-control" disabled value="<?php echo e($user->status == 0 ? 'Новичек' : ($user->status == 1 ? 'Волк' : ($user->status == 2 ? 'Хищник' : ($user->status == 3 ? 'Премиум' : ($user->status == 4 ? 'Альфа' : ($user->status == 5 ? 'Вип' : ($user->status == 6 ? 'Профи' : 'Легенда'))))))); ?>">
      </div>
      <div class="mb-3">
          <label class="form-label">WAGER</label>
          <input class="form-control" disabled value="<?php echo e($user->sum_to_withdraw); ?>">
      </div>

      <div class="mb-3">
          <label class="form-label">Рефералов</label>
          <input class="form-control" disabled value="<?php echo e($user->refs); ?>">
      </div>

      <div class="mb-3">
          <label class="form-label">Реферал</label>
          <input class="form-control" disabled value="<?php echo e($user->ref_id); ?>">
      </div>

      <div class="mb-3">
          <label class="form-label">Баланс реф</label>
          <input class="form-control" disabled value="<?php echo e($user->balance_ref); ?>">
      </div>
      <div class="mb-3">
          <label class="form-label">Cashback balance</label>
          <input class="form-control" disabled value="<?php echo e($user->cashback); ?>">
      </div>
      <div class="mb-3">
          <label class="form-label">Пополнено</label>
          <input class="form-control" disabled value="<?php echo e($user->deps); ?>">
      </div>

      <div class="mb-3">
          <label class="form-label">Выведено</label>
          <input class="form-control" disabled value="<?php echo e($user->withdraws); ?>">
      </div>

      <div class="mb-3">
          <label class="form-label">Дата регистрации</label>
          <input class="form-control" disabled value="<?php echo e(date('d.m.y в H:i:s', strtotime($user->created_at))); ?>">
      </div>


      <div class="row">
        <div class="col-6">
            <?php if($user->ban == 1): ?><button type="button" onclick="changeBan(<?php echo e($user->id); ?>, 0)" class="btn btn-success w-100">Разблокировать</button><?php else: ?><button type="button" onclick="changeBan(<?php echo e($user->id); ?>, 1)" class="btn btn-danger w-100">Заблокировать</button><?php endif; ?>
        </div>
        <div class="col-6"><button class="btn btn-danger w-100" type="button" onclick="deleteUser(<?php echo e($user->id); ?>)">Удалить аккаунт</button></div>
    </div>

</form>
</div>
</div>
</div>
<div class="col-xl-8">
  <form class="card">
    <div class="card-header">
      <h4 class="card-title mb-0">Edit Profile</h4>
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
                <label class="form-label">Демо баланс</label>
                <input class="form-control" type="text" value="<?php echo e($user->demo_balance); ?>" id="demo_balance" placeholder="Баланс">
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
          <th scope="col">Пользователь</th>
          <th scope="col">Дата регистрации</th>
          <th scope="col">Действия</th>

      </tr>
  </thead>
  <tbody>
      <?php $__currentLoopData = $data['accounts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
          <th scope="row"><?php echo e($acc->id); ?></th>
          <td><img src="<?php echo e($acc->avatar); ?>" style="width:30px;height:30px;border-radius: 100%" class="me-3"><a href="/admin/user/<?php echo e($acc->id); ?>" target="_blank" <?php if($acc->admin == 1): ?> class="text-danger" <?php endif; ?>><?php echo e($acc->name); ?></a></td>         
          <td><?php echo e(date('d.m.y в H:i:s', strtotime($acc->created_at))); ?></td>
          <th scope="col"><?php if($acc->ban == 0): ?><button onclick="changeBan(<?php echo e($acc->id); ?>, 1)" class="btn btn-info btn-sm">Заблокировать</button> <?php else: ?><button onclick="changeBan(<?php echo e($acc->id); ?>, 0)" class="btn btn-info btn-sm">Разблокировать</button> <?php endif; ?></th>

      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  </tbody>
</table>

<div style="margin-bottom: 5px;">
  <?php echo e($data['accounts']->links()); ?>

</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-6">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title mb-0">Пополнения</h4>
      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
  </div>
  <div class="table-responsive add-project">

      <table class="table "  style="margin-bottom: 20px;"> 

        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Пользователь</th>
                <th scope="col">Система</th>
                <th scope="col">Сумма</th>
                
                <th scope="col">Дата</th>

                <th scope="col">Действия</th>

            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $data['deps']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            $u = \App\User::where('id', $d->user_id)->first();
            ?>
            <tr>
                <th scope="row"><?php echo e($d->id); ?></th>
                <td><img src="<?php echo e($u->avatar); ?>" style="width:30px;height:30px;border-radius: 100%" class="me-3"><a href="<?php echo e($u->social); ?>" target="_blank" <?php if($u->admin == 1): ?> class="text-danger" <?php endif; ?>><?php echo e($u->name); ?></a></td>
                <td><img src="../<?php echo e($d->img_system); ?>" style="width: 30px;"></td>
                <td><?php echo e(number_format($d->sum, 2, ',', ' ')); ?></td>
                
                <td><?php echo e(date('d.m.y в H:i:s', strtotime($d->created_at))); ?></td>

                <th scope="col"><?php if($d['status'] == 0): ?><button onclick="changePay(<?php echo e($d->id); ?>)" class="btn btn-info btn-sm">Зачислить депозит</button><?php endif; ?></th>

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
<div class="col-md-6">
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
                <th scope="col">Пользователь</th>
                <th scope="col">Система</th>
                <th scope="col">Сумма</th>
                <th scope="col">Кошелек</th>
                <th scope="col">Дата</th>
                <th scope="col">Действия</th>

            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $data['withdraws']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            $u = \App\User::where('id', $w->user_id)->first();
            ?>
            <tr>
                <th scope="row"><?php echo e($w->id); ?></th>
                <td><img src="<?php echo e($u->avatar); ?>" style="width:30px;height:30px;border-radius: 100%" class="me-3"><a href="<?php echo e($u->social); ?>" target="_blank" <?php if($u->admin == 1): ?> class="text-danger" <?php endif; ?>><?php echo e($u->name); ?></a></td>
                <th scope="row"><?php echo e($w->ps); ?></th>
                <td><?php echo e(number_format($w->sum, 2, ',', ' ')); ?></td>
                <th scope="row"><?php echo e($w->wallet); ?></th>
                <td><?php echo e(date('d.m.y в H:i:s', strtotime($w->created_at))); ?></td>

                <th scope="col"><?php if($w['status'] == 0): ?><button onclick="changeWithdraw(<?php echo e($w->id); ?>, 1)" class="btn btn-info btn-sm">Вывести</button><?php endif; ?></th>

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

<div class="col-md-12">
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
</div>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<!-- apexcharts -->
<script src="<?php echo e(URL::asset('/assets/libs/apexcharts/apexcharts.min.js')); ?>"></script>

<!-- dashboard init -->
<script src="/assets/js/pages/dashboard.init.js?v=<?php echo e(time()); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/product/resources/views/admin/user.blade.php ENDPATH**/ ?>