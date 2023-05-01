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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Редактировать город</h5>
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
	<div class="col-md-6">
		<form action="" method="post">
			@csrf
			<input type="hidden" name="id" value="{{$city->id}}">
			<div class="form-group">
				<label for="city_name">Наименование</label>
                <input type="text" name="city_name" id="city_name" class="form-control" value="{{$city->city_name}}">
			</div>
			<div class="form-group">
				<label for="city_zone">Зона</label>
                <input type="text" name="city_zone" id="city_zone" class="form-control" value="{{$city->city_zone}}">
			</div>
			<div class="form-group">
				<label for="city_area">Район</label>
                <input type="text" name="city_area" id="city_area" class="form-control" value="{{$city->city_area}}">
			</div>
			<div class="form-group">
				<label for="city_region">Область</label>
                <input type="text" name="city_region" id="city_region" class="form-control" value="{{$city->city_region}}">
			</div>
			<div class="form-group">
				<label for="city_country">Страна</label>
                <input type="text" name="city_country" id="city_country" class="form-control" value="{{$city->city_country}}">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Обновить</button>
			</div>
		</form>
	</div>
</div>
@endsection
@section('admin-script')
    <script>

    </script>
@endsection
