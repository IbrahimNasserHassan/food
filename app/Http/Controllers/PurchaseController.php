<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\PurchaseItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }




    public function StorePurchaseInvoice(Request $request)
{
    try {
        DB::beginTransaction();

        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'products' => 'required|array|min:1',
            'products.*.name' => 'required|string',
            'products.*.category_id' => 'required|exists:categories,id',
            'products.*.quantity' => 'required|numeric|min:1',
            'products.*.purchase_price' => 'required|numeric|min:1',
            'products.*.wholesale_price' => 'required|numeric|min:1',
        ]);

        //  فاتورة المشتريات
        $purchaseInvoice = Purchase::create([
            'supplier_id' => $request->supplier_id,
            'Pur_Note' => $request->Pur_Note,
            'total_amount' => 0,
        ]);

        $totalAmount = 0;

        foreach ($request->products as $productData) {
            //  منتج جديد
            $product = Product::create([
                'name' => $productData['name'],
                'category_id' => $productData['category_id'],
                'supplier_id' => $request->supplier_id,
                'quantity' => $productData['quantity'],
                'purchase_price' => $productData['purchase_price'],
                'wholesale_price' => $productData['wholesale_price'],
            ]);


            PurchaseItem::create([
                'purchase_id' => $purchaseInvoice->id,
                'product_id' => $product->id,
                'quantity' => $productData['quantity'],
                'purchase_price' => $productData['purchase_price'],
                'subtotal' => $productData['purchase_price'] * $productData['quantity'],
            ]);

            $totalAmount += $productData['purchase_price'] * $productData['quantity'];
        }

        // تحديث إجمالي الفاتورة
        $purchaseInvoice->update(['total_amount' => $totalAmount]);

        DB::commit();
        return redirect()->route('admin.product.index')->with('success', 'تمت إضافة المنتجات، و حفظ فاتورة المشتريات بنجاح');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage());
    }
}

// End Method






    public function ShowPurchaseInvoice(Purchase $purchase,PurchaseItem $PurchaseItem,$id)
    {

        $purchase = Purchase::with('Supplier')->findOrFail($id);
        $PurchaseItem = PurchaseItem::with('product')->where('purchase_id', $id)->get();

        
        return view("admin.Purchases.PurchesInvoiceSupplierDetails", compact( 'purchase', 'PurchaseItem'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase, $id)
    {
        //
        $purchase=Purchase::findOrFail($id);

        return view('admin.Purchases.UpdatePurchaseInvoice',compact('purchase'));

    }
    // End Method

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase,$id)
    {

        DB::beginTransaction();

        $purchase=Purchase::findOrFail($id);
        $purchase->Pur_Note;
        $purchase->save();

        DB::commit();

        $purchase->update($request->all());
        return redirect()->route('admin.supplier.index')->with('success','تم تحديث الملاحظة بنجاح ');

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
