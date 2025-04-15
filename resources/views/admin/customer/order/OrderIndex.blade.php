@extends('layouts.master')
@section('title')
الفواتير
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
			
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ جميع الفواتير</span>
			</div>
		</div>
		<div class="d-flex my-xl-auto right-content">
			<a href="{{ route('admin.order.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> إضافة فاتورة جديد</a>
		</div>
	</div>@endsection
@section('content')
@if(session('success'))


					<div class="alert alert-success">{{ session('success') }}</div>
					@endif
                    @if(session('error'))
					<div class="alert alert-danger">{{ session('error') }}</div>
					@endif
				<!-- row -->
				@php
                $id = Auth::guard('admin')->id();
                $profilData = App\Models\Admin::find($id);
                @endphp

				<div class="row">
                    <div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">جدول الفواتير</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2"> <a href=""></a></p>
							</div>
							<div class="card-body">
								<div class="table-responsive2">
									<table id="example2" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0">رقم الفاتورة</th>
                                                <th class="border-bottom-0"> إسم العميل</th>
												<th class="border-bottom-0">إجمالي الفاتورة</th>
												<th class="border-bottom-0">تاريخ الإنشاء</th>
												<th class="border-bottom-0">حالة الفاتورة</th>
												<th class="border-bottom-0">مستخرج الفاتورة</th>
												<th class="border-bottom-0"></th>
											</tr>
										</thead>
										<tbody>
                                            @foreach ($orders as $order )

                                            
											<tr>
												<td>{{ $order->id }}</td>
                                                <td>{{ $order->customer->CustomerName }}</td>
												<td>{{ number_format($order->total_amount) }}</td>
												<td>{{ $order->created_at->format('Y-m-d') }}</td>
                                                <td>
													<span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">
														{{ $order->payment_status == 'paid' ? 'مدفوعة' : 'غير مدفوعة' }}
													</span>
													</td>
                                                <td>{{ $profilData->name }}ِ</td>
												<td>
                                                    <a href="{{ route('admin.customer.order.details', $order->id) }}" class="btn btn-sm btn-info"><i class="fa fa-info-circle"> عرض</i></a>
                                                    <a href="" class="btn btn-sm btn-warning"><i class="fa fa-edit"> تحديث</i></a>
													@if($order->payment_status !== 'paid')
    											<form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="display: inline-block;">
    											    @csrf
    											    @method('PUT')
    											    <button class="btn btn-sm btn-success" onclick="return confirm('هل أنت متأكد من تغير الحالة إلى مدفوعة؟')">
    											        <i class="fa fa-check"> مدفوعة</i>
    											    </button>
    											</form>
													@endif

                                                </td>
											</tr>
                                                
                                            @endforeach
										
										</tbody>
									</table>
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
<!-- Internal Data tables -->
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
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection