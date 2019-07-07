@extends('frontend.master')
@section('meta', $product->meta_description)
@section('main')
	<main class="">
		<div class="bread-wrap">
			<div class="container">
				<ul class="list-unstyled bread">
					<li><a href="{{ asset('/') }}" title=""><i class="fas fa-home"></i> {{ trans('lang.title12') }}</a></li>
					<li><a href="{{ asset('san-pham') }}" title="">{{ trans('lang.title9') }}</a></li>
				</ul>
			</div>
		</div>
		<section class="pt-4 pdetail">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 col-md-9 col-sm-8">
						<div class="row">
							<div class="col-lg-7">
								<div class="pdetail-l">
									<a class="position-relative MagicZoom" id="allstar" href="#" data-options="selectorTrigger: hover;"  onclick="return false;">
										<img src="{{ asset('uploads/product/avatar/'.$product->image ) }}" alt=""/>
										@if ($product->sale != 0)
											<span class="position-absolute sale s14 text-white">-{{ $product->sale }}%</span>
										@endif
									</a>
								<div class="MagicScroll" id="ZoomScroll" data-options="height:120px;items: 4;autoplay: true;" data-mobile-options="items:3;width:100%;height: 123px;arrows:inside">
			                        <a data-zoom-id="allstar" href="{{ asset('uploads/product/avatar/'.$product->image ) }}" data-zoom-image="{{ asset('uploads/product/avatar/'.$product->image ) }}">
			                        	<img src="{{ asset('uploads/product/avatar/'.$product->image ) }}" alt="Hướng dẫn đổi trả">
			                        </a>
									@if ($product->more_image != null)
									<?php $list_image = json_decode($product->more_image) ?>
										@foreach ($list_image as $imageItem)
					                        <a data-zoom-id="allstar" href="{{ asset('uploads/product/prod/'.$imageItem ) }}" data-image="{{ asset('uploads/product/prod/'.$imageItem ) }}" onclick="return false;">
					                        	<img src="{{ asset('uploads/product/prod/'.$imageItem ) }}" alt=""/>
					                        </a>
										@endforeach
									@endif
				           </div>
								</div>
							</div>
							<div class="col-lg-5">
								<form action="{{ asset ( 'gio-hang/'.$product->id ) }}" method="POST">
									<div class="pdetail-r">
										<h1 class="s30 t5 light pdetail-tit">
											@if (App::isLocale('vi'))
												{{ $product->name }}
											@else
												{{ $product->nameeg }}
											@endif
										</h1>
										<div class="py-3 pdetail-price">
											@if ($product->status == 2 )
												@if ($product->price_promotion != null )
													<span class="bold s30 t6 pr-4"> {{ number_format($product->price_promotion) }}đ</span>
													<del class="medium s27">{{ number_format($product->price) }}đ</del>
												@else
													<span class="bold s30 t6 pr-4"> {{ number_format($product->price) }}đ</span>
												@endif
											@else
												<span class="bold s30 t6 pr-4"> {{ number_format($product->price) }}đ</span>
											@endif
										</div>
										<div class="pdetail-content">
											@if (App::isLocale('vi'))
												{!! $product->content_short !!}
											@else
												{!! $product->content_shorteg !!}
											@endif
											
										</div>
										<div class="d-flex align-items-baseline pdetail-warm b5">
											<img src="{{ asset('public/frontend') }}/images/19.png" alt="" title="">
											<ul class="list-unstyled pdetail-wram-list">
												@if (App::isLocale('vi'))
													{!! $product->content_promotion !!}
												@else
													{!! $product->content_promotioneg !!}
												@endif
												
											</ul>
										</div>

										<div class="pdetail-choice mainProduct">
											<div class="row">
												<div class="col-sm-6">
													<div class="d-flex align-items-center justify-content-between pdetail-choice-item">
														<label for="">{{ trans('lang.title22') }}</label>
														<input type="number" min="1" max="" value="1" name="qty">
													</div>
													

												</div>
												<div class="col-sm-6">
													<div class="d-flex align-items-center justify-content-between pdetail-choice-item">
														<label for="">{{ trans('lang.title23') }}</label> 
														<select name="material" id="">
														@foreach ($product->material as $material)
															<option value="{{ $material->id }}">{{ $material->name }}</option>
														@endforeach
														</select>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="d-flex align-items-center justify-content-between pdetail-choice-item">
														<label for="">Size</label> 
														<select name="size" id="">
														@foreach ($product->size as $size)
															<option value="{{ $size->id }}">{{ $size->name }}</option>
														@endforeach
														</select>
													</div>
												</div>
											</div>
											<div class="d-flex pdetail-act">
												<button type="submit" name="addCart" title="" class="btn cart-btn">{{ trans('lang.title24') }}</button> 
												<button type="submit" name="paynow" value="1" class="btn cart-btn" style="width: 100%;background: white;border: 1px solid #fb929e; color: #fb929e;">{{ trans('lang.title27') }}</button> 
											</div>
											<ul class="list-unstyled s14 medium pdetail-select">
												<li>
													<a href="{{ asset( 'add-wishlist/'.$product->id ) }}" title="">
														<i class="fas fa-heart"></i>
														{{ trans('lang.title25') }}
													</a>
												</li>
												<li>
													<a href="{{ asset( 'addGift/'.$product->id ) }}" title="" class="add_gift">
														<img src="{{ asset('public/frontend/') }}/images/gift.png" alt="" title="">
													{{ trans('lang.title26') }}
													</a>
												</li>
											</ul>
											<ul class="list-unstyled d-flex align-items-center pdetail-share">
												<li>{{ trans('lang.title15') }}:</li>
												<li><a href="#"><i class="fab fa-facebook"></i></a></li>
												<li><a href="#"><i class="fab fa-pinterest-square"></i></a></li>
												<li><a href="#"><i class="fab fa-instagram"></i></a></li>
											</ul>
										</div>
										<div class="pdetail-kethop">
											@if (!empty($combined_products))
											<h3 class="medium t5 pb-4 pdetail-kh-tit">SẢN PHẨM KẾT HỢP</h3>
											<div class="pdetail-kh-wrap">
												@foreach ($combined_products as $item)
													<article class="d-flex align-items-start pro-item">
														<figure class="position-relative text-center pro-item-img">
															<a href="{{ asset( 'san-pham/'.$item->slug.'-p'.$item->id ) }}" title="">
																<img src="{{ asset( 'uploads/product/avatar/'.$item->image ) }}" alt="" title="">
															</a>
															<div class="pro-over medium">
																<a href="#" data-toggle="modal" data-target="#combined_products{{ $item->id }}" title=""><i class="fas fa-eye"></i> {{ trans('lang.title21') }}</a>
															</div>
														</figure>
														<figcaption class="pro-item-info">
															<h3 class="medium s14 pro-item-info-tit"><a href="{{ asset( 'san-pham/'.$item->slug.'-p'.$item->id ) }}" title="">
																@if (App::isLocale('vi'))
																	{!! $item->name !!}
																@else
																	{!! $item->nameeg !!}
																@endif</a></h3>
															<div class="pro-price">
																@if ($item->status == 2)
																	@if (empty($item->price_promotion ))
																		<span class="bold t6 s16">{{ number_format($item->price_promotion) }}đ</span>
																		<del class="medium s16">{{ number_format($item->price) }}đ<</del>
																		<input type="hidden" name="price" value="{{ $item->price_promotion }}">
																	@else
																		<span class="bold t6 s16">{{ number_format($item->price) }}đ</span>
																		<input type="hidden" name="price" value="{{ $item->price }}">
																	@endif
																@else
																	<span class="bold t6 s16">{{ number_format($item->price) }}đ</span>
																		<input type="hidden" name="price" value="{{ $item->price }}">
																@endif
															</div>
														</figcaption>
													</article>
												@endforeach
												<a href="javascript:;" data-id="{{ $product->id }}" title="" class="btn text-white medium s13 cart-btn cart-add-muti">Thêm {{ count($combined_products)+1 }} sản phẩm vào giỏ hàng</a>
											</div>
											@endif
										</div>
									</div>
									{!! csrf_field() !!}
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-md-3 col-sm-4">
						<aside class="pdetail-aside">
							@if ( !$related_products->isEmpty() )
								<h2 class="medium t5 pb-4 pdetail-aside-tit">{{ trans('lang.title30') }}</h2>
							@endif
							<div class="pdetail-reitem">
								@foreach ($related_products as $item)
									<article class="pro-item pro-item-custtom">
										<figure class="position-relative text-center pro-item-img">
											<a href="{{ asset('san-pham/'.$item->slug.'-p'.$item->id ) }}" title=""><img src="{{ asset( 'uploads/product/avatar/'.$item->image ) }}" alt="" title=""></a>
											<div class="pro-over medium">
												<a href="#" data-toggle="modal" data-target="#related_products{{ $item->id }}" title=""><i class="fas fa-eye"></i> {{ trans('lang.title21') }}</a>
											</div>
										</figure>
										<figcaption class="pro-item-info">
											<h3 class="medium s14 pro-item-info-tit">
												<a href="{{ asset('san-pham/'.$item->slug.'-p'.$item->id ) }}" title="">
												@if (App::isLocale('vi'))
													{!! $item->name !!}
												@else
													{!! $item->nameeg !!}
												@endif
											</a></h3>
											<div class="pro-price">
												@if ( $item->status ==2 )
													@if ( $item->price_promotion != null )
														<span class="bold t6 s16">{{ number_format($item->price_promotion) }}đ</span>
														<del class="medium s16">{{ number_format($item->price) }}đ</del>
													@else
														<span class="bold t6 s16">{{ number_format($item->price) }}đ</span>
													@endif
												@else
													<span class="bold t6 s16">{{ number_format($item->price) }}đ</span>
												@endif
											</div>
										</figcaption>
									</article>
								@endforeach
							</div>
						</aside>
					</div>
				</div>
				<div class="pdetail-content">
					<h3 class="medium t7 s16 pdetail-content-tit"><span>{{ trans('lang.titel31') }}</span></h3>
					<div class="pdetail-content-wrap">
						@if (App::isLocale('vi'))
							{!! $product->content_main !!}
						@else
							{!! $product->content_mainrg !!}
						@endif
					</div>
				</div>
			</div>
		</section>

		@foreach ($related_products as $item)
			
		<!-- Modal -->
		<div class="modal fade promodal" id="related_products{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		      </button>
		      <div class="modal-body">
		        <div class="row">
					<div class="col-lg-7">
						<div class="pdetail-l">
							<a class="position-relative MagicZoom" id="allstar{{ $item->id }}" href="{{ asset('uploads/product/avatar/'.$item->image ) }}" data-options="selectorTrigger: hover;"  onclick="return false;">
								<img src="{{ asset('uploads/product/avatar/'.$item->image ) }}" alt=""/>
							</a>
							<div class="MagicScroll" id="ZoomScroll" data-options="height:120px;items: 5;autoplay: true;" data-mobile-options="items:3;width:100%;height: 80px;arrows:inside">
		                        <a data-zoom-id="allstar{{ $item->id }}" href="{{ asset('uploads/product/avatar/'.$item->image ) }}" data-zoom-image="{{ asset('uploads/product/avatar/'.$item->image ) }}">
		                        	<img src="{{ asset('uploads/product/avatar/'.$item->image ) }}" alt="Hướng dẫn đổi trả">
		                        </a>
		                        @if ($item->more_image != null)
									@php
										$list_image = json_decode($item->more_image);
									@endphp
									@foreach ($list_image as $imageItem)
										<a data-zoom-id="allstar{{ $item->id }}" href="#" data-image="{{ asset('uploads/product/prod/'.$imageItem) }}" onclick="return false;">
		                        			<img src="{{ asset('uploads/product/prod/'.$imageItem) }}" alt=""/>
			                        	</a>
									@endforeach   
								@endif
		                    </div>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="pdetail-r">
							<h1 class="s30 t5 light pdetail-tit">
								@if (App::isLocale('vi'))
									{{ $item->name }}
								@else
									{{ $item->nameeg }}
								@endif
							</h1>
							<div class="py-3 pdetail-price">
								@if ($item->price_promotion != null )
									<span class="bold t6 s16"> {{ number_format($item->price_promotion) }}đ</span>
									<del class="medium s14">{{ number_format($item->price) }}đ</del>
								@else
									<span class="bold t6 s16"> {{ number_format($item->price) }}đ</span>
								@endif
							</div>
							<div class="pdetail-content">
								
								@if (App::isLocale('vi'))
									{!! $item->content_short !!}
								@else
									{!! $item->content_shorteg !!}
								@endif
							</div>
							<div class="d-flex align-items-baseline pdetail-warm b5">
								<img src="{{ asset('public/frontend') }}/images/19.png" alt="" title="">
								<ul class="list-unstyled pdetail-wram-list">
									@if (App::isLocale('vi'))
										{!! $item->content_promotion !!}
									@else
										{!! $item->content_promotioneg !!}
									@endif
								</ul>
							</div>
							<form action="{{ asset ( 'gio-hang/'.$item->id ) }}" method="POST">
							<div class="pdetail-choice">
								<div class="row">
									<div class="col-sm-6">
										<div class="d-flex align-items-center justify-content-between pdetail-choice-item">
											<label for="">{{ trans('lang.title22') }}</label> 
											<input type="number" min="1" max="" value="1" name="qty">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="d-flex align-items-center justify-content-between pdetail-choice-item">
											<label for="">{{ trans('lang.title23') }}</label> 
											<select name="material" id="">
												@foreach ($item->material as $material)
													<option value="{{ $material->id }}">{{ $material->name }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="d-flex align-items-center justify-content-between pdetail-choice-item">
											<label for="">Size</label> 
											<select name="size">
												@foreach ($item->size as $size)
													<option value="{{ $size->id }}">{{ $size->name }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="d-flex pdetail-act">
									<button type="submit" name="addCart" title="" class="btn cart-btn">
										{{ trans('lang.title24') }}
									</button> 
									<button type="submit" name="paynow" value="1" class="btn cart-btn" style="width: 100%;background: white;border: 1px solid #fb929e; color: #fb929e;">{{ trans('lang.title27') }}</button> 
								</div>
								<ul class="list-unstyled s14 medium pdetail-select">
									<li>
										<a href="{{ asset( 'add-wishlist/'.$item->id ) }}" title="">
											<i class="fas fa-heart"></i> {{ trans('lang.title25') }}
										</a>
									</li>
									<li><a href="#" title=""><img src="{{ asset('public/frontend') }}/images/gift.png" alt="" title=""> {{ trans('lang.title26') }}</a></li>
								</ul>
								<ul class="list-unstyled d-flex align-items-center pdetail-share">
									<li>{{ trans('lang.title15') }}:</li>
									<li><a href="#"><i class="fab fa-facebook"></i></a></li>
									<li><a href="#"><i class="fab fa-pinterest-square"></i></a></li>
									<li><a href="#"><i class="fab fa-instagram"></i></a></li>
								</ul>
							</div>
							{{ csrf_field() }}
							</form>
						</div>
					</div>
				</div>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- End Modal -->
		@endforeach

		@if (!empty($combined_products))
			@foreach ($combined_products as $item)
				
		<!-- Modal -->
		<div class="modal fade promodal" id="combined_products{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		      </button>
		      <div class="modal-body">
		        <div class="row">
					<div class="col-lg-7">
						<div class="pdetail-l">
							<a class="position-relative MagicZoom" id="allstar{{ $item->id }}" href="#" data-options="selectorTrigger: hover;"  onclick="return false;">
								<img src="{{ asset('uploads/product/avatar/'.$item->image ) }}" alt=""/>
							</a>
							<div class="MagicScroll" id="ZoomScroll" data-options="height:120px;items: 5;autoplay: true;" data-mobile-options="items:3;width:100%;height: 80px;arrows:inside">
		                        <a data-zoom-id="allstar{{ $item->id }}" href="#" data-zoom-image="{{ asset('uploads/product/avatar/'.$item->image ) }}">
		                        	<img src="{{ asset('uploads/product/avatar/'.$item->image ) }}" alt="Hướng dẫn đổi trả">
		                        </a>
		                        @if ($item->more_image != null)
									@php
										$list_image = json_decode($item->more_image);
									@endphp
									@foreach ($list_image as $imageItem)
										<a data-zoom-id="allstar{{ $item->id }}" href="#" data-image="{{ asset('uploads/product/prod/'.$imageItem) }}" onclick="return false;">
											<img src="{{ asset('uploads/product/prod/'.$imageItem) }}" alt=""/>
										</a>
									@endforeach   
								@endif
		                    </div>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="pdetail-r">
							<h1 class="s30 t5 light pdetail-tit">
								@if (App::isLocale('vi'))
									{{ $item->name }}
								@else
									{{ $item->nameeg }}
								@endif
							</h1>
							<div class="py-3 pdetail-price">
								@if ($item->price_promotion != null )
									<span class="bold t6 s16"> {{ number_format($item->price_promotion) }}đ</span>
									<del class="medium s14">{{ number_format($item->price) }}đ</del>
								@else
									<span class="bold t6 s16"> {{ number_format($item->price) }}đ</span>
								@endif
							</div>
							<div class="pdetail-content">
								
								@if (App::isLocale('vi'))
									{!! $item->content_short !!}
								@else
									{!! $item->content_shorteg !!}
								@endif
							</div>
							<div class="d-flex align-items-baseline pdetail-warm b5">
								<img src="{{ asset('public/frontend') }}/images/19.png" alt="" title="">
								<ul class="list-unstyled pdetail-wram-list">
									@if (App::isLocale('vi'))
										{!! $item->content_promotion !!}
									@else
										{!! $item->content_promotioneg !!}
									@endif
								</ul>
							</div>
							<form action="{{ asset ( 'gio-hang/'.$item->id ) }}" method="POST">
							<div class="pdetail-choice">
								<div class="row">
									<div class="col-sm-6">
										<div class="d-flex align-items-center justify-content-between pdetail-choice-item">
											<label for="">{{ trans('lang.title22') }}</label> 
											<input type="number" min="1" max="" value="1" name="qty">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="d-flex align-items-center justify-content-between pdetail-choice-item">
											<label for="">{{ trans('lang.title23') }}</label> 
											<select name="material" id="">
												@foreach ($item->material as $material)
													<option value="{{ $material->id }}">{{ $material->name }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="d-flex align-items-center justify-content-between pdetail-choice-item">
											<label for="">Size</label> 
											<select name="size">
												@foreach ($item->size as $size)
													<option value="{{ $size->id }}">{{ $size->name }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="d-flex pdetail-act">
									<button type="submit" name="addCart" title="" class="btn cart-btn">
										{{ trans('lang.title24') }}
									</button> 
									<button type="submit" name="paynow" value="1" class="btn cart-btn" style="width: 100%;background: white;border: 1px solid #fb929e; color: #fb929e;">{{ trans('lang.title27') }}</button> 
								</div>
								<ul class="list-unstyled s14 medium pdetail-select">
									<li>
										<a href="{{ asset( 'add-wishlist/'.$item->id ) }}" title="">
											<i class="fas fa-heart"></i> {{ trans('lang.title25') }}
										</a>
									</li>
									<li>
										<a href="#" title="" id="btn_gift">
											<img src="{{ asset('public/frontend') }}/images/gift.png" alt="" title=""> {{ trans('lang.title26') }}
										</a>
									</li>
								</ul>
								<ul class="list-unstyled d-flex align-items-center pdetail-share">
									<li>{{ trans('lang.title15') }}:</li>
									<li><a href="#"><i class="fab fa-facebook"></i></a></li>
									<li><a href="#"><i class="fab fa-pinterest-square"></i></a></li>
									<li><a href="#"><i class="fab fa-instagram"></i></a></li>
								</ul>
							</div>
							{{ csrf_field() }}
							</form>
						</div>
					</div>
				</div>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- End Modal -->
			@endforeach
		@endif
	</main>
@endsection
@section('css')
	<link rel="stylesheet" href="{{ asset('public/frontend/') }}/css/magiczoomplus.css">
	<link rel="stylesheet" href="{{ asset('public/frontend/') }}/css/magicscroll.css">
@endsection
@section('script')
	<script src="{{ asset('public/frontend/') }}/js/jquery.barrating.min.js"></script>
	<script src="{{ asset('public/frontend/') }}/js/magiczoomplus.js"></script>
	<script src="{{ asset('public/frontend/') }}/js/magicscroll.js"></script>
	<script>
		jQuery(document).ready(function($) {
			$('.cart-add-muti').click(function(event) {
				$size = $('.mainProduct select[name=size]').val();
				$material = $('.mainProduct select[name=material]').val();
				$id = $(this).attr("data-id")
				$.ajax({
					url: '{{ asset('addMutiProduct') }}/'+$id,
					type: 'GET',
					data: {
						qty: 1,
						material: $material,
						size : $size
					},
				})
				.done(function($data) {
					if($data =='Ok' ){
						alert("Đã thêm tất cả các sản phẩm kết hợp vào giỏ hàng !");
						location.reload();
					}
				})
				
			});
		});
	</script>
@endsection