@extends('layouts.app')
@section('subheader')
    <style>
        .table-box{
            min-height: 500px;
            overflow-y: scroll;
        }
        @media screen
        {
            #screenarea
            {
                display: block;
            }
            #printarea
            {
                display: none;
            }
        }
        @media print
        {
            #screenarea
            {
                display: none;
            }
            #printarea
            {
                display: block;
            }
        }
        .summary_info{
            margin: 0;
            padding: 10px;
            width: 100%;
            box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.2);
        }
        .summary{
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .summary li{
            display: flex;
        }
        .summary_key{
            width: 40%;
            font-weight: bold;
        }
        .summary_table{
            min-height: 400px;
            overflow-y: scroll;
            font-size: 10px;
        }
        .overhead_checkbox_no, .overhead_checkbox_yes{
            width: 20px;
            height: 20px;
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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Сводка</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Информация о реестре</a>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="" class="btn btn-primary">Назад</a>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="summary_info">
                        <h5>Информация о сводке</h5>
                        <ul class="summary">
                            <li>
                                <div class="summary_key">Тип транспорта:</div>
                                <div class="summary_value">{{$transport->name}}</div>
                            </li>
                            <li>
                                <div class="summary_key">Статус:</div>
                                <div class="summary_value">{{$status->status_name}}</div>
                            </li>
                            <li>
                                <div class="summary_key">Откуда:</div>
                                <div class="summary_value">{{$from->city_name}}</div>
                            </li>
                            <li>
                                <div class="summary_key">Куда:</div>
                                <div class="summary_value">{{$to->city_name}}</div>
                            </li>
                            <li>
                                <div class="summary_key">Код регистра:</div>
                                <div class="summary_value">{{$registry->code}}</div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="summary_table">
                        <table class="table table-hovered table-bordered">
                            <thead>
                            <tr>
                                <th>Код</th>
                                <th>Отправитель</th>
                                <th>Получатель</th>
                                <th>Принять</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($overheads))
                                @foreach($overheads as $overhead)
                                    <tr>
                                        <td>{{$overhead->overhead_code}}</td>
                                        <td>
                                            <div>{{$overhead->from_name}}</div>
                                            <div>{{$overhead->from_company}}</div>
                                            <div>{{$overhead->from_address}}</div>
                                            <div>{{$overhead->from_phone}}</div>
                                        </td>
                                        <td>
                                            <div>{{$overhead->to_name}}</div>
                                            <div>{{$overhead->to_company}}</div>
                                            <div>{{$overhead->to_address}}</div>
                                            <div>{{$overhead->to_phone}}</div>
                                        </td>
                                        <td></td>
                                        <td></td>
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

@endsection
@section('admin-script')
    <script>
        $('.overhead_checkbox_yes').change(function(){
            console.log($(this).parent());
            let td = $(this).parent().first();
            let overhead_id = td.find('#overhead_id2').val();
            console.log(overhead_id);

        });
    </script>
@endsection
