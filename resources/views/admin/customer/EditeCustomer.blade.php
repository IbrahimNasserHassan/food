@extends('layouts.master')
@section('title')
تعديل بيانات عميل
@endsection
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">العملاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  تعديل بيانات عميل</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
                @if(session('success'))
                    <div class="alert alert-danger">
                        {{ session('success') }}
                    </div>
                @endif
				@if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                    <div class="row row-md">
                        <div class="col-lg-12 col-xl-10 col-md-12 col-sm-12">
                            <div class="card  box-shadow-0">
                                <div class="card-header">
                                    <h4 class="card-title mb-1">تعديل بيانات  </h4>
                                </div>
                                <br>
                                <div class="card-body pt-0">
                                    <form action="{{ route('admin.customer.update',$customers->id) }}" method="POST" class="form-horizontal" >
                                        @csrf
                                            
                                        <div class="form-group">
                                            <input type="text" name="CustomerName" class="form-control" id="inputName" value="{{ $customers->CustomerName }}" placeholder="إسم العميل">
                                        </div>
                                        
                                        <div class="form-group">
                                            <textarea name="CustomerAddree" class="form-control" value="{{ $customers->CustomerAddree }}" placeholder="العنوان"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="CustomerCity"  class="form-control" value="{{ $customers->CustomerCity }}" id="" placeholder="الولاية">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="CustomerPhone[]" class="form-control" id="" value="{{ $customers->CustomerPhone[0] }}" placeholder=" رقم الهاتف  (مطلوب!)">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="CustomerPhone[]" class="form-control" value="{{ $customers->CustomerPhone[1] }}" id="" placeholder="رقم الهاتف ">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="CustomerEmail" class="form-control" value="{{ $customers->CustomerEmail }}" id="" placeholder="البريد الإلكتروني">
                                        </div>
                                        </div>

                                        <div class="form-group mb-0 mt-9 justify-content-end">
                                            <div>
                                                <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                                                <a href="{{ route('admin.customer.index') }}" class="btn btn-secondary"><i class="fa fa-cros">إلغاء</i></a>
                                            </div>
                                        </div>
                                    </form> <br>
                                </div>
                            </div>
                        </div>
                    </div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection