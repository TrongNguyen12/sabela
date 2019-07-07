<footer class="ft b6 t7">
	<div class="ft-first">
		<div class="container container-big">
			<div class="d-flex align-items-center justify-content-between ft-first-wrap">
				<div class="d-flex align-items-center flex-wrap ft-first-l">
					<h2 class="bold s14 ft-first-l-tit">{{ trans('lang.title6') }}:</h2>
					<ul class="list-unstyled d-flex align-items-center top-social ft-social">
						<li><a href="{{ $social->facebook->url }}"><i class="fab fa-facebook"></i></a></li>
						<li><a href="{{ $social->twitter->url }}"><i class="fab fa-pinterest-square"></i></a></li>
						<li><a href="{{ $social->instagram->url }}"><i class="fab fa-instagram"></i></a></li>
					</ul>
				</div>
				<div class="d-flex align-items-center ft-first-r">
					<h2 class="bold s14 fr-first-r-tit">{{ trans('lang.title7') }}</h2>
					<form action="{{ asset('news-letter') }}" class="d-flex align-items-center ft-regis-frm" method="POST">
						<input type="email" required="required" placeholder="Email" class="form-control" name="
						email">
						<button class="btn regis-bt-btn" type="submit"><i class="fas fa-angle-right"></i></button>
						{{ csrf_field() }}
					</form>
				</div>
			</div>
			
		</div>
	</div>
	<div class="pb-5" style="background: url({{ asset('public/frontend') }}/images/ftbg2.jpg);">
		<div class="container container-big">
			<div class="row justify-content-between">
				<div class="col-lg-3 col-6">
					<h2 class="s14 bold ft-tit">{{ trans('lang.titel32') }}</h2>
					<ul class="list-unstyled ft-list">
						<li class="d-flex align-items-baseline">
							<a href="{{ asset('sale') }}" title="">{{ trans('lang.title41') }}</a>
						</li>
						<li><a href="{{ asset('san-pham') }}" title="">E- Cataloge</a></li>
						<li><a href="{{ asset('san-pham') }}" title="">{{ trans('lang.title42') }}</a></li>
						<li><a href="{{ asset('san-pham') }}" title="">{{ trans('lang.title9') }}</a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-6">
					<h2 class="bold s14 ft-tit">{{ trans('lang.title33') }}</h2>

					<ul class="list-unstyled ft-list">
						<li><a href="{{ asset('account') }}" title="">{{ trans('lang.title34') }}</a></li>
						@foreach ($policy as $item)
							@if ($item->status == 1)
								<li>
									<a href="{{ asset('tin-tuc/'.$item->slug.'-p'.$item->id ) }}" title="">
										@if (App::isLocale('vi'))
											{!! $item->name !!}
										@else
											{!! $item->nameeg !!}
										@endif
									</a>
								</li>
							@endif
						@endforeach
					</ul>
				</div>
				<div class="col-lg-3 col-6">
					<h2 class="bold s14 ft-tit"><a href="{{ asset('lien-he') }}" title="">{{ trans('lang.title39') }}</a></h2>
					<ul class="list-unstyled ft-list">
						<li><a href="{{ asset('vi-tri') }}" title=""><strong>{{ trans('lang.title5') }}</strong></a></li>
						<li><a href="store.html" title=""><strong>{{ trans('lang.title40') }}</strong></a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-6">
					<h2 class="bold s14 ft-tit">FANPAGE</h2>
					{!! @$site_info->codefacebook !!}
				</div>
			</div>
		</div>
	</div>
	
	<div class="ft-last">
		<div class="container">
			<div class="d-flex align-items-center justify-content-between ft-last-wrap">
				<div class="ft-last-l">
					<h2 class="s13">
						@if (App::isLocale('vi'))
							{!! $site_info->copyright !!}
						@else
							{!! $site_info->copyright_eg !!}
						@endif
					</h2>
				</div>
				<ul class="s13 list-unstyled d-flex align-items-center ft-last-r">
					<li><a href="#" title="">{{ trans('lang.title44') }}</a></li>
					<li><a href="#" title="">{{ trans('lang.title43') }}</a></li>
				</ul>
			</div>	
		</div>
	</div>
</footer>