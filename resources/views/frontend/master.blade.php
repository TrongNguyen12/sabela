<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:description" content="@yield('meta')" />
    {!! SEO::generate() !!}
	<title>{{ $site_info->site_title.' - '.$site_info->site_description }}</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ asset('public/frontend') }}/css/slick.css">
	<link rel="stylesheet" href="{{ asset('public/frontend') }}/css/slick-theme.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/css/jquery.mmenu.all.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/fonts/fontawesome/fontawesome-all.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
		@yield('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/css/style.css">
	<link rel="stylesheet" href="{{ url('public/frontend/toast/jquery.toast.css') }}">
	<link rel="icon" href="{{ asset('uploads/config/logo/'.$site_info->site_favicon ) }}" type="image/x-icon"/>
	<script>
		function base_url() {
			return '{{ asset('/') }}';
		}
	</script>
	<style>
		.jq-toast-single{
			font-size: 16px;
		}
		.jq-toast-single h2{
			font-size: 19px;
		}
		..jq-toast-single{
			width: 250px;
		}
	</style>

</head>
<body class="@yield('class')">

	<div class="wrapper index">
		
		@include('frontend.teamplate.header')

		@yield('main')

		@include('frontend.teamplate.footer')
		
		<i class="fas fa-arrow-up to-top"></i>
		<div class="over"></div>
		
	</div>



	<script src="{{ asset('public/frontend') }}/js/jquery.min.js"></script>
	<script src="{{ asset('public/frontend') }}/js/slick.min.js"></script>
	<script src="{{ asset('public/frontend') }}/js/jquery.mmenu.min.all.js"></script>
	<script src="{{ asset('public/frontend') }}/js/popper.min.js"></script>
	<script src="{{ asset('public/frontend') }}/js/bootstrap.min.js"></script>
	<script src="{{ asset('public/frontend/toast/jquery.toast.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
		@yield('script')
	<script src="{{ asset('public/frontend') }}/js/main.js"></script>
	@if (Session::has('Tsuccess'))
		<script>
			$.toast({
			    text: "{{ Session::get('Tsuccess') }}",
			    heading: 'Thông Báo', 
			    icon: 'success', 
			    showHideTransition: 'slide', 
			    allowToastClose: true, 
			    hideAfter: 4000, 
			    stack: 5, 
			    position: 'top-right',
			    textAlign: 'left', 
			    loader: false, 
			    loaderBg: '#9ec600',  
			    beforeShow: function () {}, 
			    afterShown: function () {}, 
			    beforeHide: function () {},
			    afterHidden: function () {} 
			});
		</script>
	@endif
	@if (Session::has('Tsuccess_order'))
	<!-- Modal -->
		<div class="modal fade promodal" id="Mypromodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		      </button>
		      <div class="modal-body">
		        <div class="row">
					<div class="col-sm-3">
						<img class="logo" src="{{ asset( 'uploads/config/logo/'.$site_info->site_logo ) }}" alt="" title="">
					</div>
					<div class="col-sm-9">
						<h2>Cảm ơn bạn đã mua hàng tại: WEBSITE</h2>
						<p>Mã số đơn hàng của bạn: </p>
						<p class="btn btn-lg btn-info">#{{ Session::get('Tsuccess_order') }}</p>
						@if (Auth::check())
							<p>Bạn có thể xem lại: <a href="{{ asset('account') }}">đơn hàng của tôi</a></p>
						@endif
						<div class="title-note">
							<i class="fa fa-info"></i> Nhận viên của chúng tôi sẽ gọi điện xác nhận lại đơn hàng của quý khách !
						</div>
					</div>
				</div>
		      </div>
		    </div>
		  </div>
		</div>
	<!-- End Modal -->
	<script type="text/javascript">
	    $(window).on('load',function(){
	        $('#Mypromodal').modal('show');
	    });
	</script>
	@endif

	<script>
		$(function() {
			$('#lang').change(function(event) {
				window.location.href = '{{ asset('swich-lang') }}/'+$(this).val();
			});
		});
	</script>
</body>
</html>