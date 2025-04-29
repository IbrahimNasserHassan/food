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
@section('title')
الموردين
@endsection

@section('page-header')
				<!-- breadcrumb -->
                <div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الموردين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض الموردين </span>
						</div>
					</div>
                    <a href="{{ route('admin.supplier.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"> إضافة مورد </i></a> 

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
					@endif
                    @if(session('error'))
					<div class="alert alert-danger">{{ session('error') }}</div>
					@endif


				<!-- row -->
				<div class="row">
                    <div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0"> الموردين</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2">....<a href=""></a></p>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example2">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">المورد </th>
												<th class="wd-15p border-bottom-0"> رقم الهاتف</th>
												<th class="wd-15p border-bottom-0"> العنوان</th>
                                                <th class="wd-15p border-bottom-0"></th>

\											</tr>
										</thead>
                                        <tbody>
											@foreach ($suppliers as $supplier )

                                            <tr>
                                                <td>{{ $supplier->supplier_name }}</td>
                                                <td>{{ $supplier->supplier_phone }}</td>
												<td>{{ $supplier->supplier_address }}</td>
                                                <td>
                                                    <a href="{{ route('admin.supplier.details',['id' => $supplier->id]) }}" class="btn btn-sm btn-info"><i class="fa fa-list"> التفاصيل</i></a>
													<form action="{{ route('admin.supplier.delete',['id' => $supplier->id]) }}"  class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا المورد');">
														@csrf
														<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"> حذف</i></button> <br>
													</form>
                                                </td>

												@endforeach
                                            </tr>
                                        
                                        </tbody>
									</table>
								</div>
							</div><!-- bd -->
						</div><!-- bd -->
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