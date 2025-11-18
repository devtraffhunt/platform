 

<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Dashboards'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startComponent('admin.components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> UPWIN <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Настройки <?php $__env->endSlot(); ?>
<?php if (isset($__componentOriginal999d3f2766d34e8972bbdb0991849a3ad4492a55)): ?>
<?php $component = $__componentOriginal999d3f2766d34e8972bbdb0991849a3ad4492a55; ?>
<?php unset($__componentOriginal999d3f2766d34e8972bbdb0991849a3ad4492a55); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>

<?php
$setting = \App\Setting::first();
?>



<div class="row">
	
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<h3>Настройки сайта</h3>
				<div class="row">
					<div class="col-lg-3 mb-3">
						<label>Название сайта</label>
						<input type="" class="form-control" id="name" value="<?php echo e($setting->name); ?>" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Контакт саппорта</label>
						<input type="" class="form-control" id="support_contact" value="<?php echo e($setting->support_contact); ?>" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Состояние сайта</label>
						<select class="form-select" id="status_site">
                            <option value="1" <?php if($setting->status == 1): ?> selected="selected" <?php endif; ?>>Активен</option>
                            <option value="0" <?php if($setting->status == 0): ?> selected="selected" <?php endif; ?>>Технические работы</option>
                        </select>
						
					</div>
			
					<div class="col-lg">
						<label>Действие</label>
						<button onclick="saveSetting(1)" class="btn btn-info btn-block w-100">Сохранить</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<h3>Настройки платежной системы Payou</h3>
				<div class="row">
					<div class="col-lg-3 mb-3">
						<label>ID Кассы</label>
						<input type="" class="form-control" id="payou_merchant_id" value="<?php echo e($setting->payou_merchant_id); ?>" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Секретный ключ</label>
						<input type="" class="form-control" id="payou_secret" value="<?php echo e($setting->payou_secret); ?>" name="">
					</div>
					<div class="col-lg">
						<label>Действие</label>
						<button onclick="saveSetting(2)" class="btn btn-info btn-block w-100">Сохранить</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<h3>Настройки платежной системы Pear2Pay</h3>
				<div class="row">
					<div class="col-lg-3 mb-3">
						<label>API Key</label>
						<input type="" class="form-control" id="pear2pay_api" value="<?php echo e($setting->pear2pay_api); ?>" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Secret Key</label>
						<input type="" class="form-control" id="pear2pay_secret" value="<?php echo e($setting->pear2pay_secret); ?>" name="">
					</div>
					<div class="col-lg">
						<label>Действие</label>
						<button onclick="saveSetting(3)" class="btn btn-info btn-block w-100">Сохранить</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<h3>Настройки платежной системы Kassify</h3>
				<div class="row">
					<div class="col-lg-3 mb-3">
						<label>Merchant ID</label>
						<input type="" class="form-control" id="kassify_merchant_id" value="<?php echo e($setting->kassify_merchant_id); ?>" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Secret Key</label>
						<input type="" class="form-control" id="kassify_secret" value="<?php echo e($setting->kassify_secret); ?>" name="">
					</div>
					<div class="col-lg">
						<label>Действие</label>
						<button onclick="saveSetting(4)" class="btn btn-info btn-block w-100">Сохранить</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<h3>Настройки платежной системы PayHub24</h3>
				<div class="row">
					<div class="col-lg-3 mb-3">
						<label>Public Key (API)</label>
						<input type="" class="form-control" id="payhub24_public_key" value="<?php echo e($setting->payhub24_public_key); ?>" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Private Key</label>
						<input type="" class="form-control" id="payhub24_private_key" value="<?php echo e($setting->payhub24_private_key); ?>" name="">
					</div>
					<div class="col-lg">
						<label>Действие</label>
						<button onclick="saveSetting(5)" class="btn btn-info btn-block w-100">Сохранить</button>
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/product/resources/views/admin/settings.blade.php ENDPATH**/ ?>