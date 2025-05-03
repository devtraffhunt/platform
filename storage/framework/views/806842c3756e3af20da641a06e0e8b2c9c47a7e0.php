

<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Dashboards'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startComponent('admin.components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> UPWIN <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Депозиты <?php $__env->endSlot(); ?>
<?php if (isset($__componentOriginal999d3f2766d34e8972bbdb0991849a3ad4492a55)): ?>
<?php $component = $__componentOriginal999d3f2766d34e8972bbdb0991849a3ad4492a55; ?>
<?php unset($__componentOriginal999d3f2766d34e8972bbdb0991849a3ad4492a55); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>



<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<!-- Форма поиска -->
				<form method="GET" action="" style="margin-bottom: 20px;">
					<div class="row">
						<div class="col-md-4">
							<input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control" placeholder="Поиск по ORDER ID, EXTERNAL ID или USER ID">
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
							<?php $__currentLoopData = $data['deps']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php
								$u = \App\User::where('id', $d->user_id)->first();
							?>
							<tr>
							<td><a href="javascript: void(0);" class="text-body fw-bold">#<?php echo e($d->id); ?></a> </td>
                                        <td><a href="/admin/user/<?php echo e($d->user_id); ?>" class="text-body fw-bold">#<?php echo e($d->user_id); ?></a> </td>
                                        <td><?php echo e($d->transaction); ?></td>
                                        <td><?php echo e($d->external_id ?? '-'); ?></td>
                                        <td><?php echo e(number_format($d->sum, 2, ',', ' ')); ?></td>
                                        <td><?php echo e($d->data); ?></td>
                                        <td>
    <?php if($d->status == 0): ?>
        <span class="badge badge-pill badge-soft-warning font-size-11">Ожидание</span>
    <?php elseif($d->status == 1): ?>
        <span class="badge badge-pill badge-soft-success font-size-11">Успешно</span>
    <?php elseif($d->status == 2): ?>
        <span class="badge badge-pill badge-soft-danger font-size-11">Не успешно</span>
    <?php else: ?>
        <span class="badge badge-pill badge-soft-secondary font-size-11">Неизвестно</span>
    <?php endif; ?>
</td>
                                        <td><img height="20" src="/<?php echo e($d->img_system); ?>"></td>
                                        <td><?php echo e($d->ps_system_id); ?></td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						</tbody>
					</table>

					<div style="margin-bottom: 5px;">
					<?php echo e($data['deps']->appends(request()->input())->links()); ?>

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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/product/resources/views/admin/deps.blade.php ENDPATH**/ ?>