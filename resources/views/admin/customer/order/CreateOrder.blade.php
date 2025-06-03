@extends('layouts.master')
@section('title', 'إنشاء فاتورة')

@section('content')
<form action="{{ route('admin.order.store') }}" method="POST">
    @csrf
    <div class="mb-3" style="max-width: 18rem;">
        <label for="invoice_type" class="form-label">نوع الفاتورة:</label>
        <select name="invoice_type" id="invoice_type" class="form-control" required>
            <option value="unpaid">غير مدفوعة</option>
            <option value="paid">مدفوعة</option>
        </select>
    
    <div class="" style="max-width: 18rem;">
        <label for="invoice_date" class="form-label">تاريخ الفاتورة:</label>
        <input type="date" name="date" id="invoice_date" class="form-control" value="{{ date('Y-m-d') }}" >
    </div>
    </div>

    <div class="mb-4" style="max-width: 18rem;">
        <label for="customer_id" class="form-label">اختر العميل:</label>
        <select name="customer_id" id="customer_id" class="form-control" required>
            <option value="">اختر العميل</option>
        
            @foreach($customers as $cust)
            <option value="{{ $cust->id }}" {{ request()->route('customer') && request()->route('customer')->id == $cust->id ? 'selected' : '' }} readonly>
                    {{ $cust->CustomerName }}
            </option>
            
                {{-- <option value="{{ $cust->id }}">{{ $cust->CustomerName }}</option> --}}
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <button type="button" class="btn btn-primary" id="open-product-modal"><i class="fa fa-plus"></i> إضافة منتج</button>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>اسم المنتج</th>
                <th>نوع البيع</th>
                <th>الكمية</th>
                <th>السعر</th>
                <th>المجموع</th>
                <th>حذف</th>
            </tr>
        </thead>
        <tbody id="product-list"></tbody>
    </table>

    <div class="mb-3" style="max-width: 18rem;">
        <label for="total_amount" class="form-label">إجمالي الفاتورة:</label>
        <input type="text" id="total_amount_display" class="form-control" readonly>
        <input type="hidden" name="total_amount" id="total_amount">
    </div>

    <button type="submit" class="btn btn-success">حفظ الفاتورة</button>
</form>

<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        {{-- <h5 class="modal-title" id="productModalLabel">اختيار المنتج</h5> --}}
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
      </div>
      <div class="modal-body">
        <input type="text" id="productSearch" class="form-control mb-3" placeholder="ابحث عن المنتج...">
        <table class="table table-hover" id="productTable">
          <thead>
            <tr>
              <th>اسم المنتج</th>
              <th>سعر الجملة</th>
              <th>سعر القطاعي</th>
              <th>#</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
            <tr 
                data-id="{{ $product->id }}"
                data-name="{{ $product->name }}"
                data-wholesale-price="{{ $product->wholesale_price }}"
                data-retail-price="{{ $product->retail_price }}"
                data-allows-retail="{{ $product->allows_retail ? '1' : '0' }}"
            >
              <td>{{ $product->name }}</td>
              <td>{{ number_format($product->wholesale_price, 2) }}</td>
              <td>{{ $product->allows_retail ? number_format($product->retail_price, 2) : '-' }}</td>
              <td><button type="button" class="btn btn-sm btn-primary select-product-btn">اختيار</button></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const productModal = new bootstrap.Modal(document.getElementById('productModal'));
    const productList = document.getElementById('product-list');
    const totalAmountInput = document.getElementById('total_amount');
    const totalAmountDisplay = document.getElementById('total_amount_display');
    let productIndex = 0;

    // فتح المودل
    document.getElementById('open-product-modal').addEventListener('click', () => {
        productModal.show();
    });

    // بحث  
    document.getElementById('productSearch').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        document.querySelectorAll('#productTable tbody tr').forEach(row => {
            const name = row.dataset.name.toLowerCase();
            row.style.display = name.includes(filter) ? '' : 'none';
        });
    });

    // عند اختيار المنتج من المودال
    document.querySelectorAll('.select-product-btn').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const id = row.dataset.id;
            const name = row.dataset.name;
            const wholesalePrice = parseFloat(row.dataset.wholesalePrice);
            const retailPrice = parseFloat(row.dataset.retailPrice);
            const allowsRetail = row.dataset.allowsRetail === '1';

            // تحقق من عدم إضافة نفس المنتج مرتين
            if ([...productList.querySelectorAll('input[name^="products"]')].some(input => input.value == id)) {
                alert('المنتج مضاف بالفعل');
                return;
            }

            // إنشاء صف جديد في الفاتورة
            const tr = document.createElement('tr');

            tr.innerHTML = `
                <td>
                    ${name}
                    <input type="hidden" name="products[${productIndex}][id]" value="${id}">
                </td>
                <td>
                    <select name="products[${productIndex}][type]" class="form-control type-selector" required>
                        ${allowsRetail ? '<option value="retail">قطاعي</option>' : ''}
                        <option value="wholesale">جملة</option>
                    </select>
                </td>
                <td>
                    <input type="number" name="products[${productIndex}][quantity]" class="form-control quantity" min="1" value="1" required>
                </td>
                <td>
                    <input type="number" name="products[${productIndex}][price]" class="form-control price" step="0.01" value="${wholesalePrice.toFixed(2)}" required>
                </td>
                <td>
                    <input type="text" class="form-control subtotal" readonly value="${wholesalePrice.toFixed(2)}">
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger remove-product-btn">×</button>
                </td>
            `;

            productList.appendChild(tr);
            productIndex++;


            productModal.hide();

            calculateTotal();
            attachEvents(tr, wholesalePrice, retailPrice, allowsRetail);
        });
    });


    
    //   المجموع الكلي
    function calculateTotal() {
        let total = 0;
        document.querySelectorAll('#product-list tr').forEach(row => {
            const qty = parseFloat(row.querySelector('.quantity').value) || 0;
            const price = parseFloat(row.querySelector('.price').value) || 0;
            const subtotal = qty * price;
            row.querySelector('.subtotal').value = subtotal.toFixed(2);
            total += subtotal;
        });
        totalAmountInput.value = total.toFixed(2);
        totalAmountDisplay.value = total.toFixed(2);
    }




    // تضبيط الأحداث على الصف الجديد: تغيير السعر/الكمية ونوع البيع، وحذف الصف
    function attachEvents(row, wholesalePrice, retailPrice, allowsRetail) {
        const quantityInput = row.querySelector('.quantity');
        const priceInput = row.querySelector('.price');
        const typeSelector = row.querySelector('.type-selector');
        const removeBtn = row.querySelector('.remove-product-btn');



        // عند تغيير نوع البيع نغير السعر تلقائيًا
        typeSelector.addEventListener('change', () => {
            if(typeSelector.value === 'retail' && allowsRetail) {
                priceInput.value = retailPrice.toFixed(2);
            } else {
                priceInput.value = wholesalePrice.toFixed(2);
            }
            calculateTotal();
        });


        // عند تغيير الكمية أو السعر نعيد حساب المجموع
        quantityInput.addEventListener('input', calculateTotal);
        priceInput.addEventListener('input', calculateTotal);


        // حذف المنتج من الفاتورة
        removeBtn.addEventListener('click', () => {
            row.remove();
            calculateTotal();
        });
    }
});
</script>
@endsection
