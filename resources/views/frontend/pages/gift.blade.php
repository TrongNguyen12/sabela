<?php
	if (Auth::check()) {
		if(Auth::user()->id_cus != null){
			$custommer = DB::table('custommer')->where('id', Auth::user()->id_cus)->first();
		}
	}
?>
@extends('frontend.master')
@section('main')
	<main class="chkout">
        <div class="bread-wrap">
            <div class="container">
                <ul class="bread justify-content-start list-unstyled">
                    <li><a href="{{ asset('/') }}" title="">Trang chủ</a></li>
                    <li><a href="{{ asset('gio-hang') }}" title="">Giỏ hàng</a></li>
                    <li><a href="#" title="">Tặng quà</a></li>
                </ul>
            </div>
        </div>
        @if (Cart::count() > 0)
	        <div class="container t5">
	            <h1 class="medium s24 chk-tit">Tặng quà</h1>
	            <form class="row chk-frm" method="POST" action="{{ asset('thanh-toan') }}">
	            	{{ csrf_field() }}
	                <div class="col-lg-6">
	                    <div class="chk-item chkout-bfrm">
	                        <h2 class="s16 medium text-md-left text-center chkoutmethod-tit"><span>Địa chỉ nhận hàng</span></h2>
	                        <div class="chkout-frm">
	                        	<div class="form-group">
                                	<label class="form-label">Tiêu đề</label>
                                    <input type="text" name="title" class="form-control form-field" placeholder="Tiêu đề gửi" required="required">
                                </div>
	                            <div class="form-group">
	                            	<label class="form-label">Họ tên người gửi</label>
									<input type="text" name="name" class="form-control form-field" placeholder="Họ tên người gửi" required="required" value="{!! old('name', isset($custommer) ? $custommer->name : null) !!}">
	                            </div>
	                            <div class="form-group">
	                            	<label class="form-label">Số điện thoại người gửi</label>
									<input type="number" name="phone" class="form-control form-field" placeholder="Số điện thoại người gửi" required="required" 
										value="{!! old('phone', isset($custommer) ? $custommer->phone : null) !!}">
	                            </div>
	                            <div class="form-group">
	                                <label class="form-label">Email người gửi</label>
									<input type="email" name="email" class="form-control form-field" placeholder="Email người gửi" required="required" 
									value="{!! old('email', isset($custommer) ? $custommer->email : null) !!}">
	                            </div>
	                            <div class="form-group">
                                	<label class="form-label">Họ tên người nhận</label>
                                    <input type="text" name="name_of_recipient" class="form-control form-field" placeholder="Họ tên người nhận hàng" required="required" value="{{ old(' name_of_recipient ') }}">
                                </div>
	                            <div class="form-group">
	                                <label class="form-label">Số điện thoại người nhận</label>
	                                <input type="number" name="phone_of_recipient" class="form-control form-field" placeholder="Số điện thoại liên hệ khi nhận hàng" required="required" value="{{ old('phone_of_recipient') }}">
	                            </div>
	                             <div class="form-group">
                                	<label class="form-label">Ngày nhận</label>
                                    <input type="date" name="dateReceive" class="form-control form-field" placeholder="" required="required">
                                </div>
	                            <div class="form-group">
	                                <label class="form-label">Tỉnh thành</label>
	                                <select class="form-control" required="required" id="province" name="province">
	                                	<option value="">Chọn tỉnh thành</option>
	                                    @foreach ($province as $item)
	                                    	<option value="{{ $item->provinceid }}">{{ $item->name }}</option>
	                                    @endforeach
	                                </select>
	                            </div>
	                            <div class="form-group">
	                                <label class="form-label">Chọn Quận/ Huyện</label>
	                                <select class="form-control" required="required" id="district" name="district">
	                                	<option value="">Chọn Quận/ Huyện</option>
	                                </select>
	                            </div>
	                            <div class="form-group">
	                                <label class="form-label">Địa chỉ người nhận</label>
	                                <input type="text" name="address" class="form-control form-field" placeholder="Số nhà, tên đường" required="required" value="{{ old('address') }}">
	                            </div>
	                        </div>
	                    </div>
	                    <div class="chk-item chkout-method">
	                        <h3 class="s16 medium text-md-left text-center chkoutmethod-tit"><span>Hình thức thanh toán</span></h3>
	                        <div class="accordion chk-method-card" id="accordion">
	                            <div class="card">
	                                <div class="card-header" data-toggle="collapse" data-target="#cod" aria-expanded='true'>
	                                    <label class="t5 medium custom-control custom-radio">
	                                        <input type="radio" checked="checked" class="custom-control-input method" name="choice" value="1" required="required">
	                                        <span class="custom-control-indicator"></span>
	                                        <span class="custom-control-description">Thanh toán khi nhận hàng</span>
	                                        <span class="d-block s14 t10 card-header-content">Thanh toán bằng tiền mặt khi nhận hàng</span>
	                                    </label>
	                                </div>

	                                <div id="cod" class="collapse show d-none" data-parent="#accordion">
	                                    <div class="s14 card-body">
	                                        
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="card">
	                                <div class="card-header collapsed" data-toggle="collapse" data-target="#bank">
	                                    <label class="t5 medium custom-control custom-radio">
	                                        <input type="radio" class="custom-control-input method" name="choice" value="2" required="required">
	                                        <span class="custom-control-indicator"></span>
	                                        <span class="custom-control-description">Thanh toán trực tuyến</span>
	                                        <span class="d-block s14 t10 card-header-content">Thanh toán bằng thẻ tín dụng / ghi nợ, thẻ ATM nội địa thanh toán chuyển khoản</span>
	                                    </label>
	                                </div>
	                                <div id="bank" class="collapse" data-parent="#accordion">
	                                    <div class="card-body">
	                                    	<div class="accordion" id="accordionExample">
	                                    		@foreach ($bank as $item)
												  <div class="card">
												    <div class="card-header collapsed" id="headingOne" data-toggle="collapse" data-target="#collapse{{ $item->id }}">
												    	<label class="t5 medium custom-control custom-radio " style="display: grid;">
					                                        <input type="radio" class="custom-control-input bank" name="choice1" value="{{ $item->id }}" required="required" checked >
					                                        <span class="custom-control-indicator"></span>
					                                        <span class="medium s16">Chuyển khoản</span>
											        		<span class="s14 t10">Thanh toán chuyển khoản qua {{ $item->name }}</span>
					                                    </label>
												    </div>
												    <div id="collapse{{ $item->id }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
												      	<div class="card-body">
		                                                    <p>Chủ TK:
		                                                        <span class="text-uppercase">{{ $item->account_name }}</span>
		                                                    </p>
		                                                    <p>Số TK: {{ $item->account_number }}</p>
		                                                    <p>Chi nhánh: {{ $item->account_branch }}</p>
												      	</div>
												    </div>
												  </div>
												@endforeach
											  <div class="card" style="pointer-events: none;">
											    <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" >
											        <span class="medium s16">Visa, ví điện tử</span>
											        <span class="s14 t10">Chưa tích hợp</span></span>
											    </div>
											  </div>
											</div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="col-lg-6 chkout-r">
	                	<div class="chk-item">
	                    	<h2 class="s16 medium text-md-left text-center chkoutmethod-tit">
	                    		<span>Thông tin đơn hàng</span>
	                    	</h2>
	                    	@foreach (Cart::content() as $item)
		                        <div class="chkout-r-item">
		                            <div class="row">
		                                <div class="col-md-2 col-3 d-flex align-items-center justify-content-center">
		                                    <a href="{{ asset('san-pham/'.str_slug($item->name).'-p'.$item->id ) }}" title="">
		                                    	<img src="{{ asset( 'uploads/product/avatar/'.$item->options->image ) }}" title="" alt="">
		                                    </a>
		                                </div>
		                                <div class="col-md-8 col-9">
		                                    <div class="pro-item-info">
												<h3 class="medium t7 s14 py-0 pro-item-info-tit">
													<a href="{{ asset('san-pham/'.str_slug($item->name).'-p'.$item->id ) }}" title="">{{ $item->name }}</a>
												</h3>
												<div class="py-2 t10 cart-item-info">
													<span>Chất liệu: <em>{{ $item->options->material }}</em></span>
													<span>Số lượng : {{ $item->qty }}</span>
												</div>
												
												<div class="pro-price">
													<span class="bold t6 s16">{{ number_format( $item->qty * $item->price  ) }}đ</span>
												</div>
											</div>
		                                </div>
		                                <div class="col-md-2 col-12 d-flex align-items-center justify-content-center">
		                                    <a href="{{ asset( '/cart/'.$item->rowId ) }}" title="">
		                                    	<i class="t10 fas fa-trash"></i>
		                                    </a>
		                                </div>
		                            </div>
		                        </div>
	                        @endforeach
	                        <ul class="list-unstyled medium pt-3 cartr-tt">
	                        	<li class="d-flex align-items-center justify-content-between ">
		                        	<span class="">Tổng tiền hàng</span>
		                            <span class="t6 s18">{{ Cart::total() }} đ</span>
	                        	</li>
	                        	<li class="d-flex align-items-center justify-content-between ">
	                        		<span>Tổng tiền thanh toán</span>
	                        		<span class="t6 s18">{{ Cart::total() }} đ</span>
	                        	</li>
	                        </ul>
	                	</div>
	                    
						<div class="chk-item">
							<h2 class="s16 medium text-md-left text-center chkoutmethod-tit"><span>Ghi chú</span></h2>

	                        <textarea rows="3" placeholder="Nội dung..." class="form-control" name="content">{{ old('content') }}</textarea>
	                        <div class="d-flex flex-md-nowrap flex-wrap align-items-center justify-content-md-start justify-content-center pt-4">
	                            <button type="submit" class="btn w-100 text-white cart-btn">ĐẶT HÀNG</button>
	                        </div>
						</div>
	                </div>
	                <input type="hidden" name="bank_id" id="bank_id" value="">
					<input type="hidden" name="payment_method" id="method" value="">
					<input type="hidden" name="type" value="2">
	            </form>
	        </div>
		@else
			Giỏ hàng rỗng !
	    @endif
    </main>
@stop
@section('script')
	<script>
		$(function() {
			$('#province').change(function(event) {
				$.ajax({
					url: '{{ asset('province') }}',
					type: 'GET',
					data: {
						districtid: $(this).val()
					},
				})
				.done(function(data) {
					$('#district').html(data);
				})	
			});
			$('.custom-control-input.method').click(function(event) {
				$('#method').val( $(this).val() );
			});
			$('.custom-control-input.bank').click(function(event) {
				$('#bank_id').val( $(this).val() );
			});

		});
	</script>
@endsection