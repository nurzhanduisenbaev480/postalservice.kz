<header class="main-header">
    <!--  logo  -->
    <div class="logo-holder"><a href="{{route('front.index')}}"><img src="{{asset('public/front/images/logo.png')}}" alt=""></a></div>
    <!-- logo end  -->
    <!-- nav-button-wrap-->
    <div class="nav-button-wrap color-bg nvminit">
        <div class="nav-button">
            <span></span><span></span><span></span>
        </div>
    </div>
    <!-- nav-button-wrap end-->
    <!-- header-search button  -->
{{--    <div class="header-search-button">--}}
{{--        <i class="fal fa-search"></i>--}}
{{--        <span>Search...</span>--}}
{{--    </div>--}}
    <!-- header-search button end  -->
    <!--  add new  btn -->
    <div class="add-list_wrap">
        <a href="{{route('front.cabinet.index')}}" class="add-list color-bg"><i class="fal fa-plus"></i> <span>Добавить накладной</span></a>
    </div>
    <!--  add new  btn end -->
    <!--  header-opt_btn -->
{{--    <div class="header-opt_btn tolt" data-microtip-position="bottom" data-tooltip="Language / Currency">--}}
{{--        <span><i class="fal fa-globe"></i></span>--}}
{{--    </div>--}}
    <!--  header-opt_btn end -->
    <!--  cart-btn   -->
{{--    <div class="cart-btn  tolt show-header-modal" data-microtip-position="bottom" data-tooltip="Your Wishlist / Compare">--}}
{{--        <i class="fal fa-bell"></i>--}}
{{--        <span class="cart-btn_counter color-bg">5</span>--}}
{{--    </div>--}}
    <!--  cart-btn end -->
    <!--  login btn -->
    <div class="show-reg-form dasbdord-submenu-open"><img src="{{asset('public/front/images/avatar/5.jpg')}}" alt=""></div>
    <!--  login btn  end -->
    <!--  dashboard-submenu-->
    <div class="dashboard-submenu">
        <div class="dashboard-submenu-title fl-wrap"><span>{{Auth::user()->name}}</span></div>
        <ul>
            <li><a href="#"><i class="fal fa-chart-line"></i>Панель управления</a></li>
            <li><a href="{{route('front.cabinet.index')}}"> <i class="fal fa-file-plus"></i>Добавить накладной</a></li>
            <li><a href="{{route('front.cabinet.profile')}}"><i class="fal fa-user-edit"></i>Инфо</a></li>
        </ul>
        <a href="{{route('front.login.logout')}}" class="color-bg db_log-out"><i class="far fa-power-off"></i> Выйти</a>
    </div>
    <!--  dashboard-submenu  end -->
    <!--  navigation -->
    @include('inc.header_menu')
    <!-- navigation  end -->
    <!-- header-search-wrapper -->
    <div class="header-search-wrapper novis_search">
        <div class="header-serach-menu">
            <div class="custom-switcher fl-wrap">
                <div class="fieldset fl-wrap">
                    <input type="radio" name="duration-1" id="buy_sw" class="tariff-toggle" checked="">
                    <label for="buy_sw">Buy</label>
                    <input type="radio" name="duration-1" class="tariff-toggle" id="rent_sw">
                    <label for="rent_sw" class="lss_lb">Rent</label>
                    <span class="switch color-bg"></span>
                </div>
            </div>
        </div>
        <div class="custom-form">
            <form method="post" name="registerform">
                <label>Keywords </label>
                <input type="text" placeholder="Address , Street , State..." value="">
                <label>Categories</label>
                <select data-placeholder="Categories" class="chosen-select on-radius no-search-select" style="display: none;">
                    <option>All Categories</option>
                    <option>House</option>
                    <option>Apartment</option>
                    <option>Hotel</option>
                    <option>Villa</option>
                    <option>Office</option>
                </select><div class="nice-select chosen-select on-radius no-search-select" tabindex="0"><span class="current">All Categories</span><div class="nice-select-search-box"><input type="text" class="nice-select-search" placeholder="Search..."></div><ul class="list"><li data-value="All Categories" class="option selected">All Categories</li><li data-value="House" class="option">House</li><li data-value="Apartment" class="option">Apartment</li><li data-value="Hotel" class="option">Hotel</li><li data-value="Villa" class="option">Villa</li><li data-value="Office" class="option">Office</li></ul></div>
                <label style="margin-top:10px;">Price Range</label>
                <div class="price-rage-item fl-wrap">
                    <span class="irs js-irs-0"><span class="irs"><span class="irs-line" tabindex="0"><span class="irs-line-left"></span><span class="irs-line-mid"></span><span class="irs-line-right"></span></span><span class="irs-min">$100</span><span class="irs-max">$100 000</span><span class="irs-from" style="visibility: hidden;">0</span><span class="irs-to" style="visibility: hidden;">0</span><span class="irs-single">0</span></span><span class="irs-grid"></span><span class="irs-bar"></span><span class="irs-bar-edge"></span><span class="irs-shadow shadow-single"></span><span class="irs-slider single"></span></span><input type="text" class="price-range irs-hidden-input" data-min="100" data-max="100000" name="price-range1" data-step="1" value="1" data-prefix="$" tabindex="-1" readonly="">
                </div>
                <button onclick="location.href='listing.html'" type="button" class="btn float-btn color-bg"><i class="fal fa-search"></i> Search</button>
            </form>
        </div>
    </div>
</header>
