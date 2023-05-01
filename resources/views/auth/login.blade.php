@extends('layouts.auth')

@section('content')
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('https://postalservice.kz/public/assets/img/bg.jpg');">
                <div class="overflow-hidden text-center login-form p-7 position-relative">
                    <!--begin::Login Header-->
                    <div class="mb-5 d-flex flex-center">
                        <a href="#">
                            <img src="{{asset('public/assets/img/logo-white.png')}}" alt="" class="max-h-75px">
                        </a>
                    </div>
{{--                    {{dd(\Illuminate\Support\Facades\Hash::make('iitu1995'))}}--}}
                    <!--end::Login Header-->
                    <!--begin::Login Sign in form-->
                    <div class="login-signin">
                        <div class="mb-20">
                            <h3 style="color: white">Добро пожаловать в Postal Service </h3>
                            <div class="text-muted font-weight-bold">Авторизуйтесь в Ваш аккаунт.</div>
                        </div>
                        <form class="form" method="POST" role="form" action="{{route('login')}}">
                            @csrf
                            <div class="mb-5 form-group">
                                <input id="email" type="email" class="form-control h-auto form-control-solid py-4 px-8 " name="email" value="" required="" autofocus="" placeholder="Email">
                            </div>
                            <div class="mb-5 form-group">
                                <input id="password" type="password" class="form-control h-auto form-control-solid py-4 px-8 " name="password" required="" placeholder="Password">
                            </div>
                            <div class="flex-wrap form-group d-flex justify-content-between align-items-center">
                                <div class="checkbox-inline">
                                    <label for="remember" class="m-0 checkbox text-muted">
                                        <input type="checkbox" name="remember" id="remember">
                                        <span></span>Запомнить логин и пароль
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="py-4 mx-4 my-3 btn btn-primary font-weight-bold px-9">Вход</button>
                        </form>
                    </div>
                    <!--end::Login Sign in form-->

                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>
@endsection
