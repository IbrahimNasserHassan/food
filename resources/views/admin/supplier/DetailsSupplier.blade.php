@extends('layouts.master')
@section('title')
تفاصيل المورد
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
            <h4 class="content-title mb-0 my-auto">الموردين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  تفاصيل المورد</span>
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
        <a href="{{ route('admin.supplier.index') }}" class="btn btn-sm btn-dark float-right ">
            <i class="fa fa-arrow-right"></i> رجوع
        </a>
    </div>
    <br>


    <div class="col-9">
        <div class="card card-secondary">
            <div class="card-header pb-0">
                <h2 class="card-title mb-0 pb-0">{{ $suppliers->supplier_name }} - {{ $suppliers->supplier_address }}</h2> 
                <h2 class="card-title mb-0 pb-0"></h2><br>

            </div>
            <div class="card-body text-secondary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example2">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">الاسم</th>
                                    <th class="wd-20p border-bottom-0">الكمية</th>
                                    <th class="wd-20p border-bottom-0">السعر</th>
                                    <th class="wd-10p border-bottom-0">  تاريخ التوريد : </th>
                                    
                                </tr>
                            </thead>
                        @foreach ( $suppliers->products as $supplier )

                        <tr>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->quantity }}</td>
                            <td>{{ number_format($supplier->purchase_price) }}</td>
                            <td>{{ $supplier->created_at->format('d-m-Y') }}</td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
                    </div>
                </div>
            </div>
            </div>
            <div class="card-footer">
            رقم الهاتف : {{ $suppliers->supplier_phone }}
            </div>
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
