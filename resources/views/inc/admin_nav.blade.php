@php
    $user_id = \Illuminate\Support\Facades\Auth::user()->id;
    $role = \Illuminate\Support\Facades\Auth::user()->getRole($user_id);
    $role_id = $role->first()->role_id;

@endphp
<style>
    .globs:hover{
        color: #F64E60;
    }
    .bell:hover{
        color: #F64E60;
    }
</style>
<!--begin::Header-->
<div id="kt_header" class="header header-fixed  @if (!trim($__env->yieldContent('subheader'))) has_shadow @endif">

    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
            <!--begin::Header Menu-->
            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default header-menu-root-arrow">
                <!--begin::Header Nav-->
                <ul class="menu-nav">
                    <li class="menu-item menu-item-submenu menu-item-rel ">
                        <a href="https://postalservice.kz/" target="_blank" class="menu-link">
                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                <i class="globs fas fa-globe"></i>
                            </span>
                        </a>
                    </li>
					<li class="menu-item menu-item-submenu menu-item-rel ">

					</li>
                    @if($role_id == 1 || $role_id == 2 || $role_id == 3 || $role_id == 4 || $role_id == 6 || $role_id == 9 || $role_id == 8)
                        <li class="menu-item menu-item-submenu menu-item-rel ">
                            <a href="{{route('admin.orders.create')}}"
                               class="menu-link btn btn-light-primary font-weight-bold" style="background-color:#004191;">
                                <i class="fas fa-plus" style="font-size: 20px;"></i>
                                <span>Добавить заявку</span>
                                <i class="ml-2 flaticon2-box-1" style="margin-top: 2px;"></i>
                            </a>
                        </li>
                        <li class="menu-item menu-item-submenu menu-item-rel ">
                            <a href="{{route('admin.overheads.create')}}"
                               class="menu-link btn btn-light-primary font-weight-bold" style="background-color:#004191;">
                                <i class="fas fa-plus" style="font-size: 20px;"></i>
                                <span>Добавить накладной</span>
                                <i class="ml-2 fas fa-address-card" style="margin-top: 2px;"></i>
                            </a>
                        </li>
                        <li class="menu-item menu-item-submenu menu-item-rel ">
                            <a href="#"
                               class="menu-link btn btn-light-primary font-weight-bold"
                               data=""
                               data-toggle="modal"
                               data-target="#importExcel"
                               style="background-color:#004191;">
                                <i class="fas fa-file-excel" style="font-size: 20px;"></i>
                                <span>Импорт</span>
                            </a>

                        </li>
                    @endif
                    @if($role_id == 5)
                        <li class="menu-item menu-item-submenu menu-item-rel ">
                            <a href="{{route('admin.overheads.create')}}"
                               class="menu-link btn btn-light-primary font-weight-bold" style="background-color:#004191;">
                                <i class="fas fa-plus" style="font-size: 20px;"></i>
                                <span>Добавить накладной</span>
                                <i class="ml-2 fas fa-address-card" style="margin-top: 2px;"></i>
                            </a>
                        </li>
                    @endif
                    <li class="menu-item menu-item-submenu menu-item-rel ">
                        <form action="{{route('admin.overheads.searchOverhead')}}" method="get" style="display:flex;">
                            <input class="form-control" type="text" name="search_overhead" id="search_overhead" placeholder="Введите номер накладного">
                            <input type="submit" class="btn btn-primary" value="Поиск" style="background-color:#004191;border-color:#004191;">
                        </form>
                    </li>
                </ul>
                <!--end::Header Nav-->
            </div>
            <!--end::Header Menu-->
        </div>

        <!--begin::Topbar-->
        <div class="topbar">
            <!--begin::Notifications-->
            <div class="dropdown">

                <!--begin::Toggle-->
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary">
                        <span class="svg-icon svg-icon-xl svg-icon-primary">
                            <i class="bell far fa-bell"></i>
                        </span>
                    </div>
                </div>
                <!--end::Toggle-->

                <!--begin::Dropdown-->
                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                    <form>
                        <!--begin::Header-->
                        <div class="d-flex flex-column pt-12 bg-dark-o-5 rounded-top">
                            <!--begin::Title-->
                            <h4 class="d-flex flex-center">
                                <span class="text-dark">Уведомления</span>
                                <span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2 counter-noti">0</span>
                            </h4>
                            <!--end::Title-->
                            <!--begin::Tabs-->
                            <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary mt-3 px-8"
                                role="tablist">
                            </ul>
                            <!--end::Tabs-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Content-->
                        <div class="tab-content">
                            <!--begin::Tabpane-->
                            <div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
                                    <!--begin::Nav-->
                                    <div class="navi navi-hover scroll mb-4" id="notifications_content" data-scroll="true"
                                        data-height="300" data-mobile-height="200">
                                            <!--begin::Item-->
                                            <a href="#" class="navi-item">
                                                <div class="navi-link">
                                                    <div class="navi-icon mr-2">
                                                        <i class="flaticon2-bell-4 text-success"></i>
                                                    </div>
                                                    <div class="navi-text">
                                                        <div class="font-weight-bold noti_text1">test</div>
                                                        <div class="text-muted noti_text2">test2</div>
                                                    </div>
                                                </div>
                                            </a>
                                            <!--end::Item-->
                                    </div>

                                    <!--end::Scroll-->
                                    <!--begin::Nav-->
                                    <!--<div class="d-flex flex-center text-center text-muted min-h-200px">
                                    <br></div>
                                    <!--end::Nav-->


                            </div>

                            <!--end::Tabpane-->
                        </div>

                        <!--end::Content-->
                    </form>
                </div>

                <!--end::Dropdown-->
            </div>

            <!--end::Notifications-->

{{--            <!--begin::Languages-->--}}
{{--            <div class="dropdown">--}}
{{--                <!--begin::Toggle-->--}}
{{--                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">--}}
{{--                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">--}}
{{--                        <i class="fas fa-user-circle"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!--end::Toggle-->--}}
{{--                <!--begin::Dropdown-->--}}
{{--                <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right" id="lang-change">--}}
{{--                    <!--begin::Nav-->--}}
{{--                    <ul class="navi navi-hover py-4"></ul>--}}
{{--                    <!--end::Nav-->--}}
{{--                </div>--}}
{{--                <!--end::Dropdown-->--}}
{{--            </div>--}}

            <!--end::Languages-->

            <!--begin::User-->
            <div class="dropdown">

                <!--begin::Toggle-->
                <div class="topbar-item" data-toggle="dropdown" data-offset="0px,0px">
                    <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2">
                        <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1"></span>
                        <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">
                            {{Auth::user()->name}}</span>
                        <div class="symbol symbol-30 mr-3">
                            <i class="fas fa-user-circle"></i>
                        </div>
                    </div>
                </div>

                <!--end::Toggle-->

                <!--begin::Dropdown-->
                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg p-0">
                    <!--begin::Header-->
                    <div class="d-flex align-items-center justify-content-between flex-wrap pl-8 pt-4 bg-dark-o-5 bgi-no-repeat rounded-top">
                        <div class="d-flex align-items-center mr-2">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30 mr-3"><i class="fas fa-user"></i></div>
                            <div class="text-dark m-0 flex-grow-1 mr-3 font-size-h5">{{Auth::user()->name}}</div>

                            <!--end::Text-->
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Nav-->
                    <div class="navi navi-spacer-x-0 pt-5">
                        <!--begin::Item-->
                        <a href="" class="navi-item px-8">
                            <div class="navi-link">
                                <div class="navi-icon mr-2">
                                    <i class="flaticon2-calendar-3 text-success"></i>
                                </div>
                                <div class="navi-text">
                                    {{Auth::user()->email}}
                                </div>
                            </div>
                        </a>

                        <!--end::Item-->

                        <!--begin::Footer-->
                        <div class="navi-separator mt-3"></div>
                        <div class="navi-footer px-8 py-5">
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <input type="submit" class="btn btn-light-primary font-weight-bold" value="Выйти"/>
                            </form>
                        </div>

                        <!--end::Footer-->
                    </div>

                    <!--end::Nav-->
                </div>

                <!--end::Dropdown-->
            </div>

            <!--end::User-->
        </div>

        <!--end::Topbar-->
    </div>

    <!--end::Container-->
</div>
@if(\Illuminate\Support\Facades\Session::has('successImport') && \Illuminate\Support\Facades\Session::get('successImport') == 1)
    <div class="alert alert-success">{{\Illuminate\Support\Facades\Session::get('messageImport')}}</div>
@elseif(\Illuminate\Support\Facades\Session::has('successImport') && \Illuminate\Support\Facades\Session::get('successImport') == 0)
    <div class="alert alert-danger">{{\Illuminate\Support\Facades\Session::get('messageImport')}}</div>
@endif
<!-- Modal -->
<div class="modal fade"
     id="importExcel" tabindex="-1"
     role="dialog"
     aria-labelledby="importExcelTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importExcelTitle">Импортировать с Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
{{--            <form action="#"--}}
{{--                  enctype="multipart/form-data"--}}
{{--                  method="post">--}}
{{--                <div class="modal-body">--}}
{{--                    @csrf--}}
{{--                    <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="file" name="excel_file" id="excel_file">--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>--}}
{{--                    <button type="button" class="btn btn-primary" id="importExcelBtn">Сохранить</button>--}}
{{--                </div>--}}
{{--            </form>--}}
            <form action="{{route('admin.overheads.import')}}"
                  enctype="multipart/form-data"
                  method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                    <div class="form-group">
                        <input type="file" name="excel_file" id="excel_file">
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
@push('admin-scripts2')
    <script>
        $('#importExcelBtn').click(function (e){
            e.preventDefault();
            let fd = new FormData();
            let files = $('#excel_file')[0].files;
            console.log("{{ csrf_token() }}");
            //return;
            // Check file selected or not
            if(files.length > 0 ){
                fd.append('excel_file',files[0]);
                fd.append('_token',"{{ csrf_token() }}");

                $.ajax({
                    url: "{{route('admin.overheads.import2')}}",
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response !== 0){
                            console.log(response);
                        }else{
                            alert('file not uploaded');
                        }
                    },
                });
            }else{
                alert("Please select a file.");
            }
        });
    </script>
@endpush
