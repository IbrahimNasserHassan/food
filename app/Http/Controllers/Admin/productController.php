<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\Websitemail;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Arr;


class productController extends Controller
{
    //


    public function ProductIndex(){
        $CategoryName = Category::get('CategoryName');
        $products = Product::get();
        // dd($products);
        return view('admin.poduct.ProductIndex',compact('products','CategoryName'));
    }
    //End Method



    public function CreateProduct(){

        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('admin.poduct.CreateProduct',compact('categories','suppliers'));
    }
    // End Method

public function CreateProductAdd(Request $request)
{
    try {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required',
            'purchase_price' => 'required',
            'retail_price' => 'nullable|numeric',
            'wholesale_price' => 'required|numeric',
            'allows_retail' => 'required|boolean',
            'units_per_wholesale' => 'required|integer|min:1',
            'sale_type' => 'required|in:unit,piece',
            'unit_name' => 'required_if:sale_type,unit|string|nullable',
            
        ], [
            'name.required' => 'حقل الاسم مطلوب.',
            'category_id.required' => 'حقل الصنف مطلوب.',
            'category_id.exists' => 'الصنف المحدد غير موجود.',
            'supplier_id.exists' => 'المورد المحدد غير موجود.',
            'purchase_price.required' => 'حقل سعر الشراء مطلوب.',
            'wholesale_price.required' => 'حقل سعر الجملة مطلوب.',
            'allows_retail.required' => 'يرجى تحديد إذا كان المنتج يُباع قطاعي أم لا.',
            'sale_type.required' => 'يرجى تحديد نوع البيع.',
            'unit_name.required_if' => 'يرجى تحديد اسم الوحدة إذا كان البيع بالوحدة.',
        ]);

        $retail_price = $request->retail_price ?? 0;

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'quantity' => $request->quantity,
            'purchase_price' => $request->purchase_price,
            'retail_price' => $request->retail_price,
            'wholesale_price' => $request->wholesale_price,
            'units_per_wholesale' => $request->units_per_wholesale,
            'allows_retail' => $request->allows_retail,
            'sale_type' => $request->sale_type,
            'unit_name' => $request->unit_name,
            'retail_price' => $retail_price,

        ]);

        return redirect()->route('admin.product.index')->with('success', 'تم إضافة المنتج بنجاح');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage());
    }
}







    public function ProductEdit($id){
        $categories=Category::get();
        $product=Product::findOrFail($id);
        return view('admin.poduct.EditProduct',compact('product','categories'));
    }
    // End Method




    

    public function ProductUpdate(Request $request,$id){
        $product=Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'PriceSalse' => 'required',
            'PriceBuy' => 'required'
        ]);
        
        $product->update($request->all());
        return redirect()->route('admin.product.index')->with('success','تم تعديل المنتج بنجاح');
    }
    //End Method    





    public function ProductDelete($id){
        $product=Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.product.index')->with('success','تم حذف المنتج بنجاح');
    

    }
    //End Method
}
