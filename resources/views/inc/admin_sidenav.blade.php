@php
    $user_id = \Illuminate\Support\Facades\Auth::user()->id;
    $role = \Illuminate\Support\Facades\Auth::user()->getRole($user_id);
    $role_id = $role->first()->role_id;

    @endphp
<style>
    .menu-item:hover .menu-bullet{
        color: #F64E60 !important;
    }
    .menu-item:hover .menu-text{
        color: #FFFFFF !important;
    }
    .brand{
        background-color: #FFFFFF;
    }
</style>
<!--begin::Aside-->
<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">

    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand">

        <!--begin::Logo-->
        <a href="{{ route('admin') }}" class="brand-log menu-toggleo">
            <img src="{{asset('public/front/images/logo.png')}}" style="height: 60px; width:180px;"  alt="">
        </a>

        <!--end::Logo-->
    </div>

    <!--end::Brand-->

    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="my-4 aside-menu" data-menu-vertical="1" data-menu-scroll="1"
            data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">
                <!--
				<li class="menu-item menu-item-active menu-item-open" aria-haspopup="true">
                    <a href="{{ route('admin') }}" class="menu-link menu-toggle">
                        <i class="menu-icon flaticon-home"></i>
                        <span class="menu-text">Панель управления</span>
                    </a>
                </li>
				-->
				@if($role_id == 2)
				<li class="menu-item" aria-haspopup="true">
                    <a href="{{ route('admin') }}" class="menu-link menu-toggle">
                        <i class="menu-icon fas fa-address-card"></i>
                        <span class="menu-text">Накладные</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <ul class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <a href="{{route('admin.overheads.create')}}" class="menu-link">
                                    <i class="menu-bullet menu-icon flaticon2-plus" style="font-size: 10px;"></i>
                                    <span class="menu-text">Добавить накладного</span>
                                </a>
                            </li>

                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <a href="{{route('admin.overheads.index')}}" class="menu-link">
                                    <i class="menu-bullet menu-icon fas fa-list" style="font-size: 10px;"></i>
                                    <span class="menu-text">Все накладные</span>
                                </a>
                            </li>
							<li class="menu-item menu-item-parent" aria-haspopup="true">
                                <a href="{{route('admin.overheads.archive')}}" class="menu-link">
                                    <i class="menu-bullet menu-icon fas fa-list" style="font-size: 10px;"></i>
                                    <span class="menu-text">Архив</span>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <i class="menu-icon fas fa-box-open"></i>
                        <span class="menu-text">Мои Заявки</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <ul class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
								<a href="{{route('admin.courier.index')}}" class="menu-link">
									<span class="menu-text">Мои заявки</span>
								</a>
							</li>
                        </ul>
                    </ul>
                </li>
				@endif
				@if($role_id == 7)
					<li class="menu-item" aria-haspopup="true">
						<a href="{{ route('admin.region.index') }}" class="menu-link menu-toggle">
							<i class="menu-icon flaticon-home"></i>
							<span class="menu-text">Главная</span>
							<i class="menu-arrow"></i>
						</a>
					</li>
				@endif

				@if($role_id == 1 || $role_id == 3)
					<li class="menu-item menu-item-active menu-item-open" aria-haspopup="true">
						<a href="{{ route('admin') }}" class="menu-link menu-toggle">
							<i class="menu-icon flaticon-home"></i>
							<span class="menu-text">Панель управления</span>
						</a>
					</li>
					<li class="menu-section">
						<h4 class="menu-text">Главная</h4>
						<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
					</li>
					<li class="menu-item" aria-haspopup="true">
						<a href="{{ route('admin.client.index') }}" class="menu-link menu-toggle">
							<i class="menu-icon fas fa-users"></i>
							<span class="menu-text">Клиенты</span>
							<i class="menu-arrow"></i>
						</a>
					</li>
				<li class="menu-item" aria-haspopup="true">
                    <a href="{{ route('admin') }}" class="menu-link menu-toggle">
                        <i class="menu-icon fas fa-address-card"></i>
                        <span class="menu-text">Накладные</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <ul class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <a href="{{route('admin.overheads.create')}}" class="menu-link">
                                    <i class="menu-bullet menu-icon flaticon2-plus" style="font-size: 10px;"></i>
                                    <span class="menu-text">Добавить накладного</span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <a href="{{route('admin.overheads.index')}}" class="menu-link">
                                    <i class="menu-bullet menu-icon fas fa-list" style="font-size: 10px;"></i>
                                    <span class="menu-text">Все накладные</span>
                                </a>
                            </li>
							<li class="menu-item menu-item-parent" aria-haspopup="true">
                                <a href="{{route('admin.overheads.archive')}}" class="menu-link">
                                    <i class="menu-bullet menu-icon fas fa-list" style="font-size: 10px;"></i>
                                    <span class="menu-text">Архив</span>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </li>
				<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <i class="menu-icon fas fa-box-open"></i>
                        <span class="menu-text">Заявки</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <ul class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <a href="{{route('admin.orders.create')}}" class="menu-link">
                                    <i class="menu-bullet menu-icon flaticon2-plus" style="font-size: 10px;"></i>
                                    <span class="menu-text">Добавить заявку</span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <a href="{{route('admin.roads.order')}}" class="menu-link">
                                    <span class="menu-text">Назначить курьеров</span>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </li>
                <li class="menu-item" aria-haspopup="true">
                    <a href="{{ route('admin') }}" class="menu-link menu-toggle">
                        <i class="menu-icon fas fa-shipping-fast"></i>
                        <span class="menu-text">ОГД</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <ul class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <a href="{{route('admin.transport.index')}}" class="menu-link">
                                    <span class="menu-text">Транспорты</span>
                                </a>
                            </li>

                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <a href="{{route('admin.roads.check')}}" class="menu-link">
                                    <span class="menu-text">Принять заявок</span>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </li>

                <li class="menu-item" aria-haspopup="true">
                    <a href="{{ route('admin') }}" class="menu-link menu-toggle">
                        <i class="menu-icon fas fa-store"></i>
                        <span class="menu-text">Склад</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <ul class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <a href="{{route('admin.store.registry2')}}" class="menu-link">
                                    <span class="menu-text">Создать сборку</span>
                                </a>
                            </li>
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <a href="{{route('admin.store.registryList')}}" class="menu-link">
                                    <span class="menu-text">Список реестров</span>
                                </a>
                            </li>
							<li class="menu-item menu-item-parent" aria-haspopup="true">
                                <a href="{{route('admin.store.archive')}}" class="menu-link">
                                    <span class="menu-text">Архив реестров</span>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </li>

                <li class="menu-item" aria-haspopup="true">
                    <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon fas fa-address-card"></i>
                        <span class="menu-text">Сводка</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <ul class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <a href="{{route('admin.store.summary')}}" class="menu-link">
                                    <span class="menu-text">Список сводок</span>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </li>
				<li class="menu-section">
                        <h4 class="menu-text">Администрация</h4>
                        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                        <a href="#" class="menu-link menu-toggle">
                            <i class="menu-icon fas fa-users"></i>
                            <span class="menu-text">Пользователи</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <ul class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item menu-item-parent" aria-haspopup="true">
                                    <a href="{{route('admin.users.employee.index')}}" class="menu-link">
                                        <span class="menu-text">Все сотрудники</span>
                                    </a>
                                </li>
                                <li class="menu-item menu-item-parent" aria-haspopup="true">
                                    <a href="{{route('admin.users.employee.create')}}" class="menu-link">
                                        <span class="menu-text">Добавить сотрудника</span>
                                    </a>
                                </li>
                                <li class="menu-item menu-item-parent" aria-haspopup="true">
                                    <a href="{{route('admin.users.client.index')}}" class="menu-link">
                                        <span class="menu-text">Все клиенты</span>
                                    </a>
                                </li>
                                <li class="menu-item menu-item-parent" aria-haspopup="true">
                                    <a href="{{route('admin.users.client.create')}}" class="menu-link">
                                        <span class="menu-text">Добавить клиента</span>
                                    </a>
                                </li>
                            </ul>
                        </ul>
                    </li>
				@endif
                @if($role_id == 7)
				<li class="menu-item" aria-haspopup="true">
                    <a href="{{ route('admin') }}" class="menu-link menu-toggle">
                        <i class="menu-icon fas fa-address-card"></i>
                        <span class="menu-text">Накладные</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <ul class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <a href="{{route('admin.overheads.create')}}" class="menu-link">
                                    <i class="menu-bullet menu-icon flaticon2-plus" style="font-size: 10px;"></i>
                                    <span class="menu-text">Добавить накладного</span>
                                </a>
                            </li>

                        </ul>
                    </ul>
                </li>

				@endif
            </ul>

            <!--end::Menu Nav-->
        </div>

        <!--end::Menu Container-->
    </div>

    <!--end::Aside Menu-->
</div>
<!--end::Aside-->
@section('admin-script')
    <script>
        $('.menu-item').click(function (el){

            let subMenu = $(el).find('.aside-menu .menu-nav .menu-inner, .aside-menu .menu-nav .menu-submenu').first();
            let menuItem = $(subMenu).find('.aside-menu .menu-nav .menu-item .menu-submenu .menu-item-parent').first();
            subMenu.css('display', 'block');
            menuItem.css('display', 'block');
        });
    </script>
@endsection
