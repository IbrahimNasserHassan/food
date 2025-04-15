<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Controllers\ClientController;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;

class OrderController extends Controller
{

    public function Indexorder(){
        $orders= Order::get();
        return view('admin.customer.order.OrderIndex',compact('orders'));

    }
    //End Method 



    public function CreateOrder(Request $request ,Customer $customer = null){
        if ($customer && $customer->exists) {
            // جاي من صفحة العميل
            $products = Product::all();
            return view('admin.customer.order.CreateOrder', [
                'customer' => $customer,
                'products' => $products,
                'fromCustomerPage' => true,
            ]);
        } else {
            // إنشاء فاتورة بدون تحديد عميل
            $customers = Customer::all();
            $products = Product::all();

            return view('admin.customer.order.CreateOrder', [
                'customers' => $customers,
                'products' => $products,

            ]);
        }
    
    }
    
    //End Method 





    public function StoreOrder(Customer $customer, Request $request){
    
        
        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $total = 0;
        foreach ($request->products as $item) {
            $product = Product::find($item['id']);
            $total += $product->price * $item['quantity'];
        }

        $order = Order::create([
            'customer_id' => $request->customer_id,
            'total_amount' => $request->total_amount,
            'payment_status' => $request->invoice_type == 'paid' ? 'paid' : 'unpaid',    
        ]);

        
        foreach ($request->products as $item) {
            $product = Product::find($item['id']);
            
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $product->price * $item['quantity'],
            ]);

            if ($product->quantity < $item['quantity']) {
                return redirect()->back()->with('error', 'الكمية المطلوبة أكبر من المتوفرة في المخزن');
            }
            $product->quantity -= $item['quantity'];
            $product->save();
        }


        
        return redirect()->route('admin.customer.order.index')->with('success', 'تم إنشاء الطلب بنجاح');
    }
    // End Method





    public function show(Order $order)
    {
        $order = Order::all();
        return view('admin.customer.order.ShowOrder', compact('order'));
    }
    //End Method




    public function EditOrder(Customer $customer, Order $order){

        $orderdetails=OrderDetails::get();
        $order=Order::findOrFail();
        return view('admin.customer.order.UpdateOrder',compact('order','orderdetails'));


    }
    // End Method



    public function updatePaymentStatus(Request $request, Order $order){


        $request->validate([
            'payment_status' => 'required|in:paid,unpaid'
        ]);

        $order->update(['payment_status' => $request->payment_status]);
        
        return back()->with('success', 'تم تحديث حالة الدفع بنجاح');


    }
    // End Method


}
