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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Редактировать заявку</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin')}}" class="text-muted">Панель управление</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.orders.index')}}" class="text-muted">Заявки</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.orders.edit')}}" class="text-muted">Редактировать заявку</a>
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
                <div class="alert alert-success">Успешно обновлен </div>
            @else
                <div class="alert alert-danger">Что то пошло не так, пожалуйста обратитесь к администратору</div>
            @endif
            {{\Illuminate\Support\Facades\Session::forget('message')}}
        @endif
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Информация о заявке</h5>
            </div>
            <form class="form-horizontal fv-plugins-bootstrap fv-plugins-framework"
                  action="{{route('admin.orders.update')}}"
                  id="kt_form_1"
                  method="POST"
                  enctype="multipart/form-data"
                  novalidate="novalidate">
                @csrf

                <input type="hidden" value="{{$user->id}}" name="user_id">
                <input type="hidden" value="{{$order->id}}" name="order_id">
                <input type="hidden" value="{{$order->order_code}}" name="order_code">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <h3 class="text-left">Отправитель</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_name">Ф.И.О</label>
                                        <input id="from_name" name="from_name" type="text"
                                               placeholder="Введите Ф.И.О отправителя" class="form-control"
                                               value="{{$order->from_name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_company">Компания</label>
                                        <input id="from_company" name="from_company" type="text"
                                               placeholder="Введите название компаний" class="form-control"
                                               value="{{$order->from_company}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_phone">Телефон</label>
                                        <input id="from_phone" name="from_phone" type="text"
                                               placeholder="Введите телефон" class="form-control"
                                               value="{{$order->from_phone}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_address">Адрес</label>
                                        <input id="from_address" name="from_address" type="text"
                                               placeholder="Введите адрес" class="form-control"
                                               value="{{$order->from_address}}">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Примечание</label>
                                        <textarea class="form-control" name="description" id="description">
                                            {{$order->description}}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-0 text-right form-group">
                            <button type="submit" class="btn btn-sm btn-primary">Обновить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>


    </div>

@endsection
@section('admin-script')
    <script>

    </script>
@endsection
