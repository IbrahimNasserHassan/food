@extends('layouts.master')
@section('title')
المعلومات الشخصية
@endsection
@section('css')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
                <!-- breadcrumb -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

                <!-- /breadcrumb -->
@endsection

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<br>
	<!-- row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <h5 class="mb-sm-0 font-size-50"> المعلومات الشخصية  </h5><br>

                    <div class="pl-0">
                        <div class="main-profile-overview">
                            <div class="main-img-user profile-user">
                                <img alt="" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : 
                                url('upload/DCT.png')}}"><a class="fas fa-camera profile-edit" href="JavaScript:void(0);"></a>
                            </div>
                            <div class="d-flex justify-content-between mg-b-20">
                                <div>
                                    <h5 class="main-profile-name"> الإسم : {{ $profileData->name }}</h5>
                                    <p class="main-profile-name-text">البريد الإلكتروني :{{ $profileData->email }}</p>
                                    <p class="main-profile-name-text"> العنوان : {{ $profileData->address }}</p>
                                    <p class="main-profile-name-text"> رقم الهاتف : {{ $profileData->phone }}</p>

                                </div>
                            </div>
                            <h6></h6>
                            <div class="main-profile-bio">
                            </div><!-- main-profile-bio -->
                        
                            <hr class="mg-y-30">
                        

                            <!--skill bar-->
                        </div><!-- main-profile-overview -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
        
            <div class="card">
                <div class="card-body">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs profile navtab-custom panel-tabs">
                        
                            <li class="">
                                <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-cog tx-16 mr-1"></i></span> <span class="hidden-xs">تعديل المعلومات الشخصية </span> </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                        
                        <div class="" id="settings">

                            <form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="FullName">الإسم </label>
                                    <input type="text" name="name" value="{{ $profileData->name }}" id="name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="Email">البريد الإلكتروني</label>
                                    <input type="email" name="email" value="{{ $profileData->email }}" id="Email" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="Username">رقم الهاتف</label>
                                    <input type="text"  value="{{ $profileData->phone }}" id="" name="phone" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="Username">العنوان</label>
                                    <input type="text" name="address" value="{{ $profileData->address }}" id="" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="Username"> الصورة الشـخصـيـة</label>
                                    <input type="file" name="photo" value="" id="image" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <img id="showImage" alt="" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : 
                                url('upload/DCT.png')}}"
                                class="rounded-circle p-1 bg-primary" width="110">
                                    
                                <div>
                                    <a href="{{ route('admin.change.password') }}"><i class="btn btn-danger"> تغيـر كـلمـة المـرور ! </i></a>
                                </div>

                                </div>
                                <div class="mt-4">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">حـفـظ الـتـغـيرات </button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script type="text/javascript">
    $(dociment).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){

                $('#showImage').attr('src',e.target.result);

            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })
</script>
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!--Internal  Chart.bundle js -->
    <script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
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