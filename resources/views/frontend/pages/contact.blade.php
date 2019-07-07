@extends('frontend.master')
@section('main')
	<main class="">
		<div class="bread-wrap">
			<div class="container">
				<ul class="list-unstyled bread">
					<li><a href="{{ asset('/') }}" title=""><i class="fas fa-home"></i> Trang chủ</a></li>
					<li><a href="#" title="">Liên hệ</a></li>
				</ul>
			</div>
		</div>
		<section class="pt-4 contact">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contact-l">
							<h1 class="medium s14 t5 contact-tit py-4">ĐỊA CHỈ LIÊN HỆ</h1>
							<ul class="list-unstyled w-lg-75 ft-add">
								<li>
									<img src="{{ asset('public/frontend') }}/images/map.png" alt="" title=""> 
										{{ $site_info->site_address }}
								</li>
								<li>
									<a href="mailto:info@gco.vn" title="">
										<img src="{{ asset('public/frontend') }}/images/mail.png" alt="" title=""> 
											{{ $site_info->site_email }}
									</a>
								</li>
								<li>
									<a href="tel:{{ $site_info->site_phone }}" title=""><img src="{{ asset('public/frontend') }}/images/phone.png" alt="" title=""> {{ $site_info->site_phone }}
									</a>
								</li>
							</ul>

							<form action="{{ asset('lien-he') }}" class="contact-frm" method="POST">
								<div class="row">
									<div class="col-sm-12">
										@include('frontend.errors.errors')
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<label for="">Họ tên</label>
										<input type="text" required="required" class="form-control" name="name">
									</div>
									<div class="col-sm-6">
										<label for="">Số điện thoại</label>
										<input type="number" required="required" class="form-control" name="phone">
									</div>
									<div class="col-sm-6">
										<label for="">Email</label>
										<input type="email" class="form-control" name="email">
									</div>
									<div class="col-sm-6">
										<label for="">Địa chỉ</label>
										<input type="text" required="required" class="form-control" name="address">
									</div>
								</div>
								<label for="">Nội dung</label>
								<textarea rows="3" required="required" class="form-control" name="content"></textarea>
								<div class="text-lg-left text-center contact-act">
									<button class="btn medium s14 text-white cart-btn" type="submit">GỬI YÊU CẦU</button>
								</div>
								{{ csrf_field() }}
							</form>
						</div>
					</div>
					<div class="col-md-6">
						{!! $site_info->codemaps !!}
					</div>
				</div>
			</div>
		</section>
		
	</main>
@endsection