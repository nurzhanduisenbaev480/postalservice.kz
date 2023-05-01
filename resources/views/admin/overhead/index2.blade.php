@extends('layouts.app')
@section('subheader')
<style>
	.order_block{
		display: flex;
		flex-direction: column;
	}
	.order_block_item{
		display: flex;
		align-items: center;
	}
	.order_block_item h5{
		font-size: 10px;
		width: 28%;
		border-right: 1px solid #e7e7e7;
		margin-bottom: 0;
		margin-left: 4px;
		border-bottom: 1px dashed #3F4254;
	}
	.order_block_item p{
		width: 72%;
		margin-left: 4px;
		font-size: 10px;
		margin-bottom: 0;
		color: #3F4254;
	}
	.table td{
		padding: 0;
	}
	.table_td_item{
		/*margin: 15px 5px 0 5px;*/
		overflow-wrap: break-word;
		color: #3F4254;
		font-weight: 600;
		cursor: pointer;
	}
	.tab-content{
		min-height: 400px;
		overflow-y: scroll;
	}
	.order_action{
		display: flex;
		margin-right: 5px;
	}
	.order_action li{
		margin-right: 5px;
	}
	.order_action_item:hover i{
		color: #ff7324;
	}
	.order_block_item .other_order{
		width: 55%;
	}
	.large-2::-webkit-scrollbar-track {
		border: 1px solid #000;
		padding: 2px 0;
		background-color: #1e1e2d;
	}

	.large-2::-webkit-scrollbar {
		width: 10px;
	}

	.large-2::-webkit-scrollbar-thumb {
		border-radius: 10px;
		box-shadow: inset 0 0 6px rgba(0,0,0,.3);
		background-color: white;
		border: 1px solid #000;
	}
	.transit-table tr th, .transit-table tr td{
		padding: 5px;
	}
	.transit-desc{
		width: 200px;
		padding: 0;
		margin: 0;
		/* display: flex; */
		font-size: 12px;
	}
	.transit-details{
		width: 150px;
	}
	.transit-actions a{
		display: block;
		width: 100%;
		text-align: center;
		padding: 2px;
		background: #004191;
		border-radius: 5px;
		margin-bottom: 2px;
	}
	.transit-actions a:hover{
		background: #0d2849;
	}
	.transit-actions a i{
		color: white;
	}
	.table td {
		border: 1px solid #004191;
	}
	.tab-content{
		min-height:40px;
	}
	.filter_forms{
		display: flex;
		align-items: center;
		margin-top: 10px;
	}
	.form-item{
		display:flex;
		text-align: left;
		align-items: center;
	}
	.fv-plugins-icon-container{
		display:flex;
		text-align: left;
		align-items: center;
		margin-bottom: 0;
	}
	.form-item label, .fv-plugins-icon-container label{
		margin-right: 10px;
		margin-left: 10px;
	}
	.form-control2{
		height: 32px;
		padding: 0;
		padding-left: 5px;
		padding-right: 5px;
		font-size: 12px;
	}
    .filter-company{
        display: flex;
        align-items: center;
    }
    .excel-btn{
        margin-top: 10px;
        display: flex;
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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Накладные</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin')}}" class="text-muted">Панель управление</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.overheads.index')}}" class="text-muted">Накладные</a>
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

    <div class="mx-auto col-lg-12">
		<div class="row">
			@if(Session::has('success'))
			<div class="alert alert-success">{{Session::get('success')}}</div>
			@endif
			@if(Session::has('successFinish'))
			<div class="alert alert-success">{{Session::get('finish')}}</div>
			@endif
		</div>

    </div>
	<div class="mx-auto col-lg-12" style="padding:0;">
		<div class="transit-tab">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="home-tab"
							data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab"
							aria-controls="home" aria-selected="true" style="color:#004191;">Фильтр по компаний</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="profile-tab"
							data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab"
							aria-controls="profile" aria-selected="false" style="color:#004191;">Фильтр по имени</button>
				</li>

			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					<div class="filter-company">
						<form method="GET" id="filter_by_company" class="filter_forms">
							<div class="form-item">
								<label for="from_company">Компания</label>
								<input type="text" name="from_company"
									   id="from_company"
									   class="form-control form-control2" placeholder="TOO Test">
							</div>
							<div class="form-item">
								<div class="form-group fv-plugins-icon-container">
									<label for="from_date">От:</label>
									<div class="input-group date">
										<input type="text" placeholder=""
											   value="{{date('Y-m-d 00:00:00')}}"
											   name="from_date"
											   autocomplete="off" class="form-control form-control2" id="from_date">
										<div class="input-group-append">
											<span class="input-group-text">
												<i class="la la-calendar"></i>
											</span>
										</div>
									</div><i data-field="from_date" class="fv-plugins-icon"></i>

									<div class="fv-plugins-message-container"></div>
								</div>
							</div>
							<div class="form-item">
								<div class="form-group fv-plugins-icon-container">
									<label for="to_date">До:</label>
									<div class="input-group date">
										<input type="text" placeholder=""
											   value="{{date('Y-m-d 23:59:00')}}"
											   name="to_date"
											   autocomplete="off" class="form-control form-control2" id="to_date">
										<div class="input-group-append">
											<span class="input-group-text">
												<i class="la la-calendar"></i>
											</span>
										</div>
									</div><i data-field="to_date" class="fv-plugins-icon"></i>

									<div class="fv-plugins-message-container"></div>
								</div>
							</div>
							<div class="form-item">
								<input type="submit" class="btn btn-success form-control2" value="Фильтр">
							</div>
						</form>

                        <a href="{{route('admin.overheads.export3', $_GET)}}"
						   class="btn btn-primary btn-sm form-control2 excel-btn">Excel</a>
					</div>
				</div>
				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="filter-company">
                        <form method="GET" id="filter_by_name" class="filter_forms">
                            <div class="form-item">
                                <label for="from_name">Отправитель</label>
                                <input type="text" name="from_name"
                                       id="from_name"
                                       class="form-control form-control2" placeholder="Иванов Иван">
                            </div>
                            <div class="form-item">
                                <div class="form-group fv-plugins-icon-container">
                                    <label for="from_date2">От:</label>
                                    <div class="input-group date">
                                        <input type="text" placeholder=""
                                               value="{{date('Y-m-d 00:00:00')}}"
                                               name="from_date2"
                                               autocomplete="off" class="form-control form-control2" id="from_date2">
                                        <div class="input-group-append">
										<span class="input-group-text">
											<i class="la la-calendar"></i>
										</span>
                                        </div>
                                    </div><i data-field="from_date2" class="fv-plugins-icon"></i>

                                    <div class="fv-plugins-message-container"></div>
                                </div>
                            </div>
                            <div class="form-item">
                                <div class="form-group fv-plugins-icon-container">
                                    <label for="to_date2">До:</label>
                                    <div class="input-group date">
                                        <input type="text" placeholder=""
                                               value="{{date('Y-m-d 23:59:00')}}"
                                               name="to_date2"
                                               autocomplete="off" class="form-control form-control2" id="to_date2">
                                        <div class="input-group-append">
										<span class="input-group-text">
											<i class="la la-calendar"></i>
										</span>
                                        </div>
                                    </div><i data-field="to_date2" class="fv-plugins-icon"></i>

                                    <div class="fv-plugins-message-container"></div>
                                </div>
                            </div>
                            <div class="form-item">
                                <input type="submit" class="btn btn-success form-control2" value="Фильтр">
                            </div>
                        </form>
                        <a href="{{route('admin.overheads.export4', $_GET)}}" class="btn btn-primary btn-sm form-control2 excel-btn">Excel</a>
                    </div>

				</div>
			</div>
		</div>
	</div>
    <div class="mx-auto col-lg-12 large-2" style="padding: 0;height:800px;overflow-y:scroll;">
		<table class="table table-bordered table-hover mt-2 transit-table">
			<thead>
				<tr>
					<th>#</th>
					<th>Код Заявки</th>
					<th>Отправитель</th>
					<th>Получатель</th>
					<th>Детали</th>
					<th>Комментарий</th>
					<th>Цена</th>
					<th>Действие</th>
					
				</tr>
			</thead>
			<tbody>
				@if(isset($overheads))
				@php $index=0;@endphp
				@foreach($overheads as $overhead)
				@php 
					//print_r($overhead->status_id);
					$index++;
				@endphp
				@if($overhead->status_id == 8)
					<tr class="" style="background:#5be485;">
				@else
					<tr class="" style="background:#e3e8f1;">
				@endif
				
					<td><div class="table_td_item">{{$index}}</div></td>
					<td><div class="table_td_item">{{$overhead->overhead_code}}</div></td>
					<td>
						<div class="order_block">
							<div class="order_block_item">
								<h5>ФИО</h5>
								<p>{{$overhead->from_name}}</p>
							</div>
							<div class="order_block_item">
								<h5>Компания</h5>
								<p class="order_company">{{$overhead->from_company}}</p>
							</div>
							<div class="order_block_item">
								<h5>Город</h5>
								@if(strlen($overhead->from_city) > 2)
								<p>{{$overhead->from_city}}</p>
								@else
								@if(App\Models\City::find($overhead->from_city) != null)
								<p>{{App\Models\City::find($overhead->from_city)->city_name}}</p>
								@else
								<p>Не правильно указан</p>
								@endif

								@endif
							</div>
							<div class="order_block_item">
								<h5>Телефон</h5>
								<p>{{$overhead->from_phone}}</p>
							</div>
							<div class="order_block_item">
								<h5>Адрес</h5>
								<p>{{$overhead->from_address}}</p>
							</div>
						</div>
					</td>
					<td>
						<div class="order_block">
							<div class="order_block_item">
								<h5>ФИО</h5>
								<p>{{$overhead->to_name}}</p>
							</div>
							<div class="order_block_item">
								<h5>Компания</h5>
								<p>{{$overhead->to_company}}</p>
							</div>
							<div class="order_block_item">
								<h5>Город</h5>
								@if(strlen($overhead->to_city) > 2)
								<p>{{$overhead->to_city}}</p>
								@else
								@if(App\Models\City::find($overhead->to_city) != null)
								<p>{{App\Models\City::find($overhead->to_city)->city_name}}</p>
								@else
								<p>Не правильно указан</p>
								@endif

								@endif
							</div>
							<div class="order_block_item">
								<h5>Телефон</h5>
								<p>{{$overhead->to_phone}}</p>
							</div>
							<div class="order_block_item">
								<h5>Адрес</h5>
								<p>{{$overhead->to_address}}</p>
							</div>
						</div>
					</td>
					<td>
						<div class="order_block">
							<div class="order_block_item">
								<h5 class="other_order">Тип</h5>
								<p>{{$overhead->type}}</p>
							</div>
							<div class="order_block_item">
								<h5 class="other_order">Срочность</h5>
								<p>{{$overhead->speed}}</p>
							</div>
							<div class="order_block_item">
								<h5 class="other_order">Оплата</h5>
								<p class="order_payment">{{$overhead->payment}}</p>
							</div>
							<div class="order_block_item transit-details">
								<h5 class="other_order">Тип оплаты</h5>
								<p class="order_payment_type">{{$overhead->payment_type}}</p>
							</div>
						</div>
					</td>
					<td>
						<div class="table_td_item">
							<div class="transit-desc">
								{{$overhead->description}}
							</div>
						</div>
					</td>
					<td>
						<div class="table_td_item">
							<div class="transit-desc">
								{{$overhead->price}}
							</div>
						</div>
					</td>
					<td>
						<div class="table_td_item">
							<div class="transit-actions" style="display:flex;flex-direction:column;align-items: center;">
								<a href="{{route('admin.overheads.show')}}?overhead_id={{$overhead->id}}" class="">
									<i class="fas fa-eye"></i>
								</a>
								<a href="{{route('admin.overheads.edit1')}}?overhead_id={{$overhead->id}}" class="">
									<i class="fas fa-edit"></i>
								</a>
								<a class="print_code" href="#"
                                   data="{{$overhead->overhead_code}}"
                                   data-id="{{$overhead->id}}">
									<i class="fas fa-print"></i>
								</a>
								<a class="finish_code" href="{{route('admin.overheads.setStatusFinish')}}?id={{$overhead->id}}"
                                   data="{{$overhead->overhead_code}}"
                                   data-id="{{$overhead->id}}">
									<i class="fas fa-flag-checkered"></i>
								</a>
{{--								<a href="#" data-id="{{$overhead->id}}"--}}
{{--								   class="editStatus"--}}
{{--								   data-toggle="modal" data-target="#exampleModalLong2">--}}
{{--									<i class="fas fa-spinner"></i>--}}
{{--								</a>--}}
							</div>
						</div>
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>

		</table>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1"
         role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Добавить маршрут</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="count">Выберите количество штрих кодов</label>
                        <input type="text" name="count" id="count" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeBtn">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="saveBtn">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
	<!-- Modal -->
    <div class="modal fade" id="exampleModalLong2" tabindex="-1"
         role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Сменить статус</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<form action="{{route('admin.overheads.editStatus')}}" method="get">
                <div class="modal-body">
					<input type="hidden" name="overhead_id" id="overhead_id">
						<div class="form-group">
							<label for="status">Выберите статус</label>
							<select class="form-control" name="status" id="status">
								@if(isset($statuses))
									@foreach($statuses as $status)
								<option value="{{$status->id}}">{{$status->status_name}}</option>
									@endforeach
								@endif
							</select>
						</div>
						<div class="form-group">
							<label for="city">Город</label>
							<select name="city" id="city" class="form-control">
									<option value="0">Выберите город</option>
									<optgroup label="1-ая зона">
										<option value="1">Нур-Султан</option>
										<option value="2">Караганда</option>
										<option value="3">Петропавловск</option>
										<option value="4">Павлодар</option>
										<option value="5">Костанай</option>
										<option value="6">Кокшетау</option>
										<option value="7">Усть-Каменегорск</option>
										<option value="8">Семей</option>
										<option value="9">Кызылорда</option>
										<option value="10">Шымкент</option>
										<option value="11">Тараз</option>
										<option value="12">Атырау</option>
										<option value="13">Актау</option>
										<option value="14">Актобе</option>
										<option value="15">Уральск</option>
										<option value="16">Талдыкорган</option>
									</optgroup>
									<optgroup label="2-ая зона">
										<option value="17">Аксай</option>
										<option value="18">Балхаш</option>
										<option value="19">Жанаозен</option>
										<option value="20">Екибастуз</option>
										<option value="21">Аксу</option>
										<option value="22">Риддер</option>
										<option value="23">Рудный</option>
										<option value="24">Жезказган</option>
										<option value="25">Сатбаев</option>
										<option value="26">Темиртау</option>
										<option value="27">Туркестан</option>
										<option value="28">Талгар</option>
										<option value="29">Каскелен</option>
									</optgroup>
									<optgroup label="3-яя зона">
										<option value="30">Другое</option>
									</optgroup>
									<optgroup label="0-ая зона">
										<option value="31">Алматы</option>
									</optgroup>
								</select>
						</div>
						<div class="form-group">
							<label for="description">Примечание</label>
							<textarea class="form-control" name="description" id="description">
							</textarea>
						</div>
						<div class="form-group fv-plugins-icon-container">
							<label for="date_status">По дате:</label>
							<div class="input-group date">
								<input type="text" placeholder="Дата доставки"
									   name="date_status"
									   autocomplete="off" class="form-control" id="date_status">
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="la la-calendar"></i>
									</span>
								</div>
							</div><i data-field="date_status" class="fv-plugins-icon"></i>

							<div class="fv-plugins-message-container"></div>
					</div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeBtn">Закрыть</button>
                    <button type="submit" class="btn btn-primary" id="saveBtn">Сохранить</button>
                </div>
				</form>
            </div>
        </div>
    </div>

    <div id="printCode2">
        <svg id="barcode"></svg>
    </div>
    <div id="printNakl" style="width:800px;margin-bottom:20px;display: none;">
        <style>
            #printNakl h4,#printNakl h5,#printNakl h6,#printNakl p,#printNakl span,#printNakl td, #printNakl div{font-size: 6px;margin: 0;}
            .printFrom, .printTo{
                width: 49%;
            }
            #printNakl h4{
                font-size: 8px;
            }
            .fio, .company, .city, .address, .fromPhone{
                border-bottom: 1px solid black;
                display: flex;
                align-items: center;
                font-size: 8px;
                height: 15px;
            }
            .printFrom h5, .printTo h5{
                margin: 5px 0;
                font-size: 8px;
                /*padding-left: 5px;*/
            }
            /*.printFrom p, .printTo p{*/
            /*    margin: 5px 0;*/
            /*    border-bottom: 1px solid black;*/
            /*}*/
            .checks{
                display: flex;
                align-items: center;
                padding-left: 5px;
                font-size: 8px;
            }
            .checks p{
                margin: 0 0 0 2px;
                font-size: 8px;
            }
            .detail_item{
                width: 33%;
                font-size: 8px;
            }
            .detail_item h5{
                margin: 5px;
                font-size: 6px;
            }
            .courier_area table td{
                width: 33%;
                height: 50px;
                font-size: 8px;
            }
            .cou-row{
                display: flex;
            }
            .courier_area{
                width: 49%;
            }
            .courier_area_item{
                display: flex;
                flex-direction: column;
                border:1px solid black;
            }
            .cou-row{
                display: flex;
            }
            .cou_row_item{
                border: 1px solid black;
                width: 33%;
                height: 27px;
                font-size: 9px;
            }
            .cou_row_item2{
                border: 1px solid black;
                width: 33%;
                height: 20px;
                font-size: 9px;
            }
        </style>
        <div class="printNaklHeader" style="display: flex;">
            <div class="printNaklTitle" style="width: 50%;display: flex;align-items:center;">
                <div style="padding: 0;">Транспортная накладная:</div>
                <div style="padding: 0;" id="naklNumber"></div>
                <div>
                    <svg id="barcode"></svg>
                </div>
            </div>
            <div class="printNaklDateAndInfo" style="width: 50%;display: flex;">
                <div class="printNaklDate" style="border: 1px solid black;display: flex;align-items: center;padding-left: 2px; height: 20px;width: 37%;font-size:8px;margin-left:2%;">Дата:</div>
                <div class="printNaklLogoAndTel" style="display: flex; flex-direction: column;margin-left: 15px;width: 57%;position:relative;">
                    <div class="photo" style="display: flex;">
                        <p style="width: 160px;margin: 0 0 0 10px;font-size:8px;">Postal Service</p>
                    </div>
                    <div class="phone44" style="position: absolute;
                                        right: 65px;
                                        top: 15px;">
                        <p style="margin:0;font-size:8px;">+7 707 342 42 99</p>
                        <p style="margin:0;font-size:8px;">info@postalserivce.kz</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="printNaklPersonInfo" style="display: flex;">
            <div class="printFrom" style="margin-right: 2%;">
                <h5 style="font-size: 12px;margin: 2px;">Отправитель:</h5>
                <div style="border: 1px solid black;padding: 2px 0 0 5px;">
                    <div class="fio">
                        <h5 style="font-size:14px;">Фамилия</h5>
                        <p style="font-size:14px;font-weight: bold;margin-left: 10px;"></p>
                    </div>
                    <div class="company">
                        <h5 style="font-size:14px;">Компания</h5>
                        <p style="font-size:14px;font-weight: bold;margin-left: 10px;"></p>
                    </div>
                    <div class="city">
                        <h5 style="font-size:14px;">Город</h5>
                        <p style="font-size:14px;font-weight: bold;margin-left: 10px;"></p>
                    </div>
                    <div class="address">
                        <h5 style="font-size:14px;">Адрес</h5>
                        <p style="font-size:14px;font-weight: bold;margin-left: 10px;"></p>
                    </div>
                    <div class="fromPhone">
                        <h5 style="font-size:14px;">Телефон</h5>
                        <p style="font-size:14px;font-weight: bold;margin-left: 10px;"></p>
                    </div>
                </div>
            </div>
            <div class="printTo">
                <h5 style="font-size: 12px;margin: 2px;">Получатель:</h5>
                <div style="border: 1px solid black;padding: 2px 0 0 5px;">
                    <div class="fio" style="display: flex;">
                        <h5 style="font-size:14px;">Фамилия</h5>
                        <p style="font-size:14px;font-weight: bold;margin-left: 10px;"></p>
                    </div>
                    <div class="company">
                        <h5 style="font-size:14px;">Компания</h5>
                        <p style="font-size:14px;font-weight: bold;margin-left: 10px;"></p>
                    </div>
                    <div class="city">
                        <h5 style="font-size:14px;">Город</h5>
                        <p style="font-size:14px;font-weight: bold;margin-left: 10px;"></p>
                    </div>
                    <div class="address" style="height: auto;">
                        <h5 style="font-size:14px;margin-top: 0;margin-bottom: 0;">Адрес</h5>
                        <p style="font-size:10px;font-weight: bold;margin-left: 10px;margin-top: 0;margin-bottom: 0;line-height: 1">

                        </p>
                    </div>
                    <div class="fromPhone">
                        <h5 style="font-size:14px;">Телефон</h5>
                        <p style="font-size:14px;font-weight: bold;margin-left: 10px;"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="printNaklDetail" style="display: flex;flex-direction: column;">
            <h4 style="margin: 2px;font-size:12px;">
                Детали накладной
            </h4>
            <div style="display: flex;border: 1px solid black;">
                <div style="display: flex;width: 50%;border-right: 1px solid black;">
                    <div class="detail_item" style="border-right: 1px solid black; width: 30%;">
                        <h5 style="margin: 3px;font-size:8px;">Тип отправлений</h5>
                        <div class="checks">
                            <div style="border: 1px solid black; width: 8px;height: 8px;display:flex;align-items:center;text-align:center;font-size: 12px;" id="document11"></div>
                            <p style="font-size:10px;">Документы</p>
                        </div>
                        <div class="checks">
                            <div style="border: 1px solid black; width: 8px;height: 8px;display:flex;align-items:center;text-align:center;font-size: 12px;" id="document12"></div>
                            <p style="font-size:10px;">Посылка</p>
                        </div>
                    </div>
                    <div class="detail_item" style="border-right: 1px solid black;width: 30%;">
                        <h5 style="margin: 5px;font-size:10px;">Срочность</h5>
                        <div class="checks">
                            <div style="border: 1px solid black; width: 8px;height: 8px;display:flex;align-items:center;text-align:center;font-size: 12px;" id="document13"></div>
                            <p style="font-size:10px;">Экспресс</p>
                        </div>
                        <div class="checks">
                            <div style="border: 1px solid black; width: 8px;height: 8px;display:flex;align-items:center;text-align:center;font-size: 12px;" id="document14"></div>
                            <p style="font-size:10px;">Стандарт</p>
                        </div>
                        <div class="checks">
                            <div style="border: 1px solid black; width: 8px;height: 8px;display:flex;align-items:center;text-align:center;font-size: 12px;" id="document15"></div>
                            <p style="font-size:10px;">Авто</p>
                        </div>
                    </div>
                    <div class="detail_item" style="width: 40%;">
                        <h5 style="margin: 5px;font-size: 10px;">Оплата</h5>
                        <div class="checks">
                            <div style="border: 1px solid black; width: 8px;height: 8px;display:flex;align-items:center;text-align:center;font-size: 12px;" id="document16"></div>
                            <p style="font-size:10px;">Отправителем</p>
                        </div>
                        <div class="checks">
                            <div style="border: 1px solid black; width: 8px;height: 8px;display:flex;align-items:center;text-align:center;font-size: 12px;" id="document17"></div>
                            <p style="font-size:10px;">Получателем</p>
                        </div>
                        <div class="checks">
                            <div style="border: 1px solid black; width: 8px;height: 8px;display:flex;align-items:center;text-align:center;font-size: 12px;" id="document18"></div>
                            <p style="font-size:10px;">Третьей стороной</p>
                        </div>
                    </div>
                </div>
                <div style="display: flex; flex-direction: column; width: 50%;">
                    <div style="display: flex;">
                        <div style="border-right: 1px solid black;width: 40%;">
                            <h5 style="margin: 5px;font-size:10px;">Способ оплаты</h5>
                            <div class="checks">
                                <div style="border: 1px solid black; width: 8px;height: 8px;display:flex;align-items:center;text-align:center;font-size: 12px;" id="document19"></div>
                                <p style="font-size:10px;">По счету</p>
                            </div>
                            <div class="checks">
                                <div style="border: 1px solid black; width: 8px;height: 8px;display:flex;align-items:center;text-align:center;font-size: 12px;" id="document110"></div>
                                <p style="font-size:10px;">Наличными</p>
                            </div>
                            <div class="checks">
                                <div style="border: 1px solid black; width: 8px;height: 8px;display:flex;align-items:center;text-align:center;font-size: 12px;" id="document111"></div>
                                <p style="font-size:10px;">Терминалом</p>
                            </div>
                        </div>
                        <div class="primechanya">
                            <div style="border-bottom: 1px solid black;" class="prim">
                                <h5 style="margin: 5px;font-size:10px;">Примечания</h5>
                                <div class="prim_desc" style="font-size: 10px;"></div>
                            </div>
                            <div>
                                <p class="rights" style="margin: 0;font-size: 8px;padding-left: 5px;">Я подтверждаю, что отправление не содержит запрещенных вложений к пересылке. С правилами пересылки ознакомлен и согласен</p>
                                <p style="margin: 0;font-size:8px;text-align: right;padding-right: 5px;">__________</p>
                                <p style="margin: 0;font-size: 8px;text-align: right;padding-right: 5px;">Подпись</p>
                            </div>
                        </div>
                    </div>
                    <div style="font-size: 8px;
                        /* padding: 5px; */
                        height: 12px;
                        display: flex;
                        border-top: 1px solid black;
                        align-items: center;">
                        Наименование 3 стороны
                    </div>
                </div>
            </div>
        </div>
        <div class="printNaklCourier" style="display: flex;">
            <div class="courier_area" style="margin-right: 2%;">
                <h4 style="margin: 2px;font-size:12px;">Заполняется курьером</h4>
                <div class="courier_area_item">
                    <div class="cou-row">
                        <div class="cou_row_item">
                            <div>Общий вес<span>(кг)</span></div>
                            <div class="cou_row_item_value"></div>
                        </div>
                        <div class="cou_row_item">
                            <div>Тариф<span>(тг)</span></div>
                            <div class="cou_row_item_value"></div>
                        </div>
                        <div class="cou_row_item" style="width: 35%;">
                            <div>Дополнительные услуги<span>(тг)</span></div>
                            <div class="cou_row_item_value"></div>
                        </div>
                    </div>
                    <div class="cou-row">
                        <div class="cou_row_item">
                            Объемный вес<span>(кг)</span>
                            <div class="cou_row_item_value"></div>
                        </div>
                        <div class="cou_row_item">
                            Объявленная ценность<span>(тг)</span>
                            <div class="cou_row_item_value"></div>
                        </div>
                        <div class="cou_row_item" style="width: 35%;">
                            Итог<span>(тг)</span>
                            <div class="cou_row_item_value"></div>
                        </div>
                    </div>
                    <div class="cou-row">
                        <div class="cou_row_item">
                            Кол-во мест<span>(шт)</span>
                            <div class="cou_row_item_value count_overhead"></div>
                        </div>
                        <div class="cou_row_item" style="width: 68%;">
                            Фамилия и подпись курьера
                            <div class="cou_row_item_value"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="courier_area" style="">
                <h4 style="margin: 2px;font-size:12px;">Детали доставки</h4>
                <div class="courier_area_item">
                    <div class="cou-row">
                        <div class="cou_row_item2">Первая попытка</div>
                        <div class="cou_row_item2" style="width: 67%;">Фамилия</div>
                    </div>
                    <div class="cou-row">
                        <div class="cou_row_item2">Вторая попытка</div>
                        <div class="cou_row_item2" style="width: 67%;">Должность или ИИН</div>
                    </div>
                    <div class="cou-row">
                        <div class="cou_row_item2">
                            Дата/Время
                        </div>
                        <div class="cou_row_item2" style="width: 67%;">
                            Подпись получателя
                        </div>
                    </div>
                    <div class="cou-row">
                        <div class="cou_row_item2" style="width: 100%;font-size: 8px;">Я подтверждаю, что отправление доставлено без повреждений упаковки.Вес соответствует весу при приеме.Претензий не имею.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="font-size:12px;border-bottom: 1px dashed black;text-align:center;">POSTAL SERVICE</div>
    </div>
@endsection
@section('admin-script')
    <script>
		$('.editStatus').click(function(e){
			e.preventDefault();
			$('#overhead_id').val($(this).attr('data-id'));
		});



		$('#date_status').datepicker({
            orientation: "bottom auto",
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,
        });
        $('#date_s').datepicker({
            orientation: "bottom auto",
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,
        });

        let overhead_code = "";
        let overhead_id = "";
        $('.print_code').click(function (e){
            e.preventDefault();
            //overhead_code = $(this).attr('data');
            overhead_id = $(this).attr('data-id');
            console.log(overhead_id);

            $.ajax({
                url: "{{route('api.overhead.get')}}",
                method: "GET",
                data: {overhead_id: overhead_id},
                success: function (result){
                   // console.log(result);
                    let res = JSON.parse(result);
                    printOverhead555(res);
                    console.log(res);
                },
                error: function (error){},
            });

            // JsBarcode("#barcode", overhead_code);
            // console.log(overhead_code);
            // let data = document.getElementById('printCode2');
            // // let data = document.getElementsByClassName('codes')[0];
            // Popup(data);
            // window.location.reload();
        });
        function printOverhead555(res){
            let document1 = res.overhead.type;
            let document2 = res.overhead.speed;
            let document3 = res.overhead.payment;
            let document4 = res.overhead.payment_type;

            let prim = res.overhead.description;


            let printFrom = $('.printFrom');
            let printTo = $('.printTo');
            printFrom.find('.fio p').text(res.overhead.from_name);
            printFrom.find('.company p').text(res.overhead.from_company);
            printFrom.find('.city p').text(res.overhead.from_city);
            printFrom.find('.address p').text(res.overhead.from_address);
            printFrom.find('.fromPhone p').text(res.overhead.from_phone);
            printTo.find('.fio p').text(res.overhead.to_name);
            printTo.find('.company p').text(res.overhead.to_company);
            printTo.find('.city p').text(res.overhead.to_city);
            printTo.find('.address p').text(res.overhead.to_address);
            printTo.find('.fromPhone p').text(res.overhead.to_phone);
            $('#printNakl .count_overhead').text(res.overhead.place);

            $('.prim_desc').append(prim);

            if (document1 === 'Документы'){
                $('#document11').text('x'); // Документы
            }
            if (document1 === 'Посылка'){
                $('#document12').text('x'); // Посылка
            }
            if (document2 === 'Экспресс'){
                $('#document13').text('x'); // Экспресс
            }
            if (document2 === 'Стандарт'){
                $('#document14').text('x'); // Стандарт
            }
            if (document2 === 'Авто'){
                $('#document15').text('x');  // Авто
            }
            if (document3 === 'Отправителем'){
                $('#document16').text('x'); // Отправителем
            }
            if (document3 === 'Получателем'){
                $('#document17').text('x'); // Получателем
            }
            if (document3 === 'Третьей стороной'){
                $('#document18').text('x'); // Третьей стороной
            }
            if (document4 === 'По счету'){
                $('#document19').text('x'); // По счету
            }
            if (document4 === 'Наличными'){
                $('#document110').text('x');// Наличными
            }
            if (document4 === 'Терминалом'){
                $('#document111').text('x');// Терминалом
            }
            $('#naklNumber').text(res.overhead.overhead_code);
            JsBarcode("#barcode", res.overhead.overhead_code, {
                height: 15,
                displayValue: false
            });

            let prtContent = document.getElementById('printNakl');
            Popup(prtContent);
            prtContent = null;
            // evalPrint2(prtContent);
            // evalContent(prtContent);
            // location.reload();
        }
        function Popup(data) {
            let mywindow = window.open('','','left=50,top=50,width=860,height=2000,toolbar=0,scrollbars=1,status=0');

            mywindow.document.write('<div class="printNakl" style="width:800px;margin-bottom:20px;">');
            mywindow.document.write(data.innerHTML);
            mywindow.document.write('</div>');
            mywindow.document.write('<div class="printNakl" style="width:800px;margin-bottom:20px;">');
            mywindow.document.write(data.innerHTML);
            mywindow.document.write('</div>');
            mywindow.document.write('<div class="printNakl" style="width:800px;margin-bottom:20px;">');
            mywindow.document.write(data.innerHTML);
            mywindow.document.write('</div>');

            mywindow.focus();
            mywindow.document.close();
            mywindow.print();mywindow.close();

            return true;
        }

        $('#closeBtn').click(function (){
            $('#printCode2').empty();
        });


		$('#from_date').datepicker({
			orientation: "bottom auto",
			autoclose: true,
			format: 'yyyy-mm-dd',
			todayBtn: true,
			todayHighlight: true,

		});
		$('#to_date').datepicker({
			orientation: "bottom auto",
			autoclose: true,
			format: 'yyyy-mm-dd',
			todayBtn: true,
			todayHighlight: true,

		});
        $('#from_date2').datepicker({
            orientation: "bottom auto",
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,

        });
        $('#to_date2').datepicker({
            orientation: "bottom auto",
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,

        });
		

    </script>
@endsection
