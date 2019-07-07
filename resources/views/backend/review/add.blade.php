@extends('backend.index')
@section('controller','Đại lý')
@section('controller_route',  route('backend.about.agency.getListAgency'))
@section('action','Thêm')
@section('content')
    @include('backend.block.error')
    <form action="{{ route('backend.config.reviews.postAdd') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin chung</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="activity">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <div class="file-loading">
                                <input id="inpImg" name="fImage" type="file">
                            </div>
                        </div>
                       <div class="form-group">
                            <label>Tên khách hàng</label>
                            <input type="text" class="form-control" name="name" id="name" value="{!! old('name') !!}">
                        </div>
                        <div class="form-group">
                            <label>Vị trí</label>
                            <input type="text" class="form-control" name="position" id="name" value="{!! old('position') !!}">
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea id="desc" name="content" cols="5">{!! old('content') !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label> <br>
                            <input type="checkbox" name="status" value="1" id="status" checked>
                            <label for="status" class="lbl">Hiển thị</label>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
        
@endsection