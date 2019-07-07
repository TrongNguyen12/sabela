@extends('backend.index')
@section('content')

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3></h3>
                    <p>Sản phẩm</p>
                    <a href="{{ asset('backend/product') }}" class="_link" title="Sản phẩm"></a>
                </div>
                <div class="icon"><i class="fa fa-apple"></i></div>
                <a href=" {{ asset('backend/product') }}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>


        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3></h3>
                    <p>Liên hệ</p>
                    <a href="" class="_link" title="Liên hệ"></a>
                </div>
                <div class="icon"><i class="fa fa-comments-o"></i></div>
                <a href="{!! url('backend/contact') !!}" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@endsection