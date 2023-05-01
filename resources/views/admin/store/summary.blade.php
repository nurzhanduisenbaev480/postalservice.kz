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
    </style>
    <!--begin::Subheader-->
    <div class="py-2 subheader py-lg-6 subheader-solid" id="kt_subheader">
        <div class="flex-wrap container-fluid d-flex align-items-center justify-content-between flex-sm-nowrap">
            <!--begin::Info-->
            <div class="flex-wrap mr-1 d-flex align-items-center">
                <!--begin::Page Heading-->
                <div class="flex-wrap mr-5 d-flex align-items-baseline">
                    <!--begin::Page Title-->
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Список сводок</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin')}}" class="text-muted">Панель управление</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.store.summary')}}" class="text-muted">Список сводок</a>
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
            <form action="#" method="get">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group fv-plugins-icon-container">
                            <label for="date_s">Дата от:</label>
                            <div class="input-group date">
                                <input type="text" name="date_s" autocomplete="off" class="form-control" id="date_s">
                                <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar"></i>
                                </span>
                                </div>
                            </div><i data-field="date_s" class="fv-plugins-icon"></i>

                            <div class="fv-plugins-message-container"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group fv-plugins-icon-container">
                            <label for="date_e">Дата до:</label>
                            <div class="input-group date">
                                <input type="text" value="" name="date_e" autocomplete="off" class="form-control" id="date_e">
                                <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar"></i>
                                </span>
                                </div>
                            </div><i data-field="date_e" class="fv-plugins-icon"></i>

                            <div class="fv-plugins-message-container"></div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="filter">Действие</label>
                            <input readonly class="btn btn-primary" name="filter" id="filter" value="Фильтр">
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-box">
                        <table class="table table-bordered table-hover mt-2">
                            <thead>
                            <tr class="table-danger">
                                <th>#</th>
                                <th>Статус</th>
                                <th>Перевозчик</th>
                                <th>Откуда</th>
                                <th>Куда</th>
                                <th>Цена отправки</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody class="summary_dates">
                            @php
                                $i=0;
                            @endphp
                                @if(isset($sum) && !empty($sum))
                                    @foreach($sum as $summary)
                                        @php
                                            $i++;
                                        @endphp
                                    <tr>
                                        <td>
                                            <a>{{ $i }}</a>
                                        </td>
                                        <td>{{$summary->status}}</td>
                                        <td>
                                            @if(App\Models\Transport::find(App\Models\Registry::find($summary->registry_id)->transport_type) != null)
                                                {{App\Models\Transport::find(App\Models\Registry::find($summary->registry_id)->transport_type)->name}}
                                            @else
                                                Не установлен
                                            @endif

                                        </td>
                                        <td>
                                            {{App\Models\City::find($summary->from_city)->city_name}}
                                        </td>
                                        <td>
                                            {{App\Models\City::find($summary->to_city)->city_name}}
                                        </td>
                                        <td class="price">{{$summary->price}}</td>
                                        <td>
                                            <a href="{{route('admin.store.showSummary')}}?id={{$summary->id}}" class="btn btn-primary">Смотреть</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5"></td>
                                    <td style="display:flex;">
                                        <p style="margin-right: 10px;">Сумма:</p>
                                        <p id="sum">100</p>тг
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('admin-script')
    <script>

        $('#date_s').datepicker({
            orientation: "bottom auto",
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,

        });
        $('#date_e').datepicker({
            orientation: "bottom auto",
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,

        });
        let sum = 0;
        sumVal(sum);
        function sumVal(sum) {
            $('.summary_dates tr td.price').each(function(i, el){
                sum += parseFloat($(el).text());
               // console.log($(el).text());
            });
            //console.log(sum);
            $('#sum').text(sum);
        }
        $('#filter').click(function(e){
            e.preventDefault();
            //console.log($('#date_s').val());
            let start = $('#date_s').val();
            let end = $('#date_e').val();
            console.log(start, end.length);
            if(start.length === 0){
                alert('Пожалуйста выберите стартовую дату');
            }
            if(end.length === 0){
                alert('Пожалуйста выберите конечную дату');
            }
            console.log('{{route("admin.store.getSummary")}}');
            //return false;
            $.ajax({
                url: '{{route("admin.store.getSummary")}}',
                data: {start: start, end: end},
                method: 'GET',
                success: function(result){
                    console.log(result);
                    let data = JSON.parse(result);
                    $('.summary_dates tr').remove();
                    let tbody = $('.summary_dates');
                    let tr = "";
                    for(let i=0; i<data.length; i++){
                        console.log(data[i]);
                        tr+="<tr>";
                        tr+="<td>"+data[i].id+"</td>";
                        tr+="<td>"+data[i].status+"</td>";
                        tr+="<td>"+data[i].driver+"</td>";
                        tr+="<td>"+data[i].from+"</td>";
                        tr+="<td>"+data[i].to+"</td>";
                        tr+="<td class='price'>"+data[i].price+"</td>";
                        tr+="<td><a href='{{route('admin.store.showSummary')}}?id="+data[i].id+"' class='btn btn-primary'>Смотреть</a></td>"
                        tr+="</tr>";
                    }
                    console.log(tr);
                    tbody.append(tr);
                    sumVal(sum);

                },
                error: function(result){
                    console.log(result);
                }
            });
        });
    </script>
@endsection
