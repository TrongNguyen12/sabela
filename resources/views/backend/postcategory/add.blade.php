
@extends('backend.index')
@section('controller','Danh mục tin tức')
@section('controller_route',asset('/backend/blog/cat'))
@section('action','Thêm')
@section('content')
    
    @include('backend.block.error')
    
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin chung</a></li>
              {{-- <li class=""><a href="#settings" data-toggle="tab" aria-expanded="true">Cấu hình SEO</a></li> --}}
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="activity">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" class="form-control" name="name" id="name" value="{!! old('name') !!}">
                        </div>
                        <div class="form-group">
                            <label>Đường dẫn tĩnh</label>
                            <input type="text" class="form-control" name="slug" id="slug" value="{!! old('slug') !!}">
                        </div>
                    </div>
                </div>
            </div>
              <div class="tab-pane " id="settings">
                  <div class="row">
                      <div class="col-lg-4">
                          <div class="form-group">
                              <label>Title SEO</label>
                              <input type="text" class="form-control" name="meta_title" value="{!! old('meta_title') !!}">
                          </div>

                          <div class="form-group">
                              <label>Meta Description</label>
                              <textarea name="meta_description"
                                        class="form-control"
                              >{!! old('meta_description') !!}</textarea>
                          </div>

                          <div class="form-group">
                              <label>Meta Keyword</label>
                              <input type="text" class="form-control" name="meta_keyword" value="{!! old('meta_keyword') !!}">
                          </div>

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