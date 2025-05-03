 

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
				<div class="row">
					<div class="col-lg-3">
						<label>Название промокода</label>
						<input type="" id="name_promo" class="form-control" name="">
					</div>
					<div class="col-lg-3">
						<label>Сумма</label>
						<input type="" id="sum_promo" class="form-control" name="">
					</div>
					<div class="col-lg-3">
						<label>Активаций</label>
						<input type="" id="active_promo" class="form-control" name="">
					</div>
					<div class="col-lg-3">
						<label>Дейсвтие</label>
						<button onclick="createPromo()" class="btn btn-info btn-block w-100">Создать промокод</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">

				<div class="table-responsive">
					<table class="table "  style="margin-bottom: 20px;"> 

						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Создатель</th>
								<th scope="col">Название</th>
								<th scope="col">Сумма</th>
								<th scope="col">Активаций</th>
								<th scope="col">Дата</th>
								<th scope="col">Действия</th>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $data['promo']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php
								$active = \Cache::get('promo.name.'.$p->name.'.active');
						        $actived = \Cache::get('promo.name.'.$p->name.'.active.count');
						        $sum = \Cache::get('promo.name.'.$p->name.'.sum');
							?>
							<tr>
								<th scope="row"><?php echo e($p->id); ?></th>
								<td><?php echo e($p->user_name); ?></td>
								<th scope="row"><?php echo e($p->name); ?></th>
								<td><?php echo e(number_format($sum, 2, ',', ' ')); ?></td>
								<th scope="row"><?php echo e($actived); ?> / <?php echo e($active); ?></th>
								<td><?php echo e(date('d.m.y в H:i:s', strtotime($p->created_at))); ?></td>
								<th scope="col"><button onclick="deletePromo(<?php echo e($p->id); ?>)" class="btn btn-danger btn-sm">Удалить</button></th>
								
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						</tbody>
					</table>

					<div style="margin-bottom: 5px;">
						<?php echo e($data['promo']->links()); ?>

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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/product/resources/views/admin/promo.blade.php ENDPATH**/ ?>