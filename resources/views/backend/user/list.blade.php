@extends('backend.index')
@section('controller','Tài khoản')
@section('action','Danh sách')
@section('content')
    @if (Request::segment(2) === 'user' &&  Request::segment(3) == null)
      @if(Auth::user())
          @if(Auth::user()->level == 1)
            <div class="btnAdd">
              <a href="{!! asset( 'backend/user/add' ) !!}">
                  <fa class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</fa>
              </a>
            </div>
          @endif
      @endif
    @endif
    <?php $i=0; ?>
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
          <th>STT</th>
          <th>Tài khoản</th>
          <th>Email</th>
          @if (Request::segment(2) === 'user' &&  Request::segment(3) == null)
            <th>Hình ảnh</th>
            <th>Sửa</th>
          @endif
          @if(Auth::user())
              @if(Auth::user()->level == 1)
              <th>Xóa</th>
              @endif
          @endif
      </tr>
      </thead>
      <tbody>
      @if(isset($user))
      @foreach($user as $item)
      <?php $i++; ?>
          <tr>
            <td>{!! $i !!}</td>
            <td>
              {!! $item['name'] !!}
              @if ($item['supperdmin'] == 1)
                <span class="badge label-warning">SUPPER ADMIN</span>
              @endif
            </td>
            <td>{!! $item['email'] !!}</td>
            @if (Request::segment(2) === 'user' &&  Request::segment(3) == null)
              <td>
                  <img src="{!! asset($item['image']) !!}" class="img-responsive imglist" />
              </td>
              <td>
                  <i class="fa fa-pencil fa-fw"></i>
                  <a href="{{ asset('backend/user/edit?id='.$item['id']) }}">Sửa</a>
              </td>
            @endif
            @if(Auth::user())
                @if(Auth::user()->level == 1)
                <td>
                    <i class="fa fa-trash-o fa-fw"></i>
                    <a href="{{ asset('backend/user/delete?id='.$item['id']) }}" onclick="return confirm('Bạn có chắc chắn xóa không ?')">Xóa</a>
                </td>
                @endif
            @endif
          </tr>
      @endforeach
      @endif
      </tbody>
    </table>
@endsection