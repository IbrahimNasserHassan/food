<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


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





    

public function updateStatus(Request $request, Order $order,$orderId){

    DB::beginTransaction();

    try {
        $order = Order::with('orderDetails.product')->findOrFail($orderId);

        if ($order->payment_status === 'paid') {
            return redirect()->back()->with('info', 'تم تأكيد الدفع مسبقًا.');
        }

        // تحديث حالة الدفع
        $order->payment_status = 'paid';
        $order->save();

        foreach ($order->orderDetails as $item) {
            $product = $item->product;

            if ($item->type === 'wholesale') {

                
                // تحقق من توفر الكمية بالجملة
                if ($product->quantity < $item->quantity) {
                    throw new \Exception("الكمية غير كافية للمنتج: {$product->name}");
                }

                $product->quantity -= $item->quantity;

            } elseif ($item->type === 'retail') {

                // تحقق من توفر الوحدات
                $unitsToDeduct = $item->quantity;
                $totalUnits = $product->quantity * $product->units_per_wholesale;

                if ($totalUnits < $unitsToDeduct) {
                    throw new \Exception("الوحدات غير كافية للمنتج: {$product->name}");
                }

                $remainingUnits = $totalUnits - $unitsToDeduct;
                $product->quantity = floor($remainingUnits / $product->units_per_wholesale);
            }

            $product->save();
        }

        DB::commit();
        return redirect()->back()->with('success', 'تم تأكيد الدفع وخصم الكمية من المخزون.');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage());
    }
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
