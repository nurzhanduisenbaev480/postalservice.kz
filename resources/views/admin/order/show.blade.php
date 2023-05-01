@extends('layouts.app')
@section('subheader')
    <style>
        .order_sender_info{
            width: 100%;
        }
        .order_sender_info h4{
            padding-bottom: 5px;
            width: 60%;
            border-bottom: 1px solid #e7e7e7;
        }
        .order_sender_info_list{
            list-style: none;
            display: flex;
            flex-direction: column;
            padding: 0;
        }
        .info_list_item{
            display: flex;
        }
        .info_list_key{
            width: 20%;
            font-weight: bold;
        }
        .info_list_value{
            width: 80%;
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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Информация о заявке</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin')}}" class="text-muted">Панель управление</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.orders.index')}}" class="text-muted">Заявка</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.orders.show')}}?order_id={{$order_id}}" class="text-muted">Информация о заявке</a>
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
            <div class="card-header">
                <h5 class="mb-0 h6">Номер заявки: #{{$order->order_code}}</h5>
            </div>
            <div class="card-body">
                <div class="container-fluid" style="padding: 0;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="order_sender_info">
                                <h4>Детали отправителя</h4>
                                <ul class="order_sender_info_list">
                                    <li class="info_list_item">
                                        <div class="info_list_key">ФИО:</div>
                                        <div class="info_list_value">{{$order->from_name}}</div>
                                    </li>
                                    <li class="info_list_item">
                                        <div class="info_list_key">Компания:</div>
                                        <div class="info_list_value">{{$order->from_company}}</div>
                                    </li>
                                    <li class="info_list_item">
                                        <div class="info_list_key">Адрес:</div>
                                        <div class="info_list_value">{{$order->from_address}}</div>
                                    </li>
                                    <li class="info_list_item">
                                        <div class="info_list_key">Телефон:</div>
                                        <div class="info_list_value">{{$order->from_phone}}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">

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
