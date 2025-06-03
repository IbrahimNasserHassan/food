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

<style>
    @media print {
        body {
            direction: rtl;
            font-family: sans-serif;
            font-size: 22px;
            background-color: white;

            
        }
        #ReportAria {
            padding: 2px;
            margin: 4 auto;
            background-color: white;
        }
        .card-body{
            background-color: white;
        }
        .card-header, h1 {
            text-align: center;
            font-size: 42px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table thead {
            background-color: ;
            color: black;
            font-size: 42px;
        }
        .table th,
        .table tr,
        .table td {
            border: 1px solid ;
            padding: 8px;
            text-align: center;
            font-size: 18px;

        }
        .seginture{
           
        }
        .about{
            text-align: button;
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

@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض الفاتورة</span>
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
<div class="">
        <a href="{{ route('admin.customer.order.index') }}" class="btn btn-sm btn-success float-right ">
            <i class="fa fa-arrow-right"></i> رجوع
        </a>
    </div>
    
    
<div class="row row-sm">
{{-- <div class="card-md-12"> --}}
    <div class="card md-10">
        <div class="d-flex justify-content-between">
		    <a href="#" onclick="printInvoice()" class="btn btn-sm btn-dark float-left mt-3 mr-2">
		    	<i class="mdi mdi-printer ml-1"></i> طباعة
		    </a>
        </div>
        <div >
            <div id="ReportAria">
            <div class="card-header" >
                <div class="tx-center">PROMAX TECHNOLOGY FOR COMPUTER SERVICES
                    {{-- <div class="main-img-user">
                        <img alt="" src="{{ (!empty($profilData->photo)) ? url('upload/admin_images/'.$profilData->photo) : url('upload/DCT.png')}}">
                    </div> --}}
                    {{-- <div class="tx"> for technical services</div> --}}
                </div>
            </div><br>

            <div class="billed-from tx-bold">
                <h6>مستخرج الفاتورة</h6>
                <p>الاسم: {{ $profilData->name }}<br>رقم هاتف: {{ $profilData->phone }}</p>
            </div>
                    
                <div class="row mg-t-20">
                    <div class="col-md">
                        <label class="tx-gray-600">بيانات العميل</label>
                        <div class="billed-to">
                            <h6>الاسم: {{ $order->customer->CustomerName ?? 'غير معروف' }}</h6>
                            <p>العنوان: {{ $order->customer->CustomerAddree ?? 'غير معروف' }}<br>
                            رقم الهاتف: {{ $order->customer->CustomerPhone [0] ?? 'غير معروف' }}<br>
                        </div>
                    </div>
                    <div class="col-md tx-left">
                        <label class="tx-gray-600 center">بيانات الفاتورة</label>
                        <p class="invoice-info "><span>رقم الفاتورة : </span> <span>{{ $order->invoice_number }}</span></p>
                        <p class="invoice-info "><span>تاريخ الإستخراج : </span> <span>{{ $order->date }}</span></p>
                    </div>
                </div>
            
					<div class="p-3">
						<h6 class="tx-gray"></h6>														
                        <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">
                            {{ $order->payment_status == 'paid' ? 'نهائية' : 'مبدئية ' }}
                        </span>
						</div>
					
				
                <div class="table-responsive">
                    <table class="table table-invoice">
                        <thead class="table-active tx-bold dark">
                            <tr class="tx-center  tx-uppercase tx-bold tx-inverse">
                                <th class="wd-20p tx-bold ">إسم المنتج</th>
                                <th class="tx-center">الكمية</th>
                                <th class="tx-right">السعر</th>
                                <th class="tx-right">المجموع</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderDetails as $details)
                                <tr colspan="3" class="g-blue-100 text-blue-800">
                                    <td>{{ $details->product->name ?? 'غير معروف' }}</td>
                                    <td class="tx-center">{{ number_format($details->quantity) }}</td>
                                    <td class="tx-right">{{ number_format($details->price) }}</td>
                                    <td class="tx-right">{{ number_format($details->quantity * $details->price) }}</td>
                                </tr>
								{{-- {{ $details->payment_status }} --}}
                            @endforeach
							<tr>
								<td colspan="3" class="tx-center  tx-uppercase tx-bold tx-inverse"> </td>
                                <td class=" table-active bg-dark tx-rigth">
                                    <h6 class="tx-primary tx-bold">الإجمالي :{{ number_format($order->total_amount) }} <span>جنيه</span></h6>
                                </td>
							</tr>
						</tbody>
                    </table>
				</div> <br>
                    
                <div class="tx-bold seginture">
                    التوقيع:............................................................................................................
                </div>
                <br>
			
                    <div class="bg-light tx-bold about">                    
                        <p>
                        هواتفنا : {{ $profilData->phone }} | 0912426069 - 0129974393 </p>
                        <p class="text-right tx-bold">
                        موقعنا :   {{ $profilData->address }} | تقاطع الأبراج
                        </p>
                    </div>
                
    </div>
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
