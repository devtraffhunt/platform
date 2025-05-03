<?php
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
?>



<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Dashboards'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startComponent('admin.components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> UPWIN <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Пользователи <?php $__env->endSlot(); ?>
<?php if (isset($__componentOriginal999d3f2766d34e8972bbdb0991849a3ad4492a55)): ?>
<?php $component = $__componentOriginal999d3f2766d34e8972bbdb0991849a3ad4492a55; ?>
<?php unset($__componentOriginal999d3f2766d34e8972bbdb0991849a3ad4492a55); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>


<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
      <form method="GET" action="" class="mb-4">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control" placeholder="Поиск по ID, External ID, email ">
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
          <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
          $deps = \App\Payment::where('user_id', $u->id)->where('status', 1)->sum('sum');
          $withdraws = \App\Withdraw::where('user_id', $u->id)->where('status', 1)->sum('sum');
          ?>
          <tr>
            <th scope="row"><?php echo e($u->id); ?></th>
            <td><?php echo e($u->external_id ?? '-'); ?></td>
            <td><?php echo e($u->ip); ?></td>
            <td><?php echo e(number_format($u->balance, 2, ',', ' ')); ?></td>
            <td><?php echo e(number_format($deps, 2, ',', ' ')); ?></td>
            <td><?php echo e(date('d.m.y в H:i:s', strtotime($u->created_at))); ?></td>
            <td>
    <?php if($u->ban == 0 && $u->frozen == 0): ?>
        <span class="badge badge-pill badge-soft-success font-size-11">Активный</span>
    <?php elseif($u->ban == 0 && $u->frozen == 1): ?>
        <span class="badge badge-pill badge-soft-warning font-size-11">Заморожен</span>
    <?php elseif($u->ban == 1): ?>
        <span class="badge badge-pill badge-soft-danger font-size-11">Забанен</span>
    <?php else: ?>
        <span class="badge badge-pill badge-soft-secondary font-size-11">Неизвестный статус</span>
    <?php endif; ?>
</td>
            <td id="btns_bun_id_<?php echo e($u->id); ?>"><a href="user/<?php echo e($u->id); ?>" class="btn btn-primary btn-sm me-2">Перейти</a></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>
</table>

<div style="margin-bottom: 5px;">
    <?php echo e($users->links()); ?>

</div>

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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/product/resources/views/admin/users.blade.php ENDPATH**/ ?>