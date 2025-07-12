@extends('layouts.master')
@section('title')
إنشاء فاتروة مشتريات
@endsection
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المشتريات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  إدخال فاتورة مشتريات جديدة</span>
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
                                    <h4 class="card-title mb-1">إدخال منتجات جديدة</h4>
                                </div> <br>
                            
                                <div class="card-body pt-0">
                                    <form action="{{ route('admin.purchase.store') }}" method="POST">
                                            @csrf
                                        
                                            <div class="mb-4">
                                                <label for="supplier_id">المورد:</label>
                                                <select name="supplier_id" class="form-control" required>
                                                    <option value="">اختر المورد</option>
                                                    @foreach($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        
                                            <div id="products-area">
                                                <div class="product-item border p-3 mb-3">
                                                    <label>اسم المنتج:</label>
                                                    <input type="text" name="products[0][name]" class="form-control" required>
                                                
                                                    <label>الصنف:</label>
                                                    <select name="products[0][category_id]" class="form-control" required>
                                                        <option value="">اختر الصنف</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->CategoryName }}</option>
                                                        @endforeach
                                                    </select>
                                                
                                                    <label>الكمية:</label>
                                                    <input type="number" name="products[0][quantity]" class="form-control" required>
                                                
                                                    <label>سعر الشراء:</label>
                                                    <input type="number" name="products[0][purchase_price]" class="form-control" required>
                                                
                                                    <label>سعر البيع:</label>
                                                    <input type="number" name="products[0][wholesale_price]" class="form-control" required>
                                                
                                                    </div>
                                            </div>
                                            
                                            <button type="button" class="btn btn-success mb-3" id="add-product">إضافة منتج جديد</button><br>
                                        
                                            <label>ملاحظات:</label>
                                        <textarea name="Pur_Note" class="form-control"></textarea> <br>
                                                
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">حفظ الفاتورة</button>
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


<script>
    let index = 1;

    document.getElementById('add-product').addEventListener('click', function () {
        const productArea = document.getElementById('products-area');
        const newProduct = document.querySelector('.product-item').cloneNode(true);

        newProduct.querySelectorAll('input, select, textarea').forEach(input => {
            input.name = input.name.replace(/\[\d+\]/, `[${index}]`);
            input.value = '';
        });

        productArea.appendChild(newProduct);
        index++;
    });
</script>


@endsection

                


{{-- / --}}

