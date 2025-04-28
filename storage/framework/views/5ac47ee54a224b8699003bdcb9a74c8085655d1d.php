 

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
                    <div class="col-lg mb-2">
                        <label>Название</label>
                        <input type="" id="name" class="form-control" name="">
                    </div>
                    <div class="col-lg mb-2">
                        <label>Мин. сумма</label>
                        <input type="" id="min_sum" class="form-control" name="">
                    </div>
                    <div class="col-lg mb-2">
                        <label>Пример реквов цифрами</label>
                        <input readonly type="" id="example" class="form-control" name="">
                    </div>                    
                    <div class="col-lg mb-2">
                        <label>Комиссия %</label>
                        <input type="" id="comm_percent" class="form-control" name="">
                    </div>
                    <div class="col-lg mb-2">
                        <label>Комиссия руб</label>
                        <input type="" id="comm_rub" class="form-control" name="">
                    </div>
                    <div class="col-lg mb-2">
                        <label>Изображение</label>
                        <input type="" id="img" class="form-control" name="">
                    </div>
                    <div class="col-lg mb-2">
                        <label>Цвет</label>
                        <input type="color" class="form-control form-control-color" id="color" style="width:100%;max-width:100%" name="">
                    </div>
                    
                    <div class="col-lg mb-2">
                        <label>Действие</label>
                        <button onclick="addSystemWithdraw()" class="btn btn-info btn-block w-100">Добавить</button>
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
                                <th scope="col">Название</th>
                                <th scope="col">Мин. сумма</th>
                                <th scope="col">Пример реквизитов (цифрами)</th>                               
                                <th scope="col">Комиссия %</th>
                                <th scope="col">Комиссия руб</th>
                                <th scope="col">Изображение</th>
                                <th scope="col">Цвет</th>
                                <th scope="col">Статус</th>
                                <th scope="col">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data['systems_withdraw']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <tr id="systemWithdraw_<?php echo e($s->id); ?>">
                                <th><input type="" class="form-control systemWithdraw_name" name="" value="<?php echo e($s->name); ?>"></th>
                                <th><input type="" class="form-control systemWithdraw_min_sum" name="" value="<?php echo e($s->min_sum); ?>"></th>
                                <th><input readonly type="" class="form-control systemWithdraw_example" name="" value="<?php echo e($s->example); ?>"></th>
                                <th><input type="" class="form-control systemWithdraw_comm_percent" name="" value="<?php echo e($s->comm_percent); ?>"></th>
                                <th><input type="" class="form-control systemWithdraw_comm_rub" name="" value="<?php echo e($s->comm_rub); ?>"></th>
                                <th style="display: flex;"><input type="" class="form-control systemWithdraw_img" name="" value="<?php echo e($s->img); ?>"> <img src="<?php echo e($s->img); ?>" style="height:30px;" class="ms-3"></th>
                                <th><input type="color" class="form-control form-control-color systemWithdraw_color" name="" value="<?php echo e($s->color); ?>"></th>
                                
                                
                                <th style="width:100px">
                                    <select class="form-select systemWithdraw_off">
                                        <option value="0" <?php if($s->off == 0): ?> selected="selected" <?php endif; ?>>On</option>
                                        <option value="1" <?php if($s->off == 1): ?> selected="selected" <?php endif; ?>>Off</option>
                                    </select>
                                </th>
                                
                                <th scope="col"><button onclick="saveSystemWithdraw(<?php echo e($s->id); ?>)" class="btn btn-info btn-sm me-2 mb-2">Сохранить</button><button onclick="deleteSystemWithdraw(<?php echo e($s->id); ?>)" class="btn btn-danger btn-sm">Удалить</button></th>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>                   

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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/product/resources/views/admin/systems_withdraw.blade.php ENDPATH**/ ?>