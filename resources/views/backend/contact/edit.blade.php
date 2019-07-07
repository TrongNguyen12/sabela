@extends('backend.index')
@section('controller','Liên hệ')
@section('controller_route',route('backend.contact'))
@section('action','Cập nhật')
@section('content')

    @include('backend.block.error')

    <form action="" method='POST' enctype="multipart/form-data" name="frmEditProduct">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin Liên hệ</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="activity">

                    <?php

                    $content = $data->type === 'contact_news_register'
                        ? date_format(date_create($data->created_at),"d.m.Y - H:i:s").': Đăng ký nhận khuyến mại'
                        : date_format(date_create($data->created_at),"d.m.Y - H:i:s").': '.$data->content;
                    ?>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Mô tả chi tiết</label>
                                <textarea id="" class="form-control" rows="16" readonly
                                          name="content_main">{!! old('content_main', isset($data) ? $content : null) !!}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       value="{!! old('name', isset($data) ? $data->customer->name : null) !!}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" id="email"
                                       value="{!! old('email', isset($data) ? $data->customer->email : null) !!}" readonly>
                            </div>

                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" id="phone"
                                       value="{!! old('phone', isset($data) ? $data->customer->phone : null) !!}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <textarea type="text" class="form-control" name="address" id="address"readonly>{!! old('address', isset($data) ? $data->customer->address : null) !!}
                                </textarea>
                            </div>

                            <div class="form-group">
                                <label class="text-danger">Trạng thái</label> <br>

                                <input type="checkbox" name="status" value="0" id="active" checked>
                                <label for="active" class="lbl">Đã xem</label>

                            </div>

                        </div>



                    </div> {{--./row--}}






                </div>



                <div class="tab-pane" id="settings">
                    <div class="form-group">
                        <label>Title SEO</label>
                        <input type="text" class="form-control" name="txtTitle"
                               value="{!! old('txtTitle', isset($data) ? $data['meta_title'] : null) !!}">
                    </div>

                    <div class="form-group">
                        <label>Meta Description</label>
                        <input type="text" class="form-control" name="txtMetaDesc"
                               value="{!! old('txtMetaDesc', isset($data) ? $data['meta_description'] : null) !!}">
                    </div>

                    <div class="form-group">
                        <label>Meta Keyword</label>
                        <input type="text" class="form-control" name="txtMetaKeyword"
                               value="{!! old('txtMetaKeyword', isset($data) ? $data['meta_keyword'] : null) !!}">
                    </div>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>

        <button type="submit" class="btn btn-primary">OK</button>
    </form>

@endsection