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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Редактировать накладной</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin')}}" class="text-muted">Панель управление</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.overhead.index')}}" class="text-muted">Заявка</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.overhead.edit')}}" class="text-muted">Редактировать накладной</a>
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="from_name1">Ф.И.О</label>
                                        <input id="from_name1" name="from_name" type="text"
                                               placeholder="Введите Ф.И.О отправителя" class="form-control"
                                               value="{{$order->from_name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_company">Компания</label>
                                        <input id="from_company" name="from_company" type="text"
                                               placeholder="Введите название компаний" class="form-control"
                                               value="{{$order->from_company}}"
                                        >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_city">Город</label>

                                        <select name="from_city" id="from_city" class="form-control">
                                            @foreach($cities as $city)
                                                @if($order->from_city == $city->city_name)
                                                    <option selected value="{{$city->id}}">{{$city->city_name}}</option>
                                                @else
                                                    <option value="{{$city->id}}">{{$city->city_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_phone">Телефон</label>
                                        <input id="from_phone" name="from_phone" type="text"
                                               placeholder="Введите телефон" class="form-control"
                                               value="{{$order->from_phone}}"
                                        >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="from_address">Адрес</label>
                                        <input id="from_address" name="from_address" type="text"
                                               placeholder="Введите адрес" class="form-control"
                                               value="{{$order->from_address}}"
                                        >
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <h3 class="text-left">Получатель</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="to_name">Ф.И.О</label>
                                        <input id="to_name" name="to_name" type="text"
                                               placeholder="Введите Ф.И.О отправителя" class="form-control"
                                               value="{{$order->to_name}}"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="to_company">Компания</label>
                                        <input id="to_company" name="to_company" type="text"
                                               placeholder="Введите название компаний" class="form-control"
                                               value="{{$order->to_company}}"
                                        >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="to_city">Город</label>
                                        <select name="to_city" id="to_city" class="form-control">
                                            @foreach($cities as $city)
                                                @if($order->to_city == $city->city_name)
                                                    <option selected value="{{$city->id}}">{{$city->city_name}}</option>
                                                @else
                                                    <option value="{{$city->id}}">{{$city->city_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="to_phone">Телефон</label>
                                        <input id="to_phone" name="to_phone" type="text"
                                               placeholder="Введите телефон" class="form-control"
                                               value="{{$order->to_phone}}"
                                        >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="to_address">Адрес</label>
                                        <input id="to_address" name="to_address" type="text"
                                               placeholder="Введите адрес" class="form-control"
                                               value="{{$order->to_address}}"
                                        >
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <h3 class="text-left">Детали заявки</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Тип отправления</label>
                                        <select name="type" id="type" class="form-control">
                                            @if($order->type == 'Посылка')
                                                <option selected value="Посылка">Посылка</option>
                                                <option value="Документы">Документы</option>
                                            @else
                                                <option value="Посылка">Посылка</option>
                                                <option selected value="Документы">Документы</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="speed">Срочность</label>
                                        <select name="speed" id="speed" class="form-control">
                                            @if($order->speed == 'Экспресс')
                                                <option selected value="Экспресс">Экспресс</option>
                                                <option value="Стандарт">Стандарт</option>
                                                <option value="Авто">Авто</option>
                                            @elseif($order->speed == 'Стандарт')
                                                <option value="Экспресс">Экспресс</option>
                                                <option selected value="Стандарт">Стандарт</option>
                                                <option value="Авто">Авто</option>
                                            @else
                                                <option value="Экспресс">Экспресс</option>
                                                <option value="Стандарт">Стандарт</option>
                                                <option selected value="Авто">Авто</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment">Оплата</label>
                                        <select name="payment" id="payment" class="form-control">
                                            @if($order->speed == 'Отправителем')
                                                <option selected value="Отправителем">Отправителем</option>
                                                <option value="Получателем">Получателем</option>
                                                <option value="Третьей стороной">Третьей стороной</option>

                                            @elseif($order->speed == 'Получателем')
                                                <option value="Отправителем">Отправителем</option>
                                                <option selected value="Получателем">Получателем</option>
                                                <option value="Третьей стороной">Третьей стороной</option>
                                            @else
                                                <option value="Отправителем">Отправителем</option>
                                                <option value="Получателем">Получателем</option>
                                                <option selected value="Третьей стороной">Третьей стороной</option>
                                            @endif

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment_type">Способ оплаты</label>
                                        <select name="payment_type" id="payment_type" class="form-control">
                                            @if($order->speed == 'По счету')
                                                <option selected value="По счету">По счету</option>
                                                <option value="Наличными">Наличными</option>
                                                <option value="Терминалом">Терминалом</option>

                                            @elseif($order->speed == 'Наличными')
                                                <option value="По счету">По счету</option>
                                                <option selected value="Наличными">Наличными</option>
                                                <option value="Терминалом">Терминалом</option>
                                            @else
                                                <option value="По счету">По счету</option>
                                                <option value="Наличными">Наличными</option>
                                                <option selected value="Терминалом">Терминалом</option>
                                            @endif

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <h3 class="text-left">Детали доставки</h3>
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
