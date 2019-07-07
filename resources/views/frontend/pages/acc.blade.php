<?php use App\Models\Product;  ?>

@extends('frontend.master')
@section('main')
	<main class="">
		<div class="bread-wrap">
			<div class="container">
				<ul class="list-unstyled bread">
					<li><a href="index.html" title=""><i class="fas fa-home"></i> Trang chủ</a></li>
					<li><a href="acc.html" title="">Tài khoản</a></li>
				</ul>
			</div>
		</div>
		<section class="accpage">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-lg-3 col-md-4 col-sm-4">
						<aside class="vk-sidebar acc-aside">
							<div class="d-flex align-items-center acc-info">
								<a href="#" title=""><img src="{{ asset('public/frontend') }}/images/40.jpg" alt="" title=""></a>
								<div class="acc-info-content">
									<h2 class="t5 medium">
										<a href="#" title="">{{ Auth::user()->name }}</a></h2>
									<a class="acc-info-content-fix" href="#" id="editUser" title="">Chỉnh sửa tài khoản</a>
								</div>
							</div>
							<div id="acc-sum" class="acc-sum">
								<ul class="nav nav-pills wel-tabs"role="tablist">
									<li class="nav-item">
								    	<a class="active" data-toggle="pill" href="#acc1"><h2 class="medium t5 acc-list-tit">Quản lý đơn hàng</h2></a>
								  	</li>
								  	<li class="nav-item">
								    	<a class="" data-toggle="pill" href="#acc2"><i class="fas fa-tag mr-3"></i> Lịch sử đơn hàng</a>
								  	</li>
								  	<li class="nav-item">
								    	<a class="" data-toggle="pill" href="#acc3" id="accc3">
								    		<i class="fas fa-heart mr-3"></i> Sản phẩm yêu thích
								    	</a>
								  	</li>
								  	<li class="nav-item">
								    	<a class="" data-toggle="pill" href="#acc4"><img class="mr-3" src="{{ asset('public/frontend') }}/images/gift.png" alt="" title=""> Giỏ quà tặng</a>
								  	</li>
								</ul>
							</div>
						</aside>
					</div>
					<div class="col-lg-9 col-md-8 col-sm-8">
						<div class="tab-content acc-tab-content">
							<div class="tab-pane fade show active" id="acc1">
								<div class="acc-r">
									<h1 class="medium t5 acc-btit">Thông tin tài khoản</h1>
									<div class="d-flex justify-content-between align-items-start acc-r-wrap">
										<img class="avatar" src="{{ asset('public/frontend') }}/images/40.jpg" alt="" title="">
										<form action="{{ asset('account') }}" class="acc-r-frm" method="POST">
											@include('frontend.errors.errors')
											<div class="row">
												<div class="d-flex align-items-center col-sm-3">
													<label for="">Email</label>
												</div>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="doviettoank7d@gmail.com" required="required" value="{{ @$info->email }}" name="email">
												</div>
											</div>
											<div class="row">
												<div class="d-flex align-items-center col-sm-3">
													<label for="">Số điện thoại</label>
												</div>
												<div class="col-sm-9">
													<input type="tel" class="form-control" placeholder="0911077422" required="required" value="{{  @$info->phone }}" name="phone">
												</div>
											</div>
											<div class="row">
												<div class="d-flex align-items-center col-sm-3">
													<label for="">Họ tên</label>
												</div>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Đỗ Viết Toàn" required="required" value="{{  @$info->name }}" name="name">
												</div>
											</div>
											<div class="acc-gender-wrap">
												<div class="row">
													<div class="d-flex align-items-center col-sm-3">
														<label for="">Giới tính</label>
													</div>
													<div class="acc-gender col-sm-9 d-flex align-items-center">
														<label for="nam">
															<input name="gender" type="radio" value="1" {{ @$info->gender == 1 ? 'checked' : null }}  > Nam</label>
														<label for="nu">
															<input name="gender" type="radio" value="2" {{ @$info->gender == 2 ? 'checked' : null }}> Nữ</label>
													</div>
												</div>
											</div>
											<div class="row">
												<?php 
													@$birthday = $info->birthday;
													if($birthday != null){
														$birthday = explode('/', $birthday);
														$date = $birthday[0];
														$moth = $birthday[1];
														$year = $birthday[2];
													}
												?>
												<div class="d-flex align-items-start col-sm-3 acc-birthday">
													<label for="">Ngày sinh</label>
												</div>
												<div class="col-sm-9">
													<div class="row">
														<div class="col-4">
															<select class="form-control" name="date">
																@if (isset( $date ))
																	  <option value="{{ $date }}" selected>{{ $date }}</option>
																@endif
																	<option value="1">1</option>
															          <option value="2">2</option>
															          <option value="3">3</option>
															          <option value="4">4</option>
															          <option value="5">5</option>
															          <option value="6">6</option>
															          <option value="7">7</option>
															          <option value="8">8</option>
															          <option value="9">9</option>
															          <option value="10">10</option>
															          <option value="11">11</option>
															          <option value="12">12</option>
															          <option value="13">13</option>
															          <option value="14">14</option>
															          <option value="15">15</option>
															          <option value="16">16</option>
															          <option value="17">17</option>
															          <option value="18">18</option>
															          <option value="19">19</option>
															          <option value="20">20</option>
															          <option value="21">21</option>
															          <option value="22">22</option>
															          <option value="23">23</option>
															          <option value="24">24</option>
															          <option value="25">25</option>
															          <option value="26">26</option>
															          <option value="27">27</option>
															          <option value="28">28</option>
															          <option value="29">29</option>
															          <option value="30">30</option>
															          <option value="31">31</option>
															</select>
														</div>
														<div class="col-4">
															<select class="form-control" name="month">
																@if (isset( $moth ))
																	<option value="{{ $moth }}" selected>Tháng {{ $moth }}</option>
																	<option value="1">Tháng 1</option>
																	<option value="2">Tháng 2</option>
																	<option value="3">Tháng 3</option>
																	<option value="4">Tháng 4</option>
																	<option value="5">Tháng 5</option>
																	<option value="6">Tháng 6</option>
																	<option value="7">Tháng 7</option>
																	<option value="8">Tháng 8</option>
																	<option value="9">Tháng 9</option>
																	<option value="10">Tháng 10</option>
																	<option value="11">Tháng 11</option>
																	<option value="12">Tháng 12</option>
																@endif

															</select>
														</div>
														<div class="col-4">
															<select class="form-control" name="year">
																@if (isset( $year ))
																  <option value="{{ $year }}">{{ $year }}</option>
																@endif
																<option value="2014">2014</option>
														          <option value="2013">2013</option>
														          <option value="2012">2012</option>
														          <option value="2011">2011</option>
														          <option value="2010">2010</option>
														          <option value="2009">2009</option>
														          <option value="2008">2008</option>
														          <option value="2007">2007</option>
														          <option value="2006">2006</option>
														          <option value="2005">2005</option>
														          <option value="2004">2004</option>
														          <option value="2003">2003</option>
														          <option value="2002">2002</option>
														          <option value="2001">2001</option>
														          <option value="2000">2000</option>
														          <option value="1999">1999</option>
														          <option value="1998">1998</option>
														          <option value="1997">1997</option>
														          <option value="1996">1996</option>
														          <option value="1995">1995</option>
														          <option value="1994">1994</option>
														          <option value="1993">1993</option>
														          <option value="1992">1992</option>
														          <option value="1991">1991</option>
														          <option value="1990">1990</option>
														          <option value="1989">1989</option>
														          <option value="1988">1988</option>
														          <option value="1987">1987</option>
														          <option value="1986">1986</option>
														          <option value="1985">1985</option>
														          <option value="1984">1984</option>
														          <option value="1983">1983</option>
														          <option value="1982">1982</option>
														          <option value="1981">1981</option>
														          <option value="1980">1980</option>
														          <option value="1979">1979</option>
															</select>
														</div>
													</div>
													<a data-toggle="collapse" data-target="#changepw" href="#" class="acc-change">Thay đổi mật khẩu</a>
												</div>
											</div>
											<div id="changepw" class="collapse" >
										      <!-- <div class="card-body"> -->
										        <div class="row">
													<div class="d-flex align-items-center col-sm-3">
														<label for="">Mật khẩu cũ</label>
													</div>
													<div class="col-sm-9">
														<input type="password" class="form-control" placeholder="" name="password">
													</div>
												</div>
												<div class="row">
													<div class="d-flex align-items-center col-sm-3">
														<label for="">Mật khẩu mới</label>
													</div>
													<div class="col-sm-9">
														<input type="password" class="form-control" name="password_new">
													</div>
												</div>
												<div class="row">
													<div class="d-flex align-items-center col-sm-3">
														<label for="">Xác nhận mật khẩu mới</label>
													</div>
													<div class="col-sm-9">
														<input type="password" class="form-control" placeholder="" name="password_new_re">
													</div>
												</div>
										      <!-- </div> -->
										    </div>
										    <div class="row">
										    	<div class="col-sm-9 offset-sm-3">
										    		<div class="mt-4 acc-act">
														<button type="submit" class="btn cart-btn text-white medium">CẬP NHẬT</button>
														<input type="hidden" value="0" name="type" id="type">
													</div>
										    	</div>
										    </div>
										    {{ csrf_field() }}
										</form>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="acc2">
								<h2 class="medium t5 acc-btit">Lịch sử đơn hàng</h2>
								<div class="table-responsive acc-his-tbl">
									@if ( count($order_history) > 0)
										@foreach ($order_history as $item)
											<table class="table">
												<tr>
													<td colspan="2">
														<h3>Mã đơn hàng:  <span class="acc-code">#ORDER{{ $item->id }}</span> </h3>
														<h4>Đặt ngày:  {{ date_format(date_create($item['created_at']),"d/m/Y") }}</h4>
													</td>
													<td>
														<span class="d-block">Tổng tiền</span>
														<span class="d-block">
															{{ number_format($item['price_total']) }}đ
														</span>
													</td>
												</tr>
												@foreach ($item->order_detail as $detail)
													<?php 
														$product = Product::find($detail->product_id);
													?>
													@if (!empty($product))
														<tr>
															<td>
																<div class="d-flex align-items-start cart-item">
																	<a href="{{ asset('san-pham/'.$product->slug.'-p'.$product->id  ) }}" title="">
																		<img src="
																			{{ asset('uploads/product/avatar/'.$product->image ) }}" alt="" title="">
																	</a>
																	<div class="s14 cart-item-info">
																		<h3 class="medium t7 cart-item-info-tit"><a href="{{ asset('san-pham/'.$product->slug.'-p'.$product->id  ) }}" title="">{{ $product->name }}</a></h3>
																		<div class="pro-price">
																			@if (!empty($product->price_promotion))
																				<span class="bold t6 s16">{{ number_format($product->price_promotion) }}</span>
																				<del class="medium s14">
																					{{ number_format($product->price) }}
																				</del>
																			@else
																				<span class="bold t6 s16">{{ number_format($product->price) }}</span>
																			@endif
																		</div>
																	</div>
																</div>
															</td>
															<td>Số lượng: {{ $detail->product_quantity }}</td>
															<td>
																<a class="acc-his-link" href="{{ asset('san-pham/'.$product->slug.'-p'.$product->id  ) }}" title="">Chi tiết</a>
															</td>
														</tr>
													@endif
												@endforeach
											</table>
										@endforeach
									@else
										<div class="alert alert-danger background-danger alert-dismissible">
											<h4><i class="icon fa fa-ban"></i> <strong>Thông báo</strong></h4>
											<li>Bạn chưa có đơn hàng nào !</li>
										</div>
									@endif
								</div>
							</div>
							<div class="tab-pane fade" id="acc3">
								<h2 class="medium t5 acc-btit">Sản phẩm yêu thích</h2>
								<div class="acc-r-wrap">
									@if (count($wishlist)>0)
										<div class="row pro-row">
											@foreach ($wishlist as $item)
												<div class="col-lg-4 col-md-6 col-sm-6">
													<article class="pro-item">
														<figure class="position-relative text-center pro-item-img">
															<a href="{{ asset('san-pham/'.$item->product->slug.'-p'.$item->product->id  ) }}" title="">
																<img src="{{ asset('uploads/product/avatar/'.$item->product->image ) }}" alt="" title=""></a>
															<div class="pro-over medium">
																<a href="#" data-toggle="modal" data-target="#promodal{{ $item->id }}" title=""><i class="fas fa-eye"></i> XEM NHANH</a>
															</div>
														</figure>
														<figcaption class="pro-item-info">
															<h3 class="medium s14 pro-item-info-tit">
																<a href="{{ asset('san-pham/'.$item->product->slug.'-p'.$item->product->id  ) }}" title="">{{ $item->product->name }}</a></h3>
															<div class="pro-price">
																@if (!empty($item->product->price_promotion))
																	<span class="bold t6 s16">{{ number_format($item->product->price_promotion) }}</span>
																	<del class="medium s14">
																		{{ number_format($item->product->price) }}
																	</del>
																@else
																	<span class="bold t6 s16">
																		{{ number_format($item->product->price) }}</span>
																@endif
															</div>
															<span class="mt-4 d-inline-block t6 s14 acc-fav"><i class="fas fa-heart mr-2"></i>
																<a href="{{ asset('remove-wishlist/'.$item->id ) }}" title="">Bỏ yêu thích</a>
															</span>
														</figcaption>
													</article>
												</div>
											@endforeach
										</div>
									@else
										<div class="alert alert-danger background-danger alert-dismissible">
											<h4>
												<i class="icon fa fa-ban"></i> 
												<strong>Thông báo</strong></h4>
											<li>Bạn chưa có sản phẩm yêu thích nào !</li>
										</div>
									@endif
								</div>
							</div>
							<div class="tab-pane fade" id="acc4">
								<h2 class="medium t5 acc-btit">Giỏ quà tặng</h2>
								<div class="table-responsive acc-his-tbl">
									@if (count($order_gift_history) > 0)
										@foreach ($order_gift_history as $item)
											<table class="table">
												<tr>
													<td colspan="2">
														<h3>Mã đơn hàng:  <span class="acc-code">#ORDER{{ $item->id }}</span> </h3>
														<h4>Đặt ngày:  {{ date_format(date_create($item['created_at']),"d/m/Y") }}</h4>
													</td>
													<td>
														<span class="d-block">Tổng tiền</span>
														<span class="d-block">
															{{ number_format($item['price_total']) }}đ
														</span>
													</td>
												</tr>
												@foreach ($item->order_detail as $detail)
													<?php 
														$product = Product::find($detail->product_id);
													?>
													@if (!empty($product))
														<tr>
															<td>
																<div class="d-flex align-items-start cart-item">
																	<a href="{{ asset('san-pham/'.$product->slug.'-p'.$product->id  ) }}" title="">
																		<img src="
																			{{ asset('uploads/product/avatar/'.$product->image ) }}" alt="" title="">
																	</a>
																	<div class="s14 cart-item-info">
																		<h3 class="medium t7 cart-item-info-tit"><a href="{{ asset('san-pham/'.$product->slug.'-p'.$product->id  ) }}" title="">{{ $product->name }}</a></h3>
																		<div class="pro-price">
																			@if (!empty($product->price_promotion))
																				<span class="bold t6 s16">{{ number_format($product->price_promotion) }}</span>
																				<del class="medium s14">
																					{{ number_format($product->price) }}
																				</del>
																			@else
																				<span class="bold t6 s16">{{ number_format($product->price) }}</span>
																			@endif
																		</div>
																	</div>
																</div>
															</td>
															<td>Số lượng: {{ $detail->product_quantity }}</td>
															<td>
																<a class="acc-his-link" href="{{ asset('san-pham/'.$product->slug.'-p'.$product->id  ) }}" title="">Chi tiết</a>
															</td>
														</tr>
													@endif
												@endforeach
											</table>
										@endforeach
									@else
										<div class="alert alert-danger background-danger alert-dismissible">
											<h4><i class="icon fa fa-ban"></i> <strong>Thông báo</strong></h4>
											<li>Bạn chưa có đơn hàng nào !</li>
										</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		@foreach ($wishlist as $item)
			<?php $product = Product::find($item->id_product)  ?>
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
								<a class="position-relative MagicZoom" id="allstar{{ $product->id }}" href="#" data-options="selectorTrigger: hover;"  onclick="return false;">
									<img src="{{ asset('uploads/product/avatar/'.$product->image ) }}" alt=""/>
								</a>
								<div class="MagicScroll" id="ZoomScroll" data-options="height:120px;items: 5;autoplay: true;" data-mobile-options="items:3;width:100%;height: 80px;arrows:inside">
			                        <a data-zoom-id="allstar{{ $product->id }}" href="#" data-zoom-image="{{ asset('uploads/product/avatar/'.$product->image ) }}">
			                        	<img src="{{ asset('uploads/product/avatar/'.$product->image ) }}" alt="Hướng dẫn đổi trả">
			                        </a>
			                        @if ($product->more_image != null)
										@php
											$list_image = json_decode($product->more_image);
										@endphp
										@foreach ($list_image as $imageItem)
											<a data-zoom-id="allstar{{ $product->id }}" href="#" data-image="{{ asset('uploads/product/prod/'.$imageItem) }}" onclick="return false;">
			                        			<img src="{{ asset('uploads/product/prod/'.$imageItem) }}" alt=""/>
				                        	</a>
										@endforeach   
									@endif
			                    </div>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="pdetail-r">
								<h1 class="s30 t5 light pdetail-tit">{{ $product->name }}</h1>
								<div class="py-3 pdetail-price">
									@if ($product->price_promotion != null )
										<span class="bold t6 s16"> {{ number_format($product->price_promotion) }}đ</span>
										<del class="medium s14">{{ number_format($product->price) }}đ</del>
									@else
										<span class="bold t6 s16"> {{ number_format($product->price) }}đ</span>
									@endif
								</div>
								<div class="pdetail-content">
									{!! $product->content_short !!}
								</div>
								<div class="d-flex align-items-baseline pdetail-warm b5">
									<img src="{{ asset('public/frontend') }}/images/19.png" alt="" title="">
									<ul class="list-unstyled pdetail-wram-list">
										{!! $product->content_promotion !!}
									</ul>
								</div>
								<form action="{{ asset ( 'gio-hang/'.$product->id ) }}" method="POST">
								<div class="pdetail-choice">
									<div class="row">
										<div class="col-sm-6">
											<div class="d-flex align-items-center justify-content-between pdetail-choice-item">
												<label for="">Số lượng</label> 
												<input type="number" min="1" max="" value="1" name="qty">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="d-flex align-items-center justify-content-between pdetail-choice-item">
												<label for="">Chất liệu</label> 
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
												<select name="size">
													@foreach ($product->size as $size)
														<option value="{{ $size->id }}">{{ $size->name }}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
									<div class="d-flex pdetail-act">
										<button type="submit" name="addCart" title="" class="btn cart-btn">THÊM VÀO GIỎ HÀNG</button> 
										<button type="submit" name="paynow" value="1" class="btn cart-btn" style="width: 100%;background: white;border: 1px solid #fb929e; color: #fb929e;">MUA NGAY</button> 
									</div>
									<ul class="list-unstyled s14 medium pdetail-select">
										<li>
											<a href="{{ asset( 'add-wishlist/'.$item->id ) }}" title="">
												<i class="fas fa-heart"></i> THÊM VÀO YÊU THÍCH
											</a>
										</li>
										<li><a href="#" title=""><img src="{{ asset('public/frontend') }}/images/gift.png" alt="" title=""> CHỌN LÀM QUÀ TẶNG</a></li>
									</ul>
									<ul class="list-unstyled d-flex align-items-center pdetail-share">
										<li>Chia sẻ:</li>
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
@stop
@section('script')
	<script src="{{ asset('public/frontend/') }}/js/jquery.barrating.min.js"></script>
	<script src="{{ asset('public/frontend/') }}/js/magiczoomplus.js"></script>
	<script src="{{ asset('public/frontend/') }}/js/magicscroll.js"></script>
	<script>
		jQuery(document).ready(function($) {
			$('.acc-change').click(function(event) {
				if($('#type').val()== 0){
					$('#type').val(1)
				}else{
					$('#type').val(0)
				}
			});
		});
	</script>
	<script>
		$(function() {
			var pageURL = $(location).attr("href");
			var page = pageURL.split("#");
			if(page[1] == 'acc3'){
				$('#accc3').addClass('active show')
				$('#acc1').removeClass('active');
				$('#acc1').removeClass('show');
				$('#acc3').addClass('active');
				$('#acc3').addClass('show');
			}
		});
	</script>
	<script>
		$(document).ready(function () {
			$('#editUser').click(function (e) { 
				$('.tab-pane.fade').removeClass('active show');
				$('#acc1').addClass('active show');
			});
			
		});
	</script>
@endsection
@section('css')
		<link rel="stylesheet" href="{{ asset('public/frontend/') }}/css/magiczoomplus.css">
		<link rel="stylesheet" href="{{ asset('public/frontend/') }}/css/magicscroll.css">
@endsection
