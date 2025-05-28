@extends('admin.layouts.master')

@section('title') @lang('translation.Dashboards') @endsection

@section('content')

@component('admin.components.breadcrumb')
@slot('li_1') UPWIN @endslot
@slot('title') Касса @endslot
@endcomponent

@php
    $paymentsSystems = \App\PaymentsSystems::orderBy('id')->get();
@endphp


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
            @foreach($paymentsSystems as $ps)
        <div class="col-sm-4">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3 align-self-center">
                            <img src="{{ $ps->logo }}" alt="logo" style="width: 32px; height: 32px;">
                        </div>
                        <div class="flex-grow-1">
                            <p class="text-muted mb-2">{{ $ps->name }} #{{ $ps->id }}</p>
                            <h5 class="mb-0">0.00 INR <span class="font-size-14 text-muted">~ $ 0.00</span></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
        </div>
        <!-- end row -->

        
    </div>
</div>

@endsection

@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- dashboard init -->
<script src="/assets/js/pages/dashboard.init.js?v={{time()}}"></script>
@endsection