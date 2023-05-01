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
            margin: 5px;
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
        .overheads{
            padding: 5px;
            box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.5);
        }
        #overheads1,#overheads2{
            font-size: 12px;

        }
        #overheads1 p, #overheads2 p  {
            margin-bottom: 0;
        }
        .checked_item{
            margin: 7px;
            width: 20px;
            height: 20px;
        }
        .overheads_p{
            margin-top: 15px;
        }
        .registry{
            margin-bottom: 4px;
            display: flex;
            min-height: 400px;
            box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.5);
        }
        .registry_item{
            width: 90%;
            margin: 5px auto;
        }
        .registry_header{
            border: 1px solid #ff7324;
            border-radius: 3px;
        }
        .registry_content ul{
            list-style: none;
            margin-bottom: 0;
            padding: 0;
        }
        .show_ul{
            display: block;
        }
        .hide_ul{
            display: none;
        }
        .border-1{
            padding: 5px;
        }
        .registry ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            padding: 0;
            width: 100%;
        }
        .registry ul li{
            padding: 5px;
            background: #3f4254;
            color:#FFFFFF;
            display: flex;
        }
        .text_registry{
            padding: 2px;
            font-size: 14px;
            margin-right: 4px;
            border-right: 1px solid #FFFFFF;
        }
        .arrow-right, .arrow-left{
            display: block;
            text-align: center;
        }
        .arrow-right i, .arrow-left i{
            font-size: 60px;
        }
        .arrow-right:hover i{
            color: red;
        }
        .arrow-left:hover i{
            color: green;
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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Сборка</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.store.index')}}" class="text-muted">Склад</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.store.registry')}}" class="text-muted">Сборка</a>
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
                <div class="col-md-5">
					<div class="alert-info"></div>
					<div class="left_actions" style="display:flex;">
						<button class="btn btn-primary" id="select_all">Выбрать все</button>
						<select name="city" id="filter_city" class="form-control" style="width:40%;">
							@if(isset($cities))
							<option value="0">Не выбрано</option>
								@foreach($cities as $city)
									<option value="{{$city->id}}">{{$city->city_name}}</option>
								@endforeach
							@endif
						</select>
						<input type="text" name="overhead_code_5" id="overhead_code_5"
							   placeholder="123456"
                               autofocus="autofocus"
							   class="form-control"
							   style="width: 30%;">
					</div>
                </div>
				<div class="col-md-2"></div>
                <div class="col-md-5">
					<div class="right_actions">
						<button class="btn btn-primary" id="select_all2">Выбрать все</button>
						<a class="btn btn-primary add_registry"
                       	data-toggle="modal" data-target="#exampleModalLong">Сохранить</a>
					</div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-5">
                    <table class="table table-hover table-bordered" id="overheads1">
                        <thead>
                        <tr>
							<th>№</th>
                            <th style="width: 30px;"></th>
                            <th>#</th>
                            <th>Отправитель</th>
                            <th>Получатель</th>
                            <th>Куда</th>
                        </tr>
                        </thead>
                        <tbody id="leftOverheads">
                        @if(isset($overheads))
							@php $i=0 @endphp
                            @foreach($overheads as $overhead)
							@php $i++ @endphp
                                <tr class="visible">
									<td><p style="text-align: center;margin-top: 15px;">{{$i}}</p></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="checkbox" class="form-control checked_item" data="{{$overhead->id}}">

                                        </div>
                                    </td>
                                    <td> <p class="overheads_p overheads_p2">{{$overhead->overhead_code}}</p> </td>
                                    <td> <p class="overheads_p">{{$overhead->from_company}}</p> </td>
                                    <td>
                                        <p class="text-danger">{{$overhead->to_name}}</p>
                                        <p class="text-info">{{$overhead->to_address}}</p>
                                        <p class="text-dark" style="font-weight: bold;">{{$overhead->to_phone}}</p>
                                    </td>
                                    <td><p class="overheads_p td_city">{{$overhead->to_city}}</p></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-md-2 actions">
                    <a href="#" class="arrow-right">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="#" class="arrow-left">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <div class="col-md-5">
                    <table class="table table-hover table-bordered" id="overheads2">
                        <thead>
                        <tr>
							<th>№</th>
                            <th style="width: 30px;"></th>
                            <th>#</th>
                            <th>Отправитель</th>
                            <th>Получатель</th>
                            <th>Куда</th>
                        </tr>
                        </thead>
                        <tbody id="rightOverheads">
                        @if(isset($overheads2))
							@php $k=0 @endphp
                            @foreach($overheads2 as $overhead)
							@php $k++ @endphp
                                <tr class="visible">
									<td><p style="text-align: center;margin-top: 15px;">{{$k}}</p></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="checkbox" class="form-control checked_item" data="{{$overhead->id}}">
                                        </div>
                                    </td>
                                    <td> <p class="overheads_p overheads_p2">{{$overhead->overhead_code}}</p> </td>
                                    <td> <p class="overheads_p">{{$overhead->from_company}}</p> </td>
                                    <td>
                                        <p class="text-danger">{{$overhead->to_name}}</p>
                                        <p class="text-info">{{$overhead->to_address}}</p>
                                        <p class="text-dark" style="font-weight: bold;">{{$overhead->to_phone}}</p>
                                    </td>
                                    <td><p class="overheads_p td_city">{{$overhead->to_city}}</p></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Сохранить</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form action="{{route('admin.store.create')}}" method="post">
                        <input type="hidden" value="" name="registry_overheads" id="registry_overheads">
                    <div class="modal-body">
                        @csrf

                        <div class="form-group">
                            <label for="transport_type">Перевозчик</label>
                            <select name="transport_type" id="transport_type" class="form-control">
                                @if(isset($transports))
                                    <option value="0">Не установлен</option>
                                    @foreach($transports as $transport)
                                        <option value="{{$transport->id}}">{{$transport->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="from">Город(откуда)</label>
                            <select name="from" id="from" class="form-control">
                                @if(isset($cities))
                                    <option value="31">Алматы</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->city_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="to">Город(куда)</label>
                            <select name="to" id="to" class="form-control">
                                @if(isset($cities))
                                    <option value="31">Алматы</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->city_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="place">Кол-во мест</label>
                            <input type="text" name="place" id="place" class="form-control" placeholder="Укажите количество мест" value="0">
                        </div>
                        <div class="form-group">
                            <label for="count">Кол-во сборок</label>
                            <input type="text" name="count" id="count" class="form-control" placeholder="Укажите количество сборок" value="0">
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
		$('#filter_city').change(function(el){
			let select = $(this);
			let value = select.val(); //
			let option = select.find('option');
			let optionText = $(option[value]).text(); //
			console.log(optionText);
			console.log($(this).val());
			//return;
			$('#leftOverheads tr').removeClass('visible');

			//console.log(optionText);
			//console.log($(this).val());
			let to_city = $('#leftOverheads .td_city');
			console.log(to_city);
			//return;
			to_city.each(function(i, el){
				//console.log($(el).text());
				let city = $(el);
				let city_text = city.text();
				let tr = city.parent().parent();
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
		let checkbox1 = $('#leftOverheads .checked_item');
		$('#select_all').click(function(){
			if(flag1 == 0){
				//checkbox1.prop('checked', true);
				checkbox1.each(function(i, el){
					let che = $(el);
					let tr = che.parent().parent().parent();
					if(tr.hasClass('visible')){
						che.prop('checked', true);
					}
				});
				flag1 = 1;
			}else{
				checkbox1.each(function(i, el){
					let che = $(el);
					let tr = che.parent().parent().parent();
					if(tr.hasClass('visible')){
						che.prop('checked', false);
					}
				});
				flag1 = 0;
			}
		});
		let flag2 = 0;
		let checkbox2 = $('#rightOverheads .checked_item');
		$('#select_all2').click(function(){
			if(flag1 == 0){
				//checkbox1.prop('checked', true);
				checkbox2.each(function(i, el){
					let che = $(el);
					let tr = che.parent().parent().parent();
					if(tr.hasClass('visible')){
						che.prop('checked', true);
					}
				});
				flag1 = 1;
			}else{
				checkbox2.each(function(i, el){
					let che = $(el);
					let tr = che.parent().parent().parent();
					if(tr.hasClass('visible')){
						che.prop('checked', false);
					}
				});
				flag1 = 0;
			}
		});
        $('.add_registry').click(function(){
            let items = $('#rightOverheads tr .checked_item:checked');
            let data = [];
            items.each(function (i, el){
                data.push($(el).attr('data'));
            });
            let js = JSON.stringify(data);
            console.log(JSON.stringify(data));
            $('#registry_overheads').val(js);
        });

        $("#add_registry").click(function(){
            let tr = $('tr.visible');
            let ch = tr.find('.checked_item');
            let d = ch.attr('data');
            console.log(d);
            let data = [];
            let da = {};
            tr.each(function (i, el){
                data[i] = $(el).find('.checked_item').attr('data');
            });
            console.log(data);
            let registry = $('.registry_id');
            let registry_id = registry.val();
            da = {
                _token: '{{@csrf_token()}}',
                data: data,
                registry_id: registry_id
            };
            $.ajax({
                url: '{{route('admin.store.createRegistry')}}',
                method: 'post',
                data:da,
                success: function (result){
                    console.log(result);
                    let res = JSON.parse(result);
                    if (res.success === true){
                        window.location.reload();
                    }
                },
                error: function (error){
                    console.log(error);
                }
            });
            console.log(da);

        });


        $('.arrow-right').click(function (e){
            e.preventDefault();
            let ids = [];
			let check5 = $('#leftOverheads .checked_item:checked');
            check5.each(function (i, el){
                if ($(el).prop('checked') === true){
                    ids.push($(el).attr('data'));
                }
            });
			//console.log(check5);
			//return;
            $.ajax({
                url: '{{route('admin.store.updateS')}}',
                method: 'post',
                data: {ids: ids, _token: '{{csrf_token()}}'},
                success: function(res){
                    console.log(res);
                    // let result = JSON.parse(res);
                    if (res.length > 0){
                        window.location.reload();
                    }
                },
                error: function(error){
                    console.log(error);
                }
            });
            //console.log(ids);
        });
        $('.arrow-left').click(function (e){
            e.preventDefault();
            let ids = [];
			let check6 = $('#rightOverheads .checked_item:checked');
            check6.each(function (i, el){
                if ($(el).prop('checked') === true){
                    ids.push($(el).attr('data'));
                }
            });
            $.ajax({
                url: '{{route('admin.store.updateE')}}',
                method: 'post',
                data: {ids: ids, _token: '{{csrf_token()}}'},
                success: function(res){
                    //console.log(res);
                    // let result = JSON.parse(res);
                    if (res.length > 0){
                        window.location.reload();
                    }
                },
                error: function(error){
                    console.log(error);
                }
            });
            //console.log(ids);
        });

		$("#overhead_code_5").change(function(){
			let overhead_code = $(this).val();
			console.log(overhead_code);

			$.ajax({
				url: '{{route("admin.store.setStatus3")}}',
				method: 'GET',
				data: {overhead_code: overhead_code},
				success: function(result){
					console.log(JSON.parse(result));
					let res = JSON.parse(result);
					if(res.success === 1){
						window.location.reload();
					}else{
						$(".alert-info").append("<div class='alert alert-danger'>Такого накладного не сущечтвует!!!</div>");
					}

				},
				error: function(error){
					console.log(error);
				}
			});

		});
    </script>
@endsection
