<style>
    .journals li div{
        text-align: left;
    }
</style>
<header class="main-header">
    <!--  logo  -->
    <div class="logo-holder"><a href="{{route('front.cabinet.index')}}">
            <img src="{{asset('public/front/images/logo.png')}}" alt=""></a>
    </div>
    <!-- logo end  -->
    <!-- nav-button-wrap-->
    <div class="nav-button-wrap color-bg nvminit">
        <div class="nav-button">
            <span></span><span></span><span></span>
        </div>
    </div>
    <!-- nav-button-wrap end-->
    <!-- header-search button  -->
	<div class="header-search-button">
		<i class="fal fa-search"></i>
		<span>Поиск...</span>
	</div>
    <!-- header-search button end  -->
    <!--  add new  btn -->
    <div class="add-list_wrap">
        <a href="{{route('front.add.overhead')}}" class="add-list color-bg"><i class="fal fa-plus"></i> <span>Добавить накладную</span></a>
    </div>
    <!--  add new  btn end -->
    <!--  header-opt_btn -->
    <!--  login btn -->
    @if(Auth::check())
        <div class="show-reg-form dasbdord-submenu-open"><img src="{{asset('public/front/images/avatar/5.jpg')}}" alt=""></div>
        <!--  dashboard-submenu-->
        <div class="dashboard-submenu">
            <div class="dashboard-submenu-title fl-wrap"><span>{{Auth::user()->name}}</span></div>
            <ul>
                <li><a href="#"><i class="fal fa-chart-line"></i>Панель управления</a></li>
                <li><a href="{{route('front.cabinet.index')}}"> <i class="fal fa-file-plus"></i>Добавить накладную</a></li>
                <li><a href="{{route('front.cabinet.profile')}}"><i class="fal fa-user-edit"></i>Инфо</a></li>
            </ul>
            <a href="{{route('front.login.logout')}}" class="color-bg db_log-out"><i class="far fa-power-off"></i> Выйти</a>
        </div>
        <!--  dashboard-submenu  end -->
    @else
        <div class="show-reg-form modal-open"><i class="fas fa-user"></i><span>Войти в кабинет</span></div>
    @endif
    <!--  login btn  end -->
    <!--  navigation -->
    @include('inc.header_menu')
    <!-- navigation  end -->
    <!-- header-search-wrapper -->
    <div class="header-search-wrapper novis_search">
        <div class="header-serach-menu">
            <div class="custom-switcher fl-wrap">
                <div class="fieldset fl-wrap">

                </div>
            </div>
        </div>
        <div class="custom-form">
            <form method="post" name="registerform" id="searchForm">
                <label>Введите номер накладной </label>
                <input type="text" id="overhead_code" placeholder="77777" value="">
                <button onclick="searchOverhead()" type="button" class="btn float-btn color-bg"><i class="fal fa-search"></i> Поиск</button>
            </form>
			<div class="modal" id="exampleModalLong" tabindex="-1"
         role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">
						Номер накладной <span id="overhead_number" style="color:black;border-bottom:1px dashed black;"></span>
					</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4 col-md-6">
                            <div class="form-group">
								<fieldset>
								<legend>Отправитель</legend>
                                <ul class="overhead_card">
                                    <li>
                                        <div class="overhead_key">ФИО:</div>
                                        <div class="fromName">ФИО</div>
                                    </li>
                                    <li>
                                        <div class="overhead_key">Компания:</div>
                                        <div class="fromCompany">Компания</div>
                                    </li>
                                    <li>
                                        <div class="overhead_key">Город:</div>
                                        <div class="fromCity">Город</div>
                                    </li>
                                    <li>
                                        <div class="overhead_key">Адрес:</div>
                                        <div class="fromAddress">Адрес</div>
                                    </li>
                                    <li>
                                        <div class="overhead_key">Телефон:</div>
                                        <div class="fromPhone">Телефон</div>
                                    </li>
                                </ul>
								</fieldset>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-6">
                            <div class="form-group">
								<fieldset>
                                <legend>Получатель</legend>
                                <ul class="overhead_card">
                                    <li>
                                        <div class="overhead_key">ФИО:</div>
                                        <div class="toName">ФИО</div>
                                    </li>
                                    <li>
                                        <div class="overhead_key">Компания:</div>
                                        <div class="toCompany">Компания</div>
                                    </li>
                                    <li>
                                        <div class="overhead_key">Город:</div>
                                        <div class="toCity">Город</div>
                                    </li>
                                    <li>
                                        <div class="overhead_key">Адрес:</div>
                                        <div class="toAddress">Адрес</div>
                                    </li>
                                    <li>
                                        <div class="overhead_key">Телефон:</div>
                                        <div class="toPhone">Телефон</div>
                                    </li>
                                </ul>
							</fieldset>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-4 col-md-6">
                            <div class="form-group">
								<fieldset>
                                <legend>Детали</legend>
                                <ul class="overhead_card">
                                    <li>
                                        <div class="overhead_key">Тип отправки:</div>
                                        <div class="type">----------</div>
                                    </li>
                                    <li>
                                        <div class="overhead_key">Скорость:</div>
                                        <div class="speed">----------</div>
                                    </li>
                                    <li>
                                        <div class="overhead_key">Оплата:</div>
                                        <div class="payment">----------</div>
                                    </li>
                                    <li>
                                        <div class="overhead_key">Способ оплаты:</div>
                                        <div class="payment_type">----------</div>
                                    </li>
                                </ul>
								</fieldset>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-6">
                            <div class="form-group">
								<fieldset>
                                <legend>Дополнительно</legend>
                                <ul class="overhead_card">
                                    <li>
                                        <div class="overhead_key">Статус:</div>
                                        <div class="status_id">Новый</div>
                                    </li>
                                    <li>
                                        <div class="overhead_key">Дата забора:</div>
                                        <div class="date_s">2000-01-01</div>
                                    </li>
                                    <li>
                                        <div class="overhead_key">Дата доставки:</div>
                                        <div class="date_e2">2000-01-01</div>
                                    </li>
                                    <li>
                                        <div class="overhead_key">Кол-во мест:</div>
                                        <div class="count">1</div>
                                    </li>
                                </ul>
							    </fieldset>
                            </div>
                        </div>
                    </div>
					<div class="row mt-4">
                        <div class="col-sm-4 col-md-6">
                            <div class="form-group">
								<fieldset>
                                <legend>История</legend>
                                    <ul class="journals"></ul>
							    </fieldset>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-6">
                            <div class="form-group">
                                <fieldset>
                                    <legend>Примечание</legend>
                                    <div class="description" style="text-align: left;padding: 0 5px 5px 5px;
    border: 1px solid rgba(0,0,0,0.6);color: #3270FC;">---</div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-6 col-md-6">
                            <div class="overhead_photo_index"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
<!--  					<button type="button" class="btn btn-success" id="printBtn">Распечатать</button> -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeBtn">Закрыть</button>
<!--                    <button type="button" class="btn btn-primary" id="saveBtn">Сохранить</button>-->
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
    <!-- header-search-wrapper end  -->
    <!-- wishlist-wrap-->

    <!--wishlist-wrap end -->

</header>
