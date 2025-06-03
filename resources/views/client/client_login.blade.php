<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <style>
        body {
            font-family: Arial, Helvetica,  sans-serif;
            background-color: #white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #cfcfcf;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .login-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-container button:hover {
            background-color: blue;
        }
    </style>
</head>

<!-- Sidemenu-respoansive-tabs css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">

<style>
    .login-container a {
        display: block;
        text-align: center;
        margin-top: 10px;
        color: blue;
        text-decoration: none;
    }
    .login-container a:hover {
        text-decoration: underline;
    }
</style>
<div class="login-container">
	<div class="mx-auto text-center mt-4 mg-b-20">
		<h5 class="mg-b-10 tx-16"></h5>
		<p class="tx-13 text-muted">الدخول كمستخدم </p>
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

<form action="{{ route('client.client_submit') }}" method="POST" class="row g-6">
                        @csrf
						<div class="form-group">
                        	<div class="mb-3">
                        	    <label for="exampleInputEmail" class="for-control">الايميل</label>
                        	    <input type="email" name="email" class="form-control" placeholder="أدخل البريد" id="exampleInputEmail" aria-describedby="emailHelp" >
                        	</div>
                        	<div class="mb-3">
                        	    <div class="d-flex align-item-start">
                    				<div class="flex-grow-1">
                    				<label for="exampleInputPassword1" class="form control">كلمة المرور</label>
                    				<input type="password" name="password" class="form-control" placeholder="أدخل كلمة المرور" id="exampleInputPassword1">
                    				</div>
                        	    </div>
                        	</div>
						</div>
                    
                          <div class="col-12">
                            	<button type="submit" class="btn btn-primary">تسجيل الدخول</button>

                            <div class="form-check">
                              <a href="{{ route('admin.forget_Password') }}">هل نسيت كلمة السر ؟ </a>
							  	<a href="{{ route('admin.login') }}" class="btn btn-sm"><i class="fa fa-user">  تسجيل الدخول كمسئول </i></a>
                            </div> <br>
                          </div>
					</form>

				</div>

</body>
</html>