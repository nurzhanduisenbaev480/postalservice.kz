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
                    <h5 class="my-1 mr-5 text-dark font-weight-bold">Список реестров</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="p-0 my-2 mr-5 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin')}}" class="text-muted">Панель управление</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.store.registryList')}}" class="text-muted">Список реестров</a>
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
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
@if (\Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('error') !!}</li>
        </ul>
    </div>
@endif
    <div class="mx-auto col-lg-12">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-box">
                        <table class="table table-bordered table-hover mt-2">
                            <thead>
                            <tr class="table-danger">
								<th>#</th>
                                <th>ID</th>
                                <th>Статус</th>
                                <th>Перевозчик</th>
                                <th>Откуда</th>
                                <th>Куда</th>
                                <th>Дата</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($registries))
								@php $i=0 @endphp
                                @foreach($registries as $registry)
								@php $i++ @endphp
                                    <tr>
										<td>{{$i}}</td>
                                        <td>{{$registry->id}}</td>
                                        <td>{{\App\Models\Status::find($registry->status_id)->status_name}}</td>
                                        <td>{{$registry->transport_type==0 ? 'Не установлен':\App\Models\Transport::find($registry->transport_type)->name}}</td>
                                        <td>{{\App\Models\City::find($registry->from)->city_name}}</td>
                                        <td>{{\App\Models\City::find($registry->to)->city_name}}</td>
                                        <td>{{$registry->date_s}}</td>
                                        <td>
                                            <button class="print_btn" data="{{$registry->code}}" data2="{{$registry->id}}">
                                                <i class="fa fa-print" style="color: #0b2339;"></i>
                                            </button>
                                            <a href="#" class="edit_btn"
                                               data="{{$registry->id}}"
                                               data-toggle="modal" data-target="#exampleModalLongReg_{{$registry->id}}">
                                                <i class="fa fa-edit" style="color: #0b2339"></i>

                                            </a>
                                            <div class="modal fade" id="exampleModalLongReg_{{$registry->id}}" tabindex="-1"
                                                 role="dialog" aria-labelledby="exampleModalLongTitleReg"
                                                 aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="exampleModalLongTitleReg">Информация</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{route('admin.store.updateRegistry')}}" method="post">
                                                            <div class="modal-body">
                                                                @csrf
                                                                <input type="hidden" name="registry_id2" id="registry_id2" value="{{$registry->id}}">

                                                                <div class="form-group">
                                                                    <label for="transport">Первозчик</label>
                                                                    <select name="transport" id="transport" class="form-control">
                                                                        @if(isset($transports))
                                                                            <option value="0">Не установлен</option>
                                                                            @foreach($transports as $transport)
                                                                                <option value="{{$transport->id}}">{{$transport->name}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="price">Цена</label>
                                                                    <input type="text" name="price" id="price"
                                                                           class="form-control" value="0">
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
											<a href="#" class="edit_status_btn"
                                               data-toggle="modal" data-target="#exampleModalLong{{$registry->id}}">
                                                <i class="fa fa-pen" style="color:#0b2339;"></i>
                                            </a>
											<div class="modal fade" id="exampleModalLong{{$registry->id}}" tabindex="-1"
												 role="dialog" aria-labelledby="exampleModalLongTitle"
												 aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLongTitle">Информация</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<form action="{{route('admin.store.setStatus')}}" method="get">
															<div class="modal-body">
																@csrf
																<input type="hidden" name="registry_id" id="registry_id"
																	   value="{{$registry->id}}">

																<div class="form-group">
																	<label for="registry_status">Статусы</label>
																	<select name="registry_status" id="registry_status" class="form-control">
																		<option value="7">В пути в г.
																			{{\App\Models\City::find($registry->to)->city_name}}</option>
																		<option value="18">На доставке в г.
																			{{\App\Models\City::find($registry->to)->city_name}}
																		</option>
																		<option value="8">Доставлен</option>
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
                                            <a href="" class="btn btn-success btn-sm summary-btn"
                                                data="{{$registry->id}}"
                                                data-toggle="modal" data-target="#sendSummary{{$registry->id}}">Отправить</a>
											<!-- Modal -->
											<div class="modal fade" id="sendSummary{{$registry->id}}" tabindex="-1"
												 role="dialog" aria-labelledby="sendSummaryTitle{{$registry->id}}"
												 aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title"
																id="sendSummaryTitle{{$registry->id}}">Отправить сводку</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<form action="{{route('admin.store.sendSummary')}}" method="get">
															<div class="modal-body">
																@csrf
																<input type="hidden" name="registry_id2" id="registry_id2"
																	   value="{{$registry->id}}">
																<div class="form-group">
																	<label for="description">Сводка</label>
																	<textarea name="description" id="description" class="form-control" rows='7'></textarea>
																</div>
																<div class="form-group">
																	<label for="price">Цена</label>
																	<input name="price" id="price" class="form-control" value="0">
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


@include('inc.print_new')
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
        $('.edit_btn').click(function (){
            let registry_id = $(this).attr('data');
            $('#registry_id2').val(registry_id);
            console.log(registry_id);
			$.ajax({
				url: '{{route('admin.store.getRegistry')}}',
				method: 'get',
				data: {registry_id: registry_id},
				success: function(result){
					console.log(result);

				let res = JSON.parse(result);
				//console.log(res.transport_name);
				$('#price').val(res.price);
				$("#transport option").each(function(i, el){
					let optionText = $(el).text();
					if(optionText === res.transport_name){
						$(el).prop('selected', true);
					}

				});
				},
				error: function(result){
					console.log(result);
				},
			});


            //console.log($('#registry_id2').val());
        });
        //$('.summary-btn').click(function(){
            //let registry_code = $(this).attr('data');
            //console.log(registry_code);
            //$('#registry_id2').val(registry_code);
        //});
        $('.print_btn').click(function (){
            let registry_id = $(this).attr('data2');
            let registry_code = $(this).attr('data');
            console.log(registry_id);
            {{--$.ajax({--}}
            {{--    url: '{{route('admin.store.getOverhead')}}',--}}
            {{--    method: 'get',--}}
            {{--    data: {registry_id: registry_id},--}}
            {{--    success: function(result){--}}
            {{--        console.log(result);--}}
            {{--       // return;--}}
			{{--		let res = JSON.parse(result);--}}
            {{--        console.log(res.date);--}}

            {{--        if(res.date === null){--}}
            {{--            $('.top_date').text('не указан');--}}
            {{--        }else{--}}
            {{--            $('.top_date').text(res.date.substr(0, 10));--}}
            {{--        }--}}

            {{--        $('.from_city').text(res.from);--}}
            {{--        $('.to_city').text(res.to);--}}
            {{--        $('.transporter_company_value').text(res.name);--}}
            {{--        $('.transporter_type_value').text(res.type);--}}
            {{--        $('.transporter_phone_value').text(res.phone);--}}
            {{--        let tr = '';--}}
			{{--	let k=0;--}}
            {{--        console.log(res.overheads.length);--}}
            {{--        for(let i = 0; i< res.overheads.length; i++){--}}
			{{--			k++;--}}
            {{--            tr += '<tr class="table_row">'+--}}
			{{--				'<td>'+k+'</td>'+--}}
			{{--				'<td>'+--}}
			{{--					'<div>'+res.overheads[i].from_company+'</div>'--}}
			{{--				+'</td>'+--}}
			{{--				'<td>'+--}}
			{{--					'<div>'+res.overheads[i].to_name+'</div>'+--}}
			{{--					'<div>'+res.overheads[i].to_address+'</div>'+--}}
			{{--					'<div>'+res.overheads[i].to_phone+'</div>'+--}}
            {{--                '</td>'+--}}
			{{--				'<td>'+res.overheads[i].speed+'/'+res.overheads[i].type+'</td>'+--}}
			{{--				'<td>'+res.overheads[i].mass+'</td>'+--}}
			{{--				'<td>'+res.overheads[i].place+'</td>'+--}}
            {{--            	'<td>'+res.overheads[i].code+'</td>'+--}}
			{{--				'<td>'+res.overheads[i].description+'</td>'+--}}
            {{--                '<td>'+--}}
			{{--					'<div>'+res.overheads[i].to_name+'</div>'+--}}
			{{--					'<div>'+res.overheads[i].to_company+'</div>'+--}}
			{{--				'</td>'+--}}
            {{--               '<td><span style="margin-left:20px;"></span></td>'+--}}
            {{--            '</tr>'--}}
			{{--			//'+res.overheads[i].date+'--}}
            {{--        }--}}
            {{--        console.log(tr);--}}
            {{--        $("#table_body").append(tr);--}}

			{{--		JsBarcode("#barcode", registry_code,{--}}
			{{--			lineColor: "#0aa",--}}
			{{--			height: 50,--}}
			{{--			displayValue: true--}}
			{{--		});--}}
            {{--        let prtContent = document.getElementById('printRegistry');--}}
            {{--        Popup(prtContent);--}}
            {{--        prtContent = null;--}}
            {{--        window.location.reload();--}}

            {{--    },--}}
            {{--    error: function(error){--}}
            {{--        console.log(error);--}}
            {{--    }--}}
            {{--});--}}
            $.ajax({
                url: '{{route('admin.store.getOverhead')}}',
                method: 'get',
                data: {registry_id: registry_id},
                success: function(result){
                    console.log(result);
                    // return;
                    let res = JSON.parse(result);
                    console.log(res.date);

                    if(res.date === null){
                        $('.top_date').text('не указан');
                    }else{
                        $('.top_date').text(res.date.substr(0, 10));
                    }
                    $('#top_city_1').text(res.to);
                    $('.from_city').text(res.from);
                    $('.to_city').text(res.to);
                    $('.transporter_company_value').text(res.name);
                    $('.transporter_type_value').text(res.type);
                    $('.transporter_phone_value').text(res.phone);
                    let tr = '';
                    let k=0;
                    console.log(res.overheads.length);
                    for(let i = 0; i< res.overheads.length; i++){
                        k++;
                        tr += '<tr class="table_row">'+
                            '<td style="width: 10px;">'+ k +'</td>'+
                            '<td>'+ res.overheads[i].code+'</td>'+
                            '<td>'+ res.overheads[i].from_company +'</td>'+
                            '<td>'+ res.overheads[i].to_phone +'</td>'+
                            '<td>'+ res.overheads[i].to_name +'</td>'+
                            '<td>'+ res.overheads[i].to_city +'</td>'+
                            '<td>'+ res.overheads[i].to_address +'</td>'+
                            '<td>'+ res.overheads[i].price +'</td>'+
                            '<td>'+ res.overheads[i].description +'</td>'+
                            '</tr>'
                        //'+res.overheads[i].date+'
                    }
                    console.log(tr);
                    $("#table_body").append(tr);
                    JsBarcode("#barcode", registry_code,{
                        lineColor: "#0aa",
                        height: 50,
                        displayValue: true
                    });
                    let prtContent = document.getElementById('printRegistry');
                    Popup(prtContent);
                    prtContent = null;
                    window.location.reload();

                },
                error: function(error){
                    console.log(error);
                }
            });


        });
        function Popup(data) {
            var mywindow = window.open('','','left=50,top=50,width=860,height=2000,toolbar=0,scrollbars=1,status=0');
            //   mywindow.document.write('<html><head><title></title>');
            //   mywindow.document.write('<link rel="stylesheet" href="css/midday_receipt.css" type="text/css" />');
            //   mywindow.document.write('</head><body >');
            mywindow.document.write('<div class="printNakl" style="width:800px;margin-bottom:20px;">');
            mywindow.document.write(data.innerHTML);
            mywindow.document.write('</div>');
            //   mywindow.document.write('</body></html>');

            mywindow.focus();
            mywindow.document.close();
            mywindow.print();mywindow.close();
            //setTimeout(function(){mywindow.print();mywindow.close();location.reload();},1000);
            //   mywindow.close();


            return true;
        }
    </script>
@endsection
