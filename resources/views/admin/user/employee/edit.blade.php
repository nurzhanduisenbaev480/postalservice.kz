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
                <h5 class="mb-0 h6">Информация о пользователе</h5>
            </div>
            <div class="card-body" style="padding: 0;">
                <div class="container-fluid" style="padding: 0;">
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <form action="{{route('admin.users.employee.update')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <div class="row justify-content-md-center">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="name">Ф.И.О</label>
                                            <input type="text" name="name" id="name"
                                                   value="{{$user->name}}"
                                                   class="form-control"
                                                   placeholder="Введите ФИО">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email"
                                                   value="{{$user->email}}"
                                                   id="email"
                                                   class="form-control"
                                                   placeholder="Введите Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Пароль</label>
                                            <input type="text" name="password"
                                                   id="password"
                                                   value="{{$user->visible_password}}"
                                                   class="form-control"
                                                   placeholder="Введите Пароль">
                                        </div>
                                        <div class="form-group">
                                            <label for="company">Компания</label>
                                            <input type="text" name="company"
                                                   id="company"
                                                   value="{{$company->company_name}}"
                                                   class="form-control"
                                                   placeholder="Имя компания">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Телефон</label>
                                            <input type="text" name="phone"
                                                   id="phone"
                                                   value="{{$user_info->phone}}"
                                                   class="form-control"
                                                   placeholder="Введите телефон">
                                        </div>
                                        <div class="form-group">
                                            <label for="city">Город</label>
                                            <select name="city" id="city" class="form-control">
                                                @if(isset($cities))
                                                    @foreach($cities as $city)
                                                        @if($city->id == $user_info->city_id)
                                                            <option selected value="{{$city->id}}">{{$city->city_name}}</option>
                                                        @else
                                                            <option value="{{$city->id}}">{{$city->city_name}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Адрес</label>
                                            <input type="text" name="address"
                                                   id="address"
                                                   value="{{$user_info->address}}"
                                                   class="form-control"
                                                   placeholder="Введите адрес">
                                        </div>
                                        <div class="form-group">
                                            <label for="bin">БИН/ИИН</label>
                                            <input type="text" name="bin"
                                                   id="bin"
                                                   value="{{$user_info->bin}}"
                                                   class="form-control"
                                                   placeholder="Введите БИН">
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Обновить</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
