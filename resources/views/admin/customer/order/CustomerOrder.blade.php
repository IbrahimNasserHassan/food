@extends('layouts.master')
@section('title')
المعاملات السابقة
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
            <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الفواتير السابقة</span>
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
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5> العميل: {{ $customer->CustomerName }}</h5>
        <a href="{{ route('admin.customer.order.create', $customer) }}" class="btn btn-primary">
            إنشاء طلب جديد
        </a>
    </div>
{{--     
    <div class="card mb-2">
        <div class="card-header">معلومات العميل</div>
        <div class="card-body">
            <p><strong>الهاتف:</strong> {{ $customer->CustomerPhone[0] }}</p>
            <p><strong>العنوان:</strong> {{ $customer->CustomerAddree }}</p>
        </div>
    </div> --}}
    
    <div class="card">
        <div class="card-header">سجل الطلبات</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>رقم الطلب</th>
                        <th>التاريخ</th>
                        <th>الإجمالي</th>
                        <th>حالة الدفع</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customer->orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        <td>{{ number_format($order->total_amount, 2) }} ج.س</td>
                        <td>
                            <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">
                                {{ $order->payment_status == 'paid' ? 'مدفوع' : 'غير مدفوع' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.customer.order.details', $order) }}" class="btn btn-sm btn-info">
                                <i class="fa fa-list"> عرض التفاصيل </i>
                            </a>
                                @if($order->payment_status !== 'paid')
    					    		<form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" style="display: inline-block;">
    					    		    @csrf
    					    		    @method('PUT')
    					    		    <button class="btn btn-sm btn-success" onclick="return confirm('هل أنت متأكد من تغير الحالة إلى مدفوعة؟')">
    					    		        <i class="fa fa-check"> تأكيد الدفع</i>
    					    		    </button>
    					    		</form>
						    	@endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<!-- Internal Data tables -->   
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
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