@extends('layouts.master')
@section('css')
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

                <div class="row row-sm">
					<div class="col-lg-12">
						<div class="card mg-b-20" id="map">
							<div class="card-body">
								<div class="main-content-label mg-b-5">
									إضافة صنف
								</div>
								<div></div>
                                <form action="{{ route('admin.category.create') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="CategoryName" class="form-control" id="" placeholder="إسم الصنف " required>
                                    </div>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> أضافة الصنف</button>
                                </form>
                                <br>
						
			
				
					<div class="box-body">
						<div class="main-content-label mg-b-5">
							الاصناف
						</div>
                        <div class="card mg-b-20" id="map1">
						<div class="ht-3"></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-md-nowrap" id="example1">
                                    
                                    <thead>
                                        <tr>
                                            <th ">#</th>
                                            <th class="">الاسم</th>
                                            <th class="">إجراء</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->CategoryName }}</td>
                                                <td>
                                                    <form action="{{ route('admin.category.delete',['id' => $category->id]) }}"  class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا الصنف');">
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
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>

@endsection
@section('js')
@endsection