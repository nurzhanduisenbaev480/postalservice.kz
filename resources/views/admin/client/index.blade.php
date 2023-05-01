@php
use App\Models\Role;
use App\Models\User;

@endphp

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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Клиенты</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin')}}" class="text-muted">Панель управление</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.users.client.index')}}" class="text-muted">Клиенты</a>
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
        @if(\Illuminate\Support\Facades\Session::has('message'))
            @if(\Illuminate\Support\Facades\Session::get('message') == 2)
                <div class="alert alert-success">Успешно добавлен </div>
            @else
                <div class="alert alert-danger">Что то пошло не так, пожалуйста обратитесь к администратору</div>
            @endif
            {{\Illuminate\Support\Facades\Session::forget('message')}}
        @endif
            @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="alert alert-success">{{\Illuminate\Support\Facades\Session::get('success')}}</div>
            @endif
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Список клиентов</h5>
            </div>
            <div class="card-body" style="padding: 0;">
                <div class="container-fluid" style="padding: 0;">
                    <div class="row">
						<div class="col-md-2 mt-5 mb-5">
							<a class="btn btn-primary btn-sm" href="{{route('admin.client.create')}}">Добавить клиента</a>
						</div>
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover mt-2">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ФИО</th>
                                    <th>Email</th>
                                    <th>Роль</th>
                                    <th>Пароль</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($users))
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach($users as $user)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{Role::find($user->getRole($user->id)->first()->role_id)->display_name}}</td>
                                            <td>{{$user->visible_password}}</td>
                                            <td>
												<a href="{{route('admin.client.edit')}}?id={{$user->id}}"
												   class="btn btn-primary btn-sm">Редактировать</a>
                                                <a href="{{route('admin.client.order', ['client_id'=>$user->id])}}" class="btn btn-primary btn-sm">+</a>
                                                <a href="{{route('admin.client.delete', ['client_id'=>$user->id])}}" class="btn btn-danger btn-sm">-</a>
											</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
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
