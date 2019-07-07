@extends('frontend.master')
@section('main')
	<main class="">
		<section class="login">
			<div class="bread-wrap">
				<div class="container">
					<ul class="list-unstyled bread">
						<li><a href="{{ asset('/') }}" title=""><i class="fas fa-home"></i> {{ trans('lang.title12') }}</a></li>
						<li><a href="#" title="">{{ trans('lang.title2') }}</a></li>
					</ul>
				</div>
			</div>
			<div class="container">
				<h1 class="medium s18 t5 login-tit">{{ trans('lang.title2') }}</h1>
				<div class="row">
					<div class="col-lg-5 col-md-6 col-sm-6">
						<form action="{{ asset('dang-ky') }}" class="login-frm" method="POST" autocomplete="off">

							@include('frontend.errors.errors')
							
							<label for="">{{ trans('lang.title46') }} <span class="t6">( * )</span></label>
							<input type="text" placeholder="{{ trans('lang.title46') }}" required="required" class="form-control"
							name="name" value="{{ old( 'name' ) }}">
							<label for="">{{ trans('lang.title47') }} <span class="t6">( * )</span></label>
							<input type="number" placeholder="{{ trans('lang.title47') }}" required="required" class="form-control" name="phone" min="10" value="{{ old( 'phone' ) }}">
							<label for="">Email <span class="t6">( * )</span></label>
							<input type="email" placeholder="Email" required="required" class="form-control" name="email" value="{{ old( 'email' ) }}">
							<label for="">{{ trans('lang.title48') }} <span class="t6">( * )</span></label>
							<input type="password" placeholder="{{ trans('lang.title48') }}" required="required" class="form-control" name="password" value="{{ old( 'password' ) }}">
							<label for="">{{ trans('lang.title50') }} <span class="t6">( * )</span></label>
							<input type="password" placeholder="{{ trans('lang.title50') }}" required="required" class="form-control" name="re_passs">
							<div class="d-flex align-items-center justify-content-between regis-gender">
								<label>{{ trans('lang.title51') }}</label>
								<label for="nam">
									<input name="gender" type="radio" value="1" checked=""> 
										{{ trans('lang.title53') }}
								</label>
								<label for="nu">
									<input name="gender" type="radio" value="2"> {{ trans('lang.title54') }}
								</label>
							</div>
							<div class="d-flex align-items-center justify-content-between regis-dt">
								<label>{{ trans('lang.title52') }}</label>
								<select name="date" id="" class="form-control">
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
								<select name="month" id="" class="form-control">
									<option value="1"> 1</option>
									<option value="2"> 2</option>
									<option value="3"> 3</option>
									<option value="4"> 4</option>
									<option value="5"> 5</option>
									<option value="6"> 6</option>
									<option value="7"> 7</option>
									<option value="8"> 8</option>
									<option value="9"> 9</option>
									<option value="10"> 10</option>
									<option value="11"> 11</option>
									<option value="12"> 12</option>
								</select>
								<select name="year" id="" class="form-control">
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
							<button class="btn login-btn w-100" type="submit">{{ trans('lang.title2') }}</button>
							<div class="d-flex italic login-link align-items-center justify-content-lg-end justify-content-between">
								<a href="{{ asset('dang-nhap') }}" title="">{{ trans('lang.title1') }}</a>
							</div>
							{{ csrf_field() }}
						</form>
					</div>
				</div>
			</div>
		</section>
	</main>
@stop