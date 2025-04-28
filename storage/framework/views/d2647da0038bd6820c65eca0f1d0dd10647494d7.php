<?php
$users = \App\User::paginate(15);
?>



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


<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">

        <div class="table-responsive">
          <table class="table "  style="margin-bottom: 20px;"> 

            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">IP</th>
                <th scope="col">Баланс</th>
                <th scope="col">Депозитов</th>
                <th scope="col">Выводов</th>
                <th scope="col">Рефералов</th>
                <th scope="col">Дата регистрации</th>
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
            <td><img src="<?php echo e($u->avatar); ?>" style="width:30px;height:30px;border-radius: 100%" class="me-3"><a href="user/<?php echo e($u->id); ?>" target="_blank" <?php if($u->admin == 1): ?> class="text-danger" <?php endif; ?>><?php echo e($u->name); ?></a></td>
            <td><?php echo e($u->ip); ?></td>
            <td><?php echo e(number_format($u->balance, 2, ',', ' ')); ?></td>
            <td><?php echo e(number_format($deps, 2, ',', ' ')); ?></td>
            <td><?php echo e(number_format($withdraws, 2, ',', ' ')); ?></td>
            <td><?php echo e($u->refs); ?></td>
            <td><?php echo e(date('d.m.y в H:i:s', strtotime($u->created_at))); ?></td>
            <td id="btns_bun_id_<?php echo e($u->id); ?>"><a href="user/<?php echo e($u->id); ?>" class="btn btn-primary btn-sm me-2">Перейти</a><?php if($u->ban == 1): ?><button onclick="changeBan(<?php echo e($u->id); ?>, 0)" class="btn btn-success btn-sm ">Разблокировать</button><?php else: ?><button onclick="changeBan(<?php echo e($u->id); ?>, 1)" class="btn btn-danger btn-sm">Заблокировать</button><?php endif; ?></td>
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