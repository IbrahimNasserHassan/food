<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderD;
use App\Models\Customer;

class ReportController extends Controller
{
    //
// أو الموديل اللي بيخزن المنتجات داخل الطلب

// public function salesReport()
// {

//     $customers = Order::with('customer')->get();
//     $orders = Order::with(['customer', 'items.product'])->get();
//     $totalSales = 0;
//     $totalCost = 0;

//     foreach ($orders as $order) {
//         foreach ($order->items as $item) {
//             $totalSales += $item->price * $item->quantity;
//             $totalCost += $item->product->PriceBuy * $item->quantity;
//         }
//     }

//     $profit = $totalSales - $totalCost;

//     return view('admin.report.report', compact('totalSales','customers', 'totalCost', 'profit', 'orders'));
// }
//End Method





public function SalesReport(Request $request)
{
    $query = Order::with(['customer', 'items.product'])
        ->where('payment_status', 'paid'); 



        if ($request->filled('customer_id')) {
        $query->where('customer_id', $request->customer_id);
    }


    if ($request->filled('from_date')) {
        $query->whereDate('created_at', '>=', $request->from_date);
    }



    if ($request->filled('to_date')) {
        $query->whereDate('created_at', '<=', $request->to_date);
    }

    $orders = $query->get();


    $total_sales = $orders->sum('total_amount');

    $total_cost = $orders->sum(function ($order) {
        return $order->items->sum(function ($item) {
            return $item->product->PriceBuy * $item->quantity;
        });
    });

    $total_profit = $total_sales - $total_cost;

    $customers = Customer::all();

    return view('admin.report.report', compact('orders', 'customers', 'total_sales', 'total_cost', 'total_profit'));
}




}; 
