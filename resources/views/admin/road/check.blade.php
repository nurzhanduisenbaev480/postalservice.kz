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
                            <a href="{{route('admin.roads.another')}}" class="text-muted">Список заявок</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.roads.check')}}?order_id={{$order->id}}" class="text-muted">Сверить</a>
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
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <table class="table table-hover table-bordered" id="order_overheads">
                        <thead>
                        <tr class="table-info">
                            <th>Номер накладного</th>
                            <th style="width: 300px;">Отправитель</th>
                            <th style="width: 300px;">Получатель</th>
                            <th>Курьер</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($overheads) && !$overheads->isEmpty())
                            @foreach($overheads as $overhead)
                                    <tr>
                                        <td>{{$overhead->overhead_code}}</td>
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
                                        <td>
                                            @if($overhead->courier_id == null)
                                                Курьер не назначен
                                            @else
                                                {{\App\Models\User::find($overhead->courier_id)->name}}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-dark setCourierBtn"
                                               data="{{$overhead->_id}}"
                                               data-toggle="modal"
                                               data-target="#exampleModalLong"
                                               style="font-size: 10px;margin: 5px;"
                                               onclick="setCourier({{$overhead->id}})">Назначить курьера</a>
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
                        <a href="{{route('admin.roads.another')}}"
                           class="btn btn-primary" type="button">Сохранить</a>
                        <a href="{{route('admin.roads.send')}}?order_id={{$order->id}}"
                           class="btn btn-primary" type="button">Отправить в склад</a>

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
                <form action="{{route('admin.roads.setCourier2')}}" method="post">

                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="overhead_id" name="overhead_id">
                        <input type="hidden" id="order_id" name="order_id" value="{{$order->id}}">
                        <div class="form-group">
                            <label for="courier_id">Курьер</label>
                            <select name="courier_id" id="courier_id" class="form-control">
                                @if(isset($userList))
                                    @foreach($userList as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
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
        let search = $('#search');
        function setCourier(id){
            $('#overhead_id').val(id);
        }
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
            if (value.length !== 6){
                alert('Длина накладного должен быть 7 символов');
                search.val('');
                search.focus();
                return 0;
            }
            $.ajax({
                url: '{{route('admin.roads.checkOverhead')}}',
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
