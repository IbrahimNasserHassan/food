    @extends('layouts.master')
    @section('title')
الرئيسية
    @endsection
    @section('css')
    <!--  Owl-carousel css-->
    <link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
    {{-- notification Toast --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudfare.com/ajax/libs/toastr.js/latest/toastr.css">
    @endsection
    @section('page-header')
            
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                </div>
    @endsection
    @section('content')
    
    @php
    $id = Auth::guard('admin')->id();
    $profilData = App\Models\Admin::find($id);
    @endphp
                    <!-- row -->
                    <div class="row row-sm">
                        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                            <div class="card overflow-hidden sales-card bg-primary-gradient">
                                <div class="pl-3 pt-3 pr-3 pb-2 pt-0"><i class="fa fa-invoices"></i>
                                    <div class="">
                                        <h4 class="mb-3 tx-12 text-white">المخزن</h4>
                                    </div>
                                    <div class="pb-0 mt-0">
                                        <div class="d-flex">
                                            <div class="">
                                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $total_product }}</h4>
                                                <p class="mb-0 tx-12 text-white op-7"> عدد المنتجات و البضاعة  داخل المخزن  </p>
                                            </div>
                                            <span class="float-right my-auto mr-auto">
                                                <a href="{{ route('admin.product.index') }}" ><i class="fas fa-arrow-circle-right text-white"></i></a>
                                                <span class="text-white op-7"> </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                            <div class="card overflow-hidden sales-card bg-danger-gradient">
                                <div class="pl-3 pt-3 pr-3 pb-2 pt-0"><i class="fa fa-inf"></i>
                                    <div class="">
                                        <h6 class="mb-3 tx-12 text-white">العملاء</h6>
                                    </div>
                                    <div class="pb-0 mt-0">
                                        <div class="d-flex">
                                            <div class="">
                                                <h4 class="tx-20 font-weight-bold mb-1 text-white">  {{ $total_customer }} </h4>
                                                <p class="mb-0 tx-12 text-white op-7">جميع العملاء</p>
                                            </div>
                                            <span class="float-right my-auto mr-auto">
                                                <a href="{{ route('admin.supplier.index') }}"><i class="fas fa-arrow-circle-right text-white"></i></a>
                                                <span class="text-white op-7"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                            <div class="card overflow-hidden sales-card bg-info-gradient">
                                <div class="pl-3 pt-3 pr-3 pb-2 pt-0"><i class="fa fa-invoices"></i>
                                    <div class="">
                                        <h6 class="mb-3 tx-12 text-white">جميع الفواتير  </h6>
                                    </div>
                                    <div class="pb-0 mt-0">
                                        <div class="d-flex">
                                            <div class="">
                                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $total_invoices }}</h4>
                                                <p class="mb-0 tx-12 text-white op-7">جميع الفواتير المنشأة في النظام</p>
                                            </div>
                                            <span class="float-right my-auto mr-auto">
                                                <a href="{{ route('admin.customer.order.index') }}"><i class="fas fa-arrow-circle-right text-white"></i></a>
                                                <span class="text-white op-7"> </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                            <div class="card overflow-hidden sales-card bg-success-gradient">
                                <div class="pl-3 pt-3 pr-3 pb-2 pt-0"><i class="fa fa-bildding"></i>
                                    <div class="">
                                        <h6 class="mb-3 tx-12 text-white"> الفواتير المدفوعة</h6>
                                    </div>
                                    <div class="pb-0 mt-0">
                                        <div class="d-flex">
                                            <div class="">
                                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $order_paid }}</h4>
                                                <p class="mb-0 tx-12 text-white op-7">الفواتير التي  تم سدادها  </p>
                                            </div>
                                            <span class="float-right my-auto mr-auto">
                                                <i class="fas fa-arrow-circle-right text-white"></i>
                                                <span class="text-white op-7"> </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                            <div class="card overflow-hidden sales-card bg-warning">
                                <div class="pl-3 pt-3 pr-3 pb-2 pt-0"><i class="fa fa-inf"></i>
                                    <div class="">
                                        <h6 class="mb-3 tx-12 text-white">الفواتير المعلقة</h6>
                                    </div>
                                    <div class="pb-0 mt-0">
                                        <div class="d-flex">
                                            <div class="">
                                                <h4 class="tx-20 font-weight-bold mb-1 text-white">  {{ $order_unpaid }} </h4>
                                                <p class="mb-0 tx-12 text-white op-7"> الفواتير التي لم يتم سداد رسومها</p>
                                            </div>
                                            <span class="float-right my-auto mr-auto">
                                                <i class="fas fa-arrow-circle-right text-white"></i>
                                                <span class="text-white op-7"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    

                    </div>
                    <!-- row closed -->
    
    
                </div>
            </div>
            <!-- Container closed -->
    @endsection
    @section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
    {{-- Message Notification --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script>

        @if (Session::has('message')) {
            var type = "{{ Session::get('alert-type','info') }}"
            switch (type) {
                case "info":
                    toastr.info("{{ Session::get('message') }}")
                break;

                case 'success':
                toastr.success("{{ Session::get('message') }}")
                break;
            
                case 'warning':
                toastr.warning("{{ Session::get('message') }}")
                break;

                case 'error':
                toastr.error("{{ Session::get('message') }}")
                break;

                default:
                    break;
            }
            
        @endif
    }
        
    </script>

    {{-- End toast --}}
    <!-- Moment js -->
    <script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
    <!--Internal  Flot js-->
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
    <script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
    <script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
    <!--Internal Apexchart js-->
    <script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
    <!-- Internal Map -->
    <script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
    <!--Internal  index js -->
    <script src="{{URL::asset('assets/js/index.js')}}"></script>
    <script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>	
    @endsection