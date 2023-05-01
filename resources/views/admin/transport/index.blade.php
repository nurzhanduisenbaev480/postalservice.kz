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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Список</h5>
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
        @if(\Illuminate\Support\Facades\Session::has('message'))
            @if(\Illuminate\Support\Facades\Session::get('message') == 2)
                <div class="alert alert-success">Успешно обновлен </div>
            @else
                <div class="alert alert-danger">Что то пошло не так, пожалуйста обратитесь к администратору</div>
            @endif
            {{\Illuminate\Support\Facades\Session::forget('message')}}
        @endif
        

    </div>
<div class="row">
	<div class="col-md-12">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Тип</th>
					<th>Название</th>
					<th>Телефон</th>
					<th>Менеджер</th>
					<th>Email</th>
					<th>Действие</th>
				</tr>
			</thead>
			<tbody>
				@if(isset($transports))
				@php $i=0 @endphp
					@foreach($transports as $transport)
				@php $i++ @endphp
						<tr>
							<td>{{$i}}</td>
							<td>{{App\Models\TransportType::find($transport->type)->name}}</td>
							<td>{{$transport->name}}</td>
							<td>{{$transport->phone}}</td>
							<td>{{$transport->manager}}</td>
							<td>{{$transport->email}}</td>
							<td><a class="btn btn-primary btn-sm" 
								   href="{{route('admin.transport.edit')}}?id={{$transport->id}}">Редактировать</a></td>
						</tr>
					@endforeach
				@endif
			</tbody>
		</table>
	</div>
</div>
@endsection
@section('admin-script')
    <script>

    </script>
@endsection
