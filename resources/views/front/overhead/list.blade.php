@extends('layouts.front_cabinet')
@section('content')
    <!-- dashbard-menu-wrap -->
    <div class="dashbard-menu-overlay"></div>
    @include('inc.front_cabinet_nav')
    <!-- dashbard-menu-wrap end  -->
    <!-- content -->
    <div class="dashboard-content">
        <div class="dashboard-menu-btn color-bg"><span><i class="fas fa-bars"></i></span>Панель управления</div>
        <div class="container dasboard-container">
            <!-- dashboard-title -->
            <div class="dashboard-title fl-wrap">
                <div class="dashboard-title-item"><span>Электронная товарно-транспортная накладная</span></div>
                <div class="dashbard-menu-header">
                    @include('inc.simple_user')
                </div>
                <!--Tariff Plan menu-->
                <div class="tfp-det-container">

                </div>
                <!--Tariff Plan menu end-->
            </div>
            <!-- dashboard-title end -->
            <div class="dasboard-wrapper fl-wrap no-pag">
                <div class="dasboard-listing-box fl-wrap">
                    <div class="dasboard-opt sl-opt fl-wrap">
                        <div class="dashboard-search-listing">
                            <input type="text" onclick="this.select()" placeholder="Поиск по коду" value="">
                            <button type="submit"><i class="far fa-search"></i></button>
                        </div>

                        <!-- price-opt-->
                        <div class="price-opt">
{{--                            <span class="price-opt-title">Сортировать по:</span>--}}
{{--                            <div class="listsearch-input-item">--}}
{{--                                <select data-placeholder="Lastes" class="chosen-select-my">--}}
{{--                                    <option>Lastes</option>--}}
{{--                                    <option>Oldes</option>--}}
{{--                                    <option>Average rating</option>--}}
{{--                                    <option>Name: A-Z</option>--}}
{{--                                    <option>Name: Z-A</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
                        </div>
                        <!-- price-opt end-->
                        <div class="popup-form">
                            <div class="custom-form">
                                <label>Name <span class="dec-icon"><i class="fas fa-user"></i></span></label>
                                <input type="text" placeholder="Alica Noory" value="">
                                <label>Email Address <span class="dec-icon"><i class="far fa-envelope"></i></span></label>
                                <input type="text" placeholder="AlicaNoory@domain.com" value="">
                                <label>Agent Link<span class="dec-icon"><i class="fal fa-link"></i></span></label>
                                <input type="text" placeholder="homeradar.net/agent-alicanoory/" value="">
                                <button type="submit" class="btn float-btn color-bg fw-btn"> Send</button>
                            </div>
                        </div>
                    </div>
                    <div class="dasboard-opt geodir-category-content fl-wrap">
                        <div class="row">
                            <div class="col-sm-12" style="padding-left: 0;padding-right: 0;">
                                <table class="table table-bordered table-hover table-cabinet">
                                    <thead>
                                        <tr>
                                            <th>Код</th>
                                            <th>Статус</th>
                                            <th>Отправитель</th>
                                            <th>Получатель</th>
                                            <th>Действие</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($overheads as $overhead)
                                        <tr>
                                            <td>{{$overhead->overhead_code}}</td>
                                            <td>
                                                @if(is_null(\App\Models\Journal::where('overhead_code', $overhead->overhead_code)->get()->first()))
                                                    Статус не установлен
                                                @else
                                                    {{\App\Models\Journal::where('overhead_code', $overhead->overhead_code)->get()->first()->status_name}}
                                                @endif

                                            </td>
                                            <td>
                                                <div class="from_item">
                                                    <ul class="from_item_ul">
                                                        <li class="from_item_ul_li">
                                                            <span class="from_item_ul_li_span1">ФИО:</span>
                                                            <span>{{$overhead->from_name}}</span>
                                                        </li>
                                                        <li class="from_item_ul_li">
                                                            <span class="from_item_ul_li_span1">Компания:</span>
                                                            <span>{{$overhead->from_company}}</span>
                                                        </li>
                                                        <li class="from_item_ul_li">
                                                            <span class="from_item_ul_li_span1">Город:</span>
															@if(!is_null(\App\Models\City::find($overhead->from_city)))
                                                            <span>{{\App\Models\City::find($overhead->from_city)->city_name}}</span>
															@else
															<span>не установлен</span>
															@endif
                                                        </li>
                                                        <li class="from_item_ul_li">
                                                            <span class="from_item_ul_li_span1">Адрес:</span>
                                                            <span>{{$overhead->from_address}}</span>
                                                        </li>
                                                        <li class="from_item_ul_li">
                                                            <span class="from_item_ul_li_span1">Телефон:</span>
                                                            <span>{{$overhead->from_phone}}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="from_item">
                                                    <ul class="from_item_ul">
                                                        <li class="from_item_ul_li">
                                                            <span class="from_item_ul_li_span1">ФИО:</span>
                                                            <span>{{$overhead->to_name}}</span>
                                                        </li>
                                                        <li class="from_item_ul_li">
                                                            <span class="from_item_ul_li_span1">Компания:</span>
                                                            <span>{{$overhead->to_company}}</span>
                                                        </li>
                                                        <li class="from_item_ul_li">
                                                            <span class="from_item_ul_li_span1">Город:</span>
                                                            @if(!is_null(\App\Models\City::find($overhead->to_city)))
                                                            <span>{{\App\Models\City::find($overhead->to_city)->city_name}}</span>
															@else
															<span>не установлен</span>
															@endif
                                                        </li>
                                                        <li class="from_item_ul_li">
                                                            <span class="from_item_ul_li_span1">Адрес:</span>
                                                            <span>{{$overhead->to_address}}</span>
                                                        </li>
                                                        <li class="from_item_ul_li">
                                                            <span class="from_item_ul_li_span1">Телефон:</span>
                                                            <span>{{$overhead->to_phone}}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td class="actions_td">
                                                <div class="actions">
                                                    <a href="#" class="actions_item printOverhead1" overhead_code="{{$overhead->overhead_code}}">
                                                       <i class="fal fa-print"></i>
                                                    </a>

{{--                                                    <a href="#" class="actions_item">--}}
{{--                                                        <i class="fal fa-minus"></i>--}}
{{--                                                    </a>--}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="limit-box fl-wrap"></div>
        <!-- dashboard-footer -->

        <!-- dashboard-footer end -->
    </div>
    <!-- content end -->
    <div class="dashbard-bg gray-bg"></div>
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

<script>

</script>
