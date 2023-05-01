@extends('layouts.app')
@section('subheader')
    <style>
        .eval_table{
            min-height: 400px;
            overflow-y: scroll;
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
            width: 35%;
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
        #contract_info li{
            display: flex;
        }
        .contract_info_key{
            width: 35%;
        }
        .summa{
            display: flex;
        }
        .contract_sum{
            width: 35%;

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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Расчеты</h5>
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

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="summary_info">
                <h5>Номер накладного № <span class="overhead_code_s">{{$overhead->overhead_code}}</span></h5>
                <ul class="summary">
                    <li>
                        <div class="summary_key">Отправитель:</div>
                        <div class="summary_value">{{$overhead->from_name}}</div>
                    </li>
                    <li>
                        <div class="summary_key">Компания:</div>
                        <div class="summary_value">{{$overhead->from_company}}</div>
                    </li>
                    <li>
                        <div class="summary_key">Телефон:</div>
                        <div class="summary_value">{{$overhead->from_phone}}</div>
                    </li>
                    <hr>
                    <li>
                        <div class="summary_key">Получатель:</div>
                        <div class="summary_value">{{$overhead->to_name}}</div>
                    </li>
                    <li>
                        <div class="summary_key">Компания:</div>
                        <div class="summary_value">{{$overhead->to_company}}</div>
                    </li>
                    <li>
                        <div class="summary_key">Телефон:</div>
                        <div class="summary_value">{{$overhead->to_phone}}</div>
                    </li>

                    <li>
                        <div class="summary_key">Масса:</div>
                        <div class="summary_value">{{$overhead->mass}}</div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-4">
            <div class="plans">
                <div style="display:flex;">
                    <a class="btn btn-primary mr-5"
                        data-toggle="modal"
                        data-target="#exampleModalLong">Выбрать тариф</a>
                    <form action="{{route('admin.evaluate.eval')}}" method="get" class="mr-5">
                        <input type="hidden" value="{{$overhead->id}}" name="overhead_id_eval">
                        <input type="submit" class="btn btn-danger" value="Расчитать">
                    </form>
                    <a href="{{route('admin.evaluate.index')}}" class="btn btn-primary">Назад</a>
                </div>

                <div class="plan_info mt-5">

                    @if(isset($contract) && $contract != null)
                        <div class="alert alert-success">
                            <ul id="contract_info" style="list-style: none;padding:0;margin:0;">
                                <li>
                                    <div class="contract_info_key">Масса:</div>
                                    <div>{{$contract->mass}}</div>
                                </li>
                                <li>
                                    <div class="contract_info_key">Цена за 1-зону:</div>
                                    <div>{{$contract->price}}</div>
                                </li>
                                <li>
                                    <div class="contract_info_key">Цена за 2-зону:</div>
                                    <div>{{$contract->price2}}</div>
                                </li>
                                <li>
                                    <div class="contract_info_key">Цена за 3-зону:</div>
                                    <div>{{$contract->price3}}</div>
                                </li>
                            </ul>
                        </div>
                    @else
                    <h5>Тариф не выбран</h5>
                    <p class="alert alert-danger">Выберите тарифный план или расчет будет происходит по шаблону</p>
                    @endif

                    <div class="alert alert-primary summa">
                        <div class="contract_sum">Сумма:</div>
                        <div class="contract_sum_val">
                            <span class="key">
                            @if(isset($evaluate) && $evaluate != null)
                            {{$evaluate->sum}}
                            @else
                            0
                            @endif
                            </span>
                        <span class="val">тг</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1"
         role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Добавить маршрут</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.evaluate.setPlan')}}" method="get">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" value="{{$overhead->id}}" name="overhead_id">
                        <div class="form-group">
                            <label for="contract">Выбрать тариф</label>
                            <select class="form-control" id="contract" name="contract">
                                <option value="0">По умолчанию</option>
                                @if(isset($contracts) && $contracts != null)
                                @foreach($contracts as $contract)
                                    <option value="{{$contract->id}}">Номер договора: {{$contract->contract_id}} | Имя компаний: {{$contract->company_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('admin-script')
    <script>

    </script>
@endsection
