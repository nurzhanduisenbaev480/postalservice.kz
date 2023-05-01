@extends('layouts.app')
@section('subheader')
    <!--begin::Subheader-->
    <div class="py-2 subheader py-lg-6 subheader-solid" id="kt_subheader">
        <div class="flex-wrap container-fluid d-flex align-items-center justify-content-between flex-sm-nowrap">
            <!--begin::Info-->
            <div class="flex-wrap mr-1 d-flex align-items-center">
                <!--begin::Page Heading-->
                <div class="flex-wrap mr-5 d-flex align-items-baseline">
                    <!--begin::Page Title-->
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Редактировать накладной</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                   
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
        @if(\Illuminate\Support\Facades\Session::has('message'))
            @if(\Illuminate\Support\Facades\Session::get('message') == 2)
                <div class="alert alert-success">Успешно обновлен </div>
            @else
                <div class="alert alert-danger">Что то пошло не так, пожалуйста обратитесь к администратору</div>
            @endif
            {{\Illuminate\Support\Facades\Session::forget('message')}}
        @endif
		@if(\Illuminate\Support\Facades\Session::has('success'))
           <div class="alert alert-success">Успешно обновлен </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Информация о заявке</h5>
            </div>
            <form class="form-horizontal fv-plugins-bootstrap fv-plugins-framework"
                  action="{{route('admin.overheads.update2')}}"
                  id="kt_form_1"
                  method="POST"
                  enctype="multipart/form-data"
                  novalidate="novalidate">
                @csrf

                <input type="hidden" value="{{$user->id}}" name="user_id">
                <input type="hidden" value="{{$overhead->id}}" name="overhead_id">
                
                <div class="card-body">
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="overhead_code">Номер накладного</label>
								<input id="overhead_code" name="overhead_code" type="text"
									   placeholder="Номер накладного" class="form-control"
									   value="{{$overhead->overhead_code}}">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="status_id">Статус</label>
								<select id="status_id" name="status_id" class="form-control">
									@if(isset($statuses))
									@foreach($statuses as $status)
										@if($overhead->status_id == $status->id)
											<option selected value="{{$status->id}}">{{$status->status_name}}</option>
										@else
											<option value="{{$status->id}}">{{$status->status_name}}</option>
										@endif
									@endforeach
									@endif
								</select>
							</div>
						</div>
					</div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <h3 class="text-left">Отправитель</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="from_name1">Ф.И.О</label>
                                        <input id="from_name1" name="from_name" type="text"
                                               placeholder="Введите Ф.И.О отправителя" class="form-control"
                                               value="{{$overhead->from_name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_company">Компания</label>
                                        <input id="from_company" name="from_company" type="text"
                                               placeholder="Введите название компаний" class="form-control"
                                               value="{{$overhead->from_company}}"
                                        >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_city">Город</label>
                                        <select name="from_city" id="from_city" class="form-control">
                                            @foreach($cities as $city)
												@php //dd($city) @endphp
                                                @if(($overhead->from_city == $city->city_name) || ($overhead->from_city == $city->id))
													@php //dd($city->id)@endphp
                                                    <option selected value="{{$city->id}}">{{$city->city_name}}</option>
                                                @else
                                                    <option value="{{$city->id}}">{{$city->city_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_phone">Телефон</label>
                                        <input id="from_phone" name="from_phone" type="text"
                                               placeholder="Введите телефон" class="form-control"
                                               value="{{$overhead->from_phone}}"
                                        >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_address">Адрес</label>
                                        <input id="from_address" name="from_address" type="text"
                                               placeholder="Введите адрес" class="form-control"
                                               value="{{$overhead->from_address}}"
                                        >
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <h3 class="text-left">Получатель</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="to_name">Ф.И.О</label>
                                        <input id="to_name" name="to_name" type="text"
                                               placeholder="Введите Ф.И.О отправителя" class="form-control"
                                               value="{{$overhead->to_name}}"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="to_company">Компания</label>
                                        <input id="to_company" name="to_company" type="text"
                                               placeholder="Введите название компаний" class="form-control"
                                               value="{{$overhead->to_company}}"
                                        >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="to_city">Город</label>
                                        <select name="to_city" id="to_city" class="form-control">
                                            @foreach($cities as $city)
											@php 
												$cc = $overhead->to_city;
												$pos = strpos($cc, ':');
												//$cname = $city->city_name;
												if($pos !== false){
												//echo $pos;
													$str = substr($cc, $pos+1, strlen($cc));
												//echo trim($str);
													$cc = trim($str);
													//echo $city->city_name;
												}else{
													$cc = $overhead->to_city;
												}
											@endphp
                                                @if(($cc == $city->city_name) || ($cc == $city->id))
                                                    <option selected value="{{$city->id}}">{{$city->city_name}}</option>
                                                @else
                                                    <option value="{{$city->id}}">{{$city->city_name}}</option>
                                                @endif
                                            @endforeach
											</select>
											@if($overhead->to_city == 31 
												|| $overhead->to_city == "Алматы" 
												|| $overhead->to_city == "0-ая зона: Алматы")
											<label for="sub_zone" class="mt-3">Суб зона</label>
											<select class="form-control" id="sub_zone" name="sub_zone">
												@if(isset($overhead->sub_zone))
													@if($overhead->sub_zone == "A")
														<option value="A" selected>A</option>
														<option value="B">B</option>
														<option value="C">C</option>
													@elseif($overhead->sub_zone == "B")
														<option value="A">A</option>
														<option value="B" selected>B</option>
														<option value="C">C</option>
													@else
														<option value="A">A</option>
														<option value="B">B</option>
														<option value="C" selected>C</option>
													@endif
												@else
													<option value="A" selected>A</option>
													<option value="B">B</option>
													<option value="C">C</option>
												@endif												
											</select>
											@endif
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="to_phone">Телефон</label>
                                        <input id="to_phone" name="to_phone" type="text"
                                               placeholder="Введите телефон" class="form-control"
                                               value="{{$overhead->to_phone}}"
                                        >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="to_address">Адрес</label>
                                        <input id="to_address" name="to_address" type="text"
                                               placeholder="Введите адрес" class="form-control"
                                               value="{{$overhead->to_address}}"
                                        >
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <h3 class="text-left">Детали заявки</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Тип отправления</label>
                                        <select name="type" id="type" class="form-control">
                                            @if($overhead->type == 'Посылка')
                                                <option selected value="Посылка">Посылка</option>
                                                <option value="Документы">Документы</option>
                                            @else
                                                <option value="Посылка">Посылка</option>
                                                <option selected value="Документы">Документы</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="speed">Срочность</label>
                                        <select name="speed" id="speed" class="form-control">
                                            @if($overhead->speed == 'Экспресс')
                                                <option selected value="Экспресс">Экспресс</option>
                                                <option value="Стандарт">Стандарт</option>
                                                <option value="Авто">Авто</option>
                                            @elseif($overhead->speed == 'Стандарт')
                                                <option value="Экспресс">Экспресс</option>
                                                <option selected value="Стандарт">Стандарт</option>
                                                <option value="Авто">Авто</option>
                                            @else
                                                <option value="Экспресс">Экспресс</option>
                                                <option value="Стандарт">Стандарт</option>
                                                <option selected value="Авто">Авто</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment">Оплата</label>
                                        <select name="payment" id="payment" class="form-control">
                                            @if($overhead->payment == 'Отправителем')
                                                <option selected value="Отправителем">Отправителем</option>
                                                <option value="Получателем">Получателем</option>
                                                <option value="Третьей стороной">Третьей стороной</option>

                                            @elseif($overhead->payment == 'Получателем')
                                                <option value="Отправителем">Отправителем</option>
                                                <option selected value="Получателем">Получателем</option>
                                                <option value="Третьей стороной">Третьей стороной</option>
                                            @else
                                                <option value="Отправителем">Отправителем</option>
                                                <option value="Получателем">Получателем</option>
                                                <option selected value="Третьей стороной">Третьей стороной</option>
                                            @endif

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment_type">Способ оплаты</label>
                                        <select name="payment_type" id="payment_type" class="form-control">
                                            @if($overhead->payment_type == 'По счету')
                                                <option selected value="По счету">По счету</option>
                                                <option value="Наличными">Наличными</option>
                                                <option value="Терминалом">Терминалом</option>

                                            @elseif($overhead->payment_type == 'Наличными')
                                                <option value="По счету">По счету</option>
                                                <option selected value="Наличными">Наличными</option>
                                                <option value="Терминалом">Терминалом</option>
                                            @else
                                                <option value="По счету">По счету</option>
                                                <option value="Наличными">Наличными</option>
                                                <option selected value="Терминалом">Терминалом</option>
                                            @endif

                                        </select>
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mass">Масса(кг)</label>
                                        <input type="text" id="mass" name="mass" class="form-control" placeholder="12345кг" 
											   value="{{$overhead->mass}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="volume">Объем(см<sup>3</sup>)</label>
                                        <input type="text" id="volume" name="volume" class="form-control" 
											   value="{{$overhead->volume}}"
											   placeholder="12345 см куб">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="length">Длина(см)</label>
                                        <input type="text" id="length" name="length" class="form-control"
											   value="{{$overhead->length}}"
											   placeholder="12345 см">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="width">Ширина(см)</label>
                                        <input type="text" id="width" name="width" class="form-control" 
											   value="{{$overhead->width}}"
											   placeholder="12345 см">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="height">Высота(см)</label>
                                        <input type="text" id="height" name="height" class="form-control" 
											   value="{{$overhead->height}}"
											   placeholder="12345 см">
                                    </div>
                                </div>
                            </div>
                            
                            <hr>
                            <div class="row">
                                <h3 class="text-left">Детали доставки</h3>
                            </div>
                            <hr>
							<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group fv-plugins-icon-container">
                                        <label for="date_s">Дата отправки:</label>
                                        <div class="input-group date">
                                            <input type="text" placeholder="Дата отправки" value="@php echo substr($overhead->date_s, 0, 10) 
																								  @endphp"
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
                                <div class="col-md-6">
                                    <div class="form-group fv-plugins-icon-container">
                                        <label for="date_e">Дата доставки:</label>
                                        <div class="input-group date">
                                            <input type="text" placeholder="Дата доставки" value="@php echo substr($overhead->date_e, 0, 10) 
																								  @endphp"
                                                   name="date_e"
                                                   autocomplete="off" class="form-control" id="date_e">
                                            <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-calendar"></i>
                                            </span>
                                            </div>
                                        </div><i data-field="date_e" class="fv-plugins-icon"></i>

                                        <div class="fv-plugins-message-container"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Примечание</label>
                                        <textarea class="form-control" name="description" id="description">
                                            {{$overhead->description}}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-0 text-right form-group">
                            <button type="submit" class="btn btn-sm btn-success">Обновить</button>
							
                        </div>
						<div class="mb-0 text-right form-group">
                            <a href="{{route('admin.overheads.searchOverhead')}}?search_overhead={{$overhead->overhead_code}}" 
							   class="btn btn-sm btn-danger">Назад</a>
							
                        </div>
                    </div>
                </div>
            </form>
        </div>


    </div>

@endsection
@section('admin-script')
    <script>
        let dater = new Date();
		let year = dater.getFullYear();
		let date = dater.getDate();
		let month = dater.getMonth();
		console.log(date + " : "+ year+" : "+ month);
        $('#date_s').datepicker({
            orientation: "bottom auto",
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,
            defaultDate: new Date(year, month+1, date)
        });
        $('#date_e').datepicker({
            orientation: "bottom auto",
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,
            defaultDate: new Date(year, month+1, date)
        });
    </script>
@endsection
