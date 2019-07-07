@extends('frontend.master')
@section('main')
	<main class="">
		<section class="cart">
			<div class="bread-wrap">
				<div class="container">
					<ul class="list-unstyled bread">
						<li><a href="{{ asset('/') }}" title=""><i class="fas fa-home"></i> {{ trans('lang.title12') }}</a></li>
						<li><a href="#" title="">{{ trans('lang.title3') }}</a></li>
					</ul>
				</div>
			</div>
			<div class="container">
				<h1 class="medium s18 t5 login-tit">{{ trans('lang.title3') }}</h1>
				<div class="row">
					@if (Cart::count() > 0)
					<div class="col-lg-9 col-md-8">
						<div class="table-responsive cart-btl">
							<table class="table">
							  	<tbody>
							    	@foreach (Cart::content() as $item)
								    	<tr>
								      		<td scope="row">
												<div class="d-flex align-items-center cart-item">
													<a href="{{ asset('san-pham/'.str_slug($item->name).'-p'.$item->id ) }}" title="">
														<img src="{{ asset('uploads/product/avatar/'.$item->options->image ) }}" alt="" title=""></a>
													<div class="s14 cart-item-info">
														<h3 class="medium t7 cart-item-info-tit">
															<a href="{{ asset('san-pham/'.str_slug($item->name).'-p'.$item->id ) }}" title="">{{ $item->name }}</a>
														</h3>
														<h4 class="normal">{{ trans('lang.title23') }}: 
															<span class="italic">{{ $item->options->material }}</span>
														</h4>
													</div>
												</div>
								      		</td>
								      		<td class="medium t6">{{ number_format($item->price) }}đ</td>
								      		<td>
								      			<input type="number" min="1" max="" value="{{ $item->qty }}" class="upDateQty" data-id="{{ $item->rowId }}">
								      		</td>
								      		<td class="medium t6">
								      			{{ number_format( $item->price * $item->qty ) }}đ
								      		</td>
								      		<td>
								      			<a href="{{ asset( 'cart/'.$item->rowId ) }}" title="" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng ?')">
								      				<i class="fas fa-trash"></i>
								      			</a>
								      		</td>
								    	</tr>
							    	@endforeach
							  	</tbody>
							</table>
						</div>
					</div>
					<div class="col-lg-3 col-md-4">
						<aside class="cart-aside">
							<h3 class="s18 t5 medium cart-aside-tit">Đặt hàng</h3>
							<h4 class="text-right t5 medium cart-stt">Tổng tiền : <span class="s24 t6">{{ Cart::total() }}đ</span></h4>

							<a href="{{ asset('thanh-toan') }}" title="" class="w-100 medium btn cart-btn">
								THANH TOÁN
							</a>
							<a href="{{ asset('tang-qua') }}" title="" class="w-100 medium btn gift-btn">
								TẶNG QUÀ
							</a>
						</aside>
					</div>
					@else
					<div class="col-lg-9 col-md-8">
						<h2 style="font-size: 20px">Không có sản phẩm nào trong giỏ hàng !</h2>
						<a href="{{ asset('/') }}" class="cart-home">
							Mua sắm ngay
						</a>
					</div>
					@endif
				</div>
			</div>
		</section>
	</main>
@endsection

@section('script')
	<script>
		
		jQuery(document).ready(function($) {
			$('.upDateQty').change(function(event) {
				var $rowId = $(this).attr("data-id");
				$.ajax({
					url: '{{ asset('upDateCart') }}',
					type: 'GET',
					data: {
						rowId: $rowId,
						qty: $(this).val()
					},
				})
				.done(function() {
					location.reload();
				})
			});			
		});
	</script>
@endsection
