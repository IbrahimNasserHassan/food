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
                                                <option value="category_id">حدد الصنف</option>
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
                                            <label for="sale_type">الكمية</label>
                                            <input type="number" name="quantity" step="0.01" class="form-control" id="" placeholder="الكمية">
                                        </div>
                                        <div class="form-group">
                                            <label for="sale_type">سعر الشراء</label>
                                            <input type="number" name="purchase_price" class="form-control" placeholder="سعر الشراء">
                                        </div>
                                        <div class="form-group">
                                            <label for="sale_type">سعر البيع </label>
                                            <input type="number" name="wholesale_price" class="form-control" placeholder="سعر بيع  بالحبة">
                                        </div>
                                        
                                        
                                            <label for="allows_retail" class="form-label">يباع  بالتجزئة؟</label>
                                            <select name="allows_retail" id="allows_retail" class="form-control">
                                                <option value="1">نعم</option>
                                                <option value="0">لا</option>
                                            </select>

                                        <div class="form-group">
                                            <label for="sale_type">نوع البيع</label>
                                            <select name="sale_type" id="sale_type" class="form-control" required>
                                                <option value="">اختر نوع البيع</option>
                                                <option value="piece">بالحبة</option>
                                                <option value="unit">بالتجزئة</option>
                                            </select>
                                        </div>
                                        <div class="form-group d-none" id="unit_name_group">
                                            <label for="unit_name">نوع الوحدة </label>
                                            <input type="text" name="unit_name" id="unit_name" class="form-control" placeholder="نوع الوحدة">
                                        </div>

                                        <div class="form-group">
                                            <label for="sale_type"> عدد الوحدات في الحبة</label>
                                            <input type="number" name="units_per_wholesale" class="form-control" placeholder="  عدد الوحدات في الحبة الواحدة">
                                        </div>

                                        <div class="form-group d-none" id="retail_price_group">
                                            <label for="retail_price" class="form-label">سعر البيع بالتجزئة</label>
                                            <input type="text" name="retail_price" class="form-control" placeholder="  ">
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const allowsRetail = document.getElementById('allows_retail');
        const saleTypeSelect = document.getElementById('sale_type'); 
        const unitNameGroup = document.getElementById('unit_name_group');
        const unitretailInput = document.getElementById('retail_price_group');
        

        saleTypeSelect.addEventListener('change', function () {
            if (this.value === 'unit') {
                allowsRetail.classList.remove('d-none');
                unitNameGroup.classList.remove('d-none');
                unitretailInput.classList.remove('d-none');// Make retail price required for unit sale type
            } else {
                allowsRetail.classList.add('d-none');
                unitNameGroup.classList.add('d-none');
                unitretailInput.classList.add('d-none');// Remove retail price requirement for piece sale type
            }
        });
    });
</script>
@endsection