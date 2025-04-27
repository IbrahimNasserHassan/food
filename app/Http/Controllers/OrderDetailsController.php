<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    //

    public function ShowOrder($id)
    {
        $order = Order::with('customer')->findOrFail($id);
        $orderDetails = OrderDetails::with('product')->where('order_id', $id)->get();

        return view('admin.customer.order.ShowOrder', compact('order', 'orderDetails'));
    }
    //End Method 





    public function CustomerOrderShow($id)
    {
        $customer = Customer::with('orders')->findOrFail($id);
        return view('admin.customer.order.CustomerOrder', compact('customer'));
    }
    //End Method





    

    public function updateStatus($id)
{
    $order = Order::findOrFail($id);
    $order->payment_status = 'paid';
    $order->save();

    return redirect()->back()->with('success', 'تم تحديث حالة الفاتورة إلى مدفوعة.');
}
//End Method





    public function OrderEdit($id)
    {
        $order = Order::findOrFail($id);
        $orderDetails = OrderDetails::where('order_id', $id)->get();

        return view('admin.customer.order.UpdateOrder', compact('order', 'orderDetails'));
    }
    //End Method




    public function OrderDelete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.customer.order.index')->with('success', 'تم حذف الطلب ');
    }
    //End Method

}
