
@extends('backend.index')
@section('controller','Slider Trang chủ')
@section('action','Thêm')
@section('content')
    @include('backend.block.error')
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin chung</a></li></ul>
          <div class="tab-content">
            <div class="tab-pane active" id="activity">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <div class="file-loading">
                                <input id="inpImg" name="fImage" type="file">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Tên slider</label>
                            <input type="text" class="form-control" name="name" id="name"
                                   value="{!! old('name') !!}" required>
                        </div>
                        <div class="form-group">
                            <label>Đường dẫn (Link)</label>
                            <input type="text" class="form-control" name="link" id="link"
                                   value="{!! old('link') !!}" required>
                        </div>

                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea class="form-control" name="content" required>{!! old('content') !!}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Trạng thái</label> <br>
                            <input type="checkbox" name="status" value="1" id="status" checked>
                            <label for="status" class="lbl">Hiển thị</label>
                        </div>

                    </div>



                </div> {{--./row--}}


            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>


    </form>
        
@endsection