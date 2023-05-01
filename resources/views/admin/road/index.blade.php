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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Маршруты</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin')}}" class="text-muted">Панель управление</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.roads.index')}}" class="text-muted">Маршруты</a>
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
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="mb-0 h6">Список маршрутов</h5>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Добавить маршрут</a>
                    </div>
                </div>
            </div>
            <div class="card-body" style="padding: 0;">
                <div class="container-fluid" style="padding: 0;">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <table class="table table-bordered table-hover mt-2" id="road_table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Наименование маршрута</th>
                                        <th>Курьер</th>
                                        <th>Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($roads))
                                            @foreach($roads as $road)
                                                <tr>
                                                    <td>{{$road->id}}</td>
                                                    <td>{{$road->name}}</td>
                                                    <td>{{\App\Models\User::find($road->user_id)->name}}</td>
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
                <form action="{{route('admin.roads.store')}}" method="post">

                <div class="modal-body">
                    @csrf
                        <div class="form-group">
                            <label for="name">Имя маршрута</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
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

    </script>
@endsection
