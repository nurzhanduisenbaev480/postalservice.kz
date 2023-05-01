@extends('layouts.front_cabinet')
@section('content')
    <!-- dashbard-menu-wrap -->
    <div class="dashbard-menu-overlay"></div>
    @include('inc.front_cabinet_nav')
    <!-- dashbard-menu-wrap end  -->
    <!-- content -->
    <div class="dashboard-content">
        <div class="dashboard-menu-btn color-bg"><span><i class="fas fa-bars"></i></span>Панель управления</div>
        <div class="container dasboard-container">
            <!-- dashboard-title -->
            <div class="dashboard-title fl-wrap">
                <div class="dashboard-title-item"><span>Мой профиль</span></div>
                <div class="dashbard-menu-header">
                    @include('inc.simple_user')
                </div>
                <!--Tariff Plan menu-->
                <div class="tfp-det-container">

                </div>
                <!--Tariff Plan menu end-->
            </div>
            <!-- dashboard-title end -->
            <div class="dasboard-wrapper fl-wrap no-pag">
                <div class="dasboard-listing-box fl-wrap">
                    <div class="dasboard-opt sl-opt fl-wrap">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="dasboard-widget-title fl-wrap">
                                    <h5><i class="fas fa-user-circle"></i></h5>
                                </div>
                                <div class="dasboard-widget-box nopad-dash-widget-box fl-wrap">
                                    <div class="edit-profile-photo">
                                        <img src="{{asset('public/front/images/avatar/3.jpg')}}" class="respimg" alt="">
                                        <div class="change-photo-btn">
                                            <div class="photoUpload">
{{--                                                <span>  Upload New Photo</span>--}}
                                                <input type="file" class="upload">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-wrap bg-parallax-wrap-gradien">
                                        <div class="bg" data-bg="{{asset('public/front/images/avatar/3.jpg')}}" style="background-image: url({{asset('public/front/images/avatar/3.jpg')}});"></div>
                                    </div>
                                    <div class="change-photo-btn cpb-2  ">
                                        <div class="photoUpload color-bg">
{{--                                            <span> <i class="far fa-camera"></i> Change Cover </span>--}}
                                            <input type="file" class="upload">
                                        </div>
                                    </div>
                                </div>
                                <div class="dasboard-widget-title fl-wrap">
                                    <h5><i class="fas fa-key"></i>Персональные данные</h5>
                                </div>
                                <div class="dasboard-widget-box fl-wrap">
                                    <div class="custom-form">
                                        <label for="from_name">ФИО<span class="dec-icon"><i class="far fa-user"></i></span></label>
                                        <input name="from_name" id="from_name" type="text" placeholder="" value="{{$user->name}}">
                                        <label for="email">Email <span class="dec-icon"><i class="far fa-envelope"></i></span></label>
                                        <input type="text" name="email" id="email" placeholder="" value="{{$user->email}}">
                                        <label for="from_phone">Телефон<span class="dec-icon"><i class="far fa-phone"></i> </span></label>
                                        <input id="from_phone" type="text" placeholder="+7(123)987654" value="{{$user_info->phone}}">
                                        <label for="from_address">Адрес <span class="dec-icon"><i class="fas fa-map-marker"></i> </span></label>
                                        <input id="from_address" type="text" placeholder="" value="{{$user_info->address}}">
{{--                                        <label for="from_company">Компания <span class="dec-icon"><i class="far fa-house-flood"></i> </span></label>--}}
{{--                                        <input id="from_company" type="text" placeholder="" value="">--}}

                                        <button class="btn    color-bg  float-btn">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="limit-box fl-wrap"></div>
        <!-- dashboard-footer -->

        <!-- dashboard-footer end -->
    </div>
    <!-- content end -->
    <div class="dashbard-bg gray-bg"></div>

@endsection


