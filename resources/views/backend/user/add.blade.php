@extends('backend.index')
@section('controller','Quản trị viên')
@section('controller_route',asset('/backend/user'))
@section('action','Thêm')
@section('content')

    <div class="row">
      <form action="{{ asset('backend/user/add') }}" method='POST' enctype="multipart/form-data">

        <div class="col-md-2"></div>
        <div class="col-md-8">
            @include('backend.block.error')

            <input type="hidden" name="_token" value="{!! csrf_token() !!}">

            <div class="form-group">
              <label>Tài khoản</label>
              <input type="text" class="form-control" name="txtName" value="{!! old('txtName') !!}">
            </div>

            <div class="form-group">
              <label>Mật khẩu</label>
              <input type="password" class="form-control" name="txtPass" value="{!! old('txtPass') !!}">
            </div>

            <div class="form-group">
              <label>Nhập lại mật khẩu</label>
              <input type="password" class="form-control" name="txtRePass" value="{!! old('txtRePass') !!}">
            </div>

            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" name="txtEmail" value="{!! old('txtEmail') !!}">
            </div>

            <div class="form-group">
                <label>Hình ảnh</label>
                <div class="file-loading">
                    <input id="inpImg" name="fImage" type="file">
                </div>
            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary">OK</button>
            </div>
        </div>
      </form>

    </div>
        
@endsection