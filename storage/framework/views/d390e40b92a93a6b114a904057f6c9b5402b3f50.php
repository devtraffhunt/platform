 

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
                    <div class="col-lg-2 mb-2">
                        <label>Название</label>
                        <input type="" id="name" class="form-control" name="">
                    </div>
                    <div class="col-lg-2 mb-2">
                        <label>Мин. сумма</label>
                        <input type="" id="min_sum" class="form-control" name="">
                    </div>
                    <div class="col-lg-2 mb-2">
                        <label>Комиссия</label>
                        <input type="" id="comm_percent" class="form-control" name="">
                    </div>
                    <div class="col-lg-2 mb-2">
                        <label>Изображение</label>
                        <input type="" id="img" class="form-control" name="">
                    </div>
                    <div class="col-lg-2 mb-2">
                        <label>Цвет</label>
                        <input type="color" class="form-control form-control-color" id="color" style="width:100%;max-width:100%" name="">
                    </div>
                    <div class="col-lg-2 mb-2">
                        <label>Cистема</label>
                        <select id="ps" class="form-select">
                            <option value="7">PayYou (MoneyINR_Phub)</option>
                            <option value="8">Kassify</option>
                            <option value="9">Pear2Pay</option>
                            <option value="10">PayYou (ala_MoneyINR)</option>
                            <option value="11">PayHub24</option>
                            
                        </select>
                    </div>
                    <div class="col-lg-2 mb-2">
                        <label>Номер системы</label>
                        <input type="" id="number_ps" class="form-control" name="">
                    </div>
                    <div class="col-lg-2 mb-2">
                        <label>Действие</label>
                        <button onclick="addSystemDeposit()" class="btn btn-info btn-block w-100">Добавить</button>
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
                                <th scope="col">Комиссия</th>
                                <th scope="col">Изображение</th>
                                <th scope="col">Цвет</th>
                                <th scope="col">Cистема</th>
                                <th scope="col">Номер системы</th>
                                <th scope="col">Статус</th>
                                <th scope="col">Сорт</th>
                                <th scope="col">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data['systems_deposit']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <tr id="systemDeposit_<?php echo e($s->id); ?>" class="systemSort_<?php echo e($s->sort); ?>">
                                <th><input type="" class="form-control systemDeposit_name" name="" value="<?php echo e($s->name); ?>"></th>
                                <th><input type="" class="form-control systemDeposit_min_sum" name="" value="<?php echo e($s->min_sum); ?>"></th>
                                <th><input type="" class="form-control systemDeposit_comm_percent" name="" value="<?php echo e($s->comm_percent); ?>"></th>
                                <th style="display: flex;"><input type="" class="form-control systemDeposit_img" name="" value="<?php echo e($s->img); ?>"> <img src="<?php echo e($s->img); ?>" style="height:30px;" class="ms-3"></th>
                                <th><input type="color" class="form-control form-control-color systemDeposit_color" name="" value="<?php echo e($s->color); ?>"></th>
                                <th>
                                    <select class="form-select systemDeposit_ps">
                                        <option value="7" <?php if($s->ps == 7): ?> selected="selected" <?php endif; ?>>PayYou (MoneyINR_Phub)</option>
                                        <option value="8" <?php if($s->ps == 8): ?> selected="selected" <?php endif; ?>>Kassify</option>
                                        <option value="9" <?php if($s->ps == 9): ?> selected="selected" <?php endif; ?>>Pear2Pay</option>
                                        <option value="10" <?php if($s->ps == 10): ?> selected="selected" <?php endif; ?>>PayYou (ala_MoneyINR)</option>
                                        <option value="11" <?php if($s->ps == 11): ?> selected="selected" <?php endif; ?>>PayHub24</option>
                                    </select>
                                </th>
                                <th ><input type="" class="form-control systemDeposit_number_ps" name="" value="<?php echo e($s->number_ps); ?>"></th>
                                <th style="width:100px">
                                    <select class="form-select systemDeposit_off">
                                        <option value="0" <?php if($s->off == 0): ?> selected="selected" <?php endif; ?>>On</option>
                                        <option value="1" <?php if($s->off == 1): ?> selected="selected" <?php endif; ?>>Off</option>
                                    </select>
                                </th>
                                <th style="width:100px">
                                    <input type="" class="form-control systemDeposit_sort" name="" value="<?php echo e($s->sort); ?>">
                                </th>
                                
                                <th scope="col"><button onclick="saveSystemDeposit(<?php echo e($s->id); ?>)" class="btn btn-info btn-sm me-2 mb-2">Сохранить</button><button onclick="deleteSystemDeposit(<?php echo e($s->id); ?>)" class="btn btn-danger btn-sm">Удалить</button></th>
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

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/product/resources/views/admin/systems_deposit.blade.php ENDPATH**/ ?>