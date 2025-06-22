<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //

    public function ShowCustomer(){
        $customers=Customer::all();
        return view('admin.customer.IndexCustomer',compact('customers'));
    }
    //End Method







    public function CreateCustomer(){
        return view('admin.customer.CreateCustomer');
    }
    // End Method







    public function CustomerStore(Request $request){
    
        try{

    
        $request->validate([
            'CustomerName' => 'required',
            'CustomerAddree' => 'required',
            'CustomerCity' => 'required',
            'CustomerPhone' => 'required|array|min:1',
            'CustomerPhone.0' => 'required'

        ],
        [
            'CustomerName.required'=> 'ادخل إسم العميل',
            'CustomerAddree'=> 'ادخل عنوان العميل',
            'CustomerCity'=> 'الولاية!',
            'CustomerPhone.0'=> 'أدخل رقم العميل'
        ]
    );
        

        Customer::create($request->all());

        return redirect()->route('admin.customer.index')->with('success','تم إضافة العميل');

        
    } catch (\Exception $e) {

        return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage());
    }

    }
    // End Method







    public function CustomertEdit($id){

        $customers=Customer::findOrFail($id);
        return view('admin.customer.EditeCustomer',compact('customers'));

    }
    // End Method




    public function CustomerUpdate(Request $request, $id){

        $customers=Customer::findOrFail($id);

        try{

    
        $request->validate([
            'CustomerName' => 'required',
            'CustomerAddree' => 'required',
            'CustomerCity' => 'required',
            'CustomerPhone' => 'required|array|min:1',
            'CustomerPhone.0' => 'required'

        ],
        [
            'CustomerName.required'=> 'ادخل إسم العميل',
            'CustomerAddree'=> 'ادخل عنوان العميل',
            'CustomerCity'=> 'الولاية!',
            'CustomerPhone.0'=> 'أدخل رقم العميل'
        ]
    );
        

        $customers->update($request->all());

        return redirect()->route('admin.customer.index')->with('success','تم تحديث بيانات العميل');

        
    } catch (\Exception $e) {

        return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage());
    }
    }





    
    public function CustomerDelete($id){
        $customers=Customer::findOrFail($id);
        $customers->delete();
        return redirect()->route('admin.customer.index')->with('success','تم حذف العميل ');
    

    }
}
