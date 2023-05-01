<div class="main-register-wrap modal">
    <div class="reg-overlay"></div>
    <div class="main-register-holder tabs-act">
        <div class="main-register-wrapper modal_main fl-wrap">
            <div class="main-register-header color-bg">
                <div class="main-register-logo fl-wrap">
                    <img src="{{asset('public/front/images/white-logo.png')}}" alt="">
                </div>
                <div class="main-register-bg">
                    <div class="mrb_pin"></div>
                    <div class="mrb_pin mrb_pin2"></div>
                </div>
                <div class="mrb_dec"></div>
                <div class="mrb_dec mrb_dec2"></div>
            </div>
            <div class="main-register">
                <div class="close-reg"><i class="fal fa-times"></i></div>
                <ul class="tabs-menu fl-wrap no-list-style">
                    
{{--                    <li><a href="#tab-2"><i class="fal fa-user-plus"></i> Register</a></li>--}}
                </ul>
                <!--tabs -->
                <div class="tabs-container">
                    <div class="tab">
                        <!--tab -->
                        <div id="tab-1" class="tab-content first-tab">
                            <div class="custom-form">
                                <form action="{{route('front.login.auth')}}" method="post" name="registerform">
                                    @csrf
                                    <label>Email  * <span class="dec-icon"><i class="fal fa-user"></i></span></label>
                                    <input name="email" type="text" placeholder="Your Name or Mail" onclick="this.select()" value="">
                                    <div class="pass-input-wrap fl-wrap">
                                        <label>Пароль  * <span class="dec-icon"><i class="fal fa-key"></i></span></label>
                                        <input name="password" placeholder="Your Password" type="password" autocomplete="off" onclick="this.select()" value="">
                                        <span class="eye"><i class="fal fa-eye"></i> </span>
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                    <button type="submit" class="log_btn color-bg"> Войти </button>
                                </form>
                            </div>
                        </div>
                        <!--tab end -->
                        <!--tab -->

                        <!--tab end -->
                    </div>
                    <!--tabs end -->
                    
                </div>
            </div>
        </div>
    </div>
</div>
