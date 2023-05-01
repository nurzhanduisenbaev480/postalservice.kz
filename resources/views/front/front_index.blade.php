@extends('layouts.front')
@section('content')
<!-- content -->
<div class="content">
    <!--  section  -->
    <section class="hero-section hero-section_dec" data-scrollax-parent="true">
        <div class="bg-wrap">
           <div class="bg par-elem " data-bg="{{asset('public/front/images/bg/bg.png')}}" data-scrollax="properties: { translateY: '30%' }" style="background-image: url(&quot; https://postalservice.kz/public/front/images/bg/bg.png&quot;); transform: translateZ(0px) translateY(-4.66667%);"></div>
        </div>
        <div class="overlay"></div>
        <div class="container">
            <div class="hero-title hero-title_small">
                <h4>Самая быстрая, безопасная служба доставки в Казахстане!</h4>
                <h2>Доставим ваш груз от двери <br>
                    до двери точно в срок 
                </h2>
            </div>
            <div class="main-search-input-wrap">
                <div class="main-search-input fl-wrap">
				</div>
			</div>
            <div class="scroll-down-wrap">
                <div class="mousey">
                    <div class="scroller"></div>
                </div>
                <span>Прокрутите вниз, чтобы рассчитать стоимость доставки</span>
            </div>
        </div>
    </section>
    <!--  section  end-->
    <!-- breadcrumbs-->
    <div class="breadcrumbs fw-breadcrumbs sp-brd fl-wrap">
        <div class="container">
            <div class="share-holder hid-share">
                <a href="#" class="share-btn showshare sfcs">  <i class="fas fa-share-alt"></i>  Поделится   </a>
                <div class="share-container  isShare">
					
				</div>
            </div>
        </div>
    </div>
    <!-- breadcrumbs end -->
    <!-- section -->
	<section>
		<div class="container">
			<div class="about-wrap">
				<div class="row mb-3">
					<div class="col-md-12">
						<h1 style="font-weight: bold;
    font-size: 24px;color:#3270FC;">РАСЧИТАЙТЕ СТОИМОСТЬ</h1>
					</div>
				</div>
				<form id="calculator-form" class="custom-form" style="margin-top:10px;">
                <div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="from"><span>*</span>Пункт от
									<span class="dec-icon"><i class="far fa-house-flood"></i></span>
								</label>
								<input class="form-control" type="text" name="from" id="from" placeholder="Алматы" readonly="">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="to"><span>*</span>Пункт назначения</label>
								<select class="form-control chosen-select-my" name="to" id="to">
									<optgroup label="1-ая Зона">
										<option value="0">Нур-Султан</option>
										<option value="1">Караганда</option>
										<option value="2">Петропавловск</option>
										<option value="3">Павлодар</option>
										<option value="4">Костанай</option>
										<option value="5">Кокшетау</option>
										<option value="6">Усть-Каменегорск</option>
										<option value="7">Семей</option>
										<option value="8">Кызылорда</option>
										<option value="9">Шымкент</option>
										<option value="10">Тараз</option>
										<option value="11">Атырау</option>
										<option value="12">Актау</option>
										<option value="13">Актобе</option>
										<option value="14">Уральск</option>
										<option value="15">Талдыкорган</option>
									</optgroup>
									<optgroup label="2-ая Зона">
										<option value="16">Аксай</option>
										<option value="17">Балхаш</option>
										<option value="18">Жанаозен</option>
										<option value="19">Екибастуз</option>
										<option value="20">Аксу</option>
										<option value="21">Риддер</option>
										<option value="22">Рудный</option>
										<option value="23">Жезказган</option>
										<option value="24">Сатбаев</option>
										<option value="25">Темиртау</option>
										<option value="26">Туркестан</option>
										<option value="27">Талгар</option>
										<option value="28">Каскелен</option>
									</optgroup>
									<optgroup label="3-я зона">
										<option value="99">Другое</option>
									</optgroup>
									<optgroup label="0-ая зона">
										<option value="100">Алматы</option>
									</optgroup>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group speeder" style="display: flex;flex-direction: column;">
								<label>Срочность</label>
								<div class="form-check form-check-inline">
									<h5 style="width: 30%;">Экспресс</h5>
									<div class="onoffswitch" style="width: 70%;">
										<input type="radio" name="type" class="onoffswitch-checkbox" id="express" checked="">
										<label class="onoffswitch-label" for="express">
											<span class="onoffswitch-inner"></span>
											<span class="onoffswitch-switch"></span>
										</label>
									</div>
								</div>
								<div class="form-check form-check-inline">
									<h5 style="width: 30%;">Стандарт</h5>
									<div class="onoffswitch" style="width: 70%;">
										<input type="radio" name="type" class="onoffswitch-checkbox" id="standard" checked="">
										<label class="onoffswitch-label" for="standard">
											<span class="onoffswitch-inner"></span>
											<span class="onoffswitch-switch"></span>
										</label>
									</div>
							
								</div>
								
							</div>
						</div>
						
					</div>
					<div class="row">
						
						<div class="col-md-6">
							<div class="form-group">
								
								<label for="mass">Вес(кг)
								<span class="dec-icon"></span>
								</label>
								<input class="form-control" type="text" name="mass" id="mass">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="sum3">Результат</label>
								<input class="form-control" type="text" name="sum3" id="sum3" readonly="">
							</div>
						</div>
					</div>
				
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<button type="reset" class="btn color-bg float-btn" id="reset-btn" style="margin-right: 5px;">Сброс</button>
								<button type="button" class="btn color-bg float-btn" id="evaluate-btn">Расчет</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
    <!-- section end-->
    <!-- section -->
    <section>
        <div class="container">
            <!--about-wrap -->
            <div class="about-wrap">
                <div class="row">
                    <div class="col-md-5">
                        <div class="about-title ab-hero fl-wrap">
                            <h2>МЫ ПРЕДЛАГАЕМ ЛУЧШИЙ СЕРВИС ДЛЯ НАШИХ КЛИЕНТОВ </h2>
                            <h4></h4>
                        </div>
                        <div class="services-opions fl-wrap">
                            <ul>
                                <li>
                                    <i class="fal fa-headset"></i>
                                    <h4>24/7 ПОДДЕРЖКА  </h4>
                                    <p>Экспедиторская поддержка на всех <br>этапах доставки груза</p>
                                </li>
                                <li>
                                    <i class="fal fa-users-cog"></i>
                                    <h4>ОТ ДВЕРИ ДО ДВЕРИ</h4>
                                    <p>Позаботьтесь о своем адресате и закажите перевозку с доставкой до двери. </p>
                                </li>
                                <li>
                                    <i class="fal fa-phone-laptop"></i>
                                    <h4>СВОЕВРЕМЕННАЯ ДОСТАВКА</h4>
                                    <p>Доставим вовремя, бережно, экономно по всему Казахстану</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-6">
                        <div class="about-img fl-wrap">
                            <img src="{{asset('public/front/images/all/50.jpg')}}" class="respimg" alt="">
                           
                        </div>
                    </div>
                </div>
            </div>
            <!-- about-wrap end  -->
        </div>
    </section>
    <!-- section end-->
    <!-- section  -->
	
	
	
	
	
	
	<section class="hidden-section no-padding-section">
		<div class="half-carousel-wrap">
			<div class="half-carousel-title color-bg">
				<div class="half-carousel-title-item fl-wrap">
					<h2>Мы на 100% уверены в безопасности вашего груза</h2>
					<h5>Заключая с нами договор на оказание логистических услуг, 
						Вы получаете возможность сосредоточиться на своих главных задачах и стратегических целях.</h5>
				</div>
				<div class="pwh_bg"></div>
			</div>
			<div class="half-carousel-conatiner">
				<div class="half-carousel fl-wrap full-height">
					<!--slick-item -->
					<div class="slick-item">
						<div class="half-carousel-item fl-wrap">
							<div class="bg-wrap bg-parallax-wrap-gradien">
								<div class="bg" data-bg="{{asset('public/front/images/bg/long/1.jpg')}}"></div>
							</div>
							<div class="half-carousel-content">
								<div class="hc-counter color-bg"></div>
								<h3><a href="">
									24/7 онлайн-слежение с системой Logis</a></h3>
								<p>Для удобства наших клиентов и безопасности перевозки грузов, все перемещения отслеживаются специальной транспортной программой. Так Вы будете отслеживать маршрут груза и знать даты его прибытия.</p>
								<br>
								<br>
								<br>
							</div>
						</div>
					</div>
					<!--slick-item end -->
					<!--slick-item -->
					<div class="slick-item">
						<div class="half-carousel-item fl-wrap">
							<div class="bg-wrap bg-parallax-wrap-gradien">
								<div class="bg" data-bg="{{asset('public/front/images/bg/long/2.jpg')}}"></div>
							</div>
							<div class="half-carousel-content">
								<div class="hc-counter color-bg"></div>
								<h3><a href="">ГАРАНТИЯ ПО СРОКАМ ДОСТАВКИ</a></h3>
								<p>Наличие собственных представителей в 19 областных регионах Казахстана позволяет нам организовать не только доставки в крупные центры, но и в областные города и населенные пункты. Компания осуществляет доставку корреспонденции, посылок и грузов внутри страны и за её пределами по принципу "от двери до двери". </p>
							</div>
						</div>
					</div>
					<!--slick-item end -->									
					<!--slick-item -->
					<div class="slick-item">
						<div class="half-carousel-item fl-wrap">
							<div class="bg-wrap bg-parallax-wrap-gradien">
								<div class="bg" data-bg="{{asset('public/front/images/bg/long/3.jpg')}}"></div>
							</div>
							<div class="half-carousel-content">
								<div class="hc-counter color-bg"></div>
								<h3><a href="">Сохранность</a></h3>
								<p>
									Мы обеспечиваем высокий уровень оперативности осуществления доставки, благодаря чему грузы будут доставлены строго в назначенное время. Кроме того, мы работаем также с грузами, которые требуют особого режима содержания, что позволяет существенно расширить возможности осуществления транспортировки.
								</p>
							</div>
						</div>
					</div>
					<!--slick-item end -->
					<!--slick-item
									<div class="slick-item">
										<div class="half-carousel-item fl-wrap">
											<div class="bg-wrap bg-parallax-wrap-gradien">
												<div class="bg" data-bg="{{asset('public/front/images/bg/long/4.jpg')}}"></div>
											</div>
											<div class="half-carousel-content">
												<div class="hc-counter color-bg">51 Properties</div>
												<h3><a href="listing.html">Elite Houses in Dubai</a></h3>
												<p>Constant care and attention to the patients makes good record</p>
											</div>
										</div>
									</div>
									slick-item end -->									
				</div>
			</div>
		</div>
	</section>
    <!--section end-->
    <!-- section -->
    <section>
        <div class="container">
            <div class="main-facts fl-wrap">
                <!-- inline-facts  -->
                <div class="inline-facts-wrap my-facts-wrap">
                    <div class="inline-facts">
                        <div class="milestone-counter">
							<img src="{{asset('public/front/images/icons/24hour.png')}}">
                        </div>
                        <h6>Вы выбираете тип услуги на сайте и оставляете заявку</h6>
                    </div>
                </div>
                <!-- inline-facts end -->
                <!-- inline-facts  -->
                <div class="inline-facts-wrap my-facts-wrap">
                    <div class="inline-facts">
                        <div class="milestone-counter">
                            <img src="{{asset('public/front/images/icons/customerservice.png')}}">
                        </div>
                        <h6>Менеджер свяжется с Вами для уточнения деталей перевозки</h6>
                    </div>
                </div>
                <!-- inline-facts end -->
                <!-- inline-facts  -->
                <div class="inline-facts-wrap my-facts-wrap">
                    <div class="inline-facts">
                        <div class="milestone-counter">
                            <img src="{{asset('public/front/images/icons/checklist.png')}}">
                        </div>
                        <h6>Мы производим расчет стоимости и выставляем коммерческое предложение</h6>
                    </div>
                </div>
                <!-- inline-facts end -->
                <!-- inline-facts  -->
                <div class="inline-facts-wrap my-facts-wrap">
                    <div class="inline-facts">
                        <div class="milestone-counter">
                            <img src="{{asset('public/front/images/icons/dimension.png')}}">
                        </div>
                        <h6>Заключаем юридический договор с условиями поставки груза</h6>
                    </div>
                </div>
                <!-- inline-facts end -->
				
            </div>
        </div>
    </section>
    <!-- section end-->
    <!-- section -->
    
    <!-- section end-->
    <!-- section -->
    
    <!-- section end-->
</div>
<!-- content end -->
<!-- subscribe-wrap -->
<!-- <div class="subscribe-wrap fl-wrap">
    <div class="container">
        <div class="subscribe-container fl-wrap color-bg">
            <div class="pwh_bg"></div>
            <div class="mrb_dec mrb_dec3"></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="subscribe-header">
                        <h4>newsletter</h4>
                        <h3>Sign up for newsletter and get latest news and update</h3>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="footer-widget fl-wrap">
                        <div class="subscribe-widget fl-wrap">
                            <div class="subcribe-form">
                                <form id="subscribe" novalidate="true">

                                    <input class="enteremail fl-wrap" name="EMAIL" id="subscribe-email" placeholder="Enter Your Email" spellcheck="false" type="text">
                                    <button type="submit" id="subscribe-button" class="subscribe-button color-bg">  Subscribe</button>
                                    <label for="subscribe-email" class="subscribe-message"></label>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->
<!-- subscribe-wrap end -->
<!-- footer -->
@include('inc.front_footer')
<!-- footer end -->
@endsection
