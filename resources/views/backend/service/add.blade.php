
@extends('backend.index')
@section('controller','Dịch vụ')
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

                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" class="form-control" name="name" id="name" value="{!! old('name') !!}">
                        </div>

                        <div class="form-group">
                            <label>Trạng thái</label> <br>

                            <input type="checkbox" name="status" value="1" id="status" checked>
                            <label for="status" class="lbl">Hiển thị</label>

                        </div>

                    </div>

                </div> {{--./row--}}


                <div class="form-group">
                  <label>Mô tả chi tiết</label>
                  <textarea id="content" name="content_main">{!! old('content_main') !!}</textarea>
                </div>

            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>


    </form>
        
@endsection