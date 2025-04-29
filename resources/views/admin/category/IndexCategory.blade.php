@extends('layouts.master')
@section('title')
    الأصناف
@endsection
@section('css')
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
							<h4 class="content-title mb-0 my-auto">الأصناف</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/   إضافة صنف</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
                
					@if(session('success'))
					<div class="alert alert-success">{{ session('success') }}</div>
					@endif
                    @if(session('error'))
					<div class="alert alert-danger">{{ session('error') }}</div>
					@endif


                <div class="row row-sm">
					<div class="col-lg-12">
						<div class="card mg-b-20" id="map">
                            <div class="card-header bg-light">
							<div class="card-body">
								<div class="main-content-label mg-b-5">
								</div>
                                    <!-- Button trigger modal -->
                                    <a href="" type="button" class="btn btn-sm btn-primary " data-bs-toggle="modal" id="myModal" data-bs-target="#exampleModal">
                                    <i class="fa fa-plus"> إضافة صنف</i>
                                    </a> <br>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-light">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">إضافة الصنف</h1>
                                            </div>
                                            <form action="{{ route('admin.category.create') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">إسم الصنف:</label>
                                                    <input  type="text" name="CategoryName" class="form-control" id="" placeholder="إسم الصنف " required>
                                                </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> أضافة الصنف</button>
                                        </div>
                                            </form>
                                        </div>
                                    </div>
                                    </div>
                                    </div>                                   
                    </td>
                                
                                <br>
						
                                <div class="main-content-label mg-b-5">
                                    الاصناف
                                </div>
                            </div>

					<div class="box-body">
					
                        <div class="card mg-b-20" id="map1">
						<div class="ht-3"></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-md-nowrap" id="example1">
                                    
                                    <thead>
                                        <tr>
                                            <th ">#</th>
                                            <th class="">اسم الصنف</th>
                                            <th class="">إجراء</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->CategoryName }}</td>
                                                <td>
                                                    <form action="{{ route('admin.category.delete',['id' => $category->id]) }}"  class="d-inline" onsubmit="return confirm('  هل أنت متأكد من حذف هذا الصنف، سيتم حذف المنتجات المرتبطة به أيضا!');">
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
                        </div>
                    </div>
                    </div>
                </div>
                
				
			
			
            </div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>

@endsection
@section('js')
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