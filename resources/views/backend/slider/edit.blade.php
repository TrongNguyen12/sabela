@extends('backend.index')
@section('controller','Slider Trang chủ')
@section('controller_route','Sửa')
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
                                     <img src="{{ asset('uploads/slider') }}/{{ $data->image }}" id="show-img" class="showImg">
                                @endif
                                <div class="file-loading">
                                    <input id="inpImg" name="fImage" type="file" value="">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Tên slider</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       value="{!! old('name', isset($data) ? $data['name'] : null) !!}" required>
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                <input type="text" class="form-control" name="link" id="account_name"
                                       value="{!! old('link', isset($data) ? $data['link'] : null) !!}" required>
                            </div>

                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="form-control" name="content" required>{!! old('content', isset($data) ? $data['content'] : null) !!}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Trạng thái</label> <br>

                                <input type="checkbox" name="status" value="1" id="active"
                                       @if($data['status'] == 1)
                                        checked="checked"
                                        @endif
                                >
                                <label for="active" class="lbl">Hiển thị</label>

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