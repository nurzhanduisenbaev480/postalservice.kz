@extends('layouts.app')
@section('subheader')
    <style>
        .order_sender_info{
            width: 100%;
        }
        .order_sender_info h4{
            padding-bottom: 5px;
            width: 60%;
            border-bottom: 1px solid #e7e7e7;
        }
        .order_sender_info_list{
            list-style: none;
            display: flex;
            flex-direction: column;
            padding: 0;
        }
        .info_list_item{
            display: flex;
        }
        .info_list_key{
            width: 20%;
            font-weight: bold;
        }
        .info_list_value{
            width: 80%;
        }
        .form-group{
            margin-bottom: 1rem;
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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Информация о заявке</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.roads.check')}}" class="text-muted">Сверка</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.roads.show')}}?overhead_id={{$overhead->id}}" class="text-muted">Информация о заявке</a>
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
                <h5 class="mb-0 h6">Номер накладного: #<span id="overhead_code">{{$overhead->overhead_code}}</span></h5>
            </div>
            <div class="card-body">
                <div class="container-fluid" style="padding: 0;">
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
                                        <label for="from_name">Ф.И.О</label>
                                        <input value="{{$overhead->from_name}}" disabled id="from_name" name="from_name" type="text"
                                               placeholder="Введите Ф.И.О отправителя"
                                               class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_company">Компания</label>
                                        <input value="{{$overhead->from_company}}" disabled id="from_company" name="from_company" type="text"
                                               placeholder="Введите название компаний"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_city">Город</label>
                                        <input value="{{$overhead->from_city}}" disabled name="from_city" id="from_city"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_phone">Телефон</label>
                                        <input value="{{$overhead->from_phone}}" disabled id="from_phone" name="from_phone" type="text"
                                               placeholder="Введите телефон"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_address">Адрес</label>
                                        <input value="{{$overhead->from_address}}" disabled id="from_address" name="from_address" type="text"
                                               placeholder="Введите адрес"
                                               class="form-control">
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
                                        <input value="{{$overhead->to_name}}" disabled id="to_name" name="to_name" type="text"
                                               placeholder="Введите Ф.И.О отправителя"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="to_company">Компания</label>
                                        <input value="{{$overhead->to_company}}" disabled id="to_company" name="to_company" type="text"
                                               placeholder="Введите название компаний"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="to_city">Город</label>
                                        <input value="{{$overhead->to_city}}" disabled name="to_city" id="to_city"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="to_phone">Телефон</label>
                                        <input value="{{$overhead->to_phone}}" disabled id="to_phone" name="to_phone" type="text"
                                               placeholder="Введите телефон"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="to_address">Адрес</label>
                                        <input value="{{$overhead->to_address}}" disabled id="to_address" name="to_address" type="text"
                                               placeholder="Введите адрес"
                                               class="form-control">
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
                                        <input value="{{$overhead->type}}" disabled type="text" name="type" id="type"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="speed">Срочность</label>
                                        <input value="{{$overhead->speed}}" disabled name="speed" id="speed"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment">Оплата</label>
                                        <input value="{{$overhead->payment}}" disabled name="payment" id="payment"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment_type">Способ оплаты</label>
                                        <input value="{{$overhead->payment_type}}" disabled name="payment_type" id="payment_type"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mass">Масса(кг)</label>
                                        <input value="{{$overhead->mass}}" disabled type="text" id="mass" name="mass"
                                               class="form-control" placeholder="12345кг">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="volume">Объем(см<sup>3</sup>)</label>
                                        <input value="{{$overhead->volume}}" disabled type="text" id="volume" name="volume"
                                               class="form-control" placeholder="12345 см куб">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="length">Длина(см)</label>
                                        <input value="{{$overhead->length}}" disabled type="text" id="length" name="length"
                                               class="form-control" placeholder="12345 см">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="width">Ширина(см)</label>
                                        <input value="{{$overhead->width}}" disabled type="text" id="width" name="width"
                                               class="form-control" placeholder="12345 см">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="height">Высота(см)</label>
                                        <input value="{{$overhead->height}}" disabled type="text" id="height" name="height"
                                               class="form-control" placeholder="12345 см">
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
                                        <input value="{{$overhead->date_s}}" disabled type="text" placeholder="Дата отправки"
                                               name="date_s"
                                               autocomplete="off"
                                               class="form-control" id="date_s">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group fv-plugins-icon-container">
                                        <label for="date_e">Дата доставки:</label>
                                        <input value="{{$overhead->from_name}}" disabled type="text" placeholder="Дата доставки"
                                               name="date_e"
                                               autocomplete="off"
                                               class="form-control" id="date_e">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Примечание</label>
                                        <textarea disabled
                                                  class="form-control" name="description" id="description">{{$overhead->from_name}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="place">Количество мест</label>
                                        <input value="{{$overhead->place}}" disabled class="form-control" name="place" id="place">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-0 text-right form-group">
                            <a href="{{route('admin.roads.check')}}" class="btn btn-sm btn-primary">Назад</a>
                            <a href="#" class="btn btn-sm btn-primary" id="printOverhead">Печать</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


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
                        <p style="width: 160px;margin: 0 0 0 10px;font-size:8px;">Transit Trade Company</p>
                    </div>
                    <div class="phone44" style="position: absolute;
                                        right: 65px;
                                        top: 15px;">
                        <p style="margin:0;font-size:8px;">+7 708 227 08 26</p>
                        <p style="margin:0;font-size:8px;">abbasexprexxlogistics@gmail.com</p>
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
                            </div>
                            <div>
                                <p class="rights" style="margin: 0;font-size: 8px;padding-left: 5px;">Я потверждаю, что отправление не содержит запрещенных вложений к пересылке. С правилами пересылки ознакомлен и согласен</p>
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
                            <div class="cou_row_item_value"></div>
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
                        <div class="cou_row_item2" style="width: 100%;font-size: 8px;">Я потверждаю, что отправление доставлено без повреждений упаковки.Вес соответствует весу при приеме.Претензий не имею.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="font-size:12px;border-bottom: 1px dashed black;text-align:center;">TRANSIT TRADE COMPANY</div>
    </div>
@endsection
@section('admin-script')
    <script>
        $('#printOverhead').click(function (e){
            e.preventDefault();
            printOverhead();
        });
        function printOverhead(){
            let document1 = '{{$overhead->type}}';
            let document2 = '{{$overhead->speed}}';
            let document3 = '{{$overhead->payment}}';
            let document4 = '{{$overhead->payment_type}}';

            let prim = $('#primechanya').val();


            let printFrom = $('.printFrom');
            let printTo = $('.printTo');
            printFrom.find('.fio p').text('{{$overhead->from_name}}');
            printFrom.find('.company p').text('{{$overhead->from_company}}');
            printFrom.find('.city p').text('{{$overhead->from_city}}');
            printFrom.find('.address p').text('{{$overhead->from_address}}');
            printFrom.find('.fromPhone p').text('{{$overhead->from_phone}}');
            printTo.find('.fio p').text('{{$overhead->to_name}}');
            printTo.find('.company p').text('{{$overhead->to_company}}');
            printTo.find('.city p').text('{{$overhead->to_city}}');
            printTo.find('.address p').text('{{$overhead->to_address}}');
            printTo.find('.fromPhone p').text('{{$overhead->to_phone}}');

            $('.prim').append(prim);

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
            $('#naklNumber').text('{{$overhead->overhead_code}}');
            JsBarcode("#barcode", '{{$overhead->overhead_code}}', {
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
            var mywindow = window.open('','','left=50,top=50,width=860,height=2000,toolbar=0,scrollbars=1,status=0');
            //   mywindow.document.write('<html><head><title></title>');
            //   mywindow.document.write('<link rel="stylesheet" href="css/midday_receipt.css" type="text/css" />');
            //   mywindow.document.write('</head><body >');
            mywindow.document.write('<div class="printNakl" style="width:800px;margin-bottom:20px;">');
            mywindow.document.write(data.innerHTML);
            mywindow.document.write('</div>');
            mywindow.document.write('<div class="printNakl" style="width:800px;margin-bottom:20px;">');
            mywindow.document.write(data.innerHTML);
            mywindow.document.write('</div>');
            mywindow.document.write('<div class="printNakl" style="width:800px;margin-bottom:20px;">');
            mywindow.document.write(data.innerHTML);
            mywindow.document.write('</div>');

            //   mywindow.document.write('</body></html>');

            mywindow.focus();
            mywindow.document.close();
            mywindow.print();mywindow.close();
            //setTimeout(function(){mywindow.print();mywindow.close();location.reload();},1000);
            //   mywindow.close();


            return true;
        }
    </script>
@endsection
