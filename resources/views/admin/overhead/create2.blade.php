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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Создание накладной</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin')}}" class="text-muted">Панель управление</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.overheads.index')}}" class="text-muted">Накладные</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.overheads.create')}}" class="text-muted">Создать накладной</a>
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
<style>
	.search_results{
		width: 50%;
		display:none;
		background: transparent;
		height: auto;
		position: absolute;
		z-index: 2;
		margin-top: 5px;
	}
	.search_results .search_item{
		padding: 5px;
		background: white;
		box-shadow: 2px 2px 2px rgb(0, 0, 0,0.5);
		cursor: pointer;
		border-bottom: 1px solid #e7e7e7;
	}
	.search_results .search_item:hover{
		background: #e7e7e7;
	}

	.description-tags{
		display: flex;
	}
	.tag_item{
		padding: 5px;
		cursor:pointer;
		background: #004191;
		color: #fff;
		margin-right: 5px;
	}
</style>
@endsection
@section('content-admin')
    <div class="mx-auto col-lg-12">
        <div class="card">
            <form class="form-horizontal fv-plugins-bootstrap fv-plugins-framework"
                  action="{{route('admin.overheads.store')}}"
                  id="kt_form_1"
                  method="POST"
                  enctype="multipart/form-data"
                  novalidate="novalidate">
                @csrf

                <input type="hidden" value="{{$user->id}}" name="user_id">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-12">
                                    @if(\Illuminate\Support\Facades\Session::has('message'))
                                        @if(\Illuminate\Support\Facades\Session::get('message') == 0)
                                            <div class="alert alert-success">Успешно добавлен </div>
										@elseif(\Illuminate\Support\Facades\Session::get('message') == 3)
											<div class="alert alert-danger">Накладной с таким номером существует</div>
                                        @else
                                            <div class="alert alert-danger">Что то пошло не так, пожалуйста обратитесь к администратору</div>
                                        @endif
                                        {{\Illuminate\Support\Facades\Session::forget('message')}}
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="overhead_code">Код накладной</label>
                                        <input id="overhead_code" name="overhead_code" type="text"
                                               placeholder="Введите код накладного" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <h3 class="text-left">Отправитель</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="from_name1">Ф.И.О</label>
                                        <input id="from_name1" name="from_name" type="text"
                                               placeholder="Введите Ф.И.О отправителя" class="form-control">
										<div class="search_results">
											<div class="search_item" data="">Тоо Астана плат</div>
											
										</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_company">Компания</label>
                                        <input id="from_company" name="from_company" type="text"
                                               placeholder="Введите название компаний" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_city">Город</label>
										<select name="from_city" id="from_city" class="form-control">
                                            <option value="0">Выберите город</option>
                                            <optgroup label="1-ая зона">
                                                @foreach($cities as $cityItem)
                                                    @if($cityItem->city_zone==1)
                                                        <option value="{{$cityItem->id}}">{{$cityItem->city_name}}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="2-ая зона">
                                                @foreach($cities as $cityItem)
                                                    @if($cityItem->city_zone==2)
                                                        <option value="{{$cityItem->id}}">{{$cityItem->city_name}}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="3-яя зона">
                                                @foreach($cities as $cityItem)
                                                    @if($cityItem->city_zone==3)
                                                        <option value="{{$cityItem->id}}">{{$cityItem->city_name}}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="0-ая зона">
                                                @foreach($cities as $cityItem)
                                                    @if($cityItem->city_zone==0)
                                                        <option value="{{$cityItem->id}}">{{$cityItem->city_name}}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        </select>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_phone">Телефон</label>
                                        <input id="from_phone" name="from_phone" type="text"
                                               placeholder="Введите телефон" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_address">Адрес</label>
                                        <input id="from_address" name="from_address" type="text"
                                               placeholder="Введите адрес" class="form-control">
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
                                               placeholder="Введите Ф.И.О отправителя" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="to_company">Компания</label>
                                        <input id="to_company" name="to_company" type="text"
                                               placeholder="Введите название компаний" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="to_city">Город</label>
                                        <select name="to_city" id="to_city" class="form-control">
                                            <option value="0">Выберите город</option>
                                            <optgroup label="1-ая зона">
                                                @foreach($cities as $cityItem)
                                                    @if($cityItem->city_zone==1)
                                                        <option value="{{$cityItem->id}}">{{$cityItem->city_name}}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="2-ая зона">
                                                @foreach($cities as $cityItem)
                                                    @if($cityItem->city_zone==2)
                                                        <option value="{{$cityItem->id}}">{{$cityItem->city_name}}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="3-яя зона">
                                                @foreach($cities as $cityItem)
                                                    @if($cityItem->city_zone==3)
                                                        <option value="{{$cityItem->id}}">{{$cityItem->city_name}}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="0-ая зона">
                                                @foreach($cities as $cityItem)
                                                    @if($cityItem->city_zone==0)
                                                        <option value="{{$cityItem->id}}">{{$cityItem->city_name}}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="to_phone">Телефон</label>
                                        <input id="to_phone" name="to_phone" type="text"
                                               placeholder="Введите телефон" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="to_address">Адрес</label>
                                        <input id="to_address" name="to_address" type="text"
                                               placeholder="Введите адрес" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <h3 class="text-left">Детали накладной</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Тип отправления</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="Посылка">Посылка</option>
                                            <option value="Документы">Документы</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="speed">Срочность</label>
                                        <select name="speed" id="speed" class="form-control">
                                            <option value="Экспресс">Экспресс</option>
                                            <option value="Стандарт">Стандарт</option>
                                            <option value="Авто">Авто</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment">Оплата</label>
                                        <select name="payment" id="payment" class="form-control">
                                            <option value="Отправителем">Отправителем</option>
                                            <option value="Получателем">Получателем</option>
                                            <option value="Третьей стороной">Третьей стороной</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment_type">Способ оплаты</label>
                                        <select name="payment_type" id="payment_type" class="form-control">
                                            <option value="По счету">По счету</option>
                                            <option value="Наличными">Наличными</option>
                                            <option value="Терминалом">Терминалом</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="price">Цена(тг)</label>
                                        <input type="text" id="price" name="price" class="form-control" placeholder="1000">
                                    </div>
                                </div>
							</div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mass">Масса(кг)</label>
                                        <input type="text" id="mass" name="mass" class="form-control" placeholder="12345кг" value="0.3">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="volume">Объем(см<sup>3</sup>)</label>
                                        <input type="text" id="volume" name="volume" class="form-control" placeholder="12345 см куб">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="length">Длина(см)</label>
                                        <input type="text" id="length" name="length" class="form-control" placeholder="12345 см">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="width">Ширина(см)</label>
                                        <input type="text" id="width" name="width" class="form-control" placeholder="12345 см">
                                    </div>
                                </div>
                                
                            </div>
							<div class="row">
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label for="height">Высота(см)</label>
                                        <input type="text" id="height" name="height" class="form-control" placeholder="12345 см">
                                    </div>
                                </div>
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label for="place">Количество</label>
                                        <input type="text" id="place" name="place" class="form-control" placeholder="1" value="1">
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
                                <div class="col-md-6">
                                    <div class="form-group fv-plugins-icon-container">
                                        <label for="date_e">Дата доставки:</label>
                                        <div class="input-group date">
                                            <input type="text" placeholder="Дата доставки"
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
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label for="description">Примечание</label>
                                        <textarea class="form-control" name="description" id="description"></textarea>
                                    </div>
									<div class="description-tags">
										<div class="tag_item">Экспесс</div>
										<div class="tag_item">Эконом</div>
										<div class="tag_item">Безнал</div>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-0 text-right form-group" style="margin-top: 5px;">
                            <button type="submit" class="btn btn-sm btn-primary">Сохранить</button>
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
		
		$("#to_city").change(function(){
			$("#sub_zone_label").remove();
			$("#sub_zone").remove();
			console.log(parseInt($(this).val()));
			let cityId = parseInt($(this).val());
			if(cityId === 31){
				let subItem = "<label class='mt-3' id='sub_zone_label' for='sub_zone'>Выберите суб зону</label>";
				subItem += "<select class='form-control' name='sub_zone' id='sub_zone'>";
				subItem += "<option value='A'>A</option>";
				subItem += "<option value='B'>B</option>";
				subItem += "<option value='C'>C</option>";
				subItem += "</select>";
				$(this)
					.parent()
					.append(subItem)
			}
		});
		
		$('.tag_item').click(function(e){
			console.log($(this).text());
			$('#description').append($(this).text()+', ');
		});
    
		
    </script>
@endsection
