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
{{--    <link rel="stylesheet" href="{{asset('public/assets/css/bootstrap-rtl.min.css')}}">--}}
    <link type="text/css" rel="stylesheet" href="{{asset('public/front/css/plugins.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('public/front/css/style.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('public/front/css/dashboard-style.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('public/front/css/color.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('public/front/css/custom.css')}}">

    <!--  favicons  -->
    <base href="/">
    <link rel="shortcut icon" href="{{ asset('public/postal-icon.jpeg') }}" />
</head>
<body>
<!--loader-->
@include('inc.front_loader')
<!--loader end-->
<!-- main -->
<div id="main">
    <!-- header -->
@include('inc.front_cabinet_header')
<!-- header end  -->
    <!-- wrapper  -->
    <div id="wrapper">
        @yield('content')
    </div>
    <!-- wrapper end -->
</div>
<!-- Main end -->
<!--=============== scripts  ===============-->
<script src="{{asset('public/front/js/jquery.min.js')}}"></script>
<script src="{{asset('public/front/js/plugins.js')}}"></script>
<script src="{{asset('public/front/js/scripts.js')}}"></script>
{{--<script src="js/map-add.js"></script>--}}
<script src="{{asset('public/front/js/dashboard.js')}}"></script>
	<script src="{{ asset('public/assets/js/JsBarcode.all.min.js') }}"></script>
<script>
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
    $('.chosen-select').niceSelect();
    // $(".dasbdord-submenu-open").on('click', function () {
    //
    //     $(this).toggleClass("db_submenu_open-init_vis");
    //     $(".dashboard-submenu").toggleClass("db_submenu_open-init");
    // });
	$('.printOverhead2').click(function (e){
		e.preventDefault();
		//alert(33);
		printOverhead();
	});
	function printOverhead(){
		$.ajax({
			url: 'https://postalservice.kz/api/v1/addOver3',
			method: "GET",
			data: {
                "user_id"	   : $("#user_id").val(),
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
				printTo.find('.city p').text($("#from_city option[value='"+res.data.to_city+"']").text());
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

	$('.printOverhead1').click(function(e){
		e.preventDefault();
		printOverhead11($(this));
	});
	
	function printOverhead11(val){
		console.log(val.attr('overhead_code'));
		let overhead_code = val.attr('overhead_code');
		$.ajax({
			url: "https://postalservice.kz/api/v1/overhead/getOverheadByCode",
			method: "GET",
			data: {overhead_code: overhead_code},
			success: function(result){
				//console.log(res);
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
				printFrom.find('.city p').text(res.data.from_city);
				printFrom.find('.address p').text(res.data.from_address);
				printFrom.find('.fromPhone p').text(res.data.from_phone);
				printTo.find('.fio p').text(res.data.to_name);
				printTo.find('.company p').text(res.data.to_company);
				printTo.find('.city p').text(res.data.to_city);
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
			}
		});
	}

</script>
<script>

</script>

{{--<script src="{{asset('public/front/maps/api/js?key=AIzaSyDwJSRi0zFjDemECmFl9JtRj1FY7TiTRRo&libraries=places')}}"></script>--}}
{{--<script src="{{asset('public/front/js/map-single.js')}}"></script>--}}
	<script src="https://kit.fontawesome.com/d758200422.js" crossorigin="anonymous"></script>
	<script>
		
		
		//console.log(user_id);
		$('#other_company').change(function(e){
			let user_id = $(this).val();
			console.log($(this).val());
			$.ajax({
				url: "{{route('api.user.getInfo')}}",
				method: "GET",
				data: {id:user_id},
				success: function(result){
					//console.log(result);
					let res = JSON.parse(result);
					//console.log(res);
					$('#from_name').val(res.success.from_name);
					$('#from_company').val(res.success.from_company);
					$('#from_city option[value="'+res.success.from_city+'"]').prop('selected', 'selected');
					$('#from_address').val(res.success.from_address);
					$('#from_phone').val(res.success.from_phone);
				},
				error: function(error){
					console.log(error);
				}
			});
		});
	
	</script>

</body>
</html>
