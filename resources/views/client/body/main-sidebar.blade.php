<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
	<div class="main-sidebar-header active">
		<a class="desktop-logo logo-light active" href=""><img src="{{URL::asset('assets/img/brand/Itech.png')}}" class="main-logo" ></a>
		{{-- <a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a> --}}
		{{-- <a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/re.jpg')}}" class="logo-icon" alt="user-img""></a> --}}
		{{-- <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.jpg')}}" class="logo-icon dark-theme" alt="logo"></a> --}}
	</div>
</div>
					@php
						$id = Auth::guard('client')->id();
						$profilData = App\Models\Client::find($id);
					@endphp
	<div class="main-sidemenu">
		<div class="app-sidebar__user clearfix">
			<div class="dropdown user-pro-body">
				<div class="">
					<img alt="user-img" class="avatar avatar-xl brround" src="{{ (!empty($profilData->photo)) ? url('upload/admin_images/'.$profilData->photo) : url('upload/DCT.png')}}"><span class="avatar-status profile-status bg-green"></span>
				</div>
				<div class="user-info">
					<h4 class="font-weight-semibold mt-3 mb-0">{{ $profilData->name }}</h4>
					<span class="mb-0 text-muted">{{ $profilData->email }}</span>
				</div>
			</div>
		</div>
		<ul class="side-menu">

	
			
			<li class="slide">
				<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M4 12c0 4.08 3.06 7.44 7 7.93V4.07C7.05 4.56 4 7.92 4 12z" opacity=".3"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93s3.05-7.44 7-7.93v15.86zm2-15.86c1.03.13 2 .45 2.87.93H13v-.93zM13 7h5.24c.25.31.48.65.68 1H13V7zm0 3h6.74c.08.33.15.66.19 1H13v-1zm0 9.93V19h2.87c-.87.48-1.84.8-2.87.93zM18.24 17H13v-1h5.92c-.2.35-.43.69-.68 1zm1.5-3H13v-1h6.93c-.04.34-.11.67-.19 1z"/></svg><span class="side-menu__label">المنتجات</span><i class="angle fe fe-chevron-down"></i></a>
				<ul class="slide-menu">
					<li><a class="slide-item" href="{{ route('admin.product.index') }}">عرض المنتجات</a></li>
				
				</ul>
			</li>



		
			<li class="slide">
				<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z" opacity=".3"/><path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/></svg><span class="side-menu__label">الفواتير</span><i class="angle fe fe-chevron-down"></i></a>
				<ul class="slide-menu">
					<li><a class="slide-item" href="{{ route('admin.order.create') }}">إنشاء فاتورة</a></li>
					{{-- <li><a class="slide-item" href="{{ route('admin.customer.order.index') }}">إدارة الفواتير</a></li>					 --}}
				</ul>
			</li>



			
		
			
					
			
		
			{{-- <li class="slide">
				<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6 20h12V10H6v10zm6-7c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z" opacity=".3"/><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/></svg><span class="side-menu__label">Custom Pages</span><i class="angle fe fe-chevron-down"></i></a>
				<ul class="slide-menu">
					<li><a class="slide-item" href="{{ url('/' . $page='signin') }}">Sign In</a></li>
					<li><a class="slide-item" href="{{ url('/' . $page='signup') }}">Sign Up</a></li>
					<li><a class="slide-item" href="{{ url('/' . $page='forgot') }}">Forgot Password</a></li>
					<li><a class="slide-item" href="{{ url('/' . $page='reset') }}">Reset Password</a></li>
					<li><a class="slide-item" href="{{ url('/' . $page='lockscreen') }}">Lockscreen</a></li>
					<li><a class="slide-item" href="{{ url('/' . $page='underconstruction') }}">UnderConstruction</a></li>
					<li><a class="slide-item" href="{{ url('/' . $page='404') }}">404 Error</a></li>
					<li><a class="slide-item" href="{{ url('/' . $page='500') }}">500 Error</a></li>
				</ul>
			</li> --}}
			
		</ul>
	</div>
</aside>
<!-- main-sidebar -->
