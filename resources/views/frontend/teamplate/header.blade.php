<header class="fixed-top top">
	<div class="px150 b1 top-first">
		<div class="container container-big">
			<div class="d-flex align-items-center justify-content-between tfirst-wrap">
				<div class="d-flex align-items-center top-first-l">
					<a class="top-first-l-location" href="{{ asset('vi-tri') }}" title=""><i class="fas fa-map-marker-alt"></i> {{ trans('lang.title5') }}</a>
					<ul class="list-unstyled d-flex align-items-center top-social">
						<li><a href="{{ $social->facebook->url }}"><i class="fab fa-facebook"></i></a></li>
						<li><a href="{{ $social->twitter->url }}"><i class="fab fa-pinterest-square"></i></a></li>
						<li><a href="{{ $social->instagram->url }}"><i class="fab fa-instagram"></i></a></li>
					</ul>
				</div>
				<a id="nav-icon" href="#menu" class="d-lg-none">
					    <span></span>
					    <span></span>
					    <span></span>
					</a>
				<ul class="list-unstyled top-first-r">
					<li><a href="{{ asset('account') }}#acc3" title=""><i class="fas fa-heart"></i> {{ trans('lang.title4') }}</a></li>
					<li>
						<div class="top-cart">
							<a class="top-cart-btn" href="#" title="" data-toggle="dropdown">
								<i class="fas fa-shopping-cart"></i> {{ trans('lang.title3') }} ( {{ Cart::count() }} )
							</a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								@if (Cart::count() > 0)
									@foreach (Cart::content() as $item)
										<div class="dropdown-item d-flex align-items-center cart-top-item">
											<a class="#" href="#">
												<img src="{{ asset('uploads/product/avatar/'.$item->options->image ) }}" title="" alt=""></a>
											<div class="cart-top-info">
												<h2 class="cart-top-name text-truncate">
													<a href="#" title="">
														{{ $item->name }}
													</a>
													<br>{{ $item->qty }} x <strong>{{ number_format( $item->price ) }} đ</strong>
												</h2>
												
												<p class="text-right">
													<a href="{{ asset( 'cart/'.$item->rowId ) }}" title="" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng ?')">
														<i class="fa fa-trash top-cart-del"></i>
													</a>
												</p>
											</div>	
										</div>
									@endforeach
									<div class="dropdown-item cart-top-total">
										TỔNG <strong class="pull-right">{{ Cart::total() }}đ</strong>
									</div>
									<div class="dropdown-item cart-top-item">
										<a href="{{ asset('gio-hang') }}" title="" class="text-center btn">Xem giỏ hàng</a>
									</div>
								@else
									<div class="dropdown-item cart-top-item">
										{{ trans('lang.title45') }}
									</div>
								@endif
							</div>
						</div>
					</li>
					<li>
						<span class="top-lan">
							<img src="{{ asset('public/frontend') }}/images/global.png" alt="" title=""><!--  <i class="fas fa-sort-down"></i> -->
							<select name="" id="lang" class="">
								<option value="vi" {{ App::isLocale('vi') ? 'selected': null }}>Vi</option>
								<option value="en" {{ App::isLocale('en') ? 'selected': null }}>Eng</option>
							</select>
						</span>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="bg-white px150 top-second">
		<div class="container container-big">
			<div class="d-flex align-items-center justify-content-between tsecond-wrap">
				<img class="d-sm-none d-inline-block search-open" src="{{ asset('public/frontend') }}/images/search.png" alt="" title="" />
				<form action="{{ asset('tim-kiem') }}" class="position-relative search-frm" method="GET">
					<input type="text" required="required" placeholder="Tìm kiếm" class="form-control" name="search">
					<button class="btn search-btn" type="submit">
						<img src="{{ asset('public/frontend') }}/images/search.png" alt="" title="">
					</button>
				</form>
				<a href="{{ asset('/') }}" title="">
					<img class="logo" src="{{ asset( 'uploads/config/logo/'.$site_info->site_logo ) }}" alt="" title="">
				</a>
				<div class="dk-form">
					@if (Auth::check())
						<a href="{{ asset('account') }}" title="" class="btn login-btn">
							<i class="fas fa-user"></i> <span class="d-sm-inline-block d-none">{{ Auth::user()->name}} </span>
						</a>
						<a href="{{ asset('dang-xuat') }}" title="" class="btn login-btn">
							<i class="fas fa-sign-out-alt"></i>
							<span class="d-sm-inline-block d-none">
								{{ trans('lang.title13') }}
							</span>
						</a>
					@else
						<a href="{{ asset('dang-nhap') }}" title="" class="btn login-btn"><i class="fas fa-user"></i>
						<span class="d-sm-inline-block d-none">
							{{ trans('lang.title1') }}
						</span>
						</a>
						<a href="{{ asset('dang-ky') }}" title="" class="btn login-btn"><i class="fas fa-edit"></i> <span class="d-sm-inline-block d-none">{{ trans('lang.title2') }}</span></a>
					@endif
				</div>

			</div>
		</div>
	</div>
	<div class="px150 b2 top-three">
		<div class="container container-big">
			<!-- menu -->
			<nav id="menu" class="menu-wrap">	
				<ul class="menu">
					<li class="{{ Request::segment(1) == 'gioi-thieu' ? 'active' : null }}"><a href="{{ asset('gioi-thieu') }}" title="">{{ trans('lang.title11') }}</a></li>
					<li class="{{ Request::segment(1) == 'why-organic' ? 'active' : null }}" ><a href="{{ asset('why-organic') }}" title="" >WHY ORGANIC</a></li>
					<li class="{{ Request::segment(1) == 'san-pham' ? 'active' : null }}">
						<a href="{{ asset('san-pham') }}" title="" >{{ trans('lang.title10') }}</a>
					</li>
					<li class="{{ Request::segment(1) == 'danh-muc' ? 'active' : null }}">
						<a href="{{ asset('san-pham') }}" title="">{{ trans('lang.title9') }}</a>
						<ul class="">
							@foreach ($product_cat as $item)
								@if ($item->parent_id == 0)
									<li>
										<a href="javascript:0;" title="">
											@if (App::isLocale('vi'))
												{{ $item->name }}
											@else
												{{ $item->nameeg }}
											@endif
										</a>
										@if ( count( $item->get_child_cate() ) > 0 ) 
											<ul>
												@foreach ($item->get_child_cate() as $item2)
													<li>
														<a href="{{ asset( 'danh-muc/'. $item2->slug .'-p'. $item2->id ) }}">
															@if (App::isLocale('vi'))
																{{ $item2->name }}
															@else
																{{ $item2->nameeg }}
															@endif
														</a>
													</li>
												@endforeach
											</ul>
										@endif
									</li>
								@endif
							@endforeach				
						</ul>
					</li>
					<li class="{{ Request::segment(1) == 'album' ? 'active' : null }}"><a href="{{ asset('album') }}" title="">CATALOGE</a></li>
					<li class="{{ Request::segment(1) == 'tin-tuc' ? 'active' : null }}"><a href="{{ asset('tin-tuc') }}" title="">{{ trans('lang.title8') }} </a></li>
				</ul>
			</nav>
		</div>
	</div>
</header>