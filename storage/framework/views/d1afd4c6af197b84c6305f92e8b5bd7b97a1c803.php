 

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
								<th scope="col">Пользователь</th>
								<th scope="col">Система</th>
								<th scope="col">Сумма</th>
								<th scope="col">Кошелек</th>
								<th scope="col">Дата</th>
								<?php if($data['dop'] == 0): ?>
								<th scope="col">Действия</th>
								<?php endif; ?>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $data['withdraws']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php
								$u = \App\User::where('id', $w->user_id)->first();
							?>
							<tr>
								<th scope="row"><?php echo e($w->id); ?></th>
								<td><img src="<?php echo e($u->avatar); ?>" style="width:30px;height:30px;border-radius: 100%" class="me-3"><a href="/admin/user/<?php echo e($u->id); ?>" target="_blank" <?php if($u->admin == 1): ?> class="text-danger" <?php endif; ?>><?php echo e($u->name); ?></a></td>
								<th scope="row"><?php echo e($w->ps); ?></th>
								<td><?php echo e(number_format($w->sum, 2, ',', ' ')); ?></td>
								<th scope="row"><?php echo e($w->wallet); ?></th>
								<td><?php echo e(date('d.m.y в H:i:s', strtotime($w->created_at))); ?></td>
								<?php if($data['dop'] == 0): ?>
								<th scope="col"><button onclick="changeWithdraw(<?php echo e($w->id); ?>, 1)" class="btn btn-info btn-sm me-2">Вывести</button><button onclick="changeWithdraw(<?php echo e($w->id); ?>, 2)" class="btn btn-danger btn-sm">Отменить</button></th>
								<?php endif; ?>
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
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<!-- apexcharts -->
<script src="<?php echo e(URL::asset('/assets/libs/apexcharts/apexcharts.min.js')); ?>"></script>

<!-- dashboard init -->
<script src="/assets/js/pages/dashboard.init.js?v=<?php echo e(time()); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/product/resources/views/admin/withdraws.blade.php ENDPATH**/ ?>