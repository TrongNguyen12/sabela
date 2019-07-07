@extends('frontend.master')
@section('main')
	<main class="">
		<section class="login">
			<div class="bread-wrap">
				<div class="container">
					<ul class="list-unstyled bread">
						<li><a href="{{ asset('/') }}" title=""><i class="fas fa-home"></i> Trang chủ</a></li>
						<li><a href="{{ asset('dang-nhap') }}" title="">Tài khoản</a></li>
						<li><a href="#" title="">Quên mật khẩu</a></li>
					</ul>
				</div>
			</div>
			<div class="container">
				<h1 class="medium s18 t5 login-tit">Quên mật khẩu</h1>
				<h2 class="t5 italic login-sum">Vui lòng cung cấp email đăng nhập để khôi phục mật khẩu của bạn.</h2>
				<div class="row">
					<div class="col-lg-5 col-md-6 col-sm-6">
						@include('frontend.errors.errors')
						<form action="" class="login-frm" method="POST">
							<label for="">Email</label>
							<input type="email" placeholder="Email đăng nhập" required="required" class="form-control" name="email">
							<button class="btn login-btn w-100" type="submit">LẤY LẠI MẬT KHẨU</button>
							{{ csrf_field() }}	
						</form>
					</div>
				</div>
			</div>
		</section>
	</main>
@stop