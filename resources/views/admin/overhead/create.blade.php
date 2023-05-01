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
@endsection
@section('content-admin')
    <div class="mx-auto col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Информация о накладной</h5>
            </div>
            <form class="form-horizontal fv-plugins-bootstrap fv-plugins-framework"
                  action="{{route('admin.overheads.store')}}"
                  id="kt_form_1"
                  method="POST"
                  enctype="multipart/form-data"
                  novalidate="novalidate">
                @csrf
                <input id="overhead_code" name="overhead_code" type="hidden" value="0">
                <input type="hidden" value="{{$user->id}}" name="user_id">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-12">
                                    @if(\Illuminate\Support\Facades\Session::has('message'))
                                        @if(\Illuminate\Support\Facades\Session::get('message') == 0)
                                            <div class="alert alert-danger">Заполните пожалуйста поле Ф.И.О, Телефон, Адрес отправителя </div>
                                        @else
                                            <div class="alert alert-danger">Что то пошло не так, пожалуйста обратитесь к администратору</div>
                                        @endif
                                        {{\Illuminate\Support\Facades\Session::forget('message')}}
                                    @endif
                                </div>
                            </div>

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
                                               value="{{$user->name}}"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_company">Компания</label>
                                        <input id="from_company" name="from_company" type="text" class="form-control"
                                        value="{{\App\Models\Company::find($userInfo->company_id)->company_name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_city">Город</label>
                                        @if(isset($city))
                                            <select name="from_city" id="from_city" class="form-control">
                                                <option value="{{$city->id}}">{{$city->city_name}}</option>
                                            </select>
                                        @else
                                            <select name="from_city" id="from_city" class="form-control">
                                                <option value="{{$cityDef->id}}">{{$cityDef->city_name}}</option>
                                                <option value="31">Алматы</option>
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
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_phone">Телефон</label>
                                        <input id="from_phone" name="from_phone" type="text" class="form-control"
                                        value="{{$userInfo->phone}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_address">Адрес</label>
                                        <input id="from_address" name="from_address" type="text"
                                               value="{{$userInfo->address}}" class="form-control">
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
                                        <input id="to_address" name="to_address" type="text" placeholder="Введите адрес" class="form-control">
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
                                        <input type="text" id="mass" name="mass" class="form-control" placeholder="12345кг">
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="height">Высота(см)</label>
                                        <input type="text" id="height" name="height" class="form-control" placeholder="12345 см">
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
                                    <div class="form-group">
                                        <label for="description">Примечание</label>
                                        <textarea class="form-control" name="description" id="description"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="place">Количество мест</label>
                                        <input type="text" class="form-control" name="place" id="place" value="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-0 text-right form-group">
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
        $('#date_s').datepicker({
            orientation: "bottom auto",
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,
            startDate: new Date(),
        });
        $('#date_e').datepicker({
            orientation: "bottom auto",
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,
            startDate: new Date(),
        });
    </script>
@endsection
