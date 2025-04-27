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
        return view('admin.poduct.CreateProduct',compact('categories'));
    }
    // End Method


    public function CreateProductAdd(Request $request){
        // dd($request->all());
        try {

            $request->validate([
                'name' => 'required',
                'category_id' => 'required|exists:categories,id',
                'quantity' => 'required',
                'PriceSalse' => 'required',
                'PriceBuy' => 'required'
            ], [
                'name.required' => 'حقل الاسم مطلوب.',
                'category_id.required' => 'حقل الصنف مطلوب.',
                'category_id.exists' => 'الصنف المحدد غير موجود.',
                'quantity.required' => 'حقل الكمية مطلوب.',
                'PriceSalse.required' => 'حقل سعر البيع مطلوب.',
                'PriceBuy.required' => 'حقل سعر الشراء مطلوب.'
            ]);
    
            Product::create($request->only(['name', 'category_id', 'quantity', 'PriceSalse', 'PriceBuy']));
    
            return redirect()->route('admin.product.index')->with('success', 'تم إضافة المنتج بنجاح');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }
    // End Method






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
