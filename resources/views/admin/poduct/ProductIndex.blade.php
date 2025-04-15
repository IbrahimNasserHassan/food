@extends('layouts.master')
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
							<h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ جميع المنتجات</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						<a href="{{ route('admin.product.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> إضافة منتج جديد</a>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					@if(session('success'))
					<div class="alert alert-success">{{ session('success') }}</div>
					@endif
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">جدول المنتجات</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								{{-- <div class="d-flex justify-content-center mt-4">
									{{ $products->links() }}
								</div> --}}
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example2">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">الاسم</th>
												<th class="wd-20p border-bottom-0">الكمية</th>
												<th class="wd-15p border-bottom-0">سعر الشراء</th>
												<th class="wd-10p border-bottom-0">سعر البيع</th>
												<th class="wd-10p border-bottom-0"> تاريخ الاضافة</th>
												<th class="wd-25p border-bottom-0"></th>
											</tr>
										</thead>
										<tbody>
											@php
												$id = Auth::guard('admin')->id();
												$profilData = App\Models\Admin::find($id);
											@endphp
											@foreach ($products as $product)
											<tr>
												<td>{{ $product->name }}</td>
												<td>{{ $product->quantity }}</td>
												<td>{{ number_format($product->PriceBuy) }}</td>
												<td>{{ number_format($product->PriceSalse) }}</td>
												<td>{{ $product->created_at->format('Y-m-d')  }} </td>

												<td>
													<a href="{{ route('admin.product.edit', ['id' => $product->id]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"> تعديل</i></a>
													<form action="{{ route('admin.product.delete',['id' => $product->id]) }}"  class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا المنتج؟');">
														@csrf
														<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"> حذف</i></button> <br>
													</form>
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
				<!-- /row -->
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