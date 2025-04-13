<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;


class CategoryController extends Controller
{
    //
    

    public function ShowCategory(){

        $categories = Category::all();
            //  dd($categories);

        return view('admin.category.IndexCategory',compact('categories'));
    }
    // End Method




    public function CreateCategory( Request $request){
        try{
            $request->validate([
                'CategoryName'=>'required|unique:categories'
    
            ]);
    
            Category::create($request->all());
            return redirect()->route('admin.category.show')->with('success','تمت إضافة الصنف');

        }
    
    catch (\Exception $e) {

        return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage());
    }

    }
    //End Method




    

    public function CategorytEdit($id){

        $category=Category::findOrFail($id);
        return view('admin.category.EditCategory',compact('category'));

    }






    public function CategoryDelete($id){

        $category=Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.category.show')->with('success','تم حذف الصنف !');
    
    }

}
