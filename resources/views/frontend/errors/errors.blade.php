@if(count($errors) > 0)
	<div class="alert alert-danger background-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true" style="font-size:20px">×</span>
		</button>
		<h4><i class="icon fa fa-ban"></i> <strong>Thông báo</strong></h4>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</div>
@endif
@if (Session::has('error'))
	<div class="alert alert-danger background-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true" style="font-size:20px">×</span>
		</button>
		<h4><i class="icon fa fa-ban"></i> <strong>Thông báo</strong></h4>
		<li><strong>Sai mật khẩu hoặc tài khoản !</strong></li>
	</div>
@endif
@if (Session::has('messs'))
	<div class="alert alert-danger background-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true" style="font-size:20px">×</span>
		</button>
		<h4><i class="icon fa fa-ban"></i> <strong>Thông báo</strong></h4>
		<li>{{ Session::get('messs') }}</li>
	</div>
@endif
@if (Session::has('success'))
	<div class="alert alert-success background-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true" style="font-size:20px">×</span>
		</button>
		<h4><i class="icon fa fa-ban"></i> <strong>Thông báo</strong></h4>
		<li>{{ Session::get('success') }}</li>
	</div>
@endif