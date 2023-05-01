<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    //dd(Auth::user()->id)
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Postal Service</title>

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{ asset('public/assets/dashboard/css/pages/login/classic/login-4.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('public/assets/dashboard/plugins/global/plugins.bundle.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/dashboard/plugins/custom/prismjs/prismjs.bundle.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/dashboard/css/style.bundle.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/css/custom-style.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{ asset('public/assets/dashboard/css/themes/layout/header/base/light.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/dashboard/css/themes/layout/header/menu/light.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/dashboard/css/themes/layout/brand/dark.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/dashboard/css/themes/layout/aside/dark.css?v=7.2.3') }}" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{ asset('public/postal-icon.jpeg') }}" />
    <style>
        .aside-menu .menu-nav .menu-item .menu-submenu .menu-item-parent{
            display:block;
        }

    </style>

</head>

<body id="kt_body" class="header-fixed header-mobile-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
<!--begin::Main-->

<!--begin::Header Mobile-->
<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">

    <!--begin::Logo-->
    <a href="{{ route('admin') }}">
    </a>
	<ul style="list-style:none;margin:0;">

		@if(Auth::user()->getRole(Auth::user()->id)->first()->role_id != 14)
		<li class="menu-item menu-item-submenu menu-item-rel ">
			<form action="{{route('admin.overheads.searchOverhead')}}" method="get" style="display:flex;">
				<input class="form-control" type="text" name="search_overhead"
					   id="search_overhead" placeholder="Введите номер накладного">
				<input type="submit" class="btn btn-primary" value="Поиск">
			</form>
		</li>
		@else
		<li class="menu-item menu-item-submenu menu-item-rel ">
			<form action="{{route('admin.overheads.searchOverhead2')}}" method="get" style="display:flex;">
				<input class="form-control" type="text" name="search_overhead2"
					   id="search_overhead2" placeholder="Введите номер накладного">
				<input type="submit" class="btn btn-primary" value="Поиск">
			</form>
		</li>
		@endif

	</ul>
    <!--end::Logo-->

    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">

        <!--begin::Aside Mobile Toggle-->
        <button class="p-0 btn burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
            <span></span>
        </button>

        <!--end::Aside Mobile Toggle-->

        <!--begin::Topbar Mobile Toggle-->
        <button class="p-0 ml-2 btn btn-hover-text-primary" id="kt_header_mobile_topbar_toggle">
				<span class="svg-icon svg-icon-xl">
					<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                         height="24px" viewBox="0 0 24 24" version="1.1">
						<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							<polygon points="0 0 24 0 24 24 0 24" />
							<path
                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
							<path
                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                fill="#000000" fill-rule="nonzero" />
						</g>
					</svg>

                    <!--end::Svg Icon-->
				</span>
        </button>

        <!--end::Topbar Mobile Toggle-->
    </div>

    <!--end::Toolbar-->
</div>

<!--end::Header Mobile-->
<div class="d-flex flex-column flex-root">

    <!--begin::Page-->
    <div class="flex-row d-flex flex-column-fluid page">

    @include('inc.admin_sidenav')

    <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

        @include('inc.admin_nav')
        <!--end::Header-->

        @yield('subheader')

        <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Entry-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container-fluid">
                        @yield('content-admin')
                    </div>

                    <!--end::Container-->
                </div>

                <!--end::Entry-->
            </div>

            <!--end::Content-->

            <!--begin::Footer-->
            <div class="py-4 bg-white footer d-flex flex-lg-column" id="kt_footer">

                <!--begin::Container-->
                <div class="container text-center">

                    <!--begin::Copyright-->
                    <div class="order-2 text-dark order-md-1">
                        <span class="mr-1 text-muted font-weight-bold"> &copy; {{date('Y')}}</span>
                        <a href="http://keenthemes.com/metronic" target="_blank"
                           class="text-dark-75 text-hover-primary"></a> <span class="mr-2 text-muted font-weight-bold"></span>
                    </div>

                    <!--end::Copyright-->

                    <!--begin::Nav-->
                    <div class="nav nav-dark">
                    </div>

                    <!--end::Nav-->
                </div>

                <!--end::Container-->
            </div>

            <!--end::Footer-->
        </div>

        <!--end::Wrapper-->
    </div>

    <!--end::Page-->
</div>

<!--end::Main-->

<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop">
		<span class="svg-icon">

			<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                 viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<polygon points="0 0 24 0 24 24 0 24" />
					<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
					<path
                        d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                        fill="#000000" fill-rule="nonzero" />
				</g>
			</svg>

            <!--end::Svg Icon-->
		</span>
</div>
<!--end::Scrolltop-->
<!--begin::Global Config(global config for global JS scripts)-->
<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1400
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Helvetica"
    };
</script>
<!--begin::Global Theme Bundle(used by all pages)-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="{{ asset('public/assets/dashboard/plugins/global/plugins.bundle.js?v=7.2.3') }}"></script>
<script src="{{ asset('public/assets/dashboard/plugins/custom/prismjs/prismjs.bundle.js?v=7.2.3') }}"></script>
<script src="{{ asset('public/assets/dashboard/js/scripts.bundle.js?v=7.2.3') }}"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('public/assets/dashboard/js/pages/custom/login/login-general.js?v=7.2.3') }}"></script>
<script src="{{ asset('public/assets/js/JsBarcode.all.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/quagga.min.js') }}"></script>
<!--end::Page Scripts-->
<script src="{{ asset('public/assets/js/vendors.js') }}" ></script>
{{--<script src="{{asset('public/assets/js/datepicker_ru.js')}}"></script>--}}
{{--<script src="{{ asset('public/assets/js/aiz-core.js') }}" ></script>--}}
<script>
	$(document).ready(function(){
		if(window.location.href!=="https://postalservice.kz/admin/overheads/create"){
		let from = $("#from_name");
		from.keyup(function(e){
			$(".search_results").show();
			let val = $(this).val();
			console.log(val.trim());
			$.ajax({
				url: "https://postalservice.kz/api/v1/getClientsByName",
				method: "get",

				data: {from_name: val.trim()},
				success: function(result){
					console.log(result);
					let res = JSON.parse(result);
					//console.log(res.success[0]);
					let a = res.success;
					$(".search_results").find(".search_item").remove();
					let d = "";
					for(let i=0;i<a.length;i++){
						d += "<div class='search_item' onclick='st("+a[i].id+")' data='"+a[i].id+"'>"+a[i].company+" | "+a[i].name+"</div>";
						//console.log(a[i]);

						$(".search_results").append(d);
						d = "";
					}
					localStorage.clear();
					localStorage.setItem("res", result);
				},
				error: function(error){
					console.log(error);
				}
			});
		});
		}


	});
	function st(data){
		//alert(55);
			//let data = $(this).attr("data");
			let res = JSON.parse(localStorage.getItem("res"));
			let data2 = res.success;
		console.log(res);
			for(let i=0;i<data2.length; i++){
				if(data2[i].id == data){
					if(window.location.href=="https://postalservice.kz/admin/overheads/create"){
						$("#from_company").val(data2[i].company);
						$("#from_phone").val(data2[i].phone);
						$("#from_address").val(data2[i].address);
						let city = data2[i].city;
						$("#from_city option").each(function(i, el){
							if($(el).text().trim() == city){
								$(el).prop("selected", true);
							}
						});
					}
					else{
						$("#from_company").val(data2[i].company);
						$("#from_phone").val(data2[i].phone);
						$("#from_address").val(data2[i].address);
					}
				}
			}
		/*
		$(".search_item").click(function(e){

		});*/
		$(".search_results").hide();
	}

	$("#import").click(function(){
		$.ajax({
			url: "https://abbas.kz/wp-admin/admin-ajax.php",
			method: "get",
			data: {action: "overhead2"},
			success: function(result){
				console.log(result);
			}
		});
	});
	/*
	let checkere = setInterval(function(){
		$("#notifications_content .navi-item").remove();
		$('.counter-noti').text(0);
		getNotifications();
	}, 5000);
*/
	/*function getNotifications(){
		$.ajax({
			url: 'https://postalservice.kz/api/v1/getNotifications',
			method: 'get',
			data:{},
			success: (result)=>{
				//console.log(result);
				let res = JSON.parse(result);
				//console.log(res.notifications);
				let data = res.notifications;
				let items = '';
				if(data.length > 0){
					//alert(4);
					$('.topbar-item .bell').css('color', 'red');
					$('.counter-noti').text(data.length);
					let length = 0;
					if(data.length > 30){
						length = 30;
					}else{
						length = data.length;
					}
					for(let i=0; i< length; i++){
						let link = '<a href="https://postalservice.kz/admin/overheads/show?overhead_id='+
							data[i].item_id+'" class="navi-item">'+
							'<div class="navi-link">'+
								'<div class="navi-icon mr-2">'+
									'<i class="flaticon2-bell-4 text-success"></i>'+
							'</div>'+
							'<div class="navi-text">'+
								'<div class="font-weight-bold noti_text1">'+'Новая заявка --- '+data[i].item_id+'</div>'+
							'<div class="text-muted noti_text2">'+'Нажмите на ссылку чтобы перейти'+'</div>'+
							'</div>'+
							'</div>'+
						'</a>';
						items += link;

					}
					$("#notifications_content").append(items);

				}else{

				}

			},
		});

	}
	*/

</script>
@yield('admin-script')
@stack('admin-scripts2')
</body>
<!--end::Body-->
</html>
