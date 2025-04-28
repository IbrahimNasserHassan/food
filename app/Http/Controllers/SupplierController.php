<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.supplier.SupplierIndex',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  view('admin.supplier.CreateSpplier');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function StoreSupplier(Request $request)
    {
        //
        try {

            $request->validate([
                
                    'supplier_name' => 'required',
                    'supplier_phone' => 'required',
                    'supplier_address' => 'required',
    
                ],
                [
                    'supplier_name.required' => 'الرجاء إدخال إسم المورد',
                    'supplier_phone.required' => 'الرجاء إدخال رقم المورد',
                    'supplier_address.required' => 'الرجاء تحديد عنوان المورد'
        
                
                ]);

            Supplier::create($request->all());
            return redirect()->route('admin.supplier.index')->with('success','تم إضافة مورد جديد');


        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function SupplierDelete($id){
        $suppliers =Supplier::findOrFail($id);
        $suppliers->delete();
        return redirect()->route('admin.supplier.index')->with('error','تم حذف المورد ');
    

    }
    //End Method
}
