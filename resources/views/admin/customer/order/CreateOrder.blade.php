@extends('layouts.master')
@section('title')
إنشاء فاتورة
@endsection
@section('css')
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إنشاء فاتورة</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
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
<form action="{{ route('admin.order.store') }}" method="POST">
    @csrf
    <div class="row" style="width: 18rem;">
        <label for="invoice_type" class="form-label">نوع الفاتورة:</label>
        <select name="invoice_type" class="form-control">
            <option value="unpaid">غير مدفوعة</option>
            <option value="paid">مدفوعة</option>
        </select>
    </div><br>
    <div class="col-sm-7">
        <div class="card mg-b-20">
            <div class="card-header bg-light">
                <h2 class="mb-4">بيانات العميل</h2>
            </div>
            <div class="card-body">
                @if(isset($fromCustomerPage) && $fromCustomerPage)
                <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                <div class="mb-2">
                    
                    <input class="form-control" type="" value="{{ $customer->CustomerName }}" readonly>
                    <label for=""></label>
                    <input class="form-control" type="" value="{{ $customer->CustomerPhone[0] }}" readonly>
                
                </div>
                @else
                <div class="mb-3">
                    
                    <select class="form-select" id="customer_id" name="customer_id" required>
                        <option value="">اختر العميل</option>
                        @foreach($customers as $cust)
                        <option value="{{ $cust->id }}">
                            {{ $cust->CustomerName }} - 
                            {{ is_array($cust->CustomerPhone) ? implode(' - ', $cust->CustomerPhone) : $cust->CustomerPhone }}
                        </option>
                        @endforeach
                    </select>
                </div>
{{-- 
                <button type="button" class="btn btn-sm btn-primary" id="open-product-modal"><i class="fa fa-check"></i> تحديد عميل</button>  
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md"> 
                        <div class="modal-content">
                            <div class="modal-header bg-light">
                                <h5 class="modal-title" id="exampleModalLabel">تحديد المنتج</h5>
                            </div>
                            <div class="modal-body">
                                <input type="text" id="product-search" class="form-control mb-3" placeholder="ابحث عن منتج...">
                                <table class="table table-bordered" id="product-table">
                                    <thead>
                                        <tr>
                                            <th>اسم العميل</th>
                                            <th>رقم الهاتف</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customers as $cust)
                                        
                                        <tr data-id="{{ $cust->id }}" data-name="{{ $cust->CustomerName }}" data-price="">
                                            <td>{{ $cust->CustomerName }}</td>
                                            <td>{{ $cust->CustomerPhone[0] }}</td>
                                            <td><button type="button" class="btn btn-sm btn-primary select-product">اختيار</button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            </div>
                        </div>
                    </div>
                </div> --}}
                @endif
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0"></h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body">
                <ul id="search-results" class="list-group"></ul>
                <div class="mb-3">
                    <button type="button" class="btn btn-sm btn-success" id="open-product-modal"><i class="fa fa-plus"></i></button> إضافة منتج
                    <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>المنتج</th>
                                <th>الكمية</th>
                                <th>السعر</th>
                                <th>المجموع</th>
                            </tr>
                        </thead>
                        <tbody id="product-list">
                        </tbody>
                    </table>
                </div>
                <div class="mb-3">
                    <label for="total" class="form-label">إجمالي الفاتورة:</label>
                    <input type="text" name="total_amount" id="total" class="form-control" readonly>
                </div>
                <br>
                <input type="hidden" name="total_amount" id="hidden-total-amount">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"> حفظ الفاتورة</i></button>
            </div>
        </div>
    </div>
</form>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md"> 
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">تحديد المنتج</h5>
            </div>
            <div class="modal-body">
                <input type="text" id="product-search" class="form-control mb-3" placeholder="ابحث عن منتج...">
                <table class="table table-bordered" id="product-table">
                    <thead>
                        <tr>
                            <th>اسم المنتج</th>
                            <th>السعر</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->PriceBuy }}">
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->PriceBuy) }}</td>
                            <td><button type="button" class="btn btn-sm btn-primary select-product">اختيار</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const productModal = new bootstrap.Modal(document.getElementById('exampleModal'));
    const productList = document.getElementById('product-list');
    let productIndex = 0;

    document.getElementById('open-product-modal')?.addEventListener('click', () => {
        productModal.show();
    });


    // لما أحدد المنتج
    document.querySelectorAll('.select-product').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const id = row.dataset.id;
            const name = row.dataset.name;
            const price = row.dataset.price;

            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>
                    ${name}
                    <input type="hidden" name="products[${productIndex}][id]" value="${id}">
                    <button type="button" class="btn btn-sm btn-danger remove-product float-end">×</button>
                </td>
                <td><input type="number" name="products[${productIndex}][quantity]" class="form-control quantity" min="1" value="1"></td>
                <td><input type="number" name="products[${productIndex}][price]" class="form-control price" value="${price}"></td>
                <td><input type="text" class="form-control subtotal" readonly></td>
            `;

            productList.appendChild(newRow);
            productIndex++;
            productModal.hide();
            calculateTotal();
        });
    });

    // فلترة الجدول
    document.getElementById('product-search').addEventListener('keyup', function () {
        const value = this.value.toLowerCase();
        document.querySelectorAll('#product-table tbody tr').forEach(row => {
            const name = row.querySelector('td')?.textContent.toLowerCase() || '';
            row.style.display = name.includes(value) ? '' : 'none';
        });
    });

    // تعديل: نحسب الإجمالي لو الكمية أو السعر اتغير
    productList.addEventListener('input', function(e) {
    if (e.target.classList.contains('quantity') || e.target.classList.contains('price')) {
        calculateTotal();
    }
});

    productList.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-product')) {
            e.target.closest('tr').remove();
            calculateTotal();
        }
    });

    function calculateTotal() {
    let total = 0;
    document.querySelectorAll('#product-list tr').forEach(row => {
        const qty = parseFloat(row.querySelector('.quantity')?.value || 0);
        const price = parseFloat(row.querySelector('.price')?.value || 0);
        const subtotal = qty * price;
        row.querySelector('.subtotal').value = subtotal.toFixed(2);
        total += subtotal;
    });
    document.getElementById('total').value = total.toFixed(2);


    document.getElementById('hidden-total-amount').value = total.toFixed(2);
}
});

</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
@section('js')
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
@endsection
