<div class="dashbard-menu-avatar fl-wrap my_setting">
    <img src="{{asset('public/front/images/avatar/5.jpg')}}" alt="">
{{--    <i class="fal fa-user "></i>--}}
    <h4>Добро пожаловать, <span>{{Auth::user()->name}}</span></h4>
</div>
<a href="{{route('front.login.logout')}}" class="log-out-btn   tolt" data-microtip-position="bottom" data-tooltip="Log Out">
    <i class="far fa-power-off"></i></a>
