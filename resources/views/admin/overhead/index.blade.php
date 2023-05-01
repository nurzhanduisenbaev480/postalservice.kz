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
            font-size: 14px;
            width: 28%;
            border-right: 1px solid #e7e7e7;
            margin-bottom: 0;
            margin-left: 4px;
        }
        .order_block_item p{
            margin-left: 4px;
            font-size: 13px;
            margin-bottom: 0;
        }
        .table td{
            padding: 0;
        }
        .table_td_item{
            margin: 15px 5px 0 5px;
            overflow-wrap: break-word;
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
		</div>
        <form action="#" method="get">
            <fieldset class="border">
                <legend class="w-auto">Фильтр</legend>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>По компаний</label>
                                <input name="company_search" type="text" id="order_company_search" placeholder="Имя компаний" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group fv-plugins-icon-container">
                                <label for="date_s">По дате:</label>
                                <div class="input-group date">
                                    <input type="text" placeholder="Дата отправки"
                                           name="date_s"
                                           autocomplete="off" class="form-control" id="date_s">
                                    <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-calendar"></i>
                                            </span>
                                    </div>
                                </div><i data-field="date_s" class="fv-plugins-icon"></i>

                                <div class="fv-plugins-message-container"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>По оплате</label>
                                <select name="payment_search" class="form-control" id="payment_search">
                                    <option class="Все">Все</option>
                                    <option value="Отправителем">Отправителем</option>
                                    <option value="Получателем">Получателем</option>
                                    <option value="Третьей стороной">Третьей стороной</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>По типу оплаты</label>
                                <select name="payment_search_type" class="form-control" id="payment_search_type">
                                    <option class="Все">Все</option>
                                    <option value="По счету">По счету</option>
                                    <option value="Наличными">Наличными</option>
                                    <option value="Терминалом">Терминалом</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="submit" name="searchRow" class="btn btn-primary" id="searchRow">
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <div class="mx-auto col-lg-12">
        <div class="card">
            <div class="card-body" style="padding: 0;">
                <div class="container-fluid" style="padding: 0;height:800px;overflow-y:scroll;">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover mt-2">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width: 110px;">Код Заявки</th>
                                    <th style="width: 240px;">Отправитель</th>
                                    <th style="width: 240px;">Получатель</th>
                                    <th>Детали</th>
                                    <th>Комментарий</th>
                                    <th style="width: 50px;">Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($overheads))
									@php $index=0;@endphp
                                    @foreach($overheads as $overhead)
									@php $index++;@endphp
										@if($overhead->status_id == 1)
										<tr class="table-success">
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
                                                    <div class="order_block_item">
                                                        <h5 class="other_order">Тип оплаты</h5>
                                                        <p class="order_payment_type">{{$overhead->payment_type}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><div class="table_td_item">{{$overhead->description}}</div></td>
                                            <td>
                                                <div class="table_td_item">
                                                    <ul style="list-style: none;padding: 0;" class="order_action">

                                                        <li class="order_action_item">
                                                            <a href="{{route('admin.overheads.show')}}?overhead_id={{$overhead->id}}" 
															   class="btn btn-primary btn-sm">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </li>
														<li class="order_action_item">
                                                            <a href="{{route('admin.overheads.edit1')}}?overhead_id={{$overhead->id}}" 
															   class="btn btn-primary btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </li>
                                                        <li class="order_action_item">
                                                            <a href="#" class="btn btn-primary  btn-sm print_code" 
															   data="{{$overhead->overhead_code}}">
{{--                                                               data="{{$overhead->overhead_code}}"--}}
{{--                                                               data-toggle="modal" data-target="#exampleModalLong"--}}
{{--                                                            >--}}
                                                                <i class="fas fa-print"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
													<ul style="list-style: none;padding: 0;" class="order_action">
															<li class="order_action_item">
																<a href="#" data-id="{{$overhead->id}}"
																   class="btn btn-primary btn-sm editStatus" 
																   data-toggle="modal" data-target="#exampleModalLong{{$overhead->id}}">
																	Сменить статус
																</a>
																<!-- Modal -->
																<div class="modal fade" id="exampleModalLong{{$overhead->id}}" 
																	 tabindex="-1"
																	 role="dialog" aria-labelledby="exampleModalLongTitle{{$overhead->id}}"
																	 aria-hidden="true">
																	<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-header">
																				<h5 class="modal-title" 
																					id="exampleModalLongTitle{{$overhead->id}}">
																					Сменить статус
																				</h5>
																				<button type="button" class="close" data-dismiss="modal" 
																						aria-label="Close">
																					<span aria-hidden="true" style="display:block;">&times;</span>
																				</button>
																			</div>
																			<form action="{{route('admin.overheads.editStatus')}}" 
																				  method="get">
																				<div class="modal-body">
																					<input type="hidden" name="overhead_id" 
																						   id="overhead_id" value="{{$overhead->id}}">
																					<div class="form-group">
																						<label for="status">Выберите статус</label>
																						<select class="form-control" name="status" 
																								id="status">
																							@if(isset($statuses))
																							@foreach($statuses as $status)
																							<option value="{{$status->id}}">
																								{{$status->status_name}}
																							</option>
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
																						<textarea class="form-control" name="description" 
																								  id="description">
																							{{$overhead->description}}
																						</textarea>
																					</div>
																					<div class="form-group fv-plugins-icon-container">
																						<label for="date_status">По дате:</label>
																						<div class="input-group date">
																							<input type="text" placeholder="Дата доставки"
																								   name="date_status"
																								   autocomplete="off" class="form-control" 
																								   id="date_status">
																							<div class="input-group-append">
																								<span class="input-group-text">
																									<i class="la la-calendar"></i>
																								</span>
																							</div>
																						</div><i data-field="date_status" 
																								 class="fv-plugins-icon"></i>

																						<div class="fv-plugins-message-container"></div>
																					</div>

																				</div>
																				<div class="modal-footer">
																					
																					<button type="submit" class="btn btn-primary" 
																							id="saveBtn">Сохранить</button>
																				</div>
																			</form>
																		</div>
																	</div>
																</div>
															</li>
														</ul>
                                                </div>
                                            </td>
                                        </tr>
									@endif
									@if($overhead->status_id == 2)
									<tr class="table-info">
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
                                                    <div class="order_block_item">
                                                        <h5 class="other_order">Тип оплаты</h5>
                                                        <p class="order_payment_type">{{$overhead->payment_type}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><div class="table_td_item">{{$overhead->description}}</div></td>
                                            <td>
                                                <div class="table_td_item">
                                                    <ul style="list-style: none;padding: 0;" class="order_action">

                                                        <li class="order_action_item">
                                                            <a href="{{route('admin.overheads.show')}}?overhead_id={{$overhead->id}}" 
															   class="btn btn-primary btn-sm">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </li>
														<li class="order_action_item">
                                                            <a href="{{route('admin.overheads.edit1')}}?overhead_id={{$overhead->id}}" 
															   class="btn btn-primary btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </li>
                                                        <li class="order_action_item">
                                                            <a href="#" class="btn btn-primary  btn-sm print_code" 
															   data="{{$overhead->overhead_code}}">
{{--                                                               data="{{$overhead->overhead_code}}"--}}
{{--                                                               data-toggle="modal" data-target="#exampleModalLong"--}}
{{--                                                            >--}}
                                                                <i class="fas fa-print"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
													<ul style="list-style: none;padding: 0;" class="order_action">
															<li class="order_action_item">
																<a href="#" data-id="{{$overhead->id}}"
																   class="btn btn-primary btn-sm editStatus" 
																   data-toggle="modal" data-target="#exampleModalLong{{$overhead->id}}">
																	Сменить статус
																</a>
																<!-- Modal -->
																<div class="modal fade" id="exampleModalLong{{$overhead->id}}" 
																	 tabindex="-1"
																	 role="dialog" aria-labelledby="exampleModalLongTitle{{$overhead->id}}"
																	 aria-hidden="true">
																	<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-header">
																				<h5 class="modal-title" 
																					id="exampleModalLongTitle{{$overhead->id}}">
																					Сменить статус
																				</h5>
																				<button type="button" class="close" data-dismiss="modal" 
																						aria-label="Close">
																					<span aria-hidden="true" style="display:block;">&times;</span>
																				</button>
																			</div>
																			<form action="{{route('admin.overheads.editStatus')}}" 
																				  method="get">
																				<div class="modal-body">
																					<input type="hidden" name="overhead_id" 
																						   id="overhead_id" value="{{$overhead->id}}">
																					<div class="form-group">
																						<label for="status">Выберите статус</label>
																						<select class="form-control" name="status" 
																								id="status">
																							@if(isset($statuses))
																							@foreach($statuses as $status)
																							<option value="{{$status->id}}">
																								{{$status->status_name}}
																							</option>
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
																						<textarea class="form-control" name="description" 
																								  id="description">
																							{{$overhead->description}}
																						</textarea>
																					</div>
																					<div class="form-group fv-plugins-icon-container">
																						<label for="date_status">По дате:</label>
																						<div class="input-group date">
																							<input type="text" placeholder="Дата доставки"
																								   name="date_status"
																								   autocomplete="off" class="form-control" 
																								   id="date_status">
																							<div class="input-group-append">
																								<span class="input-group-text">
																									<i class="la la-calendar"></i>
																								</span>
																							</div>
																						</div><i data-field="date_status" 
																								 class="fv-plugins-icon"></i>

																						<div class="fv-plugins-message-container"></div>
																					</div>

																				</div>
																				<div class="modal-footer">
																					
																					<button type="submit" class="btn btn-primary" 
																							id="saveBtn">Сохранить</button>
																				</div>
																			</form>
																		</div>
																	</div>
																</div>
															</li>
														</ul>
                                                </div>
                                            </td>
                                        </tr>
									@endif
									@if($overhead->status_id == 3)
									<tr class="table-danger">
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
                                                    <div class="order_block_item">
                                                        <h5 class="other_order">Тип оплаты</h5>
                                                        <p class="order_payment_type">{{$overhead->payment_type}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><div class="table_td_item">{{$overhead->description}}</div></td>
                                            <td>
                                                <div class="table_td_item">
                                                    <ul style="list-style: none;padding: 0;" class="order_action">

                                                        <li class="order_action_item">
                                                            <a href="{{route('admin.overheads.show')}}?overhead_id={{$overhead->id}}" 
															   class="btn btn-primary btn-sm">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </li>
														<li class="order_action_item">
                                                            <a href="{{route('admin.overheads.edit1')}}?overhead_id={{$overhead->id}}" 
															   class="btn btn-primary btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </li>
                                                        <li class="order_action_item">
                                                            <a href="#" class="btn btn-primary  btn-sm print_code" 
															   data="{{$overhead->overhead_code}}">
{{--                                                               data="{{$overhead->overhead_code}}"--}}
{{--                                                               data-toggle="modal" data-target="#exampleModalLong"--}}
{{--                                                            >--}}
                                                                <i class="fas fa-print"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
													<ul style="list-style: none;padding: 0;" class="order_action">
															<li class="order_action_item">
																<a href="#" data-id="{{$overhead->id}}"
																   class="btn btn-primary btn-sm editStatus" 
																   data-toggle="modal" data-target="#exampleModalLong{{$overhead->id}}">
																	Сменить статус
																</a>
																<!-- Modal -->
																<div class="modal fade" id="exampleModalLong{{$overhead->id}}" 
																	 tabindex="-1"
																	 role="dialog" aria-labelledby="exampleModalLongTitle{{$overhead->id}}"
																	 aria-hidden="true">
																	<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-header">
																				<h5 class="modal-title" 
																					id="exampleModalLongTitle{{$overhead->id}}">
																					Сменить статус
																				</h5>
																				<button type="button" class="close" data-dismiss="modal" 
																						aria-label="Close">
																					<span aria-hidden="true" style="display:block;">&times;</span>
																				</button>
																			</div>
																			<form action="{{route('admin.overheads.editStatus')}}" 
																				  method="get">
																				<div class="modal-body">
																					<input type="hidden" name="overhead_id" 
																						   id="overhead_id" value="{{$overhead->id}}">
																					<div class="form-group">
																						<label for="status">Выберите статус</label>
																						<select class="form-control" name="status" 
																								id="status">
																							@if(isset($statuses))
																							@foreach($statuses as $status)
																							<option value="{{$status->id}}">
																								{{$status->status_name}}
																							</option>
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
																						<textarea class="form-control" name="description" 
																								  id="description">
																							{{$overhead->description}}
																						</textarea>
																					</div>
																					<div class="form-group fv-plugins-icon-container">
																						<label for="date_status">По дате:</label>
																						<div class="input-group date">
																							<input type="text" placeholder="Дата доставки"
																								   name="date_status"
																								   autocomplete="off" class="form-control" 
																								   id="date_status">
																							<div class="input-group-append">
																								<span class="input-group-text">
																									<i class="la la-calendar"></i>
																								</span>
																							</div>
																						</div><i data-field="date_status" 
																								 class="fv-plugins-icon"></i>

																						<div class="fv-plugins-message-container"></div>
																					</div>

																				</div>
																				<div class="modal-footer">
																					
																					<button type="submit" class="btn btn-primary" 
																							id="saveBtn">Сохранить</button>
																				</div>
																			</form>
																		</div>
																	</div>
																</div>
															</li>
														</ul>
                                                </div>
                                            </td>
                                        </tr>
									@endif
									@if($overhead->status_id == 4)
									<tr class="table-dark">
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
                                                    <div class="order_block_item">
                                                        <h5 class="other_order">Тип оплаты</h5>
                                                        <p class="order_payment_type">{{$overhead->payment_type}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><div class="table_td_item">{{$overhead->description}}</div></td>
                                            <td>
                                                <div class="table_td_item">
                                                    <ul style="list-style: none;padding: 0;" class="order_action">

                                                        <li class="order_action_item">
                                                            <a href="{{route('admin.overheads.show')}}?overhead_id={{$overhead->id}}" 
															   class="btn btn-primary btn-sm">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </li>
														<li class="order_action_item">
                                                            <a href="{{route('admin.overheads.edit1')}}?overhead_id={{$overhead->id}}" 
															   class="btn btn-primary btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </li>
                                                        <li class="order_action_item">
                                                            <a href="#" class="btn btn-primary  btn-sm print_code" 
															   data="{{$overhead->overhead_code}}">
{{--                                                               data="{{$overhead->overhead_code}}"--}}
{{--                                                               data-toggle="modal" data-target="#exampleModalLong"--}}
{{--                                                            >--}}
                                                                <i class="fas fa-print"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
													<ul style="list-style: none;padding: 0;" class="order_action">
															<li class="order_action_item">
																<a href="#" data-id="{{$overhead->id}}"
																   class="btn btn-primary btn-sm editStatus" 
																   data-toggle="modal" data-target="#exampleModalLong{{$overhead->id}}">
																	Сменить статус
																</a>
																<!-- Modal -->
																<div class="modal fade" id="exampleModalLong{{$overhead->id}}" 
																	 tabindex="-1"
																	 role="dialog" aria-labelledby="exampleModalLongTitle{{$overhead->id}}"
																	 aria-hidden="true">
																	<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-header">
																				<h5 class="modal-title" 
																					id="exampleModalLongTitle{{$overhead->id}}">
																					Сменить статус
																				</h5>
																				<button type="button" class="close" data-dismiss="modal" 
																						aria-label="Close">
																					<span aria-hidden="true" style="display:block;">&times;</span>
																				</button>
																			</div>
																			<form action="{{route('admin.overheads.editStatus')}}" 
																				  method="get">
																				<div class="modal-body">
																					<input type="hidden" name="overhead_id" 
																						   id="overhead_id" value="{{$overhead->id}}">
																					<div class="form-group">
																						<label for="status">Выберите статус</label>
																						<select class="form-control" name="status" 
																								id="status">
																							@if(isset($statuses))
																							@foreach($statuses as $status)
																							<option value="{{$status->id}}">
																								{{$status->status_name}}
																							</option>
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
																						<textarea class="form-control" name="description" 
																								  id="description">
																							{{$overhead->description}}
																						</textarea>
																					</div>
																					<div class="form-group fv-plugins-icon-container">
																						<label for="date_status">По дате:</label>
																						<div class="input-group date">
																							<input type="text" placeholder="Дата доставки"
																								   name="date_status"
																								   autocomplete="off" class="form-control" 
																								   id="date_status">
																							<div class="input-group-append">
																								<span class="input-group-text">
																									<i class="la la-calendar"></i>
																								</span>
																							</div>
																						</div><i data-field="date_status" 
																								 class="fv-plugins-icon"></i>

																						<div class="fv-plugins-message-container"></div>
																					</div>

																				</div>
																				<div class="modal-footer">
																					
																					<button type="submit" class="btn btn-primary" 
																							id="saveBtn">Сохранить</button>
																				</div>
																			</form>
																		</div>
																	</div>
																</div>
															</li>
														</ul>
                                                </div>
                                            </td>
                                        </tr>
									@endif
                                    @endforeach
                                @endif
                                </tbody>
								
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


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
	

    <div id="printCode2">
        <svg id="barcode"></svg>
    </div>
@endsection
@section('admin-script')
    <script>
		//$('.editStatus').click(function(e){
			//e.preventDefault();
			//$('#overhead_id').val($(this).attr('data-id'));
		//});
		
		
		
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
        $('.print_code').click(function (e){
            overhead_code = $(this).attr('data');
            console.log(overhead_code);
            JsBarcode("#barcode", overhead_code);
            console.log(overhead_code);
            let data = document.getElementById('printCode2');
            // let data = document.getElementsByClassName('codes')[0];
            Popup(data);
            window.location.reload();
        });
        $('#closeBtn').click(function (){
            $('#printCode2').empty();
        });
        function Popup(data) {
            var mywindow = window.open('','','left=50,top=50,width=860,height=2000,toolbar=1,scrollbars=1,status=1');
            //   mywindow.document.write('<html><head><title></title>');
            //   mywindow.document.write('<link rel="stylesheet" href="css/midday_receipt.css" type="text/css" />');
            //   mywindow.document.write('</head><body >');
            mywindow.document.write('<div class="printNakl">');
            mywindow.document.write(data.innerHTML);
            mywindow.document.write('</div>');

            //   mywindow.document.write('</body></html>');

            mywindow.focus();
            mywindow.document.close();
            mywindow.print();mywindow.close();
            //setTimeout(function(){mywindow.print();mywindow.close();location.reload();},1000);
            mywindow.close();


            return true;
        }




    </script>
@endsection
