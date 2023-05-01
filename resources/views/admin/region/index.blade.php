@extends('layouts.app')
@section('subheader')
<style>
	#barcode-scanner canvas.drawingBuffer, #barcode-scanner video.drawingBuffer {
		display: none;
	}

	#barcode-scanner canvas, #barcode-scanner video {
		width: 100%;
		height: auto;
	}
</style>
@endsection
@section('content-admin')
	
<div class="col-lg-6 col-sm-12">
	<div>
		Добро пожаловать в Postal Service. Чтобы принять реестр через штрих код нажмите на кнопку 
	</div>
	<div>
		<div class="form-group">
			<button id="searchByBarcode" class="btn btn-primary btn-lg btn-sm form-control" 
					style="background-color:#004191;border-color:#004191;">Поиск по Штрих код</button>
		</div>
		<div class="form-group">
			<div id="barcode-scanner"></div>
		</div>
		<div class="form-group">
			<div id="result" style="width:100%;">
			</div>
		</div>
	</div>	
</div>
<div class="col-lg-6 col-sm-12 mt-3">
	<div>
		Чтобы принять реестр через код, напечатайте код в поле и нажмите на кнопку <span style="color:#004191;"><b>Поиск</b></span>
	</div>
	<div>
		<form>
			<div class="form-group" style="margin-bottom:0;">
				<input type="text" class="form-control" name="searchCode" id="searchByCode" placeholder="123456">
			</div>
			<div class="form-group mt-2">
				<input type="submit" class="form-control" name="searchCode2" 
					   id="searchByCode2" value="Поиск" 
					   style="background-color:#004191;border-color:#004191;color:#ffffff;">
			</div>
		</form>
	</div>
</div>


@endsection
@section('admin-script')

<script>
	$("#searchByBarcode").click(function(e){
		e.preventDefault();
		console.log(44);
		load_quagga();
	});
	$("#searchByCode2").click(function(e){
		e.preventDefault();
		console.log("{{ csrf_token() }}");
		load_list();
	});
	function load_list(){
		let code = $("#searchByCode").val().trim();
		console.log(code);
		$.ajax({
			url: "{{route('admin.region.registry')}}",
			type:"POST",
			data:{
				_token: "{{ csrf_token() }}",
				code:code,
			},
			success:function(response){
				console.log(response);
				let result = JSON.parse(response);
				if(result.success){
					window.location
						.replace("https://postalservice.kz/admin/region/list?registry="+JSON.stringify(result.registry));
				}else{
					console.log("GG");
				}

			},
		});
	}
	function load_quagga(){
		console.log(55);
		if ($('#barcode-scanner').length > 0 && navigator.mediaDevices && typeof navigator.mediaDevices.getUserMedia === 'function') {
			let last_result = [];
			if (Quagga.initialized == undefined) {
				Quagga.onDetected(function(result) {
					let last_code = result.codeResult.code;
					//console.log(result);
					$.ajax({
						url: "https://postalservice.kz/admin/region/getRegistry",
						type:"POST",
						data:{
							_token: "{{ csrf_token() }}",
							code:last_code,
						},
						success:function(response){
							console.log(response);
							let result = JSON.parse(response);
							if(result.success){
								window.location
									.replace("{{route('admin.region.list')}}?registry="+JSON.stringify(result.registry));
							}else{
								console.log("GG");
							}
							
						},
					});
					$("#result").text(last_code);
				});
				
			}
			
			Quagga.init({
				inputStream : {
					name : "Live",
					type : "LiveStream",
					numOfWorkers: navigator.hardwareConcurrency,
					
					area: { // defines rectangle of the detection/localization area
						top: "0%",    // top offset
						right: "0%",  // right offset
						left: "0%",   // left offset
						bottom: "0%"  // bottom offset
					},
					target: document.querySelector('#barcode-scanner')  
				},
				decoder: {
					readers : ['code_128_reader']
				}
			},function(err) {
				if (err) { console.log(err); return }
				Quagga.initialized = true;
				Quagga.start();
			});

		}
	}
	//['ean_reader','ean_8_reader','code_39_reader',
							   //'code_39_vin_reader','codabar_reader','upc_reader','upc_e_reader']
</script>
@endsection
