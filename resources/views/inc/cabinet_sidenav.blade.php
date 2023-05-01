<style>
    .menu-item:hover .menu-bullet{
        color: #F64E60 !important;
    }
    .menu-item:hover .menu-text{
        color: #FFFFFF !important;
    }
</style>
<!--begin::Aside-->
<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">

    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand">

        <!--begin::Logo-->
        <a href="{{ route('cabinet') }}" class="brand-log menu-toggleo">
            <img src="{{asset('public/assets/img/logoabbas.png')}}" style="height: 60px;" alt="">
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
                <li class="menu-item menu-item-active menu-item-open" aria-haspopup="true">
                    <a href="{{ route('cabinet') }}" class="menu-link menu-toggle">
                        <i class="menu-icon flaticon-home"></i>
                        <span class="menu-text">Панель управления</span>
                    </a>
                </li>
                <li class="menu-section">
                    <h4 class="menu-text">Главная</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>

            </ul>
{{--
menu-item-active menu-item-open
menu-item-active menu-item-open
menu-item-active menu-item-open
menu-item-active menu-item-open
menu-item-active menu-item-open
menu-item-active menu-item-open
menu-item-active menu-item-open
--}}
            <!--end::Menu Nav-->
        </div>

        <!--end::Menu Container-->
    </div>

    <!--end::Aside Menu-->
</div>
<!--end::Aside-->
@section('cabinet-script')
    <script>
        $('.menu-item').click(function (el){

            let subMenu = $(el).find('.aside-menu .menu-nav .menu-inner, .aside-menu .menu-nav .menu-submenu').first();
            let menuItem = $(subMenu).find('.aside-menu .menu-nav .menu-item .menu-submenu .menu-item-parent').first();
            subMenu.css('display', 'block');
            menuItem.css('display', 'block');
        });
    </script>
@endsection
