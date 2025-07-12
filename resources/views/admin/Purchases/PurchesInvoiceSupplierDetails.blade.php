@extends('layouts.master')
@section('title')
تفاصيل الفاتورة
@endsection

@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الموردين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  تفاصيل فواتير المشتريات</span>
        </div>
    </div>
</div>
@endsection

@section('content')
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
@php
$id = Auth::guard('admin')->id();
$profilData = App\Models\Admin::find($id);
@endphp

<div class="row row-sm">

    <div>
        <button onclick="printInvoice()" class="btn btn-sm btn-dark"><i class="fa fa-print">  طباعة</i></button>
    </div>
    <br>

    <div id="invoiceArea">
    <div class="col-9">
        <div class="invoice-header">
            <div class="main-img-user">
                <img alt="" src="{{ !empty($profilData->photo) ? url('upload/admin_images/'.$profilData->photo) : url('upload/DCT.png') }}">
            </div>
                <h1 class="invoice-title"> </h1>
                <h3 class="invoice-title left">PROMAX TECHNOLOGY FOR COMPUTER SERVICES</h3>

            </div>
        </div><br>
        <div class="card card-secondary">
            <div class="card-header pb-0">
                <h2 class="card-title mb-0 pb-0">فاتورة مشتريات - <strong>بتاريخ :</strong> {{ $purchase->created_at->format('Y/m/d') }}</h2>

    <div class="card-body text-secondary">
                <h2 class="card-title mb-0 pb-0">المورد :  {{ $purchase->supplier->supplier_name }} - {{ $purchase->supplier->supplier_address }}</h2>
                <h2 class="card-title mb-0 pb-0">رقم الهاتف : {{ $purchase->supplier->supplier_phone  }}</h2><br>

            </div>


    <div class="table-responsive">
                        <table class="table table-invoice">
                            <thead class="table-active tx-bold dark">
                                    <th class="wd-20p tx-bold "> إسم المنتج </th>
                                    <th class="tx-right">السعر</th>
                                    <th class="tx-right">الكمية</th>
                                    <th class="tx-right">المجموع</th>
                                </tr>
                            </thead>
        <tbody>
            @foreach($PurchaseItem as $product)
                <tr>
                    <td>{{ $product->product->name ?? 'غير معروف'  }}</td>
                    <td>{{ number_format($product->purchase_price) }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ number_format($product->subtotal) }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>


        </div>
    </div>
                <div class="card-footer">
                    <h6 class="text-right">ملاحظة ! : {{ $purchase->Pur_Note }} </h6>
                    <h6 class="text-right tx-danger">المجموع الكلي: {{ number_format($purchase->total_amount) }} جنيه سـوداني  </h6>
                </div>
        </div>


    </div>
</div>
@endsection

@section('js')

<script>
    function printInvoice() {
        var printContents = document.getElementById('invoiceArea').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
        location.reload(); 
    }
</script>

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
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
@endsection
