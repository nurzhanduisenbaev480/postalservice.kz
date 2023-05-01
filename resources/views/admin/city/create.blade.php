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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Добавить город</h5>
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
		<form action="{{route('admin.transport.store')}}" method="post">
			@csrf
			<div class="form-group">
				<label for="type">Тип</label>
				<select class="form-control" name="type" id="type">
					<option value="1">Жд</option>
					<option value="2">Авиа</option>
					<option value="3">Авто</option>
				</select>
			</div>
			<div class="form-group">
				<label for="name">Название</label>
				<input type="text" name="name" id="name" class="form-control" placeholder="Введите название транспортной компаний">
			</div>
			<div class="form-group">
				<label for="phone">Телефон</label>
				<input type="text" name="phone" id="phone" class="form-control" placeholder="Введите телефон ответственного ">
			</div>
			<div class="form-group">
				<label for="manager">Менеджер</label>
				<input type="text" name="manager" id="manager" class="form-control" placeholder="Введите имя ответственного ">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="text" name="email" id="email" class="form-control" placeholder="Введите email ответственного ">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Добавить</button>
			</div>
		</form>
	</div>
</div>
@endsection
@section('admin-script')
    <script>

    </script>
@endsection
