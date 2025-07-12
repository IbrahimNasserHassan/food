@extends('layouts.master')
@section('title')
تحديث فاتورة المبيعات 
@endsection
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المببيعات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/   تحديث فاتورة المبيعات</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				
                    <div class="row row-md">
                        <div class="col-lg-12 col-xl-10 col-md-12 col-sm-12">
                            <div class="card  box-shadow-0">
                                <div class="card-header">
                                    <h4 class="card-title mb-1"> تحديث الفاتورة </h4>
                                </div>
                                <div class="card-body pt-0">
                                    <form action="{{ route('admin.purchase.update',$purchase->id) }}" method="POST" class="form-horizontal" >
                                        @csrf
                                        <label>ملاحظات:</label>
                                        <textarea type="text" name="Pur_Note" class="form-control" value="{{ $purchase->id }}">{{ $purchase->Pur_Note }}</textarea>
                                        </div>
                                        <div class="form-group mb-0 mt-9 justify-content-end">
                                            <div>
                                                <button type="submit" class="btn btn-success"><i class="fa fa-check"> حفظ </i></button>
                                                <a href="{{ route('admin.supplier.index') }}" class="btn btn-secondary"><i class="fa fa-cros">إلغاء</i></a>
                                            </div>
                                        </div>
                                    </form>
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