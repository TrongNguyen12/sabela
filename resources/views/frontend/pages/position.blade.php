@extends('frontend.master')
@section('main')
	<main class="">
			<div class="bread-wrap">
				<div class="container">
					<ul class="list-unstyled bread">
						<li><a href="{{ asset('/') }}" title=""><i class="fas fa-home"></i>{{ trans('lang.title12') }}</a></li>
						<li><a href="#" title="">{{ trans('lang.title5') }}</a></li>
					</ul>
				</div>
			</div>
			<section class="pt-4 contact">
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<div class="contact-l">
								<h1 class="medium s14 t5 contact-tit py-4">{{ trans('lang.titel55') }}</h1>
								<ul class="list-unstyled w-lg-75 ft-add">
									<li>
										<img src="{{ asset('public/frontend') }}/images/map.png" alt="" title=""> 
										{!! $site_info->site_address !!}
									</li>
									<li>
										<a href="mailto:info@gco.vn" title="">
											<img src="{{ asset('public/frontend') }}/images/mail.png" alt="" title=""> 
											{{ $site_info->site_email }}
										</a>
									</li>
									<li>
										<a href="tel:02473098885" title="">
											<img src="{{ asset('public/frontend') }}/images/phone.png" alt="" title=""> {{ $site_info->site_phone }}
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-md-6">
							{!! $site_info->codemaps !!}
						</div>
					</div>
				</div>
			</section>
			
		</main>
@stop