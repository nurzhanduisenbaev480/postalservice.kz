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
			font-size: 0.8rem;
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
		.table thead th, .table thead td{
			font-size: 0.8rem;
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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Заявки для курьера</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin')}}" class="text-muted">Панель управление</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.roads.order')}}" class="text-muted">Заявки для курьера</a>
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
        <div class="row">
            <div class="col-md-12">
                @if(\Illuminate\Support\Facades\Session::has('message'))
                    @if(\Illuminate\Support\Facades\Session::get('message') == 0)
                        <div class="alert alert-success">Успешно удален</div>
                    @else
                        <div class="alert alert-danger">Что то пошло не так, пожалуйста обратитесь к администратору</div>
                    @endif
                    {{\Illuminate\Support\Facades\Session::forget('message')}}
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="mb-0 h6">Заявки</h5>
                    </div>
                </div>
            </div>
            <div class="card-body" style="padding: 0;">
                <div class="container-fluid" style="padding: 0;">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 style="margin: 5px 0 0 5px">Новые заявки</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover mt-2">
                                <thead>
                                <tr class="table-success">
                                    <th>#</th>
                                    <th>Код Заявки</th>
                                    <th>Отправитель</th>
									<th>Компания</th>
                                    <th>Адрес</th>
                                    <th>Телефон</th>
                                    <th>Комментарий</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($newOrders))
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach($newOrders as $order)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr class="table-success">
                                            <td><div class="table_td_item">{{$i}}</div></td>
                                            <td>
                                                <div class="table_td_item">
                                                    {{$order->order_code}}
                                                </div>
                                            </td>
                                            <td><div class="table_td_item">{{$order->from_name}}</div></td>
											<td><div class="table_td_item">{{$order->from_company}}</div></td>
                                            <td><div class="table_td_item">{{$order->from_address}}</div></td>
                                            <td><div class="table_td_item">{{$order->from_phone}}</div></td>
                                            <td><div class="table_td_item">{{$order->description}}</div></td>
                                            <td>
                                                <div class="table_td_item">
                                                    <ul style="list-style: none;padding: 0;" class="order_action">
                                                        <li class="order_action_item">
                                                            <a href="#"
															   data="{{$order->id}}" class="btn btn-primary btn-sm"
                                                               data-toggle="modal"
                                                               data-target="#set22Courier-{{$order->id}}">
                                                                Назначить
                                                            </a>
															<!-- Modal -->
                                                    <div class="modal fade"
                                                             id="set22Courier-{{$order->id}}" tabindex="-1"
                                                             role="dialog" aria-labelledby="set22Courier-{{$order->id}}Title"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
																			id="set22Courier-{{$order->id}}Title">
																			Назначить курьера</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"
																				aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form action="{{route('admin.roads.setCourier')}}" method="post">
                                                                        <div class="modal-body">
                                                                            @csrf
                                                                            <input type="hidden" name="order_id" id="order_id"
																				   value="{{$order->id}}">
                                                                            <div class="form-group">
                                                                                <label for="courier_id">Курьер</label>
                                                                                <select name="courier_id" id="courier_id"
																						class="form-control">
                                                                                    @foreach($userList as $user)
                                                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
																					data-dismiss="modal">Закрыть</button>
                                                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </li>
                                                        <li>
                                                            <a href="{{route('admin.roads.orderShow', ['order_id'=>$order->id])}}"
                                                               class="btn btn-info btn-sm">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a href="{{route('admin.roads.orderDelete', ['order_id'=>$order->id])}}"
															   class="btn btn-danger btn-sm">
                                                                <i class="fa fa-minus"></i>
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
                    <div class="row">
                        <div class="col-md-12">
                            <h5 style="margin: 5px 0 0 5px">Курьер назначен</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover mt-2">
                                <thead>
                                <tr class="table-info">
                                    <th>#</th>
                                    <th>Код Заявки</th>
                                    <th>Отправитель</th>
									<th>Компания</th>

                                    <th>Телефон</th>
                                    <th>Адрес</th>
                                    <th>Комментарий</th>
                                    <th>Курьер</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($courierInstall))
                                    @php
                                        $k=0;
                                    @endphp
                                    @foreach($courierInstall as $order2)
                                        @php
                                            $k++;
                                        @endphp
                                        <tr class="table-info">
                                            <td><div class="table_td_item">{{$k}}</div></td>
                                            <td><div class="table_td_item">
                                                    <a href="{{route("admin.roads.orderShow")}}?order_id={{$order2->id}}">
                                                        {{$order2->order_code}}</a>
                                                </div></td>
                                            <td><div class="table_td_item">{{$order2->from_name}}</div></td>
											<td><div class="table_td_item">{{$order2->from_company}}</div></td>
                                            <td><div class="table_td_item">{{$order2->from_phone}}</div></td>
                                            <td><div class="table_td_item">{{$order2->from_address}}</div></td>
                                            <td><div class="table_td_item">{{$order2->description}}</div></td>
                                            <td>
                                                <div class="table_td_item">
                                                    <a href="#"
                                                       data="{{$order2->id}}" class="btn btn-primary btn-sm"
                                                       data-toggle="modal"
                                                       data-target="#setCourier-{{$order2->id}}">
                                                        {{$order2->getCourier($order2->courier_id)->name}}
                                                    </a>

                                                    <!-- Modal -->
                                                    <div class="modal fade"
                                                             id="setCourier-{{$order2->id}}" tabindex="-1"
                                                             role="dialog" aria-labelledby="setCourier-{{$order2->id}}Title"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
																			id="setCourier-{{$order2->id}}Title">Назначить курьера</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"
																				aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form action="{{route('admin.roads.setCourier')}}" method="post">
                                                                        <div class="modal-body">
                                                                            @csrf
                                                                            <input type="hidden" name="order_id" id="order_id"
																				   value="{{$order2->id}}">
                                                                            <div class="form-group">
                                                                                <label for="courier_id">Курьер</label>
                                                                                <select name="courier_id" id="courier_id"
																						class="form-control">
                                                                                    @foreach($userList as $user)
                                                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                                                    @endforeach
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
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 style="margin: 5px 0 0 5px">Курьер принял</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover mt-2">
                                <thead>
                                <tr class="table-danger">
                                    <th>#</th>
                                    <th>Код Заявки</th>
                                    <th>Отправитель</th>
									<th>Компания</th>

                                    <th>Телефон</th>
                                    <th>Адрес</th>
                                    <th>Комментарий</th>
                                    <th>Курьер</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($courierAccept))
                                    @php
                                        $d=0;
                                    @endphp
                                    @foreach($courierAccept as $order3)
                                        @php
                                            $d++;
                                        @endphp
                                        <tr class="table-danger">
                                            <td><div class="table_td_item">{{$d}}</div></td>
                                            <td><div class="table_td_item">
                                                    <a href="{{route("admin.roads.orderShow")}}?order_id={{$order3->id}}">
                                                        {{$order3->order_code}}</a>
                                                </div></td>
                                            <td><div class="table_td_item">{{$order3->from_name}}</div></td>
											<td><div class="table_td_item">{{$order3->from_company}}</div></td>
                                            <td><div class="table_td_item">{{$order3->from_phone}}</div></td>
                                            <td><div class="table_td_item">{{$order3->from_address}}</div></td>
                                            <td><div class="table_td_item">{{$order3->description}}</div></td>
                                            <td>
                                                <div class="table_td_item">
                                                    <a href="#"
                                                       data="{{$order3->id}}" class="btn btn-primary btn-sm"
                                                       data-toggle="modal"
                                                       data-target="#set1Courier-{{$order3->id}}">
                                                        {{$order3->getCourier($order3->courier_id)->name}}
                                                    </a>

                                                    <!-- Modal -->
                                                    <div class="modal fade"
                                                         id="set1Courier-{{$order3->id}}" tabindex="-1"
                                                         role="dialog" aria-labelledby="set1Courier-{{$order3->id}}Title"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="set1Courier-{{$order3->id}}Title">Назначить курьера</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="{{route('admin.roads.setCourier')}}" method="post">
                                                                    <div class="modal-body">
                                                                        @php
                                                                            print_r($order3->id);
                                                                        @endphp
                                                                        @csrf
                                                                        <input type="hidden" name="order_id" id="order_id" value="{{$order3->id}}">
                                                                        <div class="form-group">
                                                                            <label for="courier_id">Курьер</label>
                                                                            <select name="courier_id" id="courier_id" class="form-control">
                                                                                @foreach($userList as $user)
                                                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                                                @endforeach
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
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 style="margin: 5px 0 0 5px">Курьер забрал</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover mt-2">
                                <thead>
                                <tr class="table-dark">
                                    <th>#</th>
                                    <th>Код Заявки</th>
                                    <th>Отправитель</th>
									<th>Компания</th>

                                    <th>Телефон</th>
                                    <th>Адрес</th>
                                    <th>Комментарий</th>
                                    <th>Курьер</th>
									<th>Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($courierTake))
                                    @php
                                        $j=0;
                                    @endphp
                                    @foreach($courierTake as $order)
                                        @php
                                            $j++;
                                        @endphp
                                        <tr class="table-dark">
                                            <td><div class="table_td_item">{{$j}}</div></td>
                                            <td><div class="table_td_item">
                                                    <a href="{{route("admin.roads.orderShow")}}?order_id={{$order->id}}">
                                                        {{$order->order_code}}</a>
                                                </div></td>
                                            <td><div class="table_td_item">{{$order->from_name}}</div></td>
											<td><div class="table_td_item">{{$order->from_company}}</div></td>
                                            <td><div class="table_td_item">{{$order->from_phone}}</div></td>
                                            <td><div class="table_td_item">{{$order->from_address}}</div></td>
                                            <td><div class="table_td_item">{{$order->description}}</div></td>
											@if($order->getCourier($order->courier_id) != null)
                                            <td><div class="table_td_item">{{$order->getCourier($order->courier_id)->name}}</div></td>
											@else
											<td><div class="table_td_item">Курьер не установлен</div></td>
											@endif
											<td><a href="{{route('admin.roads.connect', ['order_id'=>$order->id])}}"
												   class="btn btn-sm btn-primary">Присвоить</a></td>
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
    <!-- Modal -->
    <div class="modal fade"
         id="exampleModalLong" tabindex="-1"
         role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Назначить курьера</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.roads.setCourier')}}" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="order_id" id="order_id">
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
        $('.order_action_item a').click(function (e){
            e.preventDefault();
            let order_id = $(this).attr('data');
            let orderInput = $('#order_id');
            orderInput.val();
            orderInput.val(order_id);
        });
    </script>
@endsection
