@extends('layouts.app')
@section('subheader')
    <style>
        .overhead_info{
            padding: 5px;
            box-shadow: 1px 1px 1px 1px rgba(0,0,0, 0.4);
        }
        .overhead_info ul{
            margin: 0;
            padding: 0;
        }
        .overhead_info ul li{
            display: flex;
        }
        .overhead_info_key{
            width: 30%;
        }
        .overhead_journals{
            box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.4);
            padding-left: 20px;
            padding-top: 5px;
            padding-bottom: 5px;
        }
        .progress_bar_item{
            display: flex;
            padding-bottom: 10px;
            padding-top: 10px;
            border-bottom: 1px solid #004191;
            width: 50%;
        }
        .progress_circle{
            width: 20px;
            height: 20px;
            border-radius:100%;
            border: 1px solid #004191;
        }
        .progress_info{
            margin-left: 5px;
            margin-top: -3px;
			width: 150px;
        }
		.progress_delete{
			display: flex;
			align-items: center;
			text-align: center;
			padding: 0;
			border: 1px solid #004191;
			width: 30px;
			height: 30px;
			margin-left: 10px;
			border-radius: 5px;
			cursor: pointer;
		}
		.progress_delete button{
			display: block;
			width: 100%;
			border: none;
			background: white;
		}
		.progress_delete button i{
			color: #004191;
		}
		.delete_over{
			display: block;
			text-align: end;
			margin-right: 5px;
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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Информация о Накладной</h5>
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
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Номер накладного: #<span class="overhead_code">{{$overhead->overhead_code}}</span></h5>
				<a href="{{route('admin.overheads.edit2')}}?overhead_id={{$overhead->id}}"
				   class="btn btn-primary btn-sm mt-2"
				   style="background-color: #004191;border-color: #004191;"
				   >Редактировать</a>
                <a class="btn btn-primary btn-sm mt-2 print_code" href="#"
                   data="{{$overhead->overhead_code}}"
                   data-id="{{$overhead->id}}">
                    <i class="fas fa-print"></i>
                </a>

            </div>
            <div class="card-body">
                <div class="container-fluid" style="padding: 0;">
                    <div class="row">
                        <div class="col-md-6">
                            @if(isset($overheads))
								@foreach($overheads as $overhead)
								<div class="overhead_info mb-5" style="">
									<a href="#" class="delete_over">Удалить</a>
									<ul class="" style="list-style:none;">
										<li>
											<div class="overhead_info_key">Отправитель</div>
											<div class="overhead_info_value">{{$overhead->from_name}}</div>
										</li>
										<li>
											<div class="overhead_info_key">Компания</div>
											<div class="overhead_info_value">{{$overhead->from_company}}</div>
										</li>
										<li>
											<div class="overhead_info_key">Город</div>
											<div class="overhead_info_value">
												@if(strlen($from_city) > 2)
												<p style="margin: 0;">{{$from_city}}</p>
												@else
												@if(App\Models\City::find($from_city) != null)
												<p style="margin: 0;">{{App\Models\City::find($from_city)->city_name}}</p>
												@else
												<p style="margin: 0;">Не правильно указан</p>
												@endif

												@endif

											</div>
										</li>
										<li>
											<div class="overhead_info_key">Адрес</div>
											<div class="overhead_info_value">{{$overhead->from_address}}</div>
										</li>
										<li>
											<div class="overhead_info_key">Телефон</div>
											<div class="overhead_info_value">{{$overhead->from_phone}}</div>
										</li>
										<hr>
										<li>
											<div class="overhead_info_key">Получатель</div>
											<div class="overhead_info_value">{{$overhead->to_name}}</div>
										</li>
										<li>
											<div class="overhead_info_key">Компания</div>
											<div class="overhead_info_value">{{$overhead->to_company}}</div>
										</li>
										<li>
											<div class="overhead_info_key">Город</div>
											<div class="overhead_info_value">
												@if(strlen($to_city) > 2)
												<p style="margin: 0;">{{$to_city}}</p>
												@else
												@if(App\Models\City::find($to_city) != null)
												<p style="margin: 0;">{{App\Models\City::find($to_city)->city_name}}</p>
												@else
												<p style="margin: 0;">Не правильно указан</p>
												@endif

												@endif
											</div>
										</li>
										<li>
											<div class="overhead_info_key">Адрес</div>
											<div class="overhead_info_value">{{$overhead->to_address}}</div>
										</li>
										<hr>
										<li>
											<div class="overhead_info_key">Тип отправления</div>
											<div class="overhead_info_value">{{$overhead->type}}</div>
										</li>
										<li>
											<div class="overhead_info_key">Срочность</div>
											<div class="overhead_info_value">{{$overhead->speed}}</div>
										</li>
										<li>
											<div class="overhead_info_key">Оплата</div>
											<div class="overhead_info_value">{{$overhead->payment}}</div>
										</li>
										<li>
											<div class="overhead_info_key">Тип оплаты</div>
											<div class="overhead_info_value">{{$overhead->payment_type}}</div>
										</li>
									</ul>
								</div>
								@endforeach
							@endif
                        </div>
{{--                        <div class="col-md-1"></div>--}}
                        <div class="col-md-6">
                            <h5>Журнал изменений</h5>
                            <div class="overhead_journals">
                                <div class="progress_bar">
                                    @if(isset($journals))
                                    @foreach($journals as $journal)
                                    <div class="progress_bar_item">
                                        <div class="progress_circle"></div>
                                        <div class="progress_info">
                                            <div class="progress_name">{{App\Models\Status::where('id', $journal->status_id)->get()->first()->status_name}}</div>
                                            <div class="progress_date">{{$journal->date}}</div>
                                        </div>
										<div class="progress_delete">
											<form method="POST" action="{{route('admin.journals.delete')}}">
												@csrf
												<input type="hidden" name="journal_id" value="{{$journal->id}}">
												<button type="submit" href="#" class="">
													<i class="fa fa-minus"></i>
												</button>
											</form>
										</div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="overhead_photo">
                                @if($overhead->image_file)
                                    <img src="{{asset('public/assets/overhead_photo/'.$overhead->image_file)}}"
                                         style="width: 100%;"
                                         alt="">
                                @else
                                    <img src="{{asset('public/assets/overhead_photo/no-photo.jpg')}}"
                                         style="width: 100%;"
                                         alt="">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <form method="post" action="{{route('admin.overheads.uploadImage')}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="overhead_id" value="{{$overhead->id}}">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label><h4>Добавить фото</h4></label>
                                        <input type="file" class="form-control" required name="image">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-success"
                                        style="margin-top: 35px;"
                                        >Добавить</button>
                                    </div>
                                </div>
                            </form>
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
        let overhead_id = "";
        $('.print_code').click(function (e){
            e.preventDefault();
            //overhead_code = $(this).attr('data');
            overhead_id = "{{$overhead->id}}";
            console.log(overhead_id);

            $.ajax({
                url: "{{route('api.overhead.get')}}",
                method: "GET",
                data: {overhead_id: overhead_id},
                success: function (result){
                    console.log(result);
                    let res = JSON.parse(result);
                    printOverhead555(res);
                    console.log(res);
                },
                error: function (error){},
            });
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
    </script>
@endsection
