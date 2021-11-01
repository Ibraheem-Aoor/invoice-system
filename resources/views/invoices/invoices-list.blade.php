@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <!--Internal  Font Awesome -->
    <link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    <!--Internal  treeview -->
    <link href="{{ URL::asset('assets/plugins/treeview/treeview.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

@endsection
@section('page-header')
    {{-- This is page header --}}
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    الفواتير
                </span>
            </div>
        </div>
    </div>
    <div class="mb-3">
        @if (session()->has('delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get('delete') }}
            </div>

        @endif
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <a class="btn btn-outline-primary" href="{{ route('invoice.add') }}" style="width:20%"
                        class="mb-1">اضافة فاتورة</a>
                    <a class="btn btn-outline-primary" href="{{ route('invoice.getExcel') }}" style="width:20%">طباعة
                        اكسل</a>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                                <div class="row"></div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                                            <div class="row">
                                                <div class="col-sm-12">

                                                    <table
                                                        class="table text-md-nowrap dataTable no-footer dtr-inline collapsed"
                                                        id="example2" role="grid" aria-describedby="example2_info"
                                                        style="width: 1218px;">

                                                        <thead>
                                                            <tr role="row">
                                                                <th class="wd-15p border-bottom-0 sorting_asc" tabindex="0"
                                                                    aria-controls="example2" rowspan="1" colspan="1"
                                                                    style="width: 204px;"
                                                                    aria-label="First name: activate to sort column descending"
                                                                    aria-sort="ascending">رقم الفاتورة</th>
                                                                <th class="wd-15p border-bottom-0 sorting" tabindex="0"
                                                                    aria-controls="example2" rowspan="1" colspan="1"
                                                                    style="width: 204px;"
                                                                    aria-label="Last name: activate to sort column ascending">
                                                                    تاريخ الفاتورة</th>
                                                                <th class="wd-20p border-bottom-0 sorting" tabindex="0"
                                                                    aria-controls="example2" rowspan="1" colspan="1"
                                                                    style="width: 284px;"
                                                                    aria-label="Position: activate to sort column ascending">
                                                                    تاريخ الاستحقاق</th>
                                                                <th class="wd-15p border-bottom-0 sorting" tabindex="0"
                                                                    aria-controls="example2" rowspan="1" colspan="1"
                                                                    style="width: 204px;"
                                                                    aria-label="Start date: activate to sort column ascending">
                                                                    المنتج</th>
                                                                <th class="wd-10p border-bottom-0 sorting" tabindex="0"
                                                                    aria-controls="example2" rowspan="1" colspan="1"
                                                                    style="width: 122px;"
                                                                    aria-label="Salary: activate to sort column ascending">
                                                                    القسم</th>
                                                                <th class="wd-25p border-bottom-0 sorting" tabindex="0"
                                                                    aria-controls="example2" rowspan="1" colspan="1"
                                                                    style="width: 0px; display: none;"
                                                                    aria-label="E-mail: activate to sort column ascending">
                                                                    الخصم</th>
                                                                <th class="wd-25p border-bottom-0 sorting" tabindex="0"
                                                                    aria-controls="example2" rowspan="1" colspan="1"
                                                                    style="width: 0px; display: none;"
                                                                    aria-label="E-mail: activate to sort column ascending">
                                                                    نسبة الضريبة</th>
                                                                <th class="wd-25p border-bottom-0 sorting" tabindex="0"
                                                                    aria-controls="example2" rowspan="1" colspan="1"
                                                                    style="width: 0px; display: none;"
                                                                    aria-label="E-mail: activate to sort column ascending">
                                                                    قيمة الضريبة</th>
                                                                <th class="wd-25p border-bottom-0 sorting" tabindex="0"
                                                                    aria-controls="example2" rowspan="1" colspan="1"
                                                                    style="width: 0px; display: none;"
                                                                    aria-label="E-mail: activate to sort column ascending">
                                                                    الاجمالي</th>
                                                                <th class="wd-25p border-bottom-0 sorting" tabindex="0"
                                                                    aria-controls="example2" rowspan="1" colspan="1"
                                                                    style="width: 0px; display: none;"
                                                                    aria-label="E-mail: activate to sort column ascending">
                                                                    الحالة</th>
                                                                <th class="wd-25p border-bottom-0 sorting" tabindex="0"
                                                                    aria-controls="example2" rowspan="1" colspan="1"
                                                                    style="width: 0px; display: none;"
                                                                    aria-label="E-mail: activate to sort column ascending">
                                                                    ملاحظات</th>
                                                                <th class="wd-25p border-bottom-0 sorting" tabindex="0"
                                                                    aria-controls="example2" rowspan="1" colspan="1"
                                                                    style="width: 0px; display: none;"
                                                                    aria-label="E-mail: activate to sort column ascending">
                                                                    عمليات</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if ($invoices->count() > 0)
                                                                @foreach ($invoices as $invoice)
                                                                    <tr role="row" class="odd">
                                                                        <td class="sorting_1" tabindex="0">
                                                                            {{ $invoice->invoice_number }}</td>
                                                                        <td>{{ $invoice->invoice_Date }}</td>
                                                                        <td>{{ $invoice->Due_date }}</td>
                                                                        <td>{{ $invoice->product }}</td>
                                                                        <td>
                                                                            <a
                                                                                href="{{ route('invoices.detailes.show', $invoice->id) }}">
                                                                                {{ $invoice->section->section_name }}
                                                                            </a>
                                                                        </td>
                                                                        <td>{{ $invoice->Discount }}</td>
                                                                        <td>{{ $invoice->Rate_VAT }}</td>
                                                                        <td>{{ $invoice->Value_VAT }}</td>
                                                                        <td>{{ $invoice->Total }}</td>
                                                                        @php
                                                                            $status = $invoice->Status;
                                                                        @endphp
                                                                        @if ($status = $invoice->Status == 0)
                                                                            <td class="text text-success">مدفوعة</td>
                                                                        @elseif($status == 1)
                                                                            <td class="text text-warning">مدفوعة جزئيا</td>
                                                                        @else
                                                                            <td class="text text-danger">غير مدفوعة</td>
                                                                        @endif

                                                                        @if ($x = $invoice->notes == null)
                                                                            <td>لا يوجد</td>
                                                                        @else
                                                                            <td>{{ $x }}</td>
                                                                        @endif
                                                                        <td>
                                                                            <div class="dropdown">
                                                                                <button aria-expanded="false"
                                                                                    aria-haspopup="true"
                                                                                    class="btn ripple btn-primary"
                                                                                    data-toggle="dropdown"
                                                                                    id="dropdownMenuButton"
                                                                                    type="button">عمليات<i
                                                                                        class="fas fa-caret-down ml-1"></i></button>
                                                                                <div class="dropdown-menu tx-13">
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('invoices.edit', $invoice->id) }}">
                                                                                        <i class="las la-pen"
                                                                                            style="color:green"></i>
                                                                                        تعديل
                                                                                    </a>
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('invoice.delete', $invoice->id) }}">
                                                                                        <i
                                                                                            class="text-danger fas fa-trash-alt"></i>
                                                                                        &nbsp;
                                                                                        حذف
                                                                                    </a> <a class="dropdown-item"
                                                                                        href="{{ route('invoice.archive', $invoice->id) }}">
                                                                                        <i
                                                                                            class="text-warning fas fa-exchange-alt"></i>&nbsp;
                                                                                        نقل الى الارشيف
                                                                                    </a>
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('invoice.payment.change', $invoice->id) }}">
                                                                                        <i class="fa fa-credit-card"
                                                                                            aria-hidden="true"></i>
                                                                                        &nbsp;
                                                                                        تغيير حالة الدفع
                                                                                    </a>
                                                                                    <a class="dropdown-item"
                                                                                        href="{{ route('invoice.print', $invoice->id) }}">
                                                                                        <i
                                                                                            class="fa fa-print text-primary"></i>&nbsp;
                                                                                        طباعة الفاتورة
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                    </tr>
                                                                @endforeach
                                                            @endif

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div><!-- bd -->
            </div>
        </div>
        <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
    @if (session()->has('Archived'))
        <script>
            not9();
        </script>
    @endif
@endsection

@section('js')

    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ URL::asset('assets/plugins/treeview/treeview.js') }}"></script>
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <script>
    </script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
   

@endsection
