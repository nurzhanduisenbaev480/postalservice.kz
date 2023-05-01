@extends('layouts.app')
@section('subheader')
    <style>
        .search_results{
            width: 50%;
            display:none;
            background: transparent;
            height: auto;
            position: absolute;
            z-index: 2;
            margin-top: 5px;
        }
        .search_results .search_item{
            padding: 5px;
            background: white;
            box-shadow: 2px 2px 2px rgb(0, 0, 0,0.5);
            cursor: pointer;
            border-bottom: 1px solid #e7e7e7;
        }
        .search_results .search_item:hover{
            background: #e7e7e7;
        }
        .description-tags{
            display: flex;
        }
        .tag_item{
            padding: 5px;
            cursor:pointer;
            background: #004191;
            color: #fff;
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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Редактирование</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.roads.order')}}" class="text-muted">Заявки</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.roads.orderShow')}}?order_id={{$order->id}}" class="text-muted">Редактирование заявку</a>
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
        @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        <div class="card">
            <div class="card-header" style="display: flex;">
                <h5 class="mb-0 h6 mr-5">Информация о заявке <b>№{{$order->order_code}}</b></h5>
                <div class="courier_status" style="display: flex;">
                    <a href="{{route('admin.roads.courier_status1')}}?id={{$order->id}}" class="btn btn-warning btn-sm courier_accepted">Курьер Принял</a>
                    <a href="{{route('admin.roads.courier_status2')}}?id={{$order->id}}" class="btn btn-danger btn-sm courier_take">Курьер Забрал</a>
                    <a href="{{route('admin.roads.courier_status3')}}?id={{$order->id}}" class="btn btn-info btn-sm courier_finished">Курьер Завершил</a>
                    <a href="{{route('admin.roads.order')}}" class="btn btn-primary btn-sm courier_finished">Назад</a>
                </div>
            </div>
            <form class="form-horizontal fv-plugins-bootstrap fv-plugins-framework"
                  action="{{route('admin.roads.orderSave')}}"
                  id="kt_form_1"
                  method="POST"
                  enctype="multipart/form-data"
                  novalidate="novalidate">
                @csrf
                <input type="hidden" value="{{$user->id}}" name="user_id">
                <input type="hidden" value="{{$order->id}}" name="order_id">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-12">
                                    @if(\Illuminate\Support\Facades\Session::has('message'))
                                        @if(\Illuminate\Support\Facades\Session::get('message') == 0)
                                            <div class="alert alert-success">Успешно обновлен</div>
                                        @else
                                            <div class="alert alert-danger">Что то пошло не так, пожалуйста обратитесь к администратору</div>
                                        @endif
                                        {{\Illuminate\Support\Facades\Session::forget('message')}}
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><h3 class="text-left">Отправитель</h3></div>
                                <div class="col-md-4">

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" style="position:relative;">
                                        <label for="from_name">Ф.И.О</label>
                                        <input id="from_name" name="from_name" type="text"
                                               placeholder="Введите Ф.И.О отправителя"
                                                value="{{$order->from_name}}"
                                               class="form-control">
                                        <div class="search_results">
                                            <div class="search_item" data="">Тоо Астана плат</div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_company">Компания</label>
                                        <input id="from_company" name="from_company" type="text"
                                               value="{{$order->from_company}}"
                                               placeholder="Введите название компаний" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_phone">Телефон</label>
                                        <input id="from_phone" name="from_phone" type="text"
                                               value="{{$order->from_phone}}"
                                               placeholder="Введите телефон" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_address">Адрес</label>
                                        <input id="from_address" name="from_address" type="text"
                                               value="{{$order->from_address}}"
                                               placeholder="Введите адрес" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="margin-bottom: 5px;">
                                        <label for="description">Примечание</label>
                                        <textarea class="form-control" name="description" id="description">{{$order->description}}</textarea>
                                    </div>
                                    <div class="description-tags">
                                        <div class="tag_item">Экспесс</div>
                                        <div class="tag_item">Эконом</div>
                                        <div class="tag_item">Безнал</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-0 text-right form-group" style="margin-top: 10px;">
                            <button type="submit" class="btn btn-sm btn-primary">Сохранить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>


    </div>

@endsection
@section('admin-script')
    <script>
        $('.tag_item').click(function(e){
            console.log($(this).text());
            $('#description').append($(this).text()+', ');
        });
    </script>
@endsection
