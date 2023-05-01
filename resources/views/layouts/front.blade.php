<!DOCTYPE HTML>
<html lang="en">
<head>
    <!-- basic   -->
    <meta charset="UTF-8">
    <title>{{$title}}</title>

    <meta name="robots" content="index, follow">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!-- css   -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="{{asset('public/front/css/plugins.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('public/front/css/dashboard-style.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('public/front/css/style.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('public/front/css/color.css')}}">
    <link rel="stylesheet" href="{{asset('public/front/css/custom.css')}}">
    <!--  favicons  -->
    <base href="/">
    <link rel="shortcut icon" href="{{ asset('public/postal-icon.jpeg') }}" />
    <style>
        .modal-wrapper{
            position: fixed;
            z-index: 20;
            width: 100%;
            height: 100vh;
            background-color: rgba(0,0,0,0.4);
            display: none;
            align-items: center;

        }
        .my-modal_container{
            width: 30%;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
        }
        .my-modal_content{
            width: 100%;
        }
        .my-modal_content ul{
            margin: 0;
        }
        .my-modal_content ul li{
            cursor: pointer;
            font-size: 1.4rem;
        }
        .my-modal_content ul li:hover{
            color: red;
            border-bottom: 1px dashed red;
        }
        .my_city_info{
            display: none;
        }
        #my_city_info_ul{
            width: 400px;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            opacity: 1;
            visibility: visible;
        }
        #my_city_info_ul li{
            display: flex;
            align-items: center;
        }

        .my_city_info_address_icon, .my_city_info_phone_icon{
            width: 40%;
            text-align: left;
        }
        .my_city_info_address, .my_city_info_phones{
            width: 60%;
            padding: 0;
        }

        #my_city_select{
            margin-top: 14px;
            border: 0;
            cursor: pointer;
            padding: 0;
        }

    </style>
</head>
<body>
<!--loader-->
@include('inc.front_loader')
<!--loader end-->
<!-- main -->
<div id="main">
    <!-- header -->
    @include('inc.front_header')
    <!-- header end  -->
    <!-- wrapper  -->
    <div id="wrapper">
        @yield('content')
    </div>
    <!-- wrapper end -->
    <!--register form -->
    @include('inc.login_register')
    <!--register form end -->
    <!--secondary-nav -->
    @include('inc.secondary_nav')
    <!--secondary-nav end -->
    <a class="to-top color-bg"><i class="fas fa-caret-up"></i></a>
    <!--map-modal -->
    <div class="map-modal-wrap">
        <div class="map-modal-wrap-overlay"></div>
        <div class="map-modal-item">
            <div class="map-modal-container fl-wrap">
                <h3> <span>Listing Title </span></h3>
                <div class="map-modal-close"><i class="far fa-times"></i></div>
                <div class="map-modal fl-wrap">
                    <div id="singleMap" data-latitude="40.7" data-longitude="-73.1"></div>
                    <div class="scrollContorl"></div>
                </div>
            </div>
        </div>
    </div>
    <!--map-modal end -->
</div>
<div class="modal-wrapper">
    <div class="my-modal_container">
        <div class="my-modal_content">
            <ul id="my-cities"></ul>
        </div>
    </div>
</div>
<!-- Main end -->
<!--=============== scripts  ===============-->
<script src="{{asset('public/front/js/jquery.min.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
<script src="{{asset('public/front/js/plugins.js')}}"></script>
<script src="{{asset('public/front/js/dashboard.js')}}"></script>
	<script src="{{ asset('public/assets/js/JsBarcode.all.min.js') }}"></script>
<script src="{{asset('public/front/js/scripts.js')}}"></script>


<script>

	$(function() {
        $('#searchForm').keydown(function(event){
            if(event.keyCode === 13) {
                event.preventDefault();
                return false;
            }
        });

        // Handler for .ready() called. Put the Slick Slider etc. init code here.
		var modal = {};
		modal.hide = function () {
			$('.modal , .reg-overlay').fadeOut(200);
			$("html, body").removeClass("hid-body");
			$(".modal_main").removeClass("vis_mr");
		};
		$('.modal-open').on("click", function (e) {
			e.preventDefault();
			$('.modal , .reg-overlay').fadeIn(200);
			$(".modal_main").addClass("vis_mr");
			$("html, body").addClass("hid-body");
		});
		$('.close-reg , .reg-overlay').on("click", function () {
			modal.hide();
		});
		$(".dasbdord-submenu-open").on('click', function () {

			$(this).toggleClass("db_submenu_open-init_vis");
			$(".dashboard-submenu").toggleClass("db_submenu_open-init");
		});

		let btn = $('#evaluate-btn');

		let btnShow = $('#showHide-btn');

		let express = $('#express');
		let standard = $('#standard');
		//



		let to = $('select#to');
		let toVal = 0;
		to.change(function() {
			var selected = $(':selected', this);
			toVal = parseInt(selected.closest('option').attr('value'));
		});

		let sum2 = 0;
		// Info

		let mass = 0;
		let length = 0;
		let width = 0;
		let height = 0;

		btn.click(function(){
			let price = 0;
			let massa = parseFloat($("#mass").val());
			let expressProp = express.prop('checked');
			//console.log(toVal);
			//console.log(express.prop('checked'));
			if(checkZone(toVal) == 1){

				if(massa <= 0.5){
					price += 2000;
					$("#sum3").val(price);
				}else{
					//console.log(massa);
					if(expressProp){
						console.log(massa);
						if(massa >= 0.5 && massa <= 1.0){
							price += 2000;
						}
						if(massa > 1.0 && massa <= 1.5){
							price += 2500;
						}
						if(massa > 1.5 && massa <= 2.0){
							price += 3000;
						}
						if(massa >= 2.5){
							price += 3000+parseInt((massa-2)/0.5)*500;
						}
						$("#sum3").val(price);
					}else{
						//console.log("Heere");
						if(massa >= 0.5 && massa <= 5.0){
							price += 2000;
						}
						if(massa > 5.0 && massa <= 5.5){
							price += 2200;
						}
						if(massa > 5.5 && massa <= 6.0){
							price += 2400;
						}
						if(massa >= 6.5){
							price += 2400+parseInt((massa-6)/0.5)*200;
						}
						$("#sum3").val(price);
					}
				}
			}
			if(checkZone(toVal) == 4){
				if(massa >= 0.5 && massa <= 5.0){
					price += 1000;
				}
				if(massa > 5.0 && massa <= 5.5){
					price += 1150;
				}
				if(massa > 5.5 && massa <= 6.0){
					price += 1300;
				}
				if(massa >= 6.5){
					price += 1300+parseInt((massa-6)/0.5)*150;
				}
				$("#sum3").val(price);
			}
			if(checkZone(toVal) == 2){
				if(massa >= 0.5 && massa <= 5.0){
					price += 3000;
				}
				if(massa > 5.0 && massa <= 5.5){
					price += 3350;
				}
				if(massa > 5.5 && massa <= 6.0){
					price += 3700;
				}
				if(massa >= 6.5){
					price += 3700+parseInt((massa-6)/0.5)*350;
				}
				$("#sum3").val(price);
			}
			if(checkZone(toVal) == 3){
				if(massa >= 0.5 && massa <= 5.0){
					price += 4000;
				}
				if(massa > 5.0 && massa <= 5.5){
					price += 4380;
				}
				if(massa > 5.5 && massa <= 6.0){
					price += 4720;
				}
				if(massa >= 6.5){
					price += 4720+parseInt((massa-6)/0.5)*380;
				}
				$("#sum3").val(price);
			}

		});

		function checkZone(city_id){
			if(city_id >= 0 && city_id <=15){
				return 1;
			}
			if(city_id >= 16 && city_id <=28){
				return 2;
			}
			if(city_id == 99){
				return 3;
			}
			if(city_id == 100){
				return 4;
			}
		}


	});
	let flagg = 1;
	$('.show-reg-form').click(function(){
		if(flagg === 1){
			$('.dashboard-submenu').addClass('db_submenu_open-init');
			flagg = 0;
		}else{
			$('.dashboard-submenu').removeClass('db_submenu_open-init');
			flagg = 1;
		}
	});


	$(".close").click(function(){
		$("#exampleModalLong").removeClass("fade").removeClass("show");
        $('.overhead_photo_index img').remove();
	});
	$("#closeBtn").click(function(){
		$("#exampleModalLong").removeClass("fade").removeClass("show");
        $('.overhead_photo_index img').remove();
	});
	function searchOverhead(){
		let overheadCode = $("#overhead_code").val();
		console.log(overheadCode);
		$("#exampleModalLong").addClass("fade").addClass("show");
        let code = overheadCode.trim();
        let url = "{{route('api.task.overhead')}}";
        $.ajax({
            url: url,
            method: "get",
            data: {overhead_code: code},
            success: function (result){
                //console.log(result);
                let overhead = JSON.parse(result);
                console.log(overhead);
				$('#overhead_number').text(overhead.code);
                $('.fromName').text(overhead.fromName);
                $('.fromCompany').text(overhead.fromCompany);
                $('.fromCity').text(overhead.fromCity);
                $('.fromAddress').text(overhead.fromAddress);
                $('.fromPhone').text(overhead.fromPhone);

                $('.toName').text(overhead.toName);
                $('.toCompany').text(overhead.toCompany);
                $('.toCity').text(overhead.toCity);
                $('.toAddress').text(overhead.toAddress);
                $('.toPhone').text(overhead.toPhone);

                $('.type').text(overhead.type);
                $('.speed').text(overhead.speed);
                $('.payment').text(overhead.payment);
                $('.payment_type').text(overhead.paymentMethod);
                $('.count').text(overhead.place);
                $('.date_s').text(overhead.dateS);
				$('.description').text(overhead.description);
				let image = "<img style='width: 100%;' src='{{asset("public/assets/overhead_photo")}}/"+overhead.image_file+"'>";
				$('.overhead_photo_index').append(image);

				if(overhead.dateE != null){
					$('.date_e2').text(overhead.dateE);
				}else{
					$('.date_e2').text("");
				}


				let journals = overhead.journals;

				$('.status_id').text(journals[journals.length-1].status);
                if (overhead.status === 1){
                    $('.status_id').text("Новый");
                }
                if (overhead.status === 2 || overhead.status === 3
                    || overhead.status === 4 || overhead.status === 14){
                    $('.status_id').text("В обработке");
                }
                if (overhead.status === 5 || overhead.status === 15){
                    $('.status_id').text("На складе");
                }
                if (overhead.status === 16){
                    $('.status_id').text("Не доставлен");
                }
				if (overhead.status === 8){
                    $('.status_id').text("Доставлен");
                }
                if (overhead.status === 11 || overhead.status === 12
                    || overhead.status === 13){
                    $('.status_id').text("Вышел со склада");
                }
                if (overhead.status === 6 || overhead.status === 7){
                    $('.status_id').text("В пути "+overhead.toCity);
                }
				if(overhead.status == 17){
					$('.status_id').text("На складе "+overhead.to_city);
				}
				$('.journals li').remove();
				//let journals = overhead.journals;

				for(let o=0; o<journals.length;o++){
					let date = journals[o].date;
					if(!journals[o].date){
						date = "";
					}
					$('.journals').append("<li style='display:flex;'><div style='width: 50%;'><strong>Статус:</strong> "+journals[o].status+"</div><div><strong>Дата:</strong> "+date+"</div></li>");
				}
				$('.journals');

            },
            error: function (result){
                console.log(result);
            },
        });
	}
	$('.printOverhead2').click(function (e){
		e.preventDefault();
		printOverhead();
	});
	function printOverhead(){
		$.ajax({
			url: 'https://postalservice.kz/api/v1/addOver2',
			method: "GET",
			data: {
				"from_name"    : $("#from_name").val(),
				"from_company" : $("#from_company").val(),
				"from_city"    : $("#from_city").val(),
				"from_address" : $("#from_address").val(),
				"from_phone"   : $("#from_phone").val(),
				"to_name"      : $("#to_name").val(),
				"to_company"   : $("#to_company").val(),
				"to_city"      : $("#to_city").val(),
				"to_address"   : $("#to_address").val(),
				"to_phone"     : $("#to_phone").val(),
				"type"         : $("#type").val(),
				"speed"        : $("#speed").val(),
				"payment"      : $("#payment").val(),
				"payment_type" : $("#payment_type").val(),
				"description"  : $("#description").val()
			},
			success: function(result){
				console.log(result);
				let res = JSON.parse(result);
				console.log(res);
				let document1 = res.data.type;
				let document2 = res.data.speed;
				let document3 = res.data.payment;
				let document4 = res.data.payment_type;
				let printFrom = $('.printFrom');
				let printTo = $('.printTo');
				printFrom.find('.fio p').text(res.data.from_name);
				printFrom.find('.company p').text(res.data.from_company);
				printFrom.find('.city p').text($("#from_city option[value='"+res.data.from_city+"']").text());
				printFrom.find('.address p').text(res.data.from_address);
				printFrom.find('.fromPhone p').text(res.data.from_phone);
				printTo.find('.fio p').text(res.data.to_name);
				printTo.find('.company p').text(res.data.to_company);
				printTo.find('.city p').text($("#to_city option[value='"+res.data.to_city+"']").text());
				printTo.find('.address p').text(res.data.to_address);
				printTo.find('.fromPhone p').text(res.data.to_phone);
				$('#printNakl .count_overhead').text(!res.data.place?1:res.data.place);

				$('.prim_desc').append(res.data.description);

				if (document1 === 'Документы'){
					$('#document11').text('x'); // Документы
				}
				if (document1 === 'Посылка'){
					$('#document12').text('x'); // Посылка
				}
				if (document2 === 'Экспресс'){
					$('#document13').text('x'); // Экспресс
				}
				if (document2 === 'Стандарт'){
					$('#document14').text('x'); // Стандарт
				}
				if (document2 === 'Авто'){
					$('#document15').text('x');  // Авто
				}
				if (document3 === 'Отправителем'){
					$('#document16').text('x'); // Отправителем
				}
				if (document3 === 'Получателем'){
					$('#document17').text('x'); // Получателем
				}
				if (document3 === 'Третьей стороной'){
					$('#document18').text('x'); // Третьей стороной
				}
				if (document4 === 'По счету'){
					$('#document19').text('x'); // По счету
				}
				if (document4 === 'Наличными'){
					$('#document110').text('x');// Наличными
				}
				if (document4 === 'Терминалом'){
					$('#document111').text('x');// Терминалом
				}
				$('#naklNumber').text(res.data.overhead_code);
				JsBarcode("#barcode", res.data.overhead_code, {
					height: 15,
					displayValue: false
				});
				let prtContent = document.getElementById('printNakl');
				Popup(prtContent);
				prtContent = null;


			},
			error: function(){},

		});
	}
	function Popup(data) {
		var mywindow = window.open('','','left=50,top=50,width=860,height=2000,toolbar=0,scrollbars=1,status=0');
		//   mywindow.document.write('<html><head><title></title>');
		//   mywindow.document.write('<link rel="stylesheet" href="css/midday_receipt.css" type="text/css" />');
		//   mywindow.document.write('</head><body >');
		mywindow.document.write('<div class="printNakl" style="width:800px;margin-bottom:20px;">');
		mywindow.document.write(data.innerHTML);
		mywindow.document.write('</div>');
		mywindow.document.write('<div class="printNakl" style="width:800px;margin-bottom:20px;">');
		mywindow.document.write(data.innerHTML);
		mywindow.document.write('</div>');
		mywindow.document.write('<div class="printNakl" style="width:800px;margin-bottom:20px;">');
		mywindow.document.write(data.innerHTML);
		mywindow.document.write('</div>');

		//   mywindow.document.write('</body></html>');

		mywindow.focus();
		mywindow.document.close();
		mywindow.print();mywindow.close();
		//setTimeout(function(){mywindow.print();mywindow.close();location.reload();},1000);
		//   mywindow.close();


		return true;
	}
    let cityInfo = [
        {
            id: 1,
            name: 'г. Шымкент',
            address: 'ул. Диваева 27',
            phones:[{number: '8(700)214-10-35'}]
        },
        {
            id: 2,
            name: 'г. Тараз',
            address: '',
            phones:[{number: '8(700)214-10-39'}]
        },
        {
            id: 3,
            name: 'г. Атырау',
            address: '',
            phones:[{number: '8(705)266-83-00'},{number: '8(707)742-42-99'},{number: '8(707)342-42-99'}]
        },
        {
            id: 4,
            name: 'г. Астана',
            address: 'ул. Проспект Республика, Бизнес Центр "Маржан", офис 106',
            phones:[{number: '8(700)214-10-34'}]
        },
        {
            id: 5,
            name: 'г. Алматы',
            address: 'ул. Проспект Райымбека, 208А, офис 118',
            phones:[{number: '8(707)266-83-00'},{number: '8(707)742-42-99'},{number: '8(707)342-42-99'}]
        },
    ];

    let my_city_select = $("#my_city_select");
    let footer_city_address = $(".footer-contacts");
    let footer_city_phones = $(".footer-contacts");//.find(".footer_city_phones");
    let info = localStorage.getItem('info');

    if(info !== null){
        info = JSON.parse(info);
        footer_city_address.find(".footer_city_address").text('');
        if(info.address === ''){
            footer_city_address.find(".footer_city_address").text("Не указан");
        }else{
            footer_city_address.find(".footer_city_address").text(info.address);
        }
        footer_city_phones.find(".footer_city_phones").find("a").remove();
        if(Array.isArray(info.phones)){
            info.phones.map(function(item, index, array){
                footer_city_phones.find(".footer_city_phones").append("<a href='#'>"+item.number+"</a>");
            });
        }
    }
    else{
        info = cityInfo[4];
        //console.log(cityInfo[4]);
        footer_city_address.find(".footer_city_address").text('');
        if(info.address === ''){
            footer_city_address.find(".footer_city_address").text("Не указан");
        }else{
            footer_city_address.find(".footer_city_address").text(info.address);
        }
        footer_city_phones.find(".footer_city_phones").find("a").remove();
        if(Array.isArray(info.phones)){
            info.phones.map(function(item, index, array){
                footer_city_phones.find(".footer_city_phones").append("<a href='#'>"+item.number+"</a>");
            });
        }
    }

    my_city_select.find("option").remove();
    cityInfo.map(function (item, index, array){
        if(info !== null){
            if(info.id === item.id){
                my_city_select.append("<option selected value='"+item.id+"'>"+item.name+"</option>");
            }else{
                my_city_select.append("<option value='"+item.id+"'>"+item.name+"</option>");
            }

        }
    });

    my_city_select.change(function (el){
        console.log($(this).val());
        let city_id = $(this).val();
        footer_city_address.find(".footer_city_address").text("");
        footer_city_phones.find(".footer_city_phones").find("a").remove();
        cityInfo.map(function (item, index, array){
            if(parseInt(city_id) === parseInt(item.id)){
                if (item.address !== ''){
                    footer_city_address.find(".footer_city_address").append(item.address);
                }else{
                    footer_city_address.find(".footer_city_address").append("Не указан");
                }
                if (Array.isArray(item.phones)){
                    item.phones.map(function (it, ind, arr){
                        footer_city_phones.find(".footer_city_phones").append("<a href='#'>"+it.number+"</a>");
                    });
                }
                localStorage.setItem('info', JSON.stringify(item));
            }
        });

    });
</script>
<script src="https://kit.fontawesome.com/d758200422.js" crossorigin="anonymous"></script>
</body>
</html>
