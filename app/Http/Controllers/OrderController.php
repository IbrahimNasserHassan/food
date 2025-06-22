<?php

namespace App\Http\Controllers;
use Carbon\Carbon;  

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;
use App\Models\User;

class OrderController extends Controller
{

    public function Indexorder(){
        $orders= Order::get();
        
        return view('admin.customer.order.OrderIndex',compact('orders'));

    }
    //End Method 



    public function CreateOrder(Request $request ,Customer $customer = null) {

        $customers = Customer::all();

        if ($customer && $customer->exists) {
            // جاي من صفحة العميل
            $products = Product::all();

            
            return view('admin.customer.order.CreateOrder', [
                'customers' => $customers,
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





//     public function StoreOrder(Customer $customer, Request $request){
    
        
//         $request->validate([
//             'products' => 'required|array',
//             'products.*.id' => 'required|exists:products,id',
//             'products.*.quantity' => 'required|integer|min:1',
//         ]);

//         $total = 0;
//         foreach ($request->products as $item) {
//             $product = Product::find($item['id']);
//             $total += $product->price * $item['quantity'];
//         }

//         $order = Order::create([
//             'customer_id' => $request->customer_id,
//             'total_amount' => $request->total_amount,
//             'payment_status' => $request->invoice_type == 'paid' ? 'paid' : 'unpaid',    
//         ]);

        
//         foreach ($request->products as $item) {
//             $product = Product::find($item['id']);
            
//             OrderDetails::create([
//                 'order_id' => $order->id,
//                 'product_id' => $product->id,
//                 'product_name' => $product->name,
//                 'price' => $item['price'],
//                 'quantity' => $item['quantity'],
//                 'subtotal' => $product->price * $item['quantity'],
//             ]);

//             if ($product->quantity < $item['quantity']) {
//                 return redirect()->back()->with('error', 'الكمية المطلوبة أكبر من المتوفرة في المخزن');
//             } else {
//                 $product->quantity -= $item['quantity'];
//                 $product->save();
            
            
        

//         if(Auth::guard('client'))
//         return redirect()->route('client.Dashboard')->with('success', 'تم انشاء الفاتورة');
//         else
        
//         return redirect()->route('admin.customer.order.index')->with('success', 'تم إنشاء الطلب بنجاح');
//     }
// }
//     }
    // End Method





public function StoreOrder(Request $request)
{
    DB::beginTransaction();

    try {
    
        // إنشاء الفاتورة
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'total_amount' => $request->total_amount,
            'payment_status' => $request->invoice_type,
            'date' =>$request->date, 
            'invoice_number' => $this->generateInvoiceNumber(),
            
        ]);

        foreach ($request->products as $prod) {
            $product = Product::findOrFail($prod['id']);
            $qty = (int) $prod['quantity'];
            $type = $prod['type']; 
            $price = (float) $prod['price'];
            $subtotal = $qty * $price;


            // تحقق من توفر الكمية في المخزن
            if ($request->invoice_type === 'paid') {
                if ($type === 'wholesale') {
                    if ($product->quantity < $qty) {
                        throw new \Exception("الكمية المتوفرة من المنتج {$product->name} غير كافية.");
                    }
                    $product->quantity -= $qty;
                } else {
                    // البيع بالوحدة
                    $unitsAvailable = $product->quantity * $product->units_per_wholesale;

                    if ($unitsAvailable < $qty) {
                        throw new \Exception("عدد الوحدات المتوفرة من المنتج {$product->name} غير كافية.");
                    }


                    // احسب الوحدات المتبقية بعد البيع
                    $unitsLeft = $unitsAvailable - $qty;


                    // احسب الكمية الجديدة بعد الخصم
                    $product->quantity = floor($unitsLeft / $product->units_per_wholesale);
                }

                $product->save();
            }

            // إنشاء تفاصيل الطلب
            OrderDetails::create([
                // 'user_id' => Auth::id(), // إضافة معرف المستخدم الحالي
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'price' => $price,
                'quantity' => $qty,
                'subtotal' => $subtotal,
                'type' => $type,
                
                
            ]);
        }

        DB::commit();

        return redirect()->route('admin.customer.order.index')->with('success', 'تم إنشاء الفاتورة بنجاح');
    } catch (\Exception $e) {
        DB::rollBack();
        dd($e->getMessage(), $e->getFile(), $e->getLine());
        // return back()->with('error', 'حدث خطأ: ' . $e->getMessage());
    }
}
//End Method




private function generateInvoiceNumber()
{
    $year = now()->format('Y');
    $lastOrder = Order::whereYear('created_at',$year)->latest('id')->first();
    $nextNumber = $lastOrder ? ($lastOrder->id + 1) : 1;

    return   str_pad($nextNumber, 5, '0', STR_PAD_LEFT) . '-' . now()->format('Y');
}


    //End Method


    public function OrderDelete(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.customer.order.index')->with('success', 'تم حذف الطلب بنجاح');
    }
    // End Method






    public function show(Order $order)
    {
        $order = Order::all();
        return view('admin.customer.order.ShowOrder', compact('order'));
    }
    //End Method







    public function EditOrder(Customer $customer, Order $order){

        $customers=Customer::get();
        $products = Product::all();
        $orderdetails=OrderDetails::get();
        $order=Order::get();
        return view('admin.customer.order.UpdateOrder',compact('order','orderdetails','customers','products'));


    }
    // End Method



    public function updatePaymentStatus(Request $request, Order $order,$orderId){

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
    // End Method


}
