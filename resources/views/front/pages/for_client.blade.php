@extends('layouts.front')
@section('content')
    <!-- content -->
    <div class="content">
        <!--  section  -->

        <!--  section  end-->
        <!-- breadcrumbs-->
        <div class="breadcrumbs fw-breadcrumbs sp-brd fl-wrap">
            <div class="container">
                <div class="breadcrumbs-list">
                    <a href="{{route('front.index')}}">Главная</a>  <span>Добавить накладной</span>
                </div>
                <div class="share-holder hid-share">
                    <a href="#" class="share-btn showshare sfcs">  <i class="fas fa-share-alt"></i>  Share   </a>
                    <div class="share-container  isShare"><a href="http://www.facebook.com/share.php?u=file%3A%2F%2F%2FD%3A%2FLaravel%2520Projects%2Fhomeradar.kwst.net%2Fhomeradar.kwst.net%2Findex.html" class="pop share-icon share-icon-facebook"></a><a href="http://pinterest.com/pin/create/button/?url=file%3A%2F%2F%2FD%3A%2FLaravel%2520Projects%2Fhomeradar.kwst.net%2Fhomeradar.kwst.net%2Findex.html&amp;media=&amp;description=" class="pop share-icon share-icon-pinterest"></a><a href="http://www.tumblr.com/share?v=3&amp;u=file%3A%2F%2F%2FD%3A%2FLaravel%2520Projects%2Fhomeradar.kwst.net%2Fhomeradar.kwst.net%2Findex.html" class="pop share-icon share-icon-tumblr"></a><a href="https://twitter.com/share?via=in1.com&amp;text=Homeradar - Real Estate Listing Template" class="pop share-icon share-icon-twitter"></a><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=file%3A%2F%2F%2FD%3A%2FLaravel%2520Projects%2Fhomeradar.kwst.net%2Fhomeradar.kwst.net%2Findex.html&amp;title=Homeradar - Real Estate Listing Template&amp;summary=&amp;source=in1.com" class="pop share-icon share-icon-linkedin"></a><a href="http://digg.com/submit?url=file%3A%2F%2F%2FD%3A%2FLaravel%2520Projects%2Fhomeradar.kwst.net%2Fhomeradar.kwst.net%2Findex.html&amp;title=Homeradar - Real Estate Listing Template" class="pop share-icon share-icon-digg"></a></div>
                </div>
            </div>
        </div>
        <!-- breadcrumbs end -->
        <!-- section -->

        <!-- section end-->
        <!-- section -->
        <section>
            <div class="container">
                <!--about-wrap -->
                <div class="about-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="dasboard-wrapper fl-wrap no-pag">
                                @if(\Illuminate\Support\Facades\Session::has('success'))
                                    <div class="alert alert-success">{{\Illuminate\Support\Facades\Session::get('success')}}</div>
                                @endif
                                <div class="dasboard-scrollnav-wrap scroll-to-fixed-fixed scroll-init2 fl-wrap">
                                    <ul>
                                        <li><a href="#sec1" class="act-scrlink">Отправитель</a></li>
                                        <li><a href="#sec2">Получатель</a></li>
                                        <li><a href="#sec3">Детали накладной</a></li>
                                        <li><a href="#sec4">Дополнительная информация</a></li>
                                        {{--                    <li><a href="#sec5">Rooms</a></li>--}}
                                        {{--                    <li><a href="#sec6">Plans</a></li>--}}
                                        {{--                    <li><a href="#sec7">Widgets</a></li>--}}
                                    </ul>
                                    <div class="progress-indicator">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="-1 -1 34 34">
                                            <circle cx="16" cy="16" r="15.9155" class="progress-bar__background"></circle>
                                            <circle cx="16" cy="16" r="15.9155" class="progress-bar__progress
                                        js-progress-bar"></circle>
                                        </svg>
                                    </div>
                                </div>
                                <form id="client_over">
                                @csrf
                                <!-- dasboard-widget-title -->
                                    <div class="dasboard-widget-title fl-wrap" id="sec1">
                                        <h5><i class="fas fa-info"></i>Отправитель</h5>
                                    </div>
                                    <!-- dasboard-widget-title end -->
                                    <!-- dasboard-widget-box  -->
                                    <div class="dasboard-widget-box fl-wrap">
                                        <div class="custom-form">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label for="from_name">ФИО
                                                        <span class="dec-icon"><i class="far fa-user"></i></span>
                                                    </label>
                                                    <input type="text" id="from_name" name="from_name" placeholder="ФИО" value="">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="from_company">Компания
                                                        <span class="dec-icon"><i class="far fa-house-flood"></i></span>
                                                    </label>
                                                    <input type="text" id="from_company" name="from_company" placeholder="Компания" value="">
                                                </div>
                                                {{--                        <div class="clearfix"></div>--}}
                                                <div class="col-sm-4">
                                                    <label for="from_city">Город</label>
                                                    <div class="listsearch-input-item">
                                                        <select name="from_city" id="from_city" class="chosen-select-my">
                                                            @foreach($cities as $city)
                                                                <option value="{{$city->id}}">{{$city->city_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label for="from_address">Адрес
                                                        <span class="dec-icon"><i class="far fa-map-marker"></i></span>
                                                    </label>
                                                    <input type="text" id="from_address" name="from_address" placeholder="Адрес отправителя" value="">
                                                </div>
                                                <div class="col-sm-8">
                                                    <label for="from_phone">Телефон <span class="dec-icon"><i class="far fa-phone"></i> </span> </label>
                                                    <input type="text" id="from_phone" name="from_phone" placeholder="+7(777)987654" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- dasboard-widget-box  end-->
                                    <!-- dasboard-widget-title -->
                                    <div class="dasboard-widget-title dwb-mar fl-wrap" id="sec2">
                                        <h5><i class="fas fa-info"></i>Получатель</h5>
                                    </div>
                                    <!-- dasboard-widget-title end -->
                                    <!-- dasboard-widget-box  -->
                                    <div class="dasboard-widget-box fl-wrap">
                                        <div class="custom-form">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label for="to_name">ФИО
                                                        <span class="dec-icon"><i class="far fa-user"></i></span>
                                                    </label>
                                                    <input type="text" id="to_name" name="to_name" placeholder="ФИО" value="">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="to_company">Компания
                                                        <span class="dec-icon"><i class="far fa-house-flood"></i></span>
                                                    </label>
                                                    <input type="text" id="to_company" name="to_company" placeholder="Компания" value="">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="to_city">Город</label>
                                                    <div class="listsearch-input-item">
                                                        <select name="to_city" id="to_city" class="chosen-select-my">
                                                            @foreach($cities as $city)
                                                                <option value="{{$city->id}}">{{$city->city_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label for="to_address">Адрес
                                                        <span class="dec-icon"><i class="far fa-map-marker"></i></span>
                                                    </label>
                                                    <input type="text" id="to_address" name="to_address" placeholder="Address of your business" value="">
                                                </div>
                                                <div class="col-sm-8">
                                                    <label for="to_phone">Телефон <span class="dec-icon"><i class="far fa-phone"></i> </span> </label>
                                                    <input type="text" id="to_phone" name="to_phone" placeholder="+7(123)987654" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- dasboard-widget-box  end-->
                                    <!-- dasboard-widget-title -->
                                    <div class="dasboard-widget-title dwb-mar fl-wrap" id="sec3">
                                        <h5><i class="fas fa-address-book"></i>Детали</h5>
                                    </div>
                                    <!-- dasboard-widget-title end -->
                                    <!-- dasboard-widget-box  -->
                                    <div class="dasboard-widget-box   fl-wrap">
                                        <div class="custom-form">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="type">Тип отправлений</label>
                                                    <div class="listsearch-input-item">
                                                        <select name="type" id="type" class="chosen-select-my">
                                                            <option value="Документы">Документы</option>
                                                            <option value="Посылка">Посылка</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="payment">Оплата</label>
                                                    <div class="listsearch-input-item">
                                                        <select name="payment" id="payment" class="chosen-select-my">
                                                            <option value="Отправителем">Отправителем</option>
                                                            <option value="Получателем">Получателем</option>
                                                            <option value="Третьей стороной">Третьей стороной</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--                    <div class="clearfix"></div>--}}
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="speed">Срочность</label>
                                                    <select name="speed" id="speed" class="chosen-select-my">
                                                        <option value="Экспресс">Экспресс</option>
                                                        <option value="Стандарт">Стандарт</option>
                                                        <option value="Авто">Авто</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="payment_type">Способ оплаты</label>
                                                    <div class="listsearch-input-item">
                                                        <select name="payment_type" id="payment_type" class="chosen-select-my">
                                                            <option value="По счету">По счету</option>
                                                            <option value="Наличными">Наличными</option>
                                                            <option value="Терминалом">Терминалом</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- dasboard-widget-box  end-->
                                    <!-- dasboard-widget-title -->
                                    <div class="dasboard-widget-title dwb-mar fl-wrap" id="sec4">
                                        <h5><i class="fas fa-list"></i>Дополнительная информация</h5>
                                    </div>
                                    <!-- dasboard-widget-title end -->
                                    <!-- dasboard-widget-box  -->
                                    <div class="dasboard-widget-box   fl-wrap">
                                        <div class="custom-form">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="description">Примечание</label>
                                                    <div class="listsearch-input-item">
                                                        <textarea name="description" id="description" cols="40" rows="3" style="height: 235px" placeholder="Примечание" spellcheck="false"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- dasboard-widget-box  end-->
                                    <button type="button" class="btn color-bg float-btn printOverhead2">Сохранить и Печать</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- about-wrap end  -->
            </div>
        </section>
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
								<div class="prim_desc"></div>
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
    <!-- footer -->
    @include('inc.front_footer')
    <!-- footer end -->
@endsection
