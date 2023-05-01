@php
use App\Models\Order;
@endphp

@extends('layouts.app')
@section('subheader')
    <style>
		.order-item{
			margin-bottom: 2px;
		}
		.order-item-value{
			padding: 2px;
			padding-left: 5px;
			background: #004191;
			color:#fff;
			border-radius: 5px;
		}
		.order-item-key{
			font-size: 1.2rem;
			font-weight: bold;
		}
		.overhead-item{
			display:flex;
			align-items: center;
			text-align: center;
		}
		.overhead-item .order-item-value{
			width: 80%;
			text-align: left;
		}
		.overhead-delete{
			font-size: 12px;
			width: 40px;
			height: 28px;
			display: flex;
			text-align: center;
			align-items: center;
		}
    </style>
    <!--begin::Subheader-->
    <div class="py-2 subheader py-lg-6 subheader-solid" id="kt_subheader">
        <div class="flex-wrap container-fluid d-flex align-items-center justify-content-between flex-sm-nowrap">
            <!--begin::Info-->
            <div class="flex-wrap mr-1 d-flex align-items-center">
                <!--begin::Page Heading-->
                <div class="flex-wrap mr-5 d-flex align-items-baseline">
                    <!--begin::Page Title-->
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Присвоить</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">Панель управление</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.roads.order')}}" class="text-muted">Заявки для курьера</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
@endsection
@section('content-admin')
    <div class="mx-auto">
		<div class="container-fluid">
			@if (\Session::has('success'))
			<div class="alert alert-success">
				<ul>
					<li>{!! \Session::get('success') !!}</li>
				</ul>
			</div>
			@endif
			<div class="row">
				
				<div class="col-md-4 col-sm-4">
					<div class="order_info">
						<h6 style="color:#004191;">Заявка:  № <bold>{{$order->order_code}}</bold></h6>
						<ul style="list-style-type:none;padding:0;">
							<li class="order-item">
								<div class="order-item-key">Отправитель:</div>
								<div class="order-item-value">{{$order->from_name}}</div>
							</li>
							<li class="order-item">
								<div class="order-item-key">Компания:</div>
								<div class="order-item-value">{{$order->from_company}}</div>
							</li>
							<li class="order-item">
								<div class="order-item-key">Адрес:</div>
								<div class="order-item-value">{{$order->from_address}}</div>
							</li>
							<li class="order-item">
								<div class="order-item-key">Телефон:</div>
								<div class="order-item-value">{{$order->from_phone}}</div>
							</li>
							<li class="order-item">
								<div class="order-item-key">Примечание:</div>
								<div class="order-item-value">{{$order->description}}</div>
							</li>
						</ul>
						<a href="{{route('admin.roads.backList')}}" class="btn btn-sm btn-warning">Назад</a>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="overheads_info">
						<form method="GET" action="{{route('admin.roads.addConnect')}}">
							<input name="order_id" type="hidden" value="{{$order->id}}">
							<input class="form-control" 
								   name="overhead_code"
								   placeholder="Введите номер накладного: 123456" 
								   style="padding:0;height:30px;" autofocus>
						</form>
						<h6>Накладные:</h6>
						<ul style="list-style-type:none;padding:0;">
							
							@if(!$overheads->isEmpty())
								@foreach($overheads as $overhead)
								<li class="order-item overhead-item">
									<div class="order-item-value">{{$overhead->overhead_code}}</div>
									<div class="order-item-action">
										<a href="{{route('admin.roads.disconnect', 
												 ['order_id'=>$order->id, 'overhead_code'=>$overhead->overhead_code])}}"
										   class="btn btn-sm btn-danger overhead-delete">
											<i class="fa fa-minus"></i>
										</a>
									</div>
								</li>
								@endforeach
							@else
							<li class="order-item overhead-item">
								<div class="order-item-value">Пусто</div>
								
							</li>
							@endif
						</ul>
					</div>
				</div>
			</div>
		</div>
    </div>
 
@endsection
@section('admin-script')
    <script>
        
    </script>
@endsection
