@extends('layouts.app')
@section('subheader')
    <style>

    </style>
    <!--begin::Subheader-->
    <div class="py-2 subheader py-lg-6 subheader-solid" id="kt_subheader">
        <div class="flex-wrap container-fluid d-flex align-items-center justify-content-between flex-sm-nowrap">
            <!--begin::Info-->
            <div class="flex-wrap mr-1 d-flex align-items-center">
                <!--begin::Page Heading-->
                <div class="flex-wrap mr-5 d-flex align-items-baseline">
                    <!--begin::Page Title-->
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Сборка</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.store.index')}}" class="text-muted">Склад</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.store.registry')}}" class="text-muted">Сборка</a>
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
            <div class="row border-1">
                <div class="col-md-2">
                    <button class="btn btn-dark" id="select_all">Выбрать все</button>
                </div>
                <div class="col-md-2">
                    <select name="filter_city" id="filter_city" class="form-control">
                        @if(isset($cities))
                            <option value="0">Все</option>
                            <option value="31">Алматы</option>
                            @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->city_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <button class="btn btn-dark" id="add_registry">Добавить в реестр</button>
                    <button class="btn btn-primary add_registry"
                            data-toggle="modal" data-target="#exampleModalLong">Создать сборку</button>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="overheads">
                        <table class="table table-hover table-bordered" id="overheads">
                            <thead>
                            <tr>
                                <th style="width: 30px;"></th>
                                <th>#</th>
                                <th>Отправитель</th>
                                <th>Получатель</th>
                                <th>Куда</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($overheads))
                                @foreach($overheads as $overhead)
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <input type="checkbox" class="form-control checked_item" data="{{$overhead->id}}">
                                            </div>
                                        </td>
                                        <td> <p class="overheads_p">{{$overhead->overhead_code}}</p> </td>
                                        <td> <p class="overheads_p">{{$overhead->from_company}}</p> </td>
                                        <td>
                                            <p class="text-danger">{{$overhead->to_name}}</p>
                                            <p class="text-info">{{$overhead->to_address}}</p>
                                            <p class="text-dark" style="font-weight: bold;">{{$overhead->to_phone}}</p>
                                        </td>
                                        <td><p class="overheads_p td_city">{{$overhead->to_city}}</p></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="registry">
                        <ul>
                            @if(isset($registries))
                                </li>
                                @foreach($registries as $registry)
                                    <li>
                                        <span class="text_registry">
                                            <input type="checkbox" name="check_registry" class="registry_id" value="{{$registry->id}}">
                                        </span>
                                        <span class="text_registry">Номер реестра:
                                            <span style="color:#e3342f">{{$registry->id}}</span>
                                        </span>
                                        <span class="text_registry">Тип транспорта:
                                            <span style="color:#e3342f">{{$registry->transport_type}}</span>
                                        </span>
                                        <span class="text_registry">Куда:
                                            <span style="color:#e3342f">{{\App\Models\City::find($registry->to)->city_name}}</span>
                                        </span>
                                    </li>
                                @endforeach
                            @endif
                        </ul>

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
                    <form action="{{route('admin.store.create')}}" method="post">

                    <div class="modal-body">
                        @csrf
                        <input type="hidden" value="{{$order_id}}" name="order_id">
                        <div class="form-group">
                            <label for="transport_type">Перевозчик</label>
                            <select name="transport_type" id="transport_type" class="form-control">
                                @if(isset($transports))
                                    <option value="0">Не установлен</option>
                                    @foreach($transports as $transport)
                                        <option value="{{$transport->id}}">{{$transport->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="from">Город(откуда)</label>
                            <select name="from" id="from" class="form-control">
                                @if(isset($cities))
                                    <option value="31">Алматы</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->city_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="to">Город(куда)</label>
                            <select name="to" id="to" class="form-control">
                                @if(isset($cities))
                                    <option value="31">Алматы</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->city_name}}</option>
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
        $("#filter_city").change(function (e){
            //console.log($(this).val());

            let city_id = $(this).val();
            let option = $(this).find('option[value='+city_id+']');
            //console.log(option.text());
            let city_name = option.text();
            let td_city = $('.td_city');
            td_city.each(function (i, el){
                if ($(el).text() !== city_name){
                    $(el).parent().parent().hide();
                    $(el).parent().parent().removeClass('visible');
                }else{
                    $('.checked_item').removeClass('visible');
                    $(el).parent().parent().show();
                    $(el).parent().parent().addClass('visible');
                }
            });
            if(city_id === 0){
                $('#overheads tbody tr').show();
                $('#overheads tbody tr').removeClass('visible');
            }



        });

        let check = $('.checked_item');
        check.change(function(){
            let tr = $(this).parent().parent().parent();
            if ($(this).prop('checked') === true){
                tr.addClass('visible');
            }else{
                tr.removeClass('visible');
            }
        });
        let f = 0;
        $('#select_all').click(function (){
            if (f === 0){
                $('#overheads .checked_item').prop('checked', 'checked');
                $('#overheads tbody tr').addClass('visible');
                f = 1;
            }else{
                $('#overheads .checked_item').prop('checked', '');
                $('#overheads tbody tr').removeClass('visible');
            }
        });
        $("#add_registry").click(function(){
            let tr = $('tr.visible');
            let ch = tr.find('.checked_item');
            let d = ch.attr('data');
            console.log(d);
            let data = [];
            let da = {};
            tr.each(function (i, el){
                data[i] = $(el).find('.checked_item').attr('data');
            });
            console.log(data);
            let registry = $('.registry_id');
            let registry_id = registry.val();
            da = {
                _token: '{{@csrf_token()}}',
                data: data,
                registry_id: registry_id
            };
            $.ajax({
                url: '{{route('admin.store.createRegistry')}}',
                method: 'post',
                data:da,
                success: function (result){
                    console.log(result);
                    let res = JSON.parse(result);
                    if (res.success === true){
                        window.location.reload();
                    }
                },
                error: function (error){
                    console.log(error);
                }
            });
            console.log(da);

        });
    </script>
@endsection
