@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  Telephoneput css-->
    <link rel="stylesheet" hrInef="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    تعديل فاتورة
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تعديل فاتورة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(Session::has('emptyPaidAmount'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('emptyPaidAmount') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('invoice.update', $invoice->id) }}" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}
                        @php
                            $oldInvoiceNumber = $invoice->invoice_number;
                        @endphp
                        <input type="hidden" readonly name="old_invoice_number" value="{{ $oldInvoiceNumber }}">
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">رقم الفاتورة</label>
                                <input readonly type="text" class="form-control" id="inputName" name="invoice_number"
                                    title="يرجي ادخال رقم الفاتورة" required value="{{ $invoice->invoice_number }}">
                            </div>


                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input readonly class="form-control fc-datepicker" name="invoice_Date"
                                    placeholder="YYYY-MM-DD" value="{{ date('Y-m-d') }}" required
                                    value="{{ $invoice->invoice_Date }}">
                            </div>

                            <div class="col">
                                <label>تاريخ الاستحقاق</label>
                                <input readonly class="form-control fc-datepicker" name="Due_date" placeholder="YYYY-MM-DD"
                                    value="{{ $invoice->Due_date }}" required>
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">القسم</label>
                                <select name="Section" class="form-control" readonly="true">
                                    <!--placeholder-->
                                    <option readonly="true" value="{{ $invoice->section_id }}" selected>
                                        {{ $invoice->section->section_name }}</option>

                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">المنتج</label>
                                <select id="product" name="product" class="form-control" readonly="true">
                                    <option selected value="{{ $invoice->product }}">{{ $invoice->product }}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                <input readonly type="text" class="form-control" id="inputName" name="Amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->Amount_collection }}">
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ العمولة</label>
                                <input readonly type="text" class="form-control form-control-lg" id="Amount_Commission"
                                    name="Amount_Commission" title="يرجي ادخال مبلغ العمولة "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required value="{{ $invoice->Amount_Commission }}">
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الخصم</label>
                                <input readonly type="text" class="form-control form-control-lg" id="Discount"
                                    name="Discount" title="يرجي ادخال مبلغ الخصم "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->Discount }}" required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select readonly="true" name="Rate_VAT" id="Rate_VAT" class="form-control"
                                    onchange="myFunction()">
                                    <!--placeholder-->
                                    <option value="{{ $invoice->Rate_VAT }}" selected>{{ $invoice->Rate_VAT }}</option>

                                </select>
                            </div>

                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                <input type="text" class="form-control" id="Value_VAT" name="Value_VAT" readonly
                                    value="{{ $invoice->Value_VAT }}">
                            </div>


                            <div class="col">
                                <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                <input type="text" class="form-control" id="Total" name="Total" readonly
                                    value="{{ $invoice->Total }}">
                            </div>
                        </div>
                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3"
                                    readonly="true">{{ $invoice->note }}</textarea>
                            </div>
                        </div><br>
                        {{-- 5 --}}
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="status">حالة الدفع</label>
                                <select class="form-control" name="status" id="status" onchange="myFunc();">
                                    <option selected>-- اختيار حالة الدفع --</option>
                                    <option value="2">غير مدفوعة</option>
                                    <option value="1">مدفوعة جزئيا</option>
                                    <option value="0">مدفوعة</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-control mt-4" style="margin-top: 0.5%" id="hiddenDiv">
                                <label for="">المبلغ المحصل:</label>
                                <input type="text"  name="paidAmount" style="border-color:lightgray;outline:none;width:50%;"
                                    placeholder="قيمة المبلغ المحصل">
                            </div>
                        </div><br>
                        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')



    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
            $('#hiddenDiv').hide();
            function myFunc()
            {
                var status = $('#status').val();
                if (status == 1) {
                    $('#hiddenDiv').show();
                }
                else
                $('#hiddenDiv').hide();
            }
    </script>










@endsection
