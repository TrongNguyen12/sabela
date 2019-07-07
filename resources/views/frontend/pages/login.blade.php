@extends('frontend.master')
@section('main')
	<main class="">
		<section class="login">
			<div class="bread-wrap">
				<div class="container">
					<ul class="list-unstyled bread">
						<li><a href="{{ asset('/') }}" title=""><i class="fas fa-home"></i> {{ trans('lang.title12') }}</a></li>
						<li><a href="#" title="">{{ trans('lang.title1') }}</a></li>
					</ul>
				</div>
			</div>
			<div class="container">
				<h1 class="medium s18 t5 login-tit">{{ trans('lang.title1') }}</h1>
				<div class="row">
					<div class="col-lg-5 col-md-6 col-sm-6">
						@include('frontend.errors.errors')
						<form action="{{ asset('dang-nhap') }}" method="POST" class="login-frm" >
							<label for="">Email</label>
							<input type="email" placeholder="Email" required="required" 
							class="form-control" name="name" value="{{ old('name') }}">
							<label for="">{{ trans('lang.title48') }}</label>
							<input type="password" placeholder="Password" required="required" class="form-control" name="password" value="{{ old('password') }}">
							<button class="btn login-btn w-100" type="submit">{{ trans('lang.title1') }}</button>
							<div class="d-flex italic login-link align-items-center justify-content-between">
								<a href="{{ asset('quen-mat-khau') }}" title="">{{ trans('lang.titel56') }}</a>
								<a href="{{ asset('dang-ky') }}" title="">{{ trans('lang.title2') }}</a>
							</div>
							{{ csrf_field() }}
						</form>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="regis-r">
							<h2 class="login-r-tit">{{ trans('lang.titel57') }}</h2>

							<a href="{{ route('facebook.login')}}" class="w-100 btn fb-btn d-block" title="">
			        			<i class="fab fa-facebook-f"></i>
			        			<span>Facebook</span>
			        		</a>
			        		<a href="#" class="w-100 btn gg-btn d-block" title="">
			        			<i class="fab fa-google-plus-g"></i>
			        			<span>Gmail</span>
			        		</a>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
@stop
