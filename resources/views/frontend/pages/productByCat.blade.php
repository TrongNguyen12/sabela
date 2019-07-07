@extends('frontend.master')
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
		<section class="pro">
			<div class="container">
				<div class="row">
					@include('frontend.block.sidebarCat')
					<div class="col-lg-9 col-md-8 col-sm-8 order-sm-12 order-1">
						<div class="pro-control s14 d-flex align-items-center justify-content-end py-4">
							{{ trans('lang.title17') }}
							<select class="ml-3" id="sort">
								<option value="NEW">{{ trans('lang.title18') }}</option>
								<option value="AZ" {{ Request::get('sort') == 'AZ' ? 'selected' : null }}>A - Z</option>
								<option value="DESC" {{ Request::get('sort') == 'DESC' ? 'selected' : null }} >{{ trans('lang.title19') }}</option>
								<option value="ASC" {{ Request::get('sort') == 'ASC' ? 'selected' : null }}>{{ trans('lang.title20') }}</option>
							</select>
						</div>
						<div class="row pro-row">
							@foreach ($products as $item)
								<div class="col-lg-4 col-md-6 col-sm-6">
									<article class="pro-item">
										<figure class="position-relative text-center pro-item-img">
											<a href="{{ asset('san-pham/'.$item->slug.'-p'.$item->id  ) }}" title="">
												<img src="{{ asset('uploads/product/avatar/'.$item->image ) }}" alt="" title=""></a>
											<div class="pro-over medium">
												<a href="javascript:;" data-toggle="modal" data-target="#promodal{{ $item->id }}" title=""><i class="fas fa-eye"></i>
													{{ trans('lang.title21') }}
												</a>
											</div>
										</figure>
										<figcaption class="pro-item-info">
											<h3 class="medium s14 pro-item-info-tit">
												<a href="{{ asset('san-pham/'.$item->slug.'-p'.$item->id  ) }}" title="">
													@if (App::isLocale('vi'))
														{{ $item->name }}
													@else
														{{ $item->nameeg }}
													@endif
												</a></h3>
											<div class="pro-price">
												@if ($item->status == 2)
													@if ($item->price_promotion != null )
														<span class="bold t6 s16"> {{ number_format($item->price_promotion) }}đ</span>
														<del class="medium s14">{{ number_format($item->price) }}đ</del>
													@else
														<span class="bold t6 s16"> {{ number_format($item->price) }}đ</span>
													@endif
												@else
													<span class="bold t6 s16"> {{ number_format($item->price) }}đ</span>
												@endif
											</div>
										</figcaption>
									</article>
								</div>
							@endforeach
						</div>
						<ul class="pagi">
							{{ $products->links() }}
						</ul>
					</div>
				</div>
			</div>
		</section>
		@foreach ($products as $item)

		<!-- Modal -->
		<div class="modal fade promodal" id="promodal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
							<h1 class="s30 t5 light pdetail-tit">{{ $item->name }}</h1>
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
									<button type="submit" name="addCart" title="" class="btn cart-btn">{{ trans('lang.title27') }}</button> 
									<button type="submit" name="paynow" value="1" class="btn cart-btn" style="width: 100%;background: white;border: 1px solid #fb929e; color: #fb929e;">{{ trans('lang.title24') }}</button> 
								</div>
								<ul class="list-unstyled s14 medium pdetail-select">
									<li><a href="#" title=""><i class="fas fa-heart"></i>{{ trans('lang.title27') }}</a></li>
									<li><a href="#" title=""><img src="{{ asset('public/frontend') }}/images/gift.png" alt="" title=""> {{ trans('lang.title25') }}</a></li>
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
			$('#sort').change(function(event) {
				if($(this).val().length>0){
					window.location.href = '{{  URL::current() }}?sort='+$(this).val();
				}else{
					window.location.href = '{{  URL::current() }}';
				}
			});
		});
	</script>
@endsection