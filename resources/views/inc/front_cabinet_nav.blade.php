<div class="dashbard-menu-wrap">
    <div class="dashbard-menu-close"><i class="fal fa-times"></i></div>
    <div class="dashbard-menu-container">
        <!-- user-profile-menu-->
        <div class="user-profile-menu">
            <h3>Главная</h3>
            <ul class="no-list-style">
                <li><a href="#"><i class="fal fa-chart-line"></i>Панель управления</a></li>
                <li><a href="{{route('front.cabinet.profile')}}"><i class="fal fa-user-edit"></i>Профиль</a></li>
            </ul>
        </div>
        <!-- user-profile-menu end-->
        <!-- user-profile-menu-->
        <div class="user-profile-menu">
            <h3>Накладной</h3>
            <ul class="no-list-style">
                <li><a href="{{route('front.cabinet.overhead.list')}}"><i class="fal fa-th-list"></i> Мои накладные</a></li>
{{--                <li><a href="dashboard-bookings.html"> <i class="fal fa-calendar-check"></i> Bookings <span>3</span></a></li>--}}
{{--                <li><a href="dashboard-review.html"><i class="fal fa-comments-alt"></i> Reviews <span>2</span> </a></li>--}}
                <li><a href="{{route('front.cabinet.index')}}" class="user-profile-act">
                        <i class="fal fa-file-plus"></i> Добавить накладной</a>
                </li>
            </ul>
        </div>
        <!-- user-profile-menu end-->
    </div>

</div>
