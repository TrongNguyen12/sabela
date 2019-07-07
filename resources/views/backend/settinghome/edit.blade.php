@extends('backend.index')
@section('controller','Cài đặt trang chủ')
@section('controller_route',route('backend.config.bank'))
@section('action','Cập nhật')
@section('content')

    @include('backend.block.error')

    <form action="" method='POST' enctype="multipart/form-data" name="frmEditProduct">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin chung</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="activity">

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Hình ảnh</label><br>
                                @if ($data->image != null)
                                     <img src="{{ asset('uploads/home/config') }}/{{ $data->image }}" id="show-img" class="showImg">
                                @endif
                                <div class="file-loading">
                                    <input id="inpImg" name="fImage" type="file" value="">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" class="form-control" name="name" id="name"
                                   value="{!! $data['name'] !!}" required>
                        </div>
                        <div class="form-group">
                            <label>Tiêu đề (Tiếng anh )</label>
                            <input type="text" class="form-control" name="nameeg" id="name"
                                   value="{!! $data['nameeg'] !!}" required>
                        </div>
                        <div class="form-group">
                            <label>Chọn loại hiển thị</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="type" value="1" {!! $data['type'] == 1 ? 'checked' : null !!} >Hiển thị các sản phẩm đang giảm giá
                                </label>
                            </div>
                            <div class="radio">
                              <label><input type="radio" name="type" value="2" {!! $data['type'] ==2 ? 'checked' : null !!}>Hiển thị theo đường link tĩnh</label>
                            </div>
                            <div class="radio">
                              <label><input type="radio" name="type" value="3" {!! $data['type'] ==3 ? 'checked' : null !!}>Hiển thị các sản phẩm đang giảm giá theo %</label>
                            </div>
                            <div class="radio">
                              <label><input type="radio" name="type" value="4" {!! $data['type'] ==4 ? 'checked' : null !!}>Hiển thị một danh mục sản phẩm</label>
                            </div>
                            <div class="radio">
                              <label><input type="radio" name="type" value="5" {!! $data['type'] ==5 ? 'checked' : null !!}>Hiển thị ngẫu nhiên các sản phẩm</label>
                            </div>
                        </div>

                        <div class="form-group" style="{!! $data['type'] ==3 ? 'display: block' : 'display: none' !!}"  id="giamgia" >
                            <label>Nhập số phần trăm giảm giá</label>
                            <input type="number" class="form-control" name="sale" id="account_number"
                                   value="{!! $data['value'] !!}" >
                        </div>

                        <div class="form-group" style="{!! $data['type'] ==2 ? 'display: block' : 'display: none' !!}" id="linktinh">
                            <label>Đường Link Tĩnh </label>
                            <input type="text" class="form-control" name="link" id="account_number"
                                   value="{!! $data['link'] !!}">
                        </div>

                        <div class="form-group" id="cate" style="{!! $data['type'] ==4 ? 'display: block' : 'display: none' !!}">
                            <label>Chọn danh mục sản phẩm</label>
                            <select name="cate" id="" class="form-control">
                                <option value="">Chọn danh mục sản phẩm</option>
                                @php
                                  menuMulti( $cate , 0 , '' ,   $data['value']);
                                @endphp
                            </select>
                        </div>
                    </div>



                    </div> {{--./row--}}


                </div>



            </div>
            <!-- /.tab-content -->
        </div>

        <button type="submit" class="btn btn-primary">OK</button>
    </form>

@endsection
@section('script')
    <script>
        $(function() {
            $( "input[name='type']" ).change(function(event) {
                var luachon = $( "input[name='type']:checked" ).val();
                if(luachon == 4){
                    $('#cate').show();
                }else{
                    $('#cate').hide();
                }if(luachon == 2){
                    $('#linktinh').show();
                }else{
                     $('#linktinh').hide();
                }if(luachon == 3){
                    $('#giamgia').show();
                }else{
                    $('#giamgia').hide();
                }
            });
        });
    </script>
@endsection