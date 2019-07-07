@if(count($errors) > 0)
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> Thông báo</h4>
    @foreach($errors->all() as $error)
        <li>{!! $error !!}</li>
     @endforeach
  </div>
@endif
@if (Session::has('flash_error'))
	<div class="alert alert-danger background-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true" style="font-size:20px">×</span>
		</button>
		<h4><i class="icon fa fa-ban"></i> <strong>Thông báo</strong></h4>
		<li>{{ Session::get('flash_error') }}</li>
	</div>
@endif