@extends('layouts.master2')
@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
		<div class="container-fluid">
			<div class="row no-gutter">
				<!-- The image half -->
			
				<!-- The content half -->
				{{-- <div class="col-sm-6 col-sm-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2"> --}}
						<!-- Demo content-->
						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
									{{-- <div class="mb-5 d-flex mx-auto"> <a href="{{ url('/' . $page='index') }}" class="mx-auto d-flex"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="sign-favicon ht-40 mx-auto" alt="logo"><h1 class="main-logo1 ml-1 mr-0 my-auto tx-28 text-dark ml-2">Va<span>le</span>x</h1></a></div> --}}
									<div class="main-card-signin d-md-flex bg-white">
										<div class="p-4 wd-100p">
											<div class="main-signin-header">
												{{-- <div class="avatar avatar-xxl avatar-xxl mx-auto text-center mb-2"><img alt="" class="avatar avatar-xxl rounded-circle  mt-2 mb-2 " src="{{URL::asset('assets/img/faces/6.jpg')}}"></div> --}}
												<div class="mx-auto text-center mt-4 mg-b-20">
													<h5 class="mg-b-10 tx-16"></h5>
													<p class="tx-13 text-muted">Admin Login</p>
												</div>

                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                            
                        @endforeach
                        
                    @endif
                
                    @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

												<form action="{{ route('admin.login_submit') }}" method="POST" class="row g-6">
                          @csrf
													<div class="form-group">
                            <div class="mb-3">
                              <label for="exampleInputEmail" class="for-control">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email" id="exampleInputEmail" aria-describedby="emailHelp" >
                            </div>
                            <div class="mb-3">
                              <div class="d-flex align-item-start">
                                <div class="flex-grow-1">
                                  <label for="exampleInputPassword1" class="form control">Password</label>
                                  <input type="password" name="password" class="form-control" placeholder="Enter Password" id="exampleInputPassword1">
                                </div>
                              </div>
                            </div>
													</div>
                          <div class="col-12">
                            <div class="form-check">
                              <a href="{{ route('admin.forget_Password') }}">Forget Password</a>
                            </div>
                          </div>
													<button type="submit" class="btn btn-main-primary btn-block">Login</button>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						{{-- </div><!-- End -->
					</div>
				</div><!-- End --> --}}
			</div>
		</div>
@endsection
@section('js')
@endsection
