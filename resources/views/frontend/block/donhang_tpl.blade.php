<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<div class="" style="width: 100%; max-width: 650px; margin: 0 auto; border: 1px solid #348dcc; ">
		<div class="header" style="text-align: center; background: #348dcc; padding: 1px; color: #fff;"><h3 style="text-transform: uppercase; margin-top: 5px; margin-bottom: 2px">Thông báo đặt hàng</h3></div>	
		<div class="content" style="padding: 10px;">
			<p>Chào admin,</p>
			<p>Bạn vừa nhận được một yêu cầu đặt hàng từ <a href="" title="">{{$email}}</a></p>
			<!-- <div class="detail-order">
				<h3>Thông tin đơn hàng</h3>
			</div> -->
			<table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-left:1px solid #dcdcdc;border-right:1px solid #dcdcdc">
				<tbody>
					<tr>
						<td colspan="2" align="center" style="font-family:Arial,Helvetica,sans-serif;background-color:#f2f2f2;padding:8px 20px;border-top:1px solid #dcdcdc"><span style="font-size:13px;color:#252525;font-weight:bold">THÔNG TIN CHI TIẾT</span></td>
					</tr>
					<tr>
						<td width="39%" align="right" style="padding:8px 10px 8px 20px;font-family:Arial,Helvetica,sans-serif;color:#666666;font-size:12px;border-bottom:1px solid #dcdcdc"><span>Người đặt:</span></td>
						<td align="left" style="padding:8px 20px 8px 10px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#2525253;border-bottom:1px solid #dcdcdc"><strong>{{$full_name}}</strong></td>
					</tr>					
					<tr>
						<td width="39%" align="right" style="padding:8px 10px 8px 20px;font-family:Arial,Helvetica,sans-serif;color:#666666;font-size:12px;border-bottom:1px solid #dcdcdc"><span>Số điện thoại:</span></td>
						<td align="left" style="padding:8px 20px 8px 10px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#2525253;border-bottom:1px solid #dcdcdc"><strong>{{$phone}}</strong></td>
					</tr>

					<tr>
						<td width="39%" align="right" style="padding:8px 10px 8px 20px;font-family:Arial,Helvetica,sans-serif;color:#666666;font-size:12px;border-bottom:1px solid #dcdcdc"><span>Email:</span></td>
						<td align="left" style="padding:8px 20px 8px 10px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#2525253;border-bottom:1px solid #dcdcdc"><strong>{{ $email }}</strong></td>
					</tr>
													
					<tr>
						<td width="39%" align="right" style="padding:8px 10px 8px 20px;font-family:Arial,Helvetica,sans-serif;color:#666666;font-size:12px;border-bottom:1px solid #dcdcdc"><span>Địa chỉ</span></td>
						<td align="left" style="padding:8px 20px 8px 10px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#2525253;border-bottom:1px solid #dcdcdc"><strong>{{ $address}}</strong></td>
					</tr>
					<tr>
						
					</tr>
			  	</tbody>
			</table>			
			<div class="detail" style="margin-top: 30px;">
				<table cellpadding="0" cellspacing="0" border="0" width="100%;" style="border-left:1px solid #dcdcdc;border-right:1px solid #dcdcdc">
					<tbody>
						<tr>
							<td>Sản phẩm</td>
							<td>Giá</td>
							<td>Số lượng</td>
							<td>Thành tiền</td>
						</tr>
						@foreach($cart as $item)
						<tr>
							<td>{{$item->name}}</td>
							<td>{{number_format($item->price)}}</td>
							<td>{{$item->qty}}</td>
							<td>{{number_format($item->price * $item->qty)}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>	
			</div>			
		</div>		
	</div>
</body>
</html>