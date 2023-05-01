@extends('layouts.app')
@section('subheader')
    <style>
        .eval_table{
            min-height: 400px;
            overflow-y: scroll;
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
    <div class="mx-auto col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3">
                        <h5 class="mb-0 h6">Список расчетов</h5>

                    </div>
                    <div class="col-md-4">
                        <form action="#" method="get" style="display:flex;">
                            <input class="form-control" type="text" name="search_overhead2" id="search_overhead2" placeholder="Введите номер накладного">
                            <input type="submit" class="btn btn-primary" value="Поиск" id="search_overhead_btn2">
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body" style="padding: 0;">
                <div class="container-fluid" style="padding: 0;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="eval_table">
                                <table class="table table-bordered table-hover mt-2" id="road_table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Отправитель</th>
                                        <th>Получатель</th>
                                        <th>Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody id="search_area">
                                    @if(isset($overheads))
                                    @foreach($overheads as $overhead)
                                    <tr>
                                        <td class="search_overhead_code">
                                            <a href="{{route('admin.evaluate.show')}}?id={{$overhead->id}}">{{$overhead->overhead_code}}</a>
                                        </td>
                                        <td>
                                            <div>{{$overhead->from_name}}</div>
                                            <div>{{$overhead->from_company}}</div>
                                        </td>
                                        <td>
                                            <div>{{$overhead->to_name}}</div>
                                            <div>{{$overhead->to_company}}</div>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.evaluate.showEval')}}?id={{$overhead->id}}"
											   class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
											<a href="{{route('admin.overheads.edit3')}}?overhead_id={{$overhead->id}}" 
											   class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
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
                <form action="#" method="post">

                <div class="modal-body">


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
        $('#search_overhead_btn2').click(function(e){
            e.preventDefault();
            let overhead_code = $('#search_overhead2').val();
            let tbody = $('#search_area');
            let tr = tbody.find('tr');
            tr.each(function(i, el){
                let td = $(el).find('.search_overhead_code');
                let a_text = td.find('a').text();
                if(a_text.trim() !== overhead_code.trim()){
                    $(el).hide();
                }
            });
        });
    </script>
@endsection
