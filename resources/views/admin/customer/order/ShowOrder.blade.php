@extends('layouts.master')
@section('title')
تفاصيل الفاتورة
@endsection

@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض الفاتورة</span>
        </div>
    </div>
</div>
@endsection

@section('content')
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
@php
$id = Auth::guard('admin')->id();
$profilData = App\Models\Admin::find($id);
@endphp

<div class="row row-sm">
    <div>
        <a href="{{ route('admin.customer.order.index') }}" class="btn btn-sm btn-dark float-right ">
            <i class="fa fa-arrow-left"></i> رجوع
        </a>
    </div>
    <br>
    
    <div class="col-md-12 col-xl-12">
		<div id="invoiceArea">
        <div class="main-content-body-invoice">
            <div class="card card-invoice">
                <div class="card-body">
                    <div class="invoice-header">
                        <h1 class="invoice-title">GadooraItech</h1>
                        <div class="main-img-user">
                            <img alt="" src="{{ !empty($profilData->photo) ? url('upload/admin_images/'.$profilData->photo) : url('upload/DCT.png') }}">
                        </div>

                        <div class="billed-from">
                            <h6>مستخرج الفاتورة</h6>
                            <p>الاسم: {{ $profilData->name }}<br>رقم هاتف: {{ $profilData->phone }}</p>
                        </div>
                    </div>

                    <div class="row mg-t-20">
                        <div class="col-md">
                            <label class="tx-gray-600">بيانات العميل</label>
                            <div class="billed-to">
                                <h6>الاسم: {{ $order->customer->CustomerName ?? 'غير معروف' }}</h6>
                                <p>العنوان: {{ $order->customer->CustomerAddree ?? 'غير معروف' }}<br>
                                رقم الهاتف: {{ $order->customer->CustomerPhone [0] ?? 'غير معروف' }}<br>
                            </div>
                        </div>

                        <div class="col-md">
                            <label class="tx-gray-600">بيانات الفاتورة</label>
                            <p class="invoice-info-row"><span>رقم الفاتورة</span> <span>{{ $order->id }}</span></p>
                            <p class="invoice-info-row"><span>تاريخ الإستخراج</span> <span>{{ $order->created_at }}</span></p>
                        </div>
                    </div>
                    <div class="table-responsive mg-t-10">
                        <table class="table table-invoice  border text-md-nowrap mb-0">
                            <thead class="table-active">
                                <tr>
                                    <th class="wd-20p">إسم المنتج</th>
                                    <th class="tx-center">الكمية</th>
                                    <th class="tx-right">السعر</th>
                                    <th class="tx-right">المجموع</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderDetails as $details)
                                    <tr>
                                        <td>{{ $details->product->name ?? 'غير معروف' }}</td>
                                        <td class="tx-center">{{ number_format($details->quantity) }}</td>
                                        <td class="tx-right">{{ number_format($details->price) }}</td>
                                        <td class="tx-right">{{ number_format($details->quantity * $details->price) }}</td>
                                    </tr>
									{{ $details->payment_status }}

                                @endforeach
								<tr>
									<div class="container text-center">
										<div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
										<div class="col">
											<div class="p-3">
												
											</div>
										</div>
										</div>
										<div class="col">
											<div class="p-3">
												<h6 class="tx-gray-600">حالة الدفع</h6>														
                                                <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">
                                                    {{ $order->payment_status == 'paid' ? 'مدفوعة' : 'غير مدفوعة' }}
                                                </span>
												</div>
											
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="3" class="tx-center  tx-uppercase tx-bold tx-inverse"> </td>
                                    <td class=" table-active tx-rigth">
                                        <h6 class="tx-primary tx-bold">إجمالي :{{ number_format($order->total_amount) }} <span>جنيه</span></h6>
                                    </td>
								</tr>
							</tbody>
                        </table>
                    
					</div> <br>
					<div class="invoice-notes tx-center">
						<p>هذه الفاتورة تم إنشاؤها من قبل نظام GadooraItech</p>
						هواتفنا:{{ $profilData->phone }} - 
						موقعنا:   {{ $profilData->address }}
					</div>
				</div>
			</div>
		</div>
		</div>
		<div class="card-footer">
				<div class="d-flex justify-content-between">
					
					<a href="#" onclick="printInvoice()" class="btn btn-danger float-left mt-3 mr-2">
						<i class="mdi mdi-printer ml-1"></i> طباعة
					</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('js')

<script>
    function printInvoice() {
        var printContents = document.getElementById('invoiceArea').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
        location.reload(); 
    }
</script>




<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
@endsection
