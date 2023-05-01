@extends('layouts.app')
@section('subheader')
    <style>
		.order_title{
            font-size: 1.3rem;
            font-weight: bold;
            color: #494b74;
        }
        .order-actions{
            padding: 10px;
            background: #f4f4f4;
            border-radius: 3px;
            height: 100px;
            box-shadow: 1px 3px 5px rgba(0,0,0,0.5);
        }
		.large-2::-webkit-scrollbar-track {
			border: 1px solid #000;
			padding: 2px 0;
			background-color: #1e1e2d;
		}

		.large-2::-webkit-scrollbar {
			width: 10px;
		}

		.large-2::-webkit-scrollbar-thumb {
			border-radius: 10px;
			box-shadow: inset 0 0 6px rgba(0,0,0,.3);
			background-color: white;
			border: 1px solid #000;
		}
		.transit-table{
			box-shadow: 1px 3px 5px rgba(0,0,0,0.5);
		}
		.transit-table tr th, .transit-table tr td{
			padding: 5px;
		}
		.transit-desc{
			width: 200px;
			padding: 0;
			margin: 0;
			/* display: flex; */
			font-size: 12px;
		}
		.transit-details{
			width: 150px;
		}
		.transit-actions a{
			display: block;
			width: 100%;
			text-align: center;
			padding: 2px;
			background: #004191;
			border-radius: 5px;
			margin-bottom: 2px;
		}
		.transit-actions a:hover{
			background: #0d2849;
		}
		.transit-actions a i{
			color: white;
		}
		.table td {
			border: 1px solid #004191;
		}
		.tab-content{
			min-height:100px;
		}
		.td_div_checker .form-group{
			margin: 0;
		}
		.td_div_checker .form-group .form-control, .td_div_checker .form-control{
			padding: 0;
			padding-left: 5px;
			height: 30px;
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
                            <a href="{{route('admin.checker.index')}}" class="text-muted">Накладные</a>
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
        
    </div>
	<div class="row">
		<div class="col-md-6">
			<div class="order-actions">
				<div class="form-group">
					<label for="search">Поиск накладных по штрих коду</label>
					<input  type="text" class="form-control" onchange="checkOverhead(this);"
						   id="search" placeholder="ABC1234" autofocus>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="order-actions">
				<div class="form-group">
					<label for="clients">Выберите клиента</label>
					<select id="clients" name="clients" class="form-control" onchange="saveFrom();">
						@if(isset($userData))
						@foreach($userData as $u)
						<option value="{{$u['user_id']}}" 
								from_company="{{$u['from_company']}}"
								from_city="{{$u['from_city']}}"
								from_name="{{$u['from_name']}}"
								from_address="{{$u['from_address']}}"
								from_phone="{{$u['user_id']}}"
								user_id="{{$u['user_id']}}"
								>{{$u['from_company']}} | {{$u['from_name']}}</option>
						@endforeach
						@endif
					</select>
				</div>
			</div>
		</div>
	</div>
    <div class="mx-auto col-lg-12 large-2 mt-5" style="padding: 0;height:800px;overflow-y:scroll;">
		<table class="table table-bordered table-hover mt-2 transit-table">
			<thead>
				<tr>
					<th>#</th>
					<th>Код</th>
					<th>Отправитель</th>
					<th>Имя получателя</th>
					<th>Компания/Город</th>
					<th>Адрес/Телефон</th>
					<th>Тип/Срочность</th>
					<th>Оплата/Способ оплаты</th>
					<th>Действие</th>
				</tr>
			</thead>
			<tbody>
				@if(isset($overheads))
				@php $index=0;@endphp
				@foreach($overheads as $overhead)
				@php $index++;@endphp
				<tr class="checker_row" overhead_id="{{$overhead->id}}" style="background:#e3e8f1;cursor:pointer;">
					<td>
						<div>{{$index}}</div>
					</td>
					<td>
						<div>{{$overhead->overhead_code}}</div>
					</td>
					<td>
						<div>{{$overhead->from_company}}</div>
					</td>
					<td>
						<div class="td_div_checker">
							<div class="form-group">
								<input type="text" name="to_name{{$overhead->id}}" 
									   value="{{$overhead->to_name}}" 
									   class="form-control overhead_updater"
									   onchange="overUpdate(this)"
									   >
							</div>
						</div>
					</td>
					<td>
						<div class="td_div_checker">
							<div class="form-group">
								<input type="text" name="to_company{{$overhead->id}}" 
									   value="{{$overhead->to_company}}" 
									   class="form-control overhead_updater"
									   onchange="overUpdate(this)">
							</div>
						</div>
						<div class="td_div_checker">
							<div class="form-group">
								<select class="form-control overhead_updater" 
										name="to_city{{$overhead->id}}" onchange="overUpdate(this)">
									@if(isset($cities))
									@foreach($cities as $city)
										@if($city->id == $overhead->to_city)
											<option selected value="{{$city->id}}">{{$city->city_name}}</option>
										@else
											<option value="{{$city->id}}">{{$city->city_name}}</option>
										@endif
									@endforeach
									@endif
								</select>
							</div>
						</div>
					</td>
					
					<td>
						<div class="td_div_checker">
							<div class="form-group">
								<input type="text" name="to_address{{$overhead->id}}" 
									   value="{{$overhead->to_address}}" 
									   class="form-control overhead_updater"
									   onchange="overUpdate(this)">
							</div>
						</div>
						<div class="td_div_checker">
							<div class="form-group">
								<input type="text" name="to_phone{{$overhead->id}}" 
									   value="{{$overhead->to_phone}}" 
									   class="form-control overhead_updater"
									   onchange="overUpdate(this)">
							</div>
						</div>
					</td>
					<td>
						<div class="td_div_checker">
							<select class="form-control overhead_updater" 
									name="type{{$overhead->id}}" onchange="overUpdate(this)">
								@if($overhead->type=="Документы")
									<option value="Документы" selected>Документы</option>
									<option value="Посылка">Посылка</option>
								@else
									<option value="Документы">Документы</option>
									<option value="Посылка" selected>Посылка</option>
								@endif
							</select>
						</div>
						<div class="td_div_checker">
							<select class="form-control overhead_updater" 
									name="speed{{$overhead->id}}" onchange="overUpdate(this)">
								@if($overhead->speed=="Экспресс")
									<option value="Экспресс" selected>Экспресс</option>
									<option value="Стандарт">Стандарт</option>
									<option value="Авто">Авто</option>
								@elseif($overhead->speed=="Стандарт")
									<option value="Экспресс">Экспресс</option>
									<option value="Стандарт" selected>Стандарт</option>
									<option value="Авто">Авто</option>
								@else
									<option value="Экспресс">Экспресс</option>
									<option value="Стандарт">Стандарт</option>
									<option value="Авто" selected>Авто</option>
								@endif
							</select>
						</div>
						
					</td>
					<td>
						<div class="td_div_checker">
							<select class="form-control overhead_updater" 
									name="payment{{$overhead->id}}" onchange="overUpdate(this)">
								@if($overhead->payment=="Отправителем")
									<option value="Отправителем" selected>Отправителем</option>
									<option value="Получателем">Получателем</option>
									<option value="Третьей стороной">Третьей стороной</option>
								@elseif($overhead->payment=="Получателем")
									<option value="Отправителем">Отправителем</option>
									<option value="Получателем" selected>Получателем</option>
									<option value="Третьей стороной">Третьей стороной</option>
								@else
									<option value="Отправителем">Отправителем</option>
									<option value="Получателем">Получателем</option>
									<option value="Третьей стороной" selected>Третьей стороной</option>
								@endif
							</select>
						</div>
						<div class="td_div_checker">
							<select class="form-control overhead_updater" 
									name="payment_type{{$overhead->id}}" onchange="overUpdate(this)">
								@if($overhead->payment_type=="По счету")
									<option value="По счету" selected>По счету</option>
									<option value="Наличными">Наличными</option>
									<option value="Терминалом">Терминалом</option>
								@elseif($overhead->payment_type=="Получателем")
									<option value="По счету">По счету</option>
									<option value="Наличными" selected>Наличными</option>
									<option value="Терминалом">Терминалом</option>
								@else
									<option value="По счету">По счету</option>
									<option value="Наличными">Наличными</option>
									<option value="Терминалом" selected>Терминалом</option>
								@endif
							</select>
						</div>
					</td>
					
					<td>
						<div class="td_div_checker">
							<div class="form-group">
								<a href="{{route('admin.checker.delete')}}?overhead_id={{$overhead->id}}">Убрать</a>
							</div>
						</div>
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>

		</table>

    </div>
    

    
@endsection
@section('admin-script')
    <script>
		$("#search").focus();
		initClients();
		
		let overhead_updater = $(".overhead_updater");
		
		function overUpdate(el){
			//console.log($(el).val());
			let element = $(el);
			let value = element.val();
			let tr = element.parents('tr').first();
			let overhead_id = $(tr).attr('overhead_id');
			
			let d = {};
			d.value = value;
			d.overhead_id = overhead_id;
			d._token = "{{ csrf_token() }}";
			d.to_name = $('.form-control[name="to_name'+overhead_id+'"]').val();
			d.to_company = $('.form-control[name="to_company'+overhead_id+'"]').val();
			d.to_city = $('.form-control[name="to_city'+overhead_id+'"]').val();
			d.to_address = $('.form-control[name="to_address'+overhead_id+'"]').val();
			d.to_phone = $('.form-control[name="to_phone'+overhead_id+'"]').val();
			
			d.type = $('.form-control[name="type'+overhead_id+'"]').val();
			d.speed = $('.form-control[name="speed'+overhead_id+'"]').val();
			d.payment = $('.form-control[name="payment'+overhead_id+'"]').val();
			d.payment_type = $('.form-control[name="payment_type'+overhead_id+'"]').val();
			//console.log(JSON.stringify(d));
			//console.log($(tr).attr('overhead_id'));
			//return;
			$.ajax({
				url: "{{route('admin.checker.update')}}",
				method: "POST",
				//data: {value: value, overhead_id: overhead_id, _token: "{{ csrf_token() }}"},
				data: d,
				success: function(result){
					let res = JSON.parse(result);
					console.log(res);
					//return;
					if(res['success'] === 1){
						window.location.reload();
					}else if(res['success'] === 0){
						alert("Что то пошло не так, обратитесь к администратору");
					}else{
						alert("Проблема с отправкой!!!");
					}
				},
				error: function(res){
					console.log(res);
				}
			});
			
		}
		
		function initClients(){
			let client = JSON.parse(localStorage.getItem("client"));
			
			let selectClients = $("#clients option");
			
			selectClients.each(function(i, el){
				let user_id = $(el).val();
				if(client.user_id == user_id){
					$(el).prop('selected', true);
				}
			});
		}
		
		function checkOverhead(code){
			//console.log($(code).val());
			let overhead_code = $(code).val();
			let client = JSON.parse(localStorage.getItem("client"));
			$.ajax({
				url: "{{route('admin.checker.search')}}",
				method: "GET",
				data: {code: overhead_code, user: client},
				success: function(result){
					let res = JSON.parse(result);
					console.log(res);
					//return;
					if(res['success'] === 1){
						window.location.reload();
					}else if(res['success'] === 0){
						alert("Что то пошло не так, обратитесь к администратору");
					}else{
						alert("Такой накладной существует!!!");
					}
				},
				error: function(res){
					console.log(res);
				}
			});
			
		}
		function saveFrom(){
			let client = $("#clients option:checked");
			let sClient = {};
			sClient.user_id = $(client).attr('user_id');
			sClient.fromName = $(client).attr('from_name');
			sClient.fromCompany = $(client).attr('from_company');
			sClient.fromCity = $(client).attr('from_city');
			sClient.fromAddress = $(client).attr('from_address');
			sClient.fromPhone = $(client).attr('from_phone');
			
			let storeClient = localStorage.getItem("client");
			if(storeClient === null){
				localStorage.setItem("client", JSON.stringify(sClient));
				
			}else{
				let sClient2 = JSON.parse(localStorage.getItem("client"));
				if(sClient2.user_id !== sClient.user_id){
					localStorage.clear();
					localStorage.setItem("client", JSON.stringify(sClient));
				}
			}	
			console.log(JSON.parse(localStorage.getItem("client")).fromName);
		}

    </script>
@endsection
