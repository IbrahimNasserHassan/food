@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<style>
    @media print {
        body {
            direction: rtl;
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            color: #000;
        }
        #ReportAria {
            padding: 20px;
            margin: 0 auto;
        }
        .card-header, h4, table {
            text-align: center;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table thead {
            background-color: #000;
            color: #fff;
        }
        .table th,
        .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .btn,
        .breadcrumb-header,
        form,
        .mb-3,
        .dataTables_wrapper,
        #example2_filter,
        #example2_paginate,
        #example2_info,
        #example2_length {
            display: none !important;
        }
    }
</style>
@endsection
@section('title') تقرير المبيعات @endsection
@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">التقارير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  تقرير المبيعات</span>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row row-md">
@php $id = Auth::guard('admin')->id(); $profilData = App\Models\Admin::find($id); @endphp
<form method="GET" action="{{ route('admin.report') }}" class="mb-4">
    <div class="row g-3 align-items-end">
        <div class="col-md-4">
            <label for="customer_id" class="form-label">العميل</label>
            <select name="customer_id" id="customer_id" class="form-select">
                <option value="">كل العملاء</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->CustomerName }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3">
            <label for="from_date" class="form-label">من تاريخ</label>
            <input type="date" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
        </div>
        <div class="col-sm-3">
            <label for="to_date" class="form-label">إلى تاريخ</label>
            <input type="date" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
        </div>
        <div class="col-sm-2">
            <button type="submit" class="btn btn-primary btn-sm">بحث</button>
        </div>
    </div>
</form>
</div>
<div class="mb-3">
    <a href="#" onclick="printInvoice()" class="btn btn-dark float-left mt-3 mr-2">
        <i class="mdi mdi-printer ml-1"></i> 
    </a>
</div>
<div class="card md-10">
    <div class="card-body" id="ReportAria">
        <div class="card-header">
            <div class="tx-center">PROMAX TECHNOLOGY
                <div class="main-img-user">
                    <img alt="" src="{{ (!empty($profilData->photo)) ? url('upload/admin_images/'.$profilData->photo) : url('upload/DCT.png')}}">
                </div>
            </div>
        </div> <br>
        <div>
            <h4> تقرير المبيعات  <br> التاريخ : {{ date('d/m/Y') }}</h4>
        </div><br>
        <div class="table-responsive">
            <table class="table text-md-nowrap" id="example2">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>العميل</th>
                        <th>التاريخ</th>
                        <th>الإجمالي</th>
                        <th>الربح</th>
                        <th>المنتجات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer->CustomerName }}</td>
                            <td>{{ $order->date }}</td>
                            <td>{{ number_format($order->total_amount, 2) }}</td>
                            <td> {{
                                    number_format($order->items->sum(function($item) {
                                        $purchasePrice = $item->product->purchase_price;
                                    
                                        if ($item->allows_retail === '1') {
                                            // $unitCost = $price * ($item->product->units_per_wholesale ?: 1);
                                            $profit = ($item->price - $unitCost ) * $item->quantity;
                                        } else {
                                            $profit = ($item->price - $purchasePrice) * $item->quantity;
                                        }
                                    
                                        return $profit;
                                    }), 2)
                                }}
                            </td>
                            <td>
                                <ul>
                                    @foreach($order->items as $item)
                                        <li>{{ $item->product->name }} × {{ $item->quantity }} ({{ number_format($item->price, 2) }})</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="table-dark">
                        <td class="text-right">إجمالي المبيعات:</td>
                        <td>{{ number_format($total_sales, 2) }} جنيه</td>
                    </tr>
                    <tr class="table-dark">
                        <td class="text-right">إجمالي الأرباح:</td>
                        <td>{{ number_format($total_profit, 2) }} جنيه</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    function printInvoice() {
        var printContents = document.getElementById('ReportAria').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>



<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection
