<?php use App\Models\Category;  ?>
@extends('frontend.master')
@section('main')
		<main class="">
			<h1 class="text-center f2 page-tit">
				<span class="s24 t2 d-block">KHÁM PHÁ</span>
				<span class="s48 t3 d-block">CỬA HÀNG</span>
			</h1>
			<section class="slider-wrap">
				<div class="container container-big">
					<div class="index-slider">
						@foreach ($slider as $item)
							<a href="{{ $item->link }}" title="{{ $item->content }}">
								<img data-lazy="{{ asset( 'uploads/slider/'.$item->image ) }} " alt="" title="">
							</a>
						@endforeach
					</div>
				</div>
			</section>
			<section class="cate">
				<div class="container container-big">
					<div class="mx150">
						<div class="cate-slider">
							@foreach ($settingHome as $item)
								<article class="text-center cate-item">
									<figure class="cate-item-img">
										<?php
											$type = $item->type;
											if ( $type == 2 ){
												$link = $item->link;
											}elseif( $type == 1 ){
												$link = asset('sale');
											}elseif( $type == 3 ){
												$link = asset( 'sale/'.$item->value.'.html' );
											}elseif( $type == 4 ){
												$category = Category::find($item->value);
												$link = asset( 'danh-muc/'.$category->slug.'-p'.$category->id );
											}else{
												$link = asset('san-pham');
											}
										?>
										<a href="{{ $link }}" title="">
											<img src="{{ asset( 'uploads/home/config/'.$item->image ) }}" alt="" title="">
										</a>
									</figure>
									<figcaption class="cate-item-info">
										<h2 class="bold s18 cate-item-tit">
											<a href="{{ $link }}" title="">
												@if (App::isLocale('vi'))
													{{ $item->name }}
												@else
													{{ $item->nameeg }}
												@endif
											</a>
										</h2>
										<a href="{{ $link }}" title="">
											<i class="fas fa-chevron-circle-right t3 s24"></i>
										</a>
									</figcaption>
								</article>
							@endforeach
						</div>
					</div>
					
				</div>
			</section>
		</main>
@endsection