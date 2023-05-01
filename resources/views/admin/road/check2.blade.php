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
        .order_info{
            padding: 10px;
            background: #f4f4f4;
            border-radius: 3px;
            height: 180px;
            box-shadow: 1px 3px 5px rgba(0,0,0,0.5);
        }
        .order-actions{
            padding: 10px;
            background: #f4f4f4;
            border-radius: 3px;
            height: 180px;
            box-shadow: 1px 3px 5px rgba(0,0,0,0.5);
        }
        .order_info-ul{
            width: 100%;
            display: flex;
            flex-direction: column;
        }
        .order_info-ul-item{
            width: 100%;
            display: flex;
        }
        .order_info-key{
            width:30%;
            font-size: 1.2rem;
            font-weight: bold;
            color: #ff7324;
        }
        .order_info-key, .order_info-value{
            line-height: 1.7rem;
        }
        .order_title{
            font-size: 1.3rem;
            font-weight: bold;
            color: #494b74;
        }
        #order_overheads{
            background: #f4f4f4;
            box-shadow: 1px 3px 5px rgba(0,0,0,0.5);
        }
        #order_overheads tr td input,
        #order_overheads tr th input{
            font-size: 11px;
            color: #0b2339;
            font-weight: bold;

        }
        .input_disabled{
            border: none;
            background: transparent;
        }
        .actions_td{
            display: flex;
        }
        .actions_td button{
            padding: 5px 10px;
            margin-right: 4px;
        }

        .actions_td button i{
            font-size: 1rem;
            padding: 0;
        }
        .btn_disable{
            display: none;
        }
        .table_input{
            padding: 5px;
            height: 22px;
            margin-bottom: 4px;
        }
		.my-btn{
			width: 42px;
    		height: 35px;
			font-size: 10px;margin: 5px;
		}
		.my-btn i{
			font-size: 0.9rem;
		}
		.actions_road{
			display: flex;
			align-items: center;
			text-align: center;
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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Сверить</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.roads.check')}}" class="text-muted">Сверить</a>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="from_city">Выберите город</label>
								<select name="from_city" id="from_city" class="form-control">
									<option value="0">Не выбран</option>
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
									<optgroup label="0-ая зона">                                                                                                             		   <option value="31">Алматы</option>
									</optgroup>
								</select>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-md-12">
							<button type="button" class="btn btn-secondary" id="select_all">Выбрать все</button>
							<button type="button" class="btn btn-primary" id="accept_all">Принять выбранных</button>
							<button type="button" class="btn btn-danger" id="deny_all">Отклонить выбранных</button>
						</div>
						
					</div>
                </div>
				<div class="col-md-6">
					<div class="order_title">Действие</div>
					<div class="order-actions">
						<div class="form-group">
							<label for="search">Поиск накладных по штрих коду</label>
							<input  type="text" class="form-control" onchange="checkOverhead();"
								   id="search" placeholder="ABC1234" autofocus>
						</div>
					</div>
				</div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <table class="table table-hover table-bordered" id="order_overheads">
                        <thead>
                        <tr class="table-info">
							<th>#</th>
							<th>№</th>
                            <th>Номер накладного</th>
                            <th style="width: 300px;">Отправитель</th>
                            <th style="width: 300px;">Получатель</th>
                            <th>Курьер</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody id="t-none">
                        @if(isset($overheads) && !$overheads->isEmpty())
							@php $i=0 @endphp
                            @foreach($overheads as $overhead)
							@php $i++ @endphp
                                    @if($overhead->status_id == 14)
                                        <tr class="table-danger visible">
											<td style="padding: 7px;">
												<input type="checkbox" class="form-control check_overhead">
												<input type="hidden" class="overhead_id1" value="{{$overhead->id}}">
											</td>
											<td>{{$i}}</td>
                                            <td>
												<a href="{{route('admin.roads.edit1')}}?overhead_id={{$overhead->id}}">{{$overhead->overhead_code}}</a>
											</td>
                                            <td>
                                                <div class="order_block">
                                                    <div class="order_block_item">
                                                        <h5>ФИО</h5>
                                                        <p>{{$overhead->from_name}}</p>
                                                    </div>
                                                    <div class="order_block_item">
                                                        <h5>Телефон</h5>
                                                        <p>{{$overhead->from_phone}}</p>
                                                    </div>
													<div class="order_block_item">
                                                        <h5>Город</h5>
                                                       @if(strlen($overhead->from_city) > 2)
															<p>{{$overhead->from_city}}</p>
															@else
																@if(is_null(App\Models\City::find($overhead->from_city)))
																	<p>Другое</p>
																@else
																	<p>{{App\Models\City::find($overhead->from_city)->city_name}}</p>
																@endif
															
															@endif
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
                                                        <h5>Телефон</h5>
                                                        <p>{{$overhead->to_phone}}</p>
                                                    </div>
													<div class="order_block_item">
                                                        <h5>Город</h5>
                                                        @if(strlen($overhead->to_city) > 2)
															<p class="to_city_search">{{$overhead->to_city}}</p>
															@else
																@if(is_null(App\Models\City::find($overhead->to_city)))
																	<p>Другое</p>
																@else
																	<p>{{App\Models\City::find($overhead->to_city)->city_name}}</p>
																@endif
															
															@endif
                                                    </div>
                                                    <div class="order_block_item">
                                                        <h5>Адрес</h5>
                                                        <p>{{$overhead->to_address}}</p>
                                                    </div>
													
                                                </div>
                                            </td>
                                            <td>
                                                @if($overhead->courier_id == null)
                                                    Курьер не назначен
                                                @else
                                                    {{\App\Models\User::find($overhead->courier_id)->name}}
                                                @endif
                                            </td>
                                            <td class="actions_road">
                                                <a href="{{route('admin.roads.show')}}?id={{$overhead->id}}" 
												   class="btn btn-dark btn-sm setStatusBtn my-btn"><i class="fas fa-eye"></i></a>
                                                <a href="#" class="btn btn-dark btn-sm setCourierBtn my-btn"
                                                   data="{{$overhead->_id}}"
                                                   data-toggle="modal"
                                                   data-target="#exampleModalLong"
                                                   style="font-size: 10px;margin: 5px;"
                                                   onclick="setCourier({{$overhead->id}})">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{route('admin.roads.set')}}?id={{$overhead->id}}"
                                                   class="btn btn-dark btn-sm setStatus my-btn">
                                                    <i class="fas fa-plus"></i>
                                                </a>
												<a href="{{route('admin.roads.deleteOver')}}?id={{$overhead->id}}"
                                                   class="btn btn-dark btn-sm setDelete my-btn">
                                                    <i class="fas fa-minus"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr class="table-success visible">
											<td style="padding: 7px;">
												<input type="checkbox" class="form-control check_overhead">
												<input type="hidden" class="overhead_id1" value="{{$overhead->id}}">
											</td>
											<td>{{$i}}</td>
                                            <td>
												<a href="{{route('admin.roads.edit1')}}?overhead_id={{$overhead->id}}">
													{{$overhead->overhead_code}}</a>
											</td>
                                            <td>
                                                <div class="order_block">
                                                    <div class="order_block_item">
                                                        <h5>ФИО</h5>
                                                        <p>{{$overhead->from_name}}</p>
                                                    </div>
                                                    <div class="order_block_item">
                                                        <h5>Телефон</h5>
                                                        <p>{{$overhead->from_phone}}</p>
                                                    </div>
													<div class="order_block_item">
                                                        <h5>Город</h5>
                                                         @if(strlen($overhead->from_city) > 2)
															<p>{{$overhead->from_city}}</p>
															@else
																@if(is_null(App\Models\City::find($overhead->from_city)))
																	<p>Другое</p>
																@else
																	<p>{{App\Models\City::find($overhead->from_city)->city_name}}</p>
																@endif
															
															@endif
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
                                                        <h5>Телефон</h5>
                                                        <p>{{$overhead->to_phone}}</p>
                                                    </div>
													<div class="order_block_item">
                                                        <h5>Город</h5>
                                                        @if(strlen($overhead->to_city) > 2)
															<p class="to_city_search">{{$overhead->to_city}}</p>
															@else
																@if(is_null(App\Models\City::find($overhead->to_city)))
																	<p>Другое</p>
																@else
																	<p>{{App\Models\City::find($overhead->to_city)->city_name}}</p>
																@endif
															
															@endif
                                                    </div>
                                                    <div class="order_block_item">
                                                        <h5>Адрес</h5>
                                                        <p>{{$overhead->to_address}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($overhead->courier_id == null)
                                                    Курьер не назначен
                                                @else
                                                    {{\App\Models\User::find($overhead->courier_id)->name}}
                                                @endif
                                            </td>
                                            <td class="actions_road">
                                                <a href="{{route('admin.roads.edit1')}}?overhead_id={{$overhead->id}}" 
												   class="btn btn-dark btn-sm setStatusBtn my-btn"><i class="fas fa-eye"></i></a>
                                                <a href="#" class="btn btn-dark btn-sm setCourierBtn my-btn"
                                                   data="{{$overhead->_id}}"
                                                   data-toggle="modal"
                                                   data-target="#exampleModalLong"
                                                   style=""
                                                   onclick="setCourier({{$overhead->id}})">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{route('admin.roads.set')}}?id={{$overhead->id}}"
                                                   class="btn btn-dark btn-sm setStatus my-btn">
                                                    <i class="fas fa-plus"></i>
                                                </a>
												<a href="{{route('admin.roads.deleteOver')}}?id={{$overhead->id}}"
                                                   class="btn btn-dark btn-sm setDelete my-btn">
                                                    <i class="fas fa-minus"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                            @endforeach
                        @else
                            <td colspan="10">Пусто</td>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="buttons">
                        
                       

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
                <form action="{{route('admin.roads.setCourier2')}}" method="post">

                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="overhead_id" name="overhead_id">
                        <div class="form-group">
                            <label for="courier_id">Курьер</label>
                            <select name="courier_id" id="courier_id" class="form-control">
                                @if(isset($userList))
                                    @foreach($userList as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mass">Масса(кг)</label>
                            <input type="text" name="mass" class="form-control" id="mass" value="0.0">
                        </div>
                        <div class="form-group">
                            <label for="width">Ширина(см)</label>
                            <input type="text" name="width" class="form-control" id="width" value="0.0">
                        </div>
                        <div class="form-group">
                            <label for="height">Высота(см)</label>
                            <input type="text" name="height" class="form-control" id="height" value="0.0">
                        </div>
                        <div class="form-group">
                            <label for="length">Длина(см)</label>
                            <input type="text" name="length" class="form-control" id="length" value="0.0">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('admin-script')
    <script>
		
		$('#from_city').change(function(el){
			let select = $(this);
			let value = select.val(); // 
			let option = select.find('option');
			let optionText = $(option[value]).text(); // 
			$('#t-none tr').removeClass('visible');
			
			//console.log(optionText);
			//console.log($(this).val());
			let to_city = $('.to_city_search');
			to_city.each(function(i, el){
				//console.log($(el).text());
				let city = $(el);
				let city_text = city.text();
				let tr = city.parent().parent().parent().parent();
				if(city_text === optionText || parseInt(city_text) === parseInt(value)){
					//console.log(city_text);
					//let tr = city.parent().parent().parent().parent();
					//console.log(tr);
					tr.show();
					if(!tr.hasClass('visible')){
						tr.addClass('visible');
					}
				}else{
					tr.hide();
					if(tr.hasClass('visible')){
						tr.removeClass('visible');
					}					
				}
			});
		});
		let flag1 = 0;
		let checkbox1 = $('.check_overhead');
		$('#select_all').click(function(){
			if(flag1 == 0){
				//checkbox1.prop('checked', true);
				checkbox1.each(function(i, el){
					let che = $(el);
					let tr = che.parent().parent();
					if(tr.hasClass('visible')){
						che.prop('checked', true);
					}
				});
				flag1 = 1;
			}else{
				checkbox1.each(function(i, el){
					let che = $(el);
					let tr = che.parent().parent();
					if(tr.hasClass('visible')){
						che.prop('checked', false);
					}
				});
				flag1 = 0;
			}
		});
		$('#accept_all').click(function(){
			let checkbox2 = $('.check_overhead:checked');
			console.log(checkbox2);
			let data = {
				overhead_ids: []
			};		
			checkbox2.each(function(i, el){
				let td = $(el).parent();
				let input_hidden = td.find('.overhead_id1');
				let overhead_id = input_hidden.val();
				//console.log(overhead_id);
				data.overhead_ids.push(overhead_id);
			});
			console.log(data);
			$.ajax({
                url: '{{route('admin.roads.set2')}}',
                method: 'get',
                data: {overhead_ids: data.overhead_ids, _token:'{{csrf_token()}}'},
                success: function (result){
                    let res = JSON.parse(result);
                    //let res = JSON.parse(result);
                    //console.log(res.error);

                    if (res !== '' && res !== null && res.error != 1){
                        window.location.reload();
                    }else{

                        alert("Такого накладного нету в базе");
                    }
                  
                },
                errors: function (error){
                    console.log(error);
                }
            });
			
		});
		$('#deny_all').click(function(){
			let checkbox2 = $('.check_overhead:checked');
			console.log(checkbox2);
			
			let data = {
				overhead_ids: []
			};
			
			checkbox2.each(function(i, el){
				let td = $(el).parent();
				let input_hidden = td.find('.overhead_id1');
				let overhead_id = input_hidden.val();
				//console.log(overhead_id);
				data.overhead_ids.push(overhead_id);
			});
			console.log(data);
			$.ajax({
                url: '{{route('admin.roads.set3')}}',
                method: 'get',
                data: {overhead_ids: data.overhead_ids, _token:'{{csrf_token()}}'},
                success: function (result){
                    let res = JSON.parse(result);
                    //let res = JSON.parse(result);
                    //console.log(res.error);

                    if (res !== '' && res !== null && res.error != 1){
                        window.location.reload();
                    }else{

                        alert("Такого накладного нету в базе");
                    }
                  
                },
                errors: function (error){
                    console.log(error);
                }
            });
			
		});
        let search = $('#search');
        function setCourier(id){
            $('#overhead_id').val(id);
        }
        $(document).ready(function (){
            let input = $('.table_input');
            let editBtn = $('.edit_btn');
            let saveBtn = $('.save_btn');
            input.attr('disabled', '');

            editBtn.click(function (){
                let save2 = $(this).parent().find('.save_btn');
                let tr = $(this).parent().parent();
                save2.show();
                $(this).hide();
                let input2 = tr.find('.table_input');
                input2.removeAttr('disabled');
                input2.removeClass('input_disabled');
            });
            saveBtn.click(function (){
                //console.log($(this));
                let td = $(this).parent();
                let tr = td.parent();

                //let code        = tr.find('input[name="code"]');
                let id          = tr.find('input[name="overhead_id"]');
                let to_name     = tr.find('input[name="to_name"]');
                let to_company  = tr.find('input[name="to_company"]');
                let to_city     = tr.find('input[name="to_city"]');
                let to_address  = tr.find('input[name="to_address"]');
                let to_phone    = tr.find('input[name="to_phone"]');
                let to_mass     = tr.find('input[name="to_mass"]');
                let to_length   = tr.find('input[name="to_length"]');
                let to_width    = tr.find('input[name="to_width"]');
                let to_height   = tr.find('input[name="to_height"]');
                //console.log(code.val()+" "+to_name.val());
                // console.log(parseFloat(to_height.val()));
                // return 0;
                if (isNaN(parseFloat(to_mass.val()))) {
                    to_mass.val(0.0);
                }
                if(isNaN(parseFloat(to_length.val()))){
                    to_length.val(0.0);
                }
                if(isNaN(parseFloat(to_width.val()))){
                    to_width.val(0.0);
                }
                if(isNaN(parseFloat(to_height.val()))){
                    to_height.val(0.0);
                }
                let data  = {
                    _token: '{{csrf_token()}}',
                    id: parseInt(id.val()),
                    company: to_company.val(),
                    //code: code.val(),
                    phone: to_phone.val(),
                    name: to_name.val(),
                    city: to_city.val(),
                    address: to_address.val(),
                    mass: parseFloat(to_mass.val()),
                    length: parseFloat(to_length.val()),
                    width: parseFloat(to_width.val()),
                    height: parseFloat(to_height.val()),
                };
                console.log(data);
                $.post({
                    url: '{{route('admin.store.update')}}',
                    method: 'post',
                    data: data,
                    success: function (result){
                        console.log(result);
                    },
                    errors: function (error){
                        console.log(error);
                    }
                });
                saveBtn.hide();
                editBtn.show();

            });

        });
        function checkOverhead(){
            // console.log("ch");
            //let search = $('#search');
            let value = search.val().trim();
            console.log(value);
            /*
			if (value.length !== 6){
                alert('Длина накладного должен быть 7 символов');
                search.val('');
                search.focus();
                return 0;
            }*/
            $.ajax({
                url: '{{route('admin.roads.checkOverhead')}}',
                method: 'get',
                data: {overhead: value, _token:'{{csrf_token()}}'},
                success: function (result){
                    let res = JSON.parse(result);
                    console.log(res.error);
                    if (res !== '' && res !== null && res.error != 1){
                        window.location.reload();
                    }else{
                        alert("Такого накладного нету в базе");
                    }
                },
                errors: function (error){
                    console.log(error);
                }
            });
        }
    </script>
@endsection
