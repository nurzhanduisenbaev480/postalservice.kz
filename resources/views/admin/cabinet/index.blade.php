@php
    use App\Models\Order;
@endphp

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
            margin: 5px;
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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Заявки</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin')}}" class="text-muted">Панель управление</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.cabinet.overhead')}}" class="text-muted">Заявки</a>
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
                <h5 class="mb-0 h6">Мои накладные</h5>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover mt-2">
                                <thead>
                                <tr class="table-success">
                                    <th>#</th>
                                    <th>Статус</th>
                                    <th>Код</th>
                                    <th>Получатель</th>
                                    <th>Город</th>
                                    <th>Адрес</th>
                                    <th>Телефон</th>
                                    <th>Комментарий</th>
                                    <th>Дата создания</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($overheads))
                                    @foreach($overheads as $order)
                                        <tr>
                                            <td><div class="table_td_item">{{$order->id}}</div></td>
                                            <td>
                                                <div class="table_td_item">
                                                    @if($order->status_id == 2
                                                        || $order->status_id == 3
                                                        || $order->status_id == 4
                                                        || $order->status_id == 5)
                                                        В процессе
                                                    @else
                                                        {{\App\Models\Status::find($order->status_id)->status_name}}
                                                    @endif
                                                </div>
                                            </td>
                                            <td><div class="table_td_item">{{$order->overhead_code}}</div></td>
                                            <td><div class="table_td_item">{{$order->to_name}}</div></td>
                                            <td><div class="table_td_item">{{$order->to_city}}</div></td>
                                            <td><div class="table_td_item">{{$order->to_address}}</div></td>
                                            <td><div class="table_td_item">{{$order->to_phone}}</div></td>
                                            <td><div class="table_td_item">{{$order->description}}</div></td>
                                            <td><div class="table_td_item">{{$order->created_at}}</div></td>
                                            <td>
                                                <ul style="list-style: none;padding: 0;" class="order_action">

                                                    <li class="order_action_item">
                                                        <a href="{{route('admin.overheads.show')}}?overhead_id={{$order->id}}" class="btn btn-primary">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </li>
                                                    <li class="order_action_item">
                                                        <a href="{{route('admin.cabinet.delete')}}?overhead_id={{$order->id}}" class="btn btn-primary">
                                                            <i class="fas fa-minus"></i>
                                                        </a>
                                                    </li>
                                                </ul></td>
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
