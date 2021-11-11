@extends('layouts.master')
@if (Auth::check())
    @section('title', 'الصفحة الريسية')
@else
    @section('title', 'نظام الفواتير')
@endif

@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الصفحة الرئيسية</h4>
            </div>
        </div>
    </div>
@endsection
@section('content')

    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class=" mb-3 tx-12 text-white">إجمالي الفواتير</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class=" tx-20 font-weight-bold mb-1 text-white">
                                    {{ $data['invoicesTotal'] }}</h4>
                                <p class="mb-0 tx-12 text-white op-7">
                                    {{ $data['invoicesCount'] }}</p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7">100%</span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class=" mb-3 tx-12 text-white">الفواتير الغير مدفوعة</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class=" tx-20 font-weight-bold mb-1 text-white" id="inPaidAmount">

                                    {{ $data['totalOfInPaid'] }}
                                </h4>

                                <p class="mb-0 tx-12 text-white op-7" id="inPaid">
                                    {{ $data['numOfInPaid'] }}
                                </p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-down text-white"></i>
                                <span class="text-white op-7">
                                    @if ($data['numOfInPaid'] == 0)
                                        0%
                                    @else
                                        {{ $data['numOfInPaid'] / $data['invoicesCount'] }}
                                    @endif
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class=" mb-3 tx-12 text-white">الفواتير المدفوعة</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class=" tx-20 font-weight-bold mb-1 text-white" id="paidAmount">
                                    {{ $data['totalPaid'] }}
                                </h4>
                                <p class="mb-0 tx-12 text-white op-7" id="paid">
                                    {{ $data['numOfPaid'] }}
                                </p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7">
                                    @if ($data['numOfPaid'] == 0)
                                        {{ 0 }}
                                    @else
                                        {{ $data['numOfPaid'] / $data['invoicesCount'] }}

                                    @endif
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline3"
                    class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class=" mb-3 tx-12 text-white">الفواتير المدفوعة جزئيا</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class=" tx-20 font-weight-bold mb-1 text-white" id="partPaidAmount">
                                    {{ $data['totalOfPartPaid'] }}
                                </h4>
                                <p class="mb-0 tx-12 text-white op-7" id="partPaid">
                                    {{ $data['numOfPartPaid'] }}
                                </p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-down text-white"></i>
                                <span class="text-white op-7">
                                    @if ($data['numOfPartPaid'] == 0)
                                        {{ 0 }}
                                    @else
                                        {{$data['numOfPartPaid'] / $data['invoicesCount']}}
                                    @endif
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
    </div>
    <!-- row closed -->


    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-sm-6 ">
            <div class="card">
                <div class="card-body">
                    <canvas id="myChart2" width="200" height="200">
                    </canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-6 ">
            <div class="card">
                <div class="card-body">
                    <canvas id="myChart" width="200" height="200">
                    </canvas>
                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->



    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')

    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var inpaid = $('#inPaid').text();
        var paid = $('#paid').text();
        var partPaid = $('#partPaid').text();

        var inPaidAmount = $('#inPaidAmount').text();
        var paidAmount = $('#paidAmount').text();
        var partPaidAmount = $('#partPaidAmount').text();
        // donughtChar SetUp
        const data = {
            labels: [
                'غير مدفوعة',
                'المدفوعة',
                'مدفوعة جزئيا'
            ],
            datasets: [{
                label: 'نسب الفواتير ',
                data: [inpaid, paid, partPaid],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        };

        // donughtChar SetUp
        const config = {
            type: 'doughnut',
            data: data,
            options: {}
        };

        // donughtChar render
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>



    <script>
        const data_2 = {
            labels: [
                'غير مدفوعة',
                'المدفوعة',
                'مدفوعة جزئيا'
            ],
            datasets: [{
                label: 'المبالغ حسب الفواتير',
                data: [inPaidAmount, paidAmount, partPaidAmount],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        };

        const config_2 = {
            type: 'bar',
            data: data_2,
            options: {}
        };
        const myChart2 = new Chart(
            document.getElementById('myChart2'),
            config_2
        );
    </script>

    {{-- <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('9d0599b90368895383da', {
            cluster: 'mt1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            alert(JSON.stringify(data));
        });
    </script> --}}





@endsection
