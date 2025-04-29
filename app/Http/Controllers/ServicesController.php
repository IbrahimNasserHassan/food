<?php

namespace App\Http\Controllers;

use App\Models\services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services=services::all();
        return view('admin.services.IndexServices',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function CreateServices()
    {
        //
        return view('admin.services.CreateServices');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function StoreService(Request $request)
    {
        try {

            $request->validate([
                'Service_type' => 'required',
                'company' => 'required',
                'requirment' => 'required',
                'Service_price' => 'required',
                'date' => 'required'
            ], [
                'Service_type.required' => 'الرجاء تحديد نوع الخدمة .',
                'company.required' => 'الرجاء تحدد الجهة المستفيدة .',
                'requirment.required' => 'حدد متطلبات الخدمة  .',
                'Service_price.required' => 'الرجاء كتابة سعر الخدمة .',
                'date.required' => 'حدد تاريخ تقديم الخمة .'
            ]);
    
            services::create($request->all());
    
            return redirect()->route('admin.services.index')->with('success', 'تم إضافة الخدمة بنجاح');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }





    /**
     * Display the specified resource.
     */
    public function serviceDetails($id)
    {


        $service=services::find($id);

        return view('admin.services.DetailsService',compact('service'));
    }






    /**
     * Show the form for editing the specified resource.
     */
    public function edit(services $services)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, services $services)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(services $services)
    {
        //
    }
}
