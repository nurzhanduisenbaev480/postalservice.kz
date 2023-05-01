@extends('layouts.app')
@section('subheader')
    <style>
        .order_block{
            display: flex;
            flex-direction: column;
        }
        .order_block_item{
            display: flex;
            align-items: center;
        }
        .order_block_item h5{
            font-size: 14px;
            width: 28%;
            border-right: 1px solid #e7e7e7;
            margin-bottom: 0;
            margin-left: 4px;
        }
        .order_block_item p{
            margin-left: 4px;
            font-size: 13px;
            margin-bottom: 0;
        }
        .table td{
            padding: 0;
        }
        .table_td_item{
            margin: 15px 5px 0 5px;
            overflow-wrap: break-word;
        }
        .tab-content{
            min-height: 400px;
            overflow-y: scroll;
        }
        .order_action{
            display: flex;
            margin-right: 5px;
        }
        .order_action li{
            margin-right: 5px;
        }
        .order_action_item:hover i{
            color: #ff7324;
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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Мои накладные</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin')}}" class="text-muted">Панель управление</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.courier.overhead')}}" class="text-muted">Накладные</a>
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
                <h5 class="mb-0 h6">Список накладного</h5>
            </div>
            <div class="card-body" style="padding: 0;">
                <div class="container-fluid" style="padding: 0;">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover mt-2">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width: 110px;">Код Заявки</th>
                                    <th style="width: 300px;">Отправитель</th>
                                    <th style="width: 300px;">Получатель</th>
                                    <th>Комментарий</th>
                                    <th style="width: 50px;">Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($overheads))
                                    @foreach($overheads as $overhead)
                                        <tr class="table-success">
                                            <td><div class="table_td_item">{{$overhead->id}}</div></td>
                                            <td><div class="table_td_item">{{$overhead->overhead_code}}</div></td>
                                            <td>
                                                <div class="order_block">
                                                    <div class="order_block_item">
                                                        <h5>ФИО</h5>
                                                        <p>{{$overhead->from_name}}</p>
                                                    </div>
                                                    <div class="order_block_item">
                                                        <h5>Телефон</h5>
                                                        <p>{{$overhead->from_phone}}</p>
                                                    </div>
                                                    <div class="order_block_item">
                                                        <h5>Адрес</h5>
                                                        <p>{{$overhead->from_address}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="order_block">
                                                    <div class="order_block_item">
                                                        <h5>ФИО</h5>
                                                        <p>{{$overhead->to_name}}</p>
                                                    </div>
                                                    <div class="order_block_item">
                                                        <h5>Телефон</h5>
                                                        <p>{{$overhead->to_phone}}</p>
                                                    </div>
                                                    <div class="order_block_item">
                                                        <h5>Адрес</h5>
                                                        <p>{{$overhead->to_address}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><div class="table_td_item">{{$overhead->description}}</div></td>
                                            <td>
                                                <div class="table_td_item">
                                                    <ul style="list-style: none;padding: 0;" class="order_action">
                                                        <li class="order_action_item">
                                                            <a href="{{route('admin.courier.edit')}}?overhead_id={{$overhead->id}}">
                                                                <i class="far fa-edit"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
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
