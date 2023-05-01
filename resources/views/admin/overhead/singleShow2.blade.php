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
		width: 40%;
	}
	.overhead_journals{
		box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.4);
		padding-left: 5px;
		padding-top: 5px;
		padding-bottom: 5px;
	}
	.progress_bar_item{
		display: flex;
		padding-bottom: 10px;
		padding-top: 10px;
		border-bottom: 1px solid #004191;
		
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
			<!--<a href="{{route('admin.overheads.edit2')}}?overhead_id={{$overhead->id}}" 
			   class="btn btn-primary btn-sm mt-2"
			   style="background-color: #004191;border-color: #004191;"
			   >Редактировать</a>
			-->
		</div>
		<div class="card-body">
			<div class="container-fluid" style="padding: 0;">
				<div class="row">
					<div class="col-md-4">
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
										<p>{{$from_city}}</p>
										@else
										@if(App\Models\City::find($from_city) != null)
										<p>{{App\Models\City::find($from_city)->city_name}}</p>
										@else
										<p>Не правильно указан</p>
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
										<p>{{$to_city}}</p>
										@else
										@if(App\Models\City::find($to_city) != null)
										<p>{{App\Models\City::find($to_city)->city_name}}</p>
										@else
										<p>Не правильно указан</p>
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
					<div class="col-md-2"></div>
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
			</div>
		</div>
	</div>


</div>
@endsection
@section('admin-script')
<script>

</script>
@endsection
