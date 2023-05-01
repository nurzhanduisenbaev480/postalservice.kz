@extends('layouts.app')
@section('subheader')
<style>
	#barcode-scanner canvas.drawingBuffer, #barcode-scanner video.drawingBuffer {
		display: none;
	}

	#barcode-scanner canvas, #barcode-scanner video {
		width: 100%;
		height: auto;
	}
	.form-group{
		margin-bottom: 1rem;
	}
	.success{
		background-color: #0fee85;
	}
</style>
@endsection
@section('content-admin')
	
<div class="col-lg-12 col-sm-12">
	<div>
		<h1>Реестр № 
			<span style="color:#004191">
				@if(isset($registry))
				{{$registry->code}}
				@endif
			</span>
		</h1>
		
	</div>	
</div>
<div class="col-lg-4 col-sm-4">
	<button class="btn btn-primary btn-sm" id="acceptChecked">Принять выбранных</button>
	
</div>
<div class="col-lg-4 col-sm-4" id="checkChecked">
	
</div>
<div class="col-lg-12 col-sm-12 mt-3" style="overflow-x: scroll;overflow-y: scroll;min-height: 400px;">
	@if(Session::has('success'))
	<div class="alert alert-success">{{Session::get('success')}}</div>
	@endif
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>
					<div class="form-group">
						<input type="checkbox" id="checkAll">
					</div>
				</th>
				<th>
					Действие
				</th>
				<th>
					Номер накладного
				</th>
				<th>
					Адрес получателя
				</th>
				<th>
					Получатель
				</th>
				<th>
					Отправитель
				</th>
			</tr>
		</thead>
		<tbody>
			@if(isset($overheads))
				@foreach($overheads as $overhead)
			@php 
				$journal = \App\Models\Journal::where('overhead_code', $overhead->overhead_code)->orderBy('id', 'DESC')->get()->first();
			@endphp
				@if($journal->status_id == 18 || $journal->status_id == 15)
					<tr class="table-primary">
				<td>
					<div class="form-group">
						<input type="checkbox" class="checkedItem" data="{{$overhead->id}}">
					</div>
				</td>
				<td>
					
					<a href="#" style="font-size:9px;" class="btn btn-primary btn-sm edit_status_btn"
					   data-toggle="modal" data-target="#exampleModalLong{{$overhead->id}}">
						Сменить статус
					</a>
					
					<div class="modal fade" id="exampleModalLong{{$overhead->id}}" tabindex="-1"
						 role="dialog" aria-labelledby="exampleModalLongTitle"
						 aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Информация</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="{{route('admin.region.setStatus')}}" method="post">
									<div class="modal-body">
										@csrf
										<input type="hidden" name="overhead_id" id="overhead_id" 
											   value="{{$overhead->id}}">
										<input type="hidden" name="registry_id" id="registry_id" 
											   value="{{$registry->code}}">
										<div class="form-group">
											<label for="status_id">Статус</label>
											<select id="status_id" class="form-control" name="status_id">
												<option value="18">На доставке</option>
												<option value="8">Доставлен</option>
												<option value="16">Не доставлен</option>
											</select>
										</div>
										<div class="form-group">
											<label for="description">Примечание</label>
											<textarea class="form-control" name="description" id="description">
											</textarea>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" 
												data-dismiss="modal">Закрыть</button>
										<button type="submit" class="btn btn-primary">Сохранить</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</td>
				<td>

					<a href="#" style="color:#004191;" class="edit_overhead"
					   data-toggle="modal" data-target="#overhead{{$overhead->id}}">
						{{$overhead->overhead_code}}
					</a>
					<div class="modal fade" id="overhead{{$overhead->id}}" tabindex="-1"
						 role="dialog" aria-labelledby="exampleModalLongTitle"
						 aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Информация</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="{{route('admin.region.setStatus')}}" method="post">
									<div class="modal-body">
										<h5 style="color:#004191;">Отправитель</h5>
										<hr>
										<div class="form-group">
											<label for="from_name">ФИО</label>
											<input type="text" id="from_name" class="form-control" 
												   readonly value="{{$overhead->from_name}}">
										</div>
										<div class="form-group">
											<label for="from_company">Компания</label>
											<input type="text" id="from_company" class="form-control" 
												   readonly value="{{$overhead->from_company}}">
										</div>
										<div class="form-group">
											<label for="from_city">Город</label>
											@if(strlen($overhead->from_city) > 2)
											<input type="text" id="from_city" class="form-control" 
												   readonly value="{{$overhead->from_city}}">
											@else
											@if(App\Models\City::find($overhead->from_city) != null)
											<input type="text" id="from_city" class="form-control" 
												   readonly value="{{App\Models\City::find($overhead->from_city)->city_name}}">
											@else
											<p>Не правильно указан</p>
											@endif
											@endif
										</div>
										<div class="form-group">
											<label for="from_address">Адрес</label>
											<input type="text" id="from_address" class="form-control" 
												   readonly value="{{$overhead->from_address}}">
										</div>
										<div class="form-group">
											<label for="from_phone">Телефон</label>
											<input type="text" id="from_phone" class="form-control" 
												   readonly value="{{$overhead->from_phone}}">
										</div>
										<hr>
										<h5 style="color:#004191;">Получатель</h5>
										<hr>
										<div class="form-group">
											<label for="to_name">ФИО</label>
											<input type="text" id="to_name" class="form-control" 
												   readonly value="{{$overhead->to_name}}">
										</div>
										<div class="form-group">
											<label for="to_company">Компания</label>
											<input type="text" id="to_company" class="form-control" 
												   readonly value="{{$overhead->to_company}}">
										</div>
										<div class="form-group">
											<label for="to_city">Город</label>
											@if(strlen($overhead->to_city) > 2)
											<input type="text" id="to_city" class="form-control" 
												   readonly value="{{$overhead->to_city}}">
											@else
											@if(App\Models\City::find($overhead->to_city) != null)
											<input type="text" id="to_city" class="form-control" 
												   readonly value="{{App\Models\City::find($overhead->to_city)->city_name}}">
											@else
											<p>Не правильно указан</p>
											@endif
											@endif
										</div>
										<div class="form-group">
											<label for="to_address">Адрес</label>
											<input type="text" id="to_address" class="form-control" 
												   readonly value="{{$overhead->to_address}}">
										</div>
										<div class="form-group">
											<label for="to_phone">Телефон</label>
											<input type="text" id="to_phone" class="form-control" 
												   readonly value="{{$overhead->to_phone}}">
										</div>
										<hr>
										<h5 style="color:#004191;">Детали</h5>
										<hr>
										<div class="form-group">
											<label for="type">Тип отправки:</label>
											<input type="text" id="type" class="form-control" 
												   readonly value="{{$overhead->type}}">
										</div>
										<div class="form-group">
											<label for="speed">Скорость:</label>
											<input type="text" id="speed" class="form-control" 
												   readonly value="{{$overhead->speed}}">
										</div>
										<div class="form-group">
											<label for="payment">Оплата:</label>
											<input type="text" id="payment" class="form-control" 
												   readonly value="{{$overhead->payment}}">
										</div>
										<div class="form-group">
											<label for="payment_type">Способ оплаты:</label>
											<input type="text" id="payment_type" class="form-control" 
												   readonly value="{{$overhead->payment_type}}">
										</div>
										<div class="form-group">
											<label for="mass">Масса:</label>
											<input type="text" id="mass" class="form-control" 
												   readonly value="{{$overhead->mass}}">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" 
												data-dismiss="modal">Закрыть</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</td>
				<td>
					<div>
						<p style="margin-bottom:0;color:#004191;font-size:10px;">{{$overhead->to_name}}</p>
						<p style="margin-bottom:0;font-size:10px;">{{$overhead->to_address}}</p>
						<a href="tel:{{$overhead->to_phone}}">{{$overhead->to_phone}}</a>
					</div>
				</td>
				<td>
					<div>
						{{$overhead->to_name}}
					</div>
				</td>
				<td>
					<div>
						{{$overhead->from_name}}
					</div>
				</td>
			</tr>
				@endif
			@if(\App\Models\Journal::where('overhead_code', $overhead->overhead_code)->orderBy('id', 'DESC')->get()->first()->status_id == 8)
			<tr class=" success">
				<td>
					<div class="form-group">
						<input type="checkbox" class="checkedItem" data="{{$overhead->id}}">
					</div>
				</td>
				<td>
					
					<div class="modal fade" id="exampleModalLong{{$overhead->id}}" tabindex="-1"
						 role="dialog" aria-labelledby="exampleModalLongTitle"
						 aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Информация</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="{{route('admin.region.setStatus')}}" method="post">
									<div class="modal-body">
										@csrf
										<input type="hidden" name="overhead_id" id="overhead_id" 
											   value="{{$overhead->id}}">
										<input type="hidden" name="registry_id" id="registry_id" 
											   value="{{$registry->code}}">
										<div class="form-group">
											<label for="status_id">Статус</label>
											<select id="status_id" class="form-control" name="status_id">
												<option value="18">На доставке</option>
												<option value="8">Доставлен</option>
												<option value="16">Не доставлен</option>
											</select>
										</div>
										<div class="form-group">
											<label for="description">Примечание</label>
											<textarea class="form-control" name="description" id="description">
											</textarea>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" 
												data-dismiss="modal">Закрыть</button>
										<button type="submit" class="btn btn-primary">Сохранить</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</td>
				<td>

					<a href="#" style="color:#004191;" class="edit_overhead"
					   data-toggle="modal" data-target="#overhead{{$overhead->id}}">
						{{$overhead->overhead_code}}
					</a>
					<div class="modal fade" id="overhead{{$overhead->id}}" tabindex="-1"
						 role="dialog" aria-labelledby="exampleModalLongTitle"
						 aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Информация</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="{{route('admin.region.setStatus')}}" method="post">
									<div class="modal-body">
										<h5 style="color:#004191;">Отправитель</h5>
										<hr>
										<div class="form-group">
											<label for="from_name">ФИО</label>
											<input type="text" id="from_name" class="form-control" 
												   readonly value="{{$overhead->from_name}}">
										</div>
										<div class="form-group">
											<label for="from_company">Компания</label>
											<input type="text" id="from_company" class="form-control" 
												   readonly value="{{$overhead->from_company}}">
										</div>
										<div class="form-group">
											<label for="from_city">Город</label>
											@if(strlen($overhead->from_city) > 2)
											<input type="text" id="from_city" class="form-control" 
												   readonly value="{{$overhead->from_city}}">
											@else
											@if(App\Models\City::find($overhead->from_city) != null)
											<input type="text" id="from_city" class="form-control" 
												   readonly value="{{App\Models\City::find($overhead->from_city)->city_name}}">
											@else
											<p>Не правильно указан</p>
											@endif
											@endif
										</div>
										<div class="form-group">
											<label for="from_address">Адрес</label>
											<input type="text" id="from_address" class="form-control" 
												   readonly value="{{$overhead->from_address}}">
										</div>
										<div class="form-group">
											<label for="from_phone">Телефон</label>
											<input type="text" id="from_phone" class="form-control" 
												   readonly value="{{$overhead->from_phone}}">
										</div>
										<hr>
										<h5 style="color:#004191;">Получатель</h5>
										<hr>
										<div class="form-group">
											<label for="to_name">ФИО</label>
											<input type="text" id="to_name" class="form-control" 
												   readonly value="{{$overhead->to_name}}">
										</div>
										<div class="form-group">
											<label for="to_company">Компания</label>
											<input type="text" id="to_company" class="form-control" 
												   readonly value="{{$overhead->to_company}}">
										</div>
										<div class="form-group">
											<label for="to_city">Город</label>
											@if(strlen($overhead->to_city) > 2)
											<input type="text" id="to_city" class="form-control" 
												   readonly value="{{$overhead->to_city}}">
											@else
											@if(App\Models\City::find($overhead->to_city) != null)
											<input type="text" id="to_city" class="form-control" 
												   readonly value="{{App\Models\City::find($overhead->to_city)->city_name}}">
											@else
											<p>Не правильно указан</p>
											@endif
											@endif
										</div>
										<div class="form-group">
											<label for="to_address">Адрес</label>
											<input type="text" id="to_address" class="form-control" 
												   readonly value="{{$overhead->to_address}}">
										</div>
										<div class="form-group">
											<label for="to_phone">Телефон</label>
											<input type="text" id="to_phone" class="form-control" 
												   readonly value="{{$overhead->to_phone}}">
										</div>
										<hr>
										<h5 style="color:#004191;">Детали</h5>
										<hr>
										<div class="form-group">
											<label for="type">Тип отправки:</label>
											<input type="text" id="type" class="form-control" 
												   readonly value="{{$overhead->type}}">
										</div>
										<div class="form-group">
											<label for="speed">Скорость:</label>
											<input type="text" id="speed" class="form-control" 
												   readonly value="{{$overhead->speed}}">
										</div>
										<div class="form-group">
											<label for="payment">Оплата:</label>
											<input type="text" id="payment" class="form-control" 
												   readonly value="{{$overhead->payment}}">
										</div>
										<div class="form-group">
											<label for="payment_type">Способ оплаты:</label>
											<input type="text" id="payment_type" class="form-control" 
												   readonly value="{{$overhead->payment_type}}">
										</div>
										<div class="form-group">
											<label for="mass">Масса:</label>
											<input type="text" id="mass" class="form-control" 
												   readonly value="{{$overhead->mass}}">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" 
												data-dismiss="modal">Закрыть</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</td>
				<td>
					<div>
						<p style="margin-bottom:0;color:#004191;font-size:10px;">{{$overhead->to_name}}</p>
						<p style="margin-bottom:0;font-size:10px;">{{$overhead->to_address}}</p>
						<a href="tel:{{$overhead->to_phone}}">{{$overhead->to_phone}}</a>
					</div>
				</td>
				<td>
					<div>
						{{$overhead->to_name}}
					</div>
				</td>
				<td>
					<div>
						{{$overhead->from_name}}
					</div>
				</td>
			</tr>
				@endif
			@if(\App\Models\Journal::where('overhead_code', $overhead->overhead_code)->orderBy('id', 'DESC')->get()->first()->status_id == 16)
			<tr class="table-danger">
				<td>
					<div class="form-group">
						<input type="checkbox" class="checkedItem" data="{{$overhead->id}}">
					</div>
				</td>
				<td>
					<a href="#" style="font-size:9px;" class="btn btn-primary btn-sm edit_status_btn"
					   data-toggle="modal" data-target="#exampleModalLong{{$overhead->id}}">
						Сменить статус
					</a>
					<div class="modal fade" id="exampleModalLong{{$overhead->id}}" tabindex="-1"
						 role="dialog" aria-labelledby="exampleModalLongTitle"
						 aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Информация</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="{{route('admin.region.setStatus')}}" method="post">
									<div class="modal-body">
										@csrf
										<input type="hidden" name="overhead_id" id="overhead_id" 
											   value="{{$overhead->id}}">
										<input type="hidden" name="registry_id" id="registry_id" 
											   value="{{$registry->code}}">
										<div class="form-group">
											<label for="status_id">Статус</label>
											<select id="status_id" class="form-control" name="status_id">
												<option value="18">На доставке</option>
												<option value="8">Доставлен</option>
												<option value="16">Не доставлен</option>
											</select>
										</div>
										<div class="form-group">
											<label for="description">Примечание</label>
											<textarea class="form-control" name="description" id="description">
											</textarea>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" 
												data-dismiss="modal">Закрыть</button>
										<button type="submit" class="btn btn-primary">Сохранить</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</td>
				<td>

					<a href="#" style="color:#004191;" class="edit_overhead"
					   data-toggle="modal" data-target="#overhead{{$overhead->id}}">
						{{$overhead->overhead_code}}
					</a>
					<div class="modal fade" id="overhead{{$overhead->id}}" tabindex="-1"
						 role="dialog" aria-labelledby="exampleModalLongTitle"
						 aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Информация</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="{{route('admin.region.setStatus')}}" method="post">
									<div class="modal-body">
										<h5 style="color:#004191;">Отправитель</h5>
										<hr>
										<div class="form-group">
											<label for="from_name">ФИО</label>
											<input type="text" id="from_name" class="form-control" 
												   readonly value="{{$overhead->from_name}}">
										</div>
										<div class="form-group">
											<label for="from_company">Компания</label>
											<input type="text" id="from_company" class="form-control" 
												   readonly value="{{$overhead->from_company}}">
										</div>
										<div class="form-group">
											<label for="from_city">Город</label>
											@if(strlen($overhead->from_city) > 2)
											<input type="text" id="from_city" class="form-control" 
												   readonly value="{{$overhead->from_city}}">
											@else
											@if(App\Models\City::find($overhead->from_city) != null)
											<input type="text" id="from_city" class="form-control" 
												   readonly value="{{App\Models\City::find($overhead->from_city)->city_name}}">
											@else
											<p>Не правильно указан</p>
											@endif
											@endif
										</div>
										<div class="form-group">
											<label for="from_address">Адрес</label>
											<input type="text" id="from_address" class="form-control" 
												   readonly value="{{$overhead->from_address}}">
										</div>
										<div class="form-group">
											<label for="from_phone">Телефон</label>
											<input type="text" id="from_phone" class="form-control" 
												   readonly value="{{$overhead->from_phone}}">
										</div>
										<hr>
										<h5 style="color:#004191;">Получатель</h5>
										<hr>
										<div class="form-group">
											<label for="to_name">ФИО</label>
											<input type="text" id="to_name" class="form-control" 
												   readonly value="{{$overhead->to_name}}">
										</div>
										<div class="form-group">
											<label for="to_company">Компания</label>
											<input type="text" id="to_company" class="form-control" 
												   readonly value="{{$overhead->to_company}}">
										</div>
										<div class="form-group">
											<label for="to_city">Город</label>
											@if(strlen($overhead->to_city) > 2)
											<input type="text" id="to_city" class="form-control" 
												   readonly value="{{$overhead->to_city}}">
											@else
											@if(App\Models\City::find($overhead->to_city) != null)
											<input type="text" id="to_city" class="form-control" 
												   readonly value="{{App\Models\City::find($overhead->to_city)->city_name}}">
											@else
											<p>Не правильно указан</p>
											@endif
											@endif
										</div>
										<div class="form-group">
											<label for="to_address">Адрес</label>
											<input type="text" id="to_address" class="form-control" 
												   readonly value="{{$overhead->to_address}}">
										</div>
										<div class="form-group">
											<label for="to_phone">Телефон</label>
											<input type="text" id="to_phone" class="form-control" 
												   readonly value="{{$overhead->to_phone}}">
										</div>
										<hr>
										<h5 style="color:#004191;">Детали</h5>
										<hr>
										<div class="form-group">
											<label for="type">Тип отправки:</label>
											<input type="text" id="type" class="form-control" 
												   readonly value="{{$overhead->type}}">
										</div>
										<div class="form-group">
											<label for="speed">Скорость:</label>
											<input type="text" id="speed" class="form-control" 
												   readonly value="{{$overhead->speed}}">
										</div>
										<div class="form-group">
											<label for="payment">Оплата:</label>
											<input type="text" id="payment" class="form-control" 
												   readonly value="{{$overhead->payment}}">
										</div>
										<div class="form-group">
											<label for="payment_type">Способ оплаты:</label>
											<input type="text" id="payment_type" class="form-control" 
												   readonly value="{{$overhead->payment_type}}">
										</div>
										<div class="form-group">
											<label for="mass">Масса:</label>
											<input type="text" id="mass" class="form-control" 
												   readonly value="{{$overhead->mass}}">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" 
												data-dismiss="modal">Закрыть</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</td>
				<td>
					<div>
						<p style="margin-bottom:0;color:#004191;font-size:10px;">{{$overhead->to_name}}</p>
						<p style="margin-bottom:0;font-size:10px;">{{$overhead->to_address}}</p>
						<a href="tel:{{$overhead->to_phone}}">{{$overhead->to_phone}}</a>
					</div>
				</td>
				<td>
					<div>
						{{$overhead->to_name}}
					</div>
				</td>
				<td>
					<div>
						{{$overhead->from_name}}
					</div>
				</td>
			</tr>
				@endif
			@if(\App\Models\Journal::where('overhead_code', $overhead->overhead_code)->orderBy('id', 'DESC')->get()->first()->status_id == 7)
			<tr>
				<td>
					<div class="form-group">
						<input type="checkbox" class="checkedItem" data="{{$overhead->id}}">
					</div>
				</td>
				<td>
					<a href="#" style="font-size:9px;" class="btn btn-primary btn-sm edit_status_btn"
					   data-toggle="modal" data-target="#exampleModalLong{{$overhead->id}}">
						Сменить статус
					</a>
					<div class="modal fade" id="exampleModalLong{{$overhead->id}}" tabindex="-1"
						 role="dialog" aria-labelledby="exampleModalLongTitle"
						 aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Информация</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="{{route('admin.region.setStatus')}}" method="post">
									<div class="modal-body">
										@csrf
										<input type="hidden" name="overhead_id" id="overhead_id" 
											   value="{{$overhead->id}}">
										<input type="hidden" name="registry_id" id="registry_id" 
											   value="{{$registry->code}}">
										<div class="form-group">
											<label for="status_id">Статус</label>
											<select id="status_id" class="form-control" name="status_id">
												<option value="18">На доставке</option>
												<option value="8">Доставлен</option>
												<option value="16">Не доставлен</option>
											</select>
										</div>
										<div class="form-group">
											<label for="description">Примечание</label>
											<textarea class="form-control" name="description" id="description">
											</textarea>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" 
												data-dismiss="modal">Закрыть</button>
										<button type="submit" class="btn btn-primary">Сохранить</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</td>
				<td>

					<a href="#" style="color:#004191;" class="edit_overhead"
					   data-toggle="modal" data-target="#overhead{{$overhead->id}}">
						{{$overhead->overhead_code}}
					</a>
					<div class="modal fade" id="overhead{{$overhead->id}}" tabindex="-1"
						 role="dialog" aria-labelledby="exampleModalLongTitle"
						 aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Информация</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="{{route('admin.region.setStatus')}}" method="post">
									<div class="modal-body">
										<h5 style="color:#004191;">Отправитель</h5>
										<hr>
										<div class="form-group">
											<label for="from_name">ФИО</label>
											<input type="text" id="from_name" class="form-control" 
												   readonly value="{{$overhead->from_name}}">
										</div>
										<div class="form-group">
											<label for="from_company">Компания</label>
											<input type="text" id="from_company" class="form-control" 
												   readonly value="{{$overhead->from_company}}">
										</div>
										<div class="form-group">
											<label for="from_city">Город</label>
											@if(strlen($overhead->from_city) > 2)
											<input type="text" id="from_city" class="form-control" 
												   readonly value="{{$overhead->from_city}}">
											@else
											@if(App\Models\City::find($overhead->from_city) != null)
											<input type="text" id="from_city" class="form-control" 
												   readonly value="{{App\Models\City::find($overhead->from_city)->city_name}}">
											@else
											<p>Не правильно указан</p>
											@endif
											@endif
										</div>
										<div class="form-group">
											<label for="from_address">Адрес</label>
											<input type="text" id="from_address" class="form-control" 
												   readonly value="{{$overhead->from_address}}">
										</div>
										<div class="form-group">
											<label for="from_phone">Телефон</label>
											<input type="text" id="from_phone" class="form-control" 
												   readonly value="{{$overhead->from_phone}}">
										</div>
										<hr>
										<h5 style="color:#004191;">Получатель</h5>
										<hr>
										<div class="form-group">
											<label for="to_name">ФИО</label>
											<input type="text" id="to_name" class="form-control" 
												   readonly value="{{$overhead->to_name}}">
										</div>
										<div class="form-group">
											<label for="to_company">Компания</label>
											<input type="text" id="to_company" class="form-control" 
												   readonly value="{{$overhead->to_company}}">
										</div>
										<div class="form-group">
											<label for="to_city">Город</label>
											@if(strlen($overhead->to_city) > 2)
											<input type="text" id="to_city" class="form-control" 
												   readonly value="{{$overhead->to_city}}">
											@else
											@if(App\Models\City::find($overhead->to_city) != null)
											<input type="text" id="to_city" class="form-control" 
												   readonly value="{{App\Models\City::find($overhead->to_city)->city_name}}">
											@else
											<p>Не правильно указан</p>
											@endif
											@endif
										</div>
										<div class="form-group">
											<label for="to_address">Адрес</label>
											<input type="text" id="to_address" class="form-control" 
												   readonly value="{{$overhead->to_address}}">
										</div>
										<div class="form-group">
											<label for="to_phone">Телефон</label>
											<input type="text" id="to_phone" class="form-control" 
												   readonly value="{{$overhead->to_phone}}">
										</div>
										<hr>
										<h5 style="color:#004191;">Детали</h5>
										<hr>
										<div class="form-group">
											<label for="type">Тип отправки:</label>
											<input type="text" id="type" class="form-control" 
												   readonly value="{{$overhead->type}}">
										</div>
										<div class="form-group">
											<label for="speed">Скорость:</label>
											<input type="text" id="speed" class="form-control" 
												   readonly value="{{$overhead->speed}}">
										</div>
										<div class="form-group">
											<label for="payment">Оплата:</label>
											<input type="text" id="payment" class="form-control" 
												   readonly value="{{$overhead->payment}}">
										</div>
										<div class="form-group">
											<label for="payment_type">Способ оплаты:</label>
											<input type="text" id="payment_type" class="form-control" 
												   readonly value="{{$overhead->payment_type}}">
										</div>
										<div class="form-group">
											<label for="mass">Масса:</label>
											<input type="text" id="mass" class="form-control" 
												   readonly value="{{$overhead->mass}}">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" 
												data-dismiss="modal">Закрыть</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</td>
				<td>
					<div>
						<p style="margin-bottom:0;color:#004191;font-size:10px;">{{$overhead->to_name}}</p>
						<p style="margin-bottom:0;font-size:10px;">{{$overhead->to_address}}</p>
						<a href="tel:{{$overhead->to_phone}}">{{$overhead->to_phone}}</a>
					</div>
				</td>
				<td>
					<div>
						{{$overhead->to_name}}
					</div>
				</td>
				<td>
					<div>
						{{$overhead->from_name}}
					</div>
				</td>
			</tr>
				@endif
				@endforeach
			@endif
		</tbody>
	</table>
</div>
@endsection
@section('admin-script')

<script>
	$("#checkAll").click(function(){
		if($(this).prop("checked")){
			$(".checkedItem").prop("checked", "checked");
		}else{
			$(".checkedItem").prop("checked", "");
		}
	});
	$("#acceptChecked").click(function(){
		let checked = $(".checkedItem:checked");
		console.log($(checked[0]).attr("data"));
		let data = [];
		for(let i=0;i<checked.length;i++){
			data[i] = $(checked[i]).attr('data');
		}
		console.log(data);
		$.ajax({
			url: "https://postalservice.kz/admin/region/setStatuses",
			type:"POST",
			data:{
				_token: "{{ csrf_token() }}",
				overheads:JSON.stringify(data),
			},
			success:function(response){
				console.log(response);
				let result = JSON.parse(response);
				if(result.success){
					$("#checkChecked").append('<div class="alert alert-success">Изменен</div>');
					location.reload;
				}
			},
		});
		
	});
</script>
@endsection
