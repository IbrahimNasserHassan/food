@extends('layouts.master')
@section('title')
إضافة منتج
@endsection
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  إضافة منتج</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
                @if(session('success'))
                    <div class="alert alert-danger">
                        {{ session('success') }}
                    </div>
                @endif
				@if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                    <div class="row row-md">
                        <div class="col-lg-12 col-xl-10 col-md-12 col-sm-12">
                            <div class="card  box-shadow-0">
                                <div class="card-header">
                                    <h4 class="card-title mb-1">إضافة منتج </h4>
                                </div>
                                <div class="card-body pt-0">
                                    <form action="{{ route('admin.product.add') }}" method="POST" class="form-horizontal" >
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" id="inputName" placeholder="الاسم">
                                        </div>
                                        <div>
                                            <select class="form-control" name="category_id" id="category_id" required>
                                                <option value="">حدد الصنف</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->CategoryName }}</option>
                                                @endforeach
                                            </select>
                                        </div> <br>
                                        <div>
                                            <select class="form-control" name="supplier_id" id="supplier_id" required>
                                                <option value="">المورد </option>
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                                @endforeach
                                            </select>
                                        </div> <br>
                                        <div class="form-group">
                                            <input type="number" name="quantity" step="0.01" class="form-control" id="" placeholder="الكمية">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" name="PriceSalse" step="0.01" class="form-control" id="inputName" placeholder="سعر الشراء">
                                        </div>
                                        <div class="form-group"> 
                                            <input type="number" name="PriceBuy" step="0.01" class="form-control" id="inputName" placeholder="سعر البيع">
                                        </div>
                                        </div>
                                        <div class="form-group mb-0 mt-9 justify-content-end">
                                            <div>
                                                <button type="submit" class="btn btn-primary">حفظ</button>
                                                <a href="{{ route('admin.product.index') }}" class="btn btn-secondary"><i class="fa fa-cros">إلغاء</i></a>
                                            </div>
                                        </div>
                                    </form>
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
@endsection