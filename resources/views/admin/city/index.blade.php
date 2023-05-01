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
					<th>Название</th>
					<th>Зона</th>
					<th>Область</th>
					<th>Страна</th>
					<th>Действие</th>
				</tr>
			</thead>
			<tbody>
                @php $index = 0; @endphp
                @if(isset($cities))
                    @foreach($cities as $city)
                        @php $index++; @endphp
                        <tr>
                            <td style="width: 5%;">{{$index}}</td>
                            <td>{{$city->city_name}}</td>
                            <td>{{$city->city_zone}}</td>
                            <td>{{$city->city_area}}</td>
                            <td>{{$city->city_country}}</td>
                            <td style="width: 15%;">
                                <div class="city_actions">
                                    <a href="" class="btn btn-sm btn-primary">Редактировать</a>
                                    <a href="" class="btn btn-sm btn-danger">Удалить</a>
                                </div>
                            </td>
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
