@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ طباعة فاتورة</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
                <div class="row row-sm">
					<div class="col-md-12 col-xl-12">
						<div class=" main-content-body-invoice">
							<div class="card card-invoice">
								<div class="card-body">
									<div class="invoice-header">
										<h1 class="invoice-title">فواتيري</h1>
										<div class="billed-from">
											<h6>Ibraheem Al-Awoor</h6>
											<p>invoice system management.<br>
											Mobile No:059-829-8969<br>
											Email: ibraheem.alaoor@hotmail.com</p>
										</div><!-- billed-from -->
									</div><!-- invoice-header -->
									<div class="row mg-t-20">
										<div class="col-sm-6">
											<label class="tx-gray-600">معلومات الفاتورة</label>
											<p class="invoice-info-row"><span>رقم الفاتورة</span> <span>{{$invoice->invoice_number}}</span></p>
											<p class="invoice-info-row"><span>تاريخ الإصدار:</span> <span>{{$invoice->invoice_Date}}</span></p>
											<p class="invoice-info-row"><span>تاريخ الاستحقاق:</span> <span>{{$invoice->Due_date}}</span></p>
										</div>
									</div>
									<div class="table-responsive mg-t-40">
										<table class="table table-invoice border text-md-nowrap mb-0">
											<thead>
												<tr>

													<th class="tx-right">القسم</th>
													<th class="tx-right">المنتج</th>
													<th class="tx-right">الحالة</th>
												</tr>
											</thead>
											<tbody>

												<tr>
                                                    <td>{{$invoice->section->section_name}}</td>
                                                    <td>{{$invoice->product}}</td>
                                                    @php
                                                        $status = $invoice->Status;
                                                        $class = '';
                                                        $text  = '';
                                                        switch($status)
                                                        {
                                                            case 0 : $class = 'badge badge-pill badge-success'; $text = 'مدفوعة'; break;
                                                            case 1: $class = 'badge badge-pill badge-warning'; $text = 'مدفوعة جزئيا';break;
                                                            case 2: $class = 'badge badge-pill badge-danger'; $text = 'عير مدفوعة'; break;
                                                        }
                                                    @endphp
                                                    <td>
                                                        <span class="{{$class}}">
                                                            {{$text}}
                                                        </span>
                                                    </td>
                                                </tr>
												<tr>
													<td class="valign-middle" colspan="2" rowspan="5">
														<div class="invoice-notes">
															<label class="main-content-label tx-13">تفاصيل</label>
														</div><!-- invoice-notes -->
													</td>
													<td class="tx-right">المبلغ المحصل</td>
													<td class="tx-right" colspan="2">{{$invoice->Amount_collection}}</td>
												</tr>
												<tr>
													<td class="tx-right">العمولة</td>
													<td class="tx-right" colspan="2">{{$invoice->Amount_Commission}}</td>
												</tr>
												<tr>
													<td class="tx-right">الخصم</td>
													<td class="tx-right" colspan="2">{{$invoice->Discount}}</td>
												</tr>
												<tr>
													<td class="tx-right">قيمة الضريبة</td>
													<td class="tx-right" colspan="2">{{$invoice->Value_VAT}}</td>
												</tr>
												<tr>
													<td class="tx-right tx-uppercase tx-bold tx-inverse">الاجمالي</td>
													<td class="tx-right" colspan="2">
														<h4 class="tx-primary tx-bold">{{$invoice->Total}}</h4>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<hr class="mg-b-40">
									<a href="#" class="btn btn-danger float-right mt-3 mr-2" onclick="print();">
										<i class="mdi mdi-printer ml-1"></i>طباعة
									</a>
								</div>
							</div>
						</div>
					</div><!-- COL-END -->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
@endsection
