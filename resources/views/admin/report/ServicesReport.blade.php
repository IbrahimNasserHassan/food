@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('title')
تقرير الخدمات
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">التقارير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  تقرير الخدمات</span>
						</div>
					</div>
				
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
<div class="row row-md">

@php
    $id = Auth::guard('admin')->id();
    $profilData = App\Models\Admin::find($id);
    @endphp
    <!-- Filters -->
{{--             
        <form method="GET" action="{{ route('admin.report.services') }}" class="mb-4">
            <div class="row g-3 align-items-end">
            
                <div class="col-sm-3">
                    <label for="from_date" class="form-label">من تاريخ</label>
                    <input type="date" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
                </div>
                <div class="col-sm-3">
                    <label for="to_date" class="form-label">إلى تاريخ</label>
                    <input type="date" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-light btn-sm">بحث</button>
                </div>
            </div>
        </form> --}}
    </div>

    <div class="mb-3">
        <a href="#" type="Hedin" class="btn btn-light me-2"> </a>
        <a href="#" onclick="printInvoice()" class="btn btn-dark float-left mt-3 mr-2">
            <i class="mdi mdi-printer ml-1"></i> 
        </a>
    </div>
    <div class="card md-10">
    <div class="card-body" id="ReportAria">
        <div class="card-header">
            <div class="tx-center"> GadooraItech <div class="main-img-user"><img alt="" src="{{ (!empty($profilData->photo)) ? url('upload/admin_images/'.$profilData->photo) : url('upload/DCT.png')}}">
                <a class="" class=""></div>
                    
        </div>
        <div>
            <h4> تقرير الخدمات  <br>
                التاريخ : {{ date('d/m/Y') }}</h4>
        </div>
        <div class="table-responsive">
            <table class="table text-md-nowrap" id="example2">
        
            <thead class="table-dark">
                <tr>
                    <th class="text-light">الخدمة</th>
                    <th class="text-light">الجهة المستفيدة</th>
                    <th class="text-light">التاريخ</th>
                    <th class="text-light">الربح</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $services as $service)
                    
                    <tr>
                        <td>{{ $service->Service_type }}</td>
                        <td>{{ $service->company }}</td>
                        <td>{{ $service->date }}</td>
                        <td>
                            {{ number_format($subtotal =  $service->Service_price  - $service->requirment)  }}
                        </td>
                    

                    </tr>
                @endforeach


                <td></td>
                <td><tr></tr></td>
                <tr>
                    <td class="card-header dark">

                        <div class="card-header bg-dark text-light">إجمالي الأرباح</div>
                            <h5 class="card-title">{{ number_format($total_profit ) }} جنيه</h5>

                        </div>
                            
                            </div>
    </div> 
                        {{-- End of Print --}}
                    </td>
                </tr>

            </tbody>
        </table>
        
    </div>
</div>
</div>
</div>
</div>
@endsection
@section('js')

<script>
    $(document).ready(function() {
        $('#orders-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Arabic.json"
            },
            "order": [[ 0, "desc" ]]
        });
    });
</script>



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