@extends('layouts.app')
@section('subheader')
    <style>
        .order_info{
            padding: 10px;
            background: #f4f4f4;
            border-radius: 3px;
            height: 180px;
            box-shadow: 1px 3px 5px rgba(0,0,0,0.5);
        }
        .order-actions{
            padding: 10px;
            background: #f4f4f4;
            border-radius: 3px;
            height: 180px;
            box-shadow: 1px 3px 5px rgba(0,0,0,0.5);
        }
        .order_info-ul{
            width: 100%;
            display: flex;
            flex-direction: column;
        }
        .order_info-ul-item{
            width: 100%;
            display: flex;
        }
        .order_info-key{
            width:30%;
            font-size: 1.2rem;
            font-weight: bold;
            color: #ff7324;
        }
        .order_info-key, .order_info-value{
            line-height: 1.7rem;
        }
        .order_title{
            font-size: 1.3rem;
            font-weight: bold;
            color: #494b74;
        }
        #order_overheads{
            background: #f4f4f4;
            box-shadow: 1px 3px 5px rgba(0,0,0,0.5);
        }
        #order_overheads tr td input,
        #order_overheads tr th input{
            font-size: 11px;
            color: #0b2339;
            font-weight: bold;

        }
        .input_disabled{
            border: none;
            background: transparent;
        }
        .actions_td{
            display: flex;
        }
        .actions_td button{
            padding: 5px 10px;
            margin-right: 4px;
        }

        .actions_td button i{
            font-size: 1rem;
            padding: 0;
        }
        .btn_disable{
            display: none;
        }
        .table_input{
            padding: 5px;
            height: 22px;
            margin-bottom: 4px;
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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Сверить</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.store.index')}}" class="text-muted">Склад</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.store.check')}}" class="text-muted">Сверить</a>
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
                    <p><i class="fas fa-lock"></i> Заявка № <b>{{$order->order_code}}</b> от <b>{{date("d-m-Y")}}</b></p>
                    <p style="display: none;" id="order_id">{{$order->id}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="order_title">Детали заявки</div>
                    <div class="order_info">
                        <ul style="list-style: none;padding: 0;" class="order_info-ul">
                            <li class="order_info-ul-item">
                                <div class="order_info-key">Статус</div>
                                <div class="order_info-value"
                                     style="padding: 2px 5px;color: #ffffff; background: #0a6aa1;">В процессе</div>
                            </li>
                            <li class="order_info-ul-item">
                                <div class="order_info-key">Имя отправителя</div>
                                <div class="order_info-value">{{$order->from_name}}</div>
                            </li>
                            <li class="order_info-ul-item">
                                <div class="order_info-key">Компания</div>
                                <div class="order_info-value">{{$order->from_company}}</div>
                            </li>
                            <li class="order_info-ul-item">
                                <div class="order_info-key">Город</div>
                                <div class="order_info-value">{{$order->from_city}}</div>
                            </li>
                            <li class="order_info-ul-item">
                                <div class="order_info-key">Адрес</div>
                                <div class="order_info-value"><b>{{$order->from_address}}</b></div>
                            </li>
                            <li class="order_info-ul-item">
                                <div class="order_info-key">Телефон</div>
                                <div class="order_info-value">{{$order->from_phone}}</div>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="order_title">Действие</div>
                    <div class="order-actions">
                        <div class="form-group">
                            <label for="search">Поиск накладных по штрих коду</label>
                            <input  type="text" class="form-control" onchange="checkOverhead();"
                                    id="search" placeholder="ABC1234" autofocus>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-dark">
                                <i class="fas fa-print"></i>
                                Печать реестр
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <table class="table table-hover table-bordered" id="order_overheads">
                        <thead>
                        <tr class="table-info">
                            <th style="width: 130px;">№</th>
                            <th>Получатель</th>
                            <th>Адрес</th>
                            <th style="width: 110px;">Телефон</th>
                            <th style="width: 100px;">Вес(кг)<br>Длина(см)</th>
                            <th style="width: 100px;">Ширина(см)<br>Высота(см)</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($overheads) && !$overheads->isEmpty())
                            @foreach($overheads as $overhead)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="overhead_id" value="{{$overhead->id}}">
                                            <input disabled class="form-control table_input input_disabled"
                                                   type="text" name="code" value="{{$overhead->overhead_code}}">
                                        </td>
                                        <td>
                                            <input class="form-control table_input input_disabled"
                                                   type="text" name="to_name" placeholder="ФИО отправителя" value="{{$overhead->to_name}}">
                                            <input class="form-control table_input input_disabled"
                                                   type="text" name="to_company" placeholder="Компания отправителя" value="{{$overhead->to_company}}">
                                        </td>
                                        <td>
                                            <input class="form-control table_input input_disabled"
                                                   type="text" name="to_city" placeholder="Город" value="{{$overhead->to_city}}">
                                            <input class="form-control table_input input_disabled"
                                                   type="text" name="to_address" placeholder="Адрес" value="{{$overhead->to_address}}">

                                        </td>
                                        <td>
                                            <input class="form-control table_input input_disabled"
                                                   type="text" name="to_phone" placeholder="Телефон" value="{{$overhead->to_phone}}">
                                        </td>
                                        <td>
                                            <input class="form-control table_input input_disabled"
                                                   type="text" name="to_mass" placeholder="Вес" value="{{$overhead->mass}}">
                                            <input class="form-control table_input input_disabled"
                                                   type="text" name="to_length" placeholder="Длина" value="{{$overhead->length}}">
                                        </td>
                                        <td>
                                            <input class="form-control table_input input_disabled"
                                                   type="text" name="to_width" placeholder="Ширина" value="{{$overhead->width}}">
                                            <input class="form-control table_input input_disabled"
                                                   type="text" name="to_height" placeholder="Высота" value="{{$overhead->height}}">
                                        </td>

                                        <td class="actions_td">
                                            <button id="edit_btn" class="btn btn-danger edit_btn">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button id="save_btn" class="btn btn-warning btn_disable save_btn">
                                                <i class="fas fa-plus-circle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </form>
                            @endforeach
                        @else
                            <td colspan="10">Пусто</td>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="buttons">
                        <a href="{{route('admin.store.index')}}" class="btn btn-primary" type="button">Сохранить</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('admin-script')
    <script>
        let search = $('#search');
        $(document).ready(function (){
            let input = $('.table_input');
            let editBtn = $('.edit_btn');
            let saveBtn = $('.save_btn');
            input.attr('disabled', '');

            editBtn.click(function (){
                let save2 = $(this).parent().find('.save_btn');
                let tr = $(this).parent().parent();
                save2.show();
                $(this).hide();
                let input2 = tr.find('.table_input');
                input2.removeAttr('disabled');
                input2.removeClass('input_disabled');
            });
            saveBtn.click(function (){
                //console.log($(this));
                let td = $(this).parent();
                let tr = td.parent();

                //let code        = tr.find('input[name="code"]');
                let id          = tr.find('input[name="overhead_id"]');
                let to_name     = tr.find('input[name="to_name"]');
                let to_company  = tr.find('input[name="to_company"]');
                let to_city     = tr.find('input[name="to_city"]');
                let to_address  = tr.find('input[name="to_address"]');
                let to_phone    = tr.find('input[name="to_phone"]');
                let to_mass     = tr.find('input[name="to_mass"]');
                let to_length   = tr.find('input[name="to_length"]');
                let to_width    = tr.find('input[name="to_width"]');
                let to_height   = tr.find('input[name="to_height"]');
                //console.log(code.val()+" "+to_name.val());
                // console.log(parseFloat(to_height.val()));
                // return 0;
                if (isNaN(parseFloat(to_mass.val()))) {
                    to_mass.val(0.0);
                }
                if(isNaN(parseFloat(to_length.val()))){
                    to_length.val(0.0);
                }
                if(isNaN(parseFloat(to_width.val()))){
                    to_width.val(0.0);
                }
                if(isNaN(parseFloat(to_height.val()))){
                    to_height.val(0.0);
                }
                let data  = {
                    _token: '{{csrf_token()}}',
                    id: parseInt(id.val()),
                    company: to_company.val(),
                    //code: code.val(),
                    phone: to_phone.val(),
                    name: to_name.val(),
                    city: to_city.val(),
                    address: to_address.val(),
                    mass: parseFloat(to_mass.val()),
                    length: parseFloat(to_length.val()),
                    width: parseFloat(to_width.val()),
                    height: parseFloat(to_height.val()),
                };
                console.log(data);
                $.post({
                    url: '{{route('admin.store.update')}}',
                    method: 'post',
                    data: data,
                    success: function (result){
                        console.log(result);
                    },
                    errors: function (error){
                        console.log(error);
                    }
                });
                saveBtn.hide();
                editBtn.show();

            });

        });
        function checkOverhead(){
            // console.log("ch");
            //let search = $('#search');
            let value = search.val();
            console.log(value);
            if (value.length !== 7){
                alert('Длина накладного должен быть 7 символов');
                search.val('');
                search.focus();
                return 0;
            }
            $.ajax({
                url: '{{route('admin.store.checkOverhead')}}',
                method: 'get',
                data: {overhead: value, _token:'{{csrf_token()}}', order_id: $('#order_id').text()},
                success: function (result){
                    let res = JSON.parse(result);
                    console.log(result);

                    if (res !== ''){
                        window.location.reload();
                    }else{
                        alert("Что то не так, пожалуйста обратитесь к администратору");
                    }
                },
                errors: function (error){
                    console.log(error);
                }
            });
        }
    </script>
@endsection
