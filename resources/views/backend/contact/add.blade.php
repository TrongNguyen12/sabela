
@extends('backend.index')
@section('controller','Tin tức')
@section('controller_route',route('backend.contact'))
@section('action','Thêm')
@section('content')
    
    @include('backend.block.error')
    
    <form action="{!! route('backend.blog.postAdd') !!}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin chung</a></li>
            <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Cấu hình SEO</a></li>
          </ul>
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

                    <div class="col-lg-8">
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" class="form-control" name="name" id="name" value="{!! old('name') !!}">
                        </div>

                        <div class="form-group">
                            <label>Đường dẫn tĩnh</label>
                            <input type="text" class="form-control" name="slug" id="slug" value="{!! old('slug') !!}">
                        </div>

                        <div class="form-group">
                            <label>Trạng thái</label> <br>

                            <input type="checkbox" name="status" value="1" id="status" checked>
                            <label for="status" class="lbl">Hiển thị</label>

                        </div>

                    </div>
                </div> {{--./row--}}


                <div class="form-group">
                  <label>Mô tả ngắn</label>
                  <textarea id="desc" name="desc">{!! old('desc') !!}</textarea>
                </div>

                <div class="form-group">
                  <label>Mô tả chi tiết</label>
                  <textarea id="content" name="content_main">{!! old('content_main') !!}</textarea>
                </div>

            </div>

              <div class="tab-pane" id="product_gallery">
                  <label>Hình ảnh</label>
                  <div class="file-loading">
                      <input id="gallery" name="fImageGallery[]" type="file" multiple>
                  </div>
              </div>

              <div class="tab-pane" id="product_video">
                  <div class="row">
                      <div class="col-lg-4">

                          <div class="form-group">
                              <label>Hình ảnh</label>
                              <div class="file-loading">
                                  <input id="inpImg3" name="fImageVideo" type="file">
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-4">
                          <div class="form-group">
                              <label>Tiêu đề Video: </label>
                              <input type="text" class="form-control" name="video_name" value="{!! old('video_name') !!}">
                          </div>
                          <div class="form-group">
                              <label>Link: </label>
                              <input type="text" class="form-control" name="video_link" value="{!! old('video_link') !!}">
                          </div>

                      </div>

                  </div>
              </div>

            <div class="tab-pane" id="settings">
                <div class="form-group">
                    <label>Title SEO</label>
                    <input type="text" class="form-control" name="txtTitle" value="{!! old('txtTitle') !!}">
                </div>

                <div class="form-group">
                    <label>Meta Description</label>
                    <input type="text" class="form-control" name="txtMetaDesc" value="{!! old('txtMetaDesc') !!}">
                </div>

                <div class="form-group">
                    <label>Meta Keyword</label>
                    <input type="text" class="form-control" name="txtMetaKeyword" value="{!! old('txtMetaKeyword') !!}">
                </div>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>


    </form>
        
@endsection