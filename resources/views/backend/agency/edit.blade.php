@extends('backend.index')
@section('controller','Đại lý')
@section('controller_route',  route('backend.about.agency.getListAgency'))
@section('action','Sửa')
@section('content')
    @include('backend.block.error')
    <form action="{{ route( 'backend.about.agency.postedit', $data->id  ) }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin chung</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="activity">
                <div class="row">
                    <div class="col-lg-6">
                       <div class="form-group">
                            <label>Tên đại lý</label>
                            <input type="text" class="form-control" name="name" id="name" 
                            value="{!! old('name', isset($data) ? $data['name'] : null) !!}">
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ</label>
                            <input type="text" class="form-control" name="address" id="name" 
                            value="{!! old('address', isset($data) ? $data['address'] : null) !!}">
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" id="name" 
                            value="{!! old('phone', isset($data) ? $data['phone'] : null) !!}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" id="name" 
                            value="{!! old('email', isset($data) ? $data['email'] : null) !!}">
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label> <br>
                            <input type="checkbox" name="status" value="1" id="status" 
                            {{ $data['status'] == 1 ? 'checked' : null }}>
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