@extends('frontend.master')
@section('class', 'aboutpage')
@section('main')
	<main id="fullpage" class="">
		<section class="fp-auto-height position-relative section">	
			<div class="bread-wrap">
				<div class="container">
					<ul class="list-unstyled bread">
						<li><a href="{{ asset('/') }}" title=""><i class="fas fa-home"></i> 
						{{ trans('lang.title12') }}</a></li>
						<li>
							<a href="#" title="">
								@if ( Request::segment(1) == 'why-organic')
									WHY-ORGRANIC
								@else
									{{ trans('lang.title11') }}
								@endif
								
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="container">	
				<h1 class="text-center f2 about-page-tit">
					<span class="s24 t2 d-block">
						@if (App::isLocale('vi'))
							{{ $about->titleSmallSec1 }}
						@else
							{{ $about->titleSmallSec1eg }}
						@endif
					</span>
					<span class="s48 sbold t3 d-block">
						@if (App::isLocale('vi'))
							{{ $about->titleBigSec1 }}
						@else
							{{ $about->titleBigSec1eg }}
						@endif
					</span>
				</h1>
				<div class="row justify-content-between">	
					<div class="col-lg-3 col-md-6 col-sm-6">
						<article class="text-center about-item">
							<figure class="about-img">	
								<img src="{{ asset('uploads/post/'.$about->fImageSec1Col1 ) }}" alt="" title="">
							</figure>
							<figcaption class="about-item-info">	
								@if (App::isLocale('vi'))
									{!! $about->contentSec1Col1 !!}
								@else
									{!! $about->contentSec1Col1eg !!}
								@endif
							</figcaption>
						</article>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<article class="text-center about-item">
							<figure class="about-img">	
								<img src="{{ asset('uploads/post/'.$about->fImageSec1Col2 ) }}" alt="" title="">
							</figure>
							<figcaption class="about-item-info">	
								@if (App::isLocal('vi'))
									{!! $about->contentSec1Col2 !!}
								@else
									{!! $about->contentSec1Col2eg !!}
								@endif
							</figcaption>
						</article>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<article class="text-center about-item">
							<figure class="about-img">	
								<img src="{{ asset('uploads/post/'.$about->fImageSec1Col3 ) }}" alt="" title="">
							</figure>
							<figcaption class="about-item-info">
								@if (App::isLocale('vi'))
									{!! $about->contentSec1Col3 !!}
								@else
									{!! $about->contentSec1Col3eg !!}
								@endif
							</figcaption>
						</article>
					</div>
				</div>
				<div class="text-center t8 about-sec-link"><img class="scroll-link" data-pos='2' src="{{ asset('public/frontend') }}/images/down.png" alt="" title=""></div>
			</div>
		</section>

		<section class="fp-auto-height position-relative text-white section about-sec-two" 
		style="background: url({{ asset('uploads/post/'.$about->fImageSec2) }}) no-repeat center center; background-size: cover;">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<h2 class="s30 sbold about-sec-two-tit">
							@if (App::isLocale('vi'))
								{{ $about->titleSec2 }}
							@else
								{{ $about->titleSec2eg }}
							@endif
						</h2>
						<div class="about-content">
							
							@if (App::isLocale('vi'))
								{!! $about->contentSec2 !!}
							@else
								{!! $about->contentSec2eg !!}
							@endif
						</div>
					</div>
				</div>
				<h2 class="text-center mt-30 f2 page-tit">
					<span class="s24 t2 d-block">KHÁM PHÁ</span>
					<span class="s48 sbold t3 d-block">CỬA HÀNG</span>
				</h2>
				<div class="text-center t8 about-sec-link"><img class="scroll-link" data-pos='3' src="{{ asset('public/frontend') }}/images/down.png" alt="" title=""></div>
			</div>
		</section>
		<section class="fp-auto-height position-relative section about-sec-cef">
			<div class="container">
				<h2 class="text-center f2 about-cef-tit">
					<span class="s24 t2 d-block">
						@if (App::isLocale('vi'))
							{!! $about->titleSmallSec3 !!}
						@else
							{!! $about->titleSmallSec3eg !!}
						@endif
						
					</span>
					<span class="s48 sbold t3 d-block">
						@if (App::isLocale('vi'))
							{!! $about->titleBigSec3 !!}
						@else
							{!! $about->titleBigSec3eg !!}
						@endif
					</span>
				</h2>
				@if (App::isLocale('vi'))
					{!! $about->contentSec3  !!}
				@else
					{!! $about->contentSec3eg  !!}
				@endif

				<div class="text-center t8 about-sec-link-act"><img class="scroll-link" data-pos='1' src="{{ asset('public/frontend') }}/images/up.png" alt="" title=""></div>
			</div>
		</section>
	</main>
@endsection

@section('css')
	<link rel="stylesheet" href="{{ asset('public/frontend') }}/css/fullpage.min.css">
@endsection

@section('script')
	<script src="{{ asset('public/frontend') }}/js/fullpage.js"></script>
@endsection