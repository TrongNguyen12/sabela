@extends('frontend.master')
@section('main')
	<main class="">
		<div class="bread-wrap">
			<div class="container">
				<ul class="list-unstyled bread">
					<li><a href="{{ asset('/') }}" title=""><i class="fas fa-home"></i> {{ trans('lang.title12') }}</a></li>
					<li><a href="{{ asset('tin-tuc') }}" title="">{{ trans('lang.title8') }}</a></li>
					<li><a href="#" title="">{{ $post->name }}</a></li>
				</ul>
			</div>
		</div>
		<section class="pt-4 bdetail">
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="bdetail-wrap">
							<div class="text-center">
								<img src="{{ asset( 'uploads/post/'.$post->image ) }}" alt="" title="">
							</div>
							<h1 class="medium s30 t5 bdetail-tit">
								@if (App::isLocale('vi'))
									{{ $post->name }}
								@else
									{{ $post->nameeg }}
								@endif
							</h1>
							<time class="d-inline-block mt-3 bdetail-time t6">{{ date('d/m/Y', strtotime( $post->created_at )) }}
							</time>

							<div class="bdetail-content">
								@if (App::isLocale('vi'))
									{!! $post->content_main !!}
								@else
									{!! $post->content_maineg !!}
								@endif
							</div>
							<ul class="list-unstyled d-flex align-items-center pdetail-share bdetail-share">
								<li>{{ trans('lang.title15') }}</li>
								<li><a href="#"><i class="fab fa-facebook"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<aside class="pdetail-aside">
							@if ( count($postCat) >0 )
								<h2 class="medium t5 pb-4 pdetail-aside-tit s24 bdetail-re">{{ trans('lang.title14') }}</h2>
							@endif
							<div class="pdetail-reitem">
								@foreach ($postCat as $item)
								<article class="blog-item">
									<figure class="blog-img">
										<a href="{{ asset( 'tin-tuc/'.$item->slug.'-p'.$item->id ) }}" title="">
											<img src="{{ asset( 'uploads/post/'.$post->image ) }}" alt="" title="">
										</a>
									</figure>
									<figcaption class="blog-info">
										<h2 class="text-uppercase medium blog-info-tit py-3 t5"><a href="{{ asset( 'tin-tuc/'.$item->slug.'-p'.$item->id ) }}" title="">
												@if (App::isLocale('vi'))
													{{ $item->name }}
												@else
													{{ $item->nameeg }}
												@endif
											</a>
										</h2>
										<div class="blog-info-content">
											@if (App::isLocale('vi'))
												{!! $item->content_short !!} 
											@else
												{!! $item->content_shorteg !!} 
											@endif
										</div>
										<div class="d-flex align-items-center justify-content-between blog-ft">
											<span class="s13">{{ date('d/m/Y', strtotime( $item->created_at )) }}</span>
											<i class="fas fa-chevron-circle-right t9"></i>
										</div>
									</figcaption>
								</article>
								@endforeach
							</div>
						</aside>
					</div>
				</div>
			</div>
		</section>
	</main>
@endsection