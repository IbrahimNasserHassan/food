@extends('layouts.master')
@section('title')
العملاء
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
				<h4 class="content-title mb-0 my-auto">العملاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ جميع العملاء</span>
			</div>
		</div>
		<div class="d-flex my-xl-auto right-content">
			<a href="{{ route('admin.customer.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> إضافة عميل جديد</a>
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
				
				<div class="row">
					<div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mg-b-0">العملاء </h4>
                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                            </div>
                        </div>
                        <br>
                        <div class="card-body">
                            <div class="table-responsive2">
                                <table id="example2" class="table key-buttons text-md-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="">اسم العميل</th>
											<th class="">العنوان</th>
                                            <th class="">الولاية</th>
                                            <th class=""> رقم الهاتف</th>
                                            <th class="">البريد الإلكتروني</th>
                                            <th class=""></th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $customer)
    {{-- @dd($customer) --}}
                                            <tr>
                                                <td>{{ $customer->CustomerName }}</td>
                                                <td>{{ $customer->CustomerAddree }}</td>
                                                <td>{{ $customer->CustomerCity }}</td>
                                                <td>{{ implode(' - ',array_filter ($customer->CustomerPhone)) }}</td>
                                                <td>{{ $customer->CustomerEmail }}</td>
                                                <td>

                                                    <a href="{{ route('admin.customer.orders.show',$customer->id) }}" class="btn btn-sm btn-info"><i class=" fa fa-list">  فواتير العميل </i></a>
													<a href="{{ route('admin.customer.order.create', ['customer' => $customer->id]) }}" class=""><i class="btn btn-sm btn-success">إنشاء فاتورة </i></a>

                                                    <form action="{{ route('admin.customer.delete',['id' => $customer->id]) }}"  class="d-inline" onsubmit="return confirm('  هل أنت متأكد من حذف هذا العميل! ');">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"> حذف</i></button> <br>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                </table>
                                {{-- <div class="d-flex justify-content-center mt-4">
                                    {{ $customers->links() }}
                                </div> --}}
					</div>
				</div>
                        </div>
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