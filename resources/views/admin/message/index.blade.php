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
	.form-group{
		margin-bottom: 1rem;
	}
</style>
@endsection
@section('content-admin')
<div class="row">
	<div class="col-md-4">
		Users
	</div>
	<div class="col-md-6">
		Chat
	</div>
</div>
@endsection
@section('admin-script')

<script>
	
</script>
@endsection
