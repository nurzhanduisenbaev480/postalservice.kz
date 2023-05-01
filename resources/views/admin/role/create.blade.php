@extends('layouts.app')
@section('subheader')
    <style>

    </style>
    <!--begin::Subheader-->
    <div class="py-2 subheader py-lg-6 subheader-solid" id="kt_subheader">
        <div class="flex-wrap container-fluid d-flex align-items-center justify-content-between flex-sm-nowrap">
            <!--begin::Info-->
            <div class="flex-wrap mr-1 d-flex align-items-center">
                <!--begin::Page Heading-->
                <div class="flex-wrap mr-5 d-flex align-items-baseline">
                    <!--begin::Page Title-->
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Роли доступа</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin')}}" class="text-muted">Панель управление</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.roles.create')}}" class="text-muted">Создать роль</a>
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
        <div class="card">
            @if(\Illuminate\Support\Facades\Session::has('message'))
                <div class="alert alert-success">Роль успешно добавлен</div>
                @php
                    \Illuminate\Support\Facades\Session::forget('message')
                @endphp
            @endif
            <div class="card-header">
                <h5 class="mb-0 h6">Детали роля</h5>
            </div>
            <div class="card-body" style="padding: 0;">
                <div class="container-fluid" style="padding: 0;">
                    <div class="row">
                        <div class="col-md-12 mt-3 mb-3">
                            <form method="post" action="{{route('admin.roles.store')}}">
                                @csrf
                                <div class="row justify-content-md-center">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="name">Название роли</label>
                                            <input type="text" name="name" id="name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="display_name">Отображение роли</label>
                                            <input type="text" name="display_name" id="display_name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="parent">Выбрать родителя</label>
                                            <select name="parent" id="parent" class="form-control">
                                                @if(isset($roles))
                                                    @foreach($roles as $role)
                                                        <option value="{{$role->id}}">{{$role->display_name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary">Сохранить</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
