
@extends('backend.index')
@section('controller','Khách hàng')
@section('controller_route',route('backend.config.customer'))
@section('action','Thêm')
@section('content')
    
    @include('backend.block.error')
    
    <form action="{!! route('backend.config.customer.postAdd') !!}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin chung</a></li></ul>
          <div class="tab-content">
            <div class="tab-pane active" id="activity">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Hình ảnh</label><br>
                            <div class="file-loading">
                                <input id="inpImg" name="fImage" type="file" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Họ tên</label>
                            <input type="text" class="form-control" name="name" id="name"
                                   value="{!! old('name') !!}" required>
                        </div>

                        <div class="form-group">
                            <label>Nghề nghiệp</label>
                            <input type="text" class="form-control" name="job" id="job"
                                   value="{!! old('job') !!}" required>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label> <br>

                            <input type="checkbox" name="status" value="1" id="active" checked>
                            <label for="active" class="lbl">Hiển thị</label>

                        </div>
                    </div>


                </div> {{--./row--}}

                <hr>
                <div class="form-group">
                    <label>Nội dung</label><br>

                    <textarea name="content_main"
                              id="content"
                              class="form-control">{!! old('content_main') !!}</textarea>
                </div>



            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>


    </form>
        
@endsection