<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Dashboards'); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startComponent('admin.components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> UPWIN <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Касса <?php $__env->endSlot(); ?>
<?php if (isset($__componentOriginal999d3f2766d34e8972bbdb0991849a3ad4492a55)): ?>
<?php $component = $__componentOriginal999d3f2766d34e8972bbdb0991849a3ad4492a55; ?>
<?php unset($__componentOriginal999d3f2766d34e8972bbdb0991849a3ad4492a55); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>

<?php
    $paymentsSystems = \App\PaymentsSystems::orderBy('id')->get();
?>


<div class="row">
    <div class="col-xl-4">
        <div class="card">

            <div class="card-body border-top">

                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <p class="text-muted mb-2">Текущий баланс</p>
                            <h5>99000148.23 INR</h5>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end mt-4 mt-sm-0">
                            <p class="text-muted mb-2">Since last month</p>
                            <h5>+ $ 248.35 <span class="badge bg-success ms-1 align-bottom">+ 1.3 %</span></h5>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body border-top">
                <div class="text-center">
                    <div class="row">
                        <div class="col-sm-4">
                            <div>
                                <div class="font-size-24 text-primary mb-2">
                                    <i class="bx bx-import"></i>
                                </div>

                                <p class="text-muted mb-2">Поступления</p>
                                <h5>$ 654.42</h5>

                                <div class="mt-3">
                                    <a href="javascript: void(0);" class="btn btn-primary btn-sm w-md">Send</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mt-4 mt-sm-0">
                                <div class="font-size-24 text-primary mb-2">
                                    <i class="bx bx-import"></i>
                                </div>

                                <p class="text-muted mb-2">Возвраты</p>
                                <h5>$ 1054.32</h5>

                                <div class="mt-3">
                                    <a href="javascript: void(0);" class="btn btn-primary btn-sm w-md">Receive</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mt-4 mt-sm-0">
                                <div class="font-size-24 text-primary mb-2">
                                    <i class="bx bx-wallet"></i>
                                </div>

                                <p class="text-muted mb-2">Выведено</p>
                                <h5>824.34 INR</h5>

                                <div class="mt-3">
                                    <a href="javascript: void(0);" class="btn btn-primary btn-sm w-md">Withdraw</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="row">
            <?php $__currentLoopData = $paymentsSystems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ps): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-sm-4">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3 align-self-center">
                            <img src="<?php echo e($ps->logo); ?>" alt="logo" style="width: 32px; height: 32px;">
                        </div>
                        <div class="flex-grow-1">
                            <p class="text-muted mb-2"><?php echo e($ps->name); ?> #<?php echo e($ps->id); ?></p>
                            <h5 class="mb-0">0.00 INR <span class="font-size-14 text-muted">~ $ 0.00</span></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <!-- end row -->

        
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<!-- apexcharts -->
<script src="<?php echo e(URL::asset('/assets/libs/apexcharts/apexcharts.min.js')); ?>"></script>

<!-- dashboard init -->
<script src="/assets/js/pages/dashboard.init.js?v=<?php echo e(time()); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/product/resources/views/admin/wallet.blade.php ENDPATH**/ ?>