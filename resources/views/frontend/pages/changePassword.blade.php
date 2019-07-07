<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	@extends('frontend.master')
@section('main')
	<main class="">
		<section class="login">
			<div class="bread-wrap">
				<div class="container">
					<ul class="list-unstyled bread">
						<li><a href="{{ asset('/') }}" title=""><i class="fas fa-home"></i> Trang chủ</a></li>
						<li><a href="#" title="">Thay đổi mật khẩu</a></li>
					</ul>
				</div>
			</div>
			<div class="container">
				<h1 class="medium s18 t5 login-tit">Thay đổi mật khẩu</h1>
				<div class="row">
					<div class="col-lg-5 col-md-6 col-sm-6">
						@include('frontend.errors.errors')
						<form action="{{ asset('reset-password/'.$token ) }}" method="POST" class="login-frm" >
							<label for="">Mật khẩu mới</label>
							<input type="password" required="required" 
							class="form-control" name="password" value="{{ old('password') }}" placeholder="Nhập mật khẩu">
							<label for="">Nhập lại mật khẩu mới</label>
							<input type="password" placeholder="Nhập lại mật khẩu" required="required" class="form-control" name="re_password" value="{{ old('re_password') }}">
							<button class="btn login-btn w-100" type="submit">Lấy lại mật khẩu</button>
							{{ csrf_field() }}
						</form>
					</div>
				</div>
			</div>
		</section>
	</main>
@stop
</body>
</html>