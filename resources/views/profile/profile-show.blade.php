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
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الحساب</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/الملف
                    الشخصي</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('updated'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تحديث الملف الشخصي بنجاح",
                    type: "success"
                });
            }
        </script>
    @endif
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>خطا</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    {!! Form::model($user, ['method' => 'PATCH', 'enctype' => 'multipart/form-data', 'route' => ['AuthUser.profile.update', $user->id]]) !!}
                    <div class="">
                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                                <label>اسم المستخدم: <span class="tx-danger">*</span></label>
                                {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>البريد الالكتروني: <span class="tx-danger">*</span></label>
                                {!! Form::text('email', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-12 col-md-4">
                        <label for="">
                            الصورة الشخصية
                        </label>
                        <input type="file" name="avatar" class="dropify" data-height="200" />
                    </div>

                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>كلمة المرور: <span class="tx-danger">*</span></label>
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                        </div>

                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label> تاكيد كلمة المرور: <span class="tx-danger">*</span></label>
                            {!! Form::password('confirm-password', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="mg-t-30">
                        <button class="btn btn-main-primary pd-x-20" type="submit">تحديث</button>
                    </div>
                    <div class="row row-sm mg-b-20">
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('js')

        <!-- Internal Nice-select js-->
        <script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js') }}">
        </script>
        <script src="{{ URL::asset('assets/plugins/treeview/treeview.js') }}"></script>
        <!--Internal  Notify js -->
        <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
        <!--Internal  Parsley.min js -->
        <!--Internal  Datepicker js -->
        <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
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
        <!-- Internal TelephoneInput js-->
        <script src="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/telephoneinput/inttelephoneinput.js') }}"></script>
    @endsection
