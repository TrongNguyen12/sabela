@extends('backend.index')
@section('controller','Quản trị viên')
@section('controller_route',asset('/backend/user'))
@section('action','Cập nhật')
@section('content')

    <div class="row">
      <form action="" method='POST' enctype="multipart/form-data">

        <div class="col-md-2"></div>
        <div class="col-md-8">
            @include('backend.block.error')

            <input type="hidden" name="_token" value="{!! csrf_token() !!}">

            <div class="form-group">
              <label>Tài khoản</label>
              <input type="text" class="form-control" name="txtName" value="{!! old('txtName', isset($data) ? $data->name : null) !!}" disabled>
            </div>

            <div class="form-group">
              <label>Mật khẩu</label>
              <input type="password" class="form-control" name="txtPass" required>
            </div>

            <div class="form-group">
              <label>Nhập lại mật khẩu</label>
              <input type="password" class="form-control" name="txtRePass" required>
            </div>

            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" name="txtEmail" value="{!! old('txtEmail', isset($data) ? $data->email : null) !!}">
            </div>

            <div class="form-group">
                <label>Hình ảnh</label><br>
                <img src="{{ asset( $data->image) }}" id="show-img" class="showImg">
                <div class="file-loading">
                    <input id="inpImg" name="fImage" type="file" value="">
                </div>
            </div>
            @if (Auth::user()->supperdmin == 1)
              <div class="form-group">
                  <label>Supper Admin</label> <br>
                  <input type="checkbox" name="SupperAdmin" value="1" id="active" {{  $data->supperdmin == 1 ? 'checked' : null }}>
                  <label for="active" class="lbl">Supper Admin</label>
              </div>
            @endif

            <div class="box-footer">
              <button type="submit" class="btn btn-primary">OK</button>
            </div>
        </div>
      </form>

    </div>
        
@endsection