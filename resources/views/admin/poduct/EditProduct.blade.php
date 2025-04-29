@extends('layouts.master')
@section('title')
تعديل المنتج
@endsection
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  تعديل منتج</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				
                    <div class="row row-md">
                        <div class="col-lg-12 col-xl-10 col-md-12 col-sm-12">
                            <div class="card  box-shadow-0">
                                <div class="card-header">
                                    <h4 class="card-title mb-1">تعديل منتج </h4>
                                </div>
                                <div class="card-body pt-0">
                                    <form action="{{ route('admin.product.update',$product->id) }}" method="POST" class="form-horizontal" >
                                        @csrf
                                        <div class="form-group">
                                            إسم المنتج :    
                                            <input type="text" name="name" class="form-control" id="inputName" value="{{ $product->name }}">
                                        </div>
                                        
                                        <div class="form-group">
                                            الكمية :
                                            <input type="number" name="quantity" class="form-control" id="" value="{{ $product->quantity }}">
                                        </div>
                                        <div class="form-group">
                                            سعر الشراء :
                                            <input type="number" name="PriceSalse" class="form-control" id="inputName" value="{{ $product->PriceSalse }}">
                                        </div>
                                        <div class="form-group">
                                            سعر البيع :
                                            <input type="number" name="PriceBuy" class="form-control" id="inputName" value="{{ $product->PriceBuy }}">
                                        </div>
                                        </div>
                                        <div class="form-group mb-0 mt-9 justify-content-end">
                                            <div>
                                                <button type="submit" class="btn btn-primary"> حفظ التعديلات</button>
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