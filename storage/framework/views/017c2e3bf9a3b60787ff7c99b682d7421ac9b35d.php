 

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
						<label>Айди группы вк</label>
						<input type="" class="form-control" id="group_id" value="<?php echo e($setting->group_id); ?>" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Токен группы вк</label>
						<input type="" class="form-control" id="group_token" value="<?php echo e($setting->group_token); ?>" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Канал тг</label>
						<input type="" class="form-control" id="tg_id" value="<?php echo e($setting->tg_id); ?>" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Бот тг</label>
						<input type="" class="form-control" id="tg_bot_id" value="<?php echo e($setting->tg_bot_id); ?>" name="">
					</div>
					<div class="col-lg-3 mb-3" >
						<label>Токен бота тг</label>
						<input type="" class="form-control" id="tg_token" value="<?php echo e($setting->tg_token); ?>" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Бонус 2</label>
						<input type="" class="form-control" id="bonus_reg" value="<?php echo e($setting->bonus_reg); ?>" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Бонус за подписку на группу ВК и ТГ</label>
						<input type="" class="form-control" id="bonus_group" value="<?php echo e($setting->bonus_group); ?>" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Максимальный вывод с бонуса</label>
						<input type="" class="form-control" id="max_withdraw_bonus" value="<?php echo e($setting->max_withdraw_bonus); ?>" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Депозит для перевода средств</label>
						<input type="" class="form-control" id="dep_transfer" value="<?php echo e($setting->dep_transfer); ?>" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Депозит для создания промокода</label>
						<input type="" class="form-control" id="dep_createpromo" value="<?php echo e($setting->dep_createpromo); ?>" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>Тема сайта</label>
						<select class="form-select" id="theme">
                            <option value="0" <?php if($setting->theme == 0): ?> selected="selected" <?php endif; ?>>Обычная</option>
                            <option value="1" <?php if($setting->theme == 1): ?> selected="selected" <?php endif; ?>>Новогодняя</option>
                        </select>
						
					</div>
					<div class="col-lg-6 mb-3">
						<label>Мета-теги</label>
						<textarea type="" class="form-control" id="meta_tags" name=""><?php echo e($setting->meta_tags); ?></textarea>
					</div>
					<div class="col-lg">
						<label>Действие</label>
						<button onclick="saveSetting(1)" class="btn btn-info btn-block w-100">Сохранить</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<h3>Настройки платежной системы FreeKassa (остальные в paymentcontroller, обязательно установить проверки после интеграции)</h3>
				<div class="row">
					<div class="col-lg-3 mb-3">
						<label>FK ID</label>
						<input type="" class="form-control" id="fk_id" value="<?php echo e($setting->fk_id); ?>" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>FK SECRET 1</label>
						<input type="" class="form-control" id="fk_secret_1" value="<?php echo e($setting->fk_secret_1); ?>" name="">
					</div>
					<div class="col-lg-3 mb-3">
						<label>FK SECRET 2</label>
						<input type="" class="form-control" id="fk_secret_2" value="<?php echo e($setting->fk_secret_2); ?>" name="">
					</div>
					<div class="col-lg">
						<label>Действие</label>
						<button onclick="saveSetting(2)" class="btn btn-info btn-block w-100">Сохранить</button>
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