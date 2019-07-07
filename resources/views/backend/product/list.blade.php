@extends('backend.index')
@section('controller','Sản phẩm')
@section('controller_route',route('backend.product'))
@section('action','Danh sách')
@section('content')

    <form action="{!! route('backend.product.postMultiDel') !!}" method="POST">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

        <div class="btnAdd">
          <a href="{!! route('backend.product.getAdd') !!}">
              <fa class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</fa>
          </a>
          <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn xóa không ?')"><i class="fa fa-trash-o"></i> Xóa</button>
        </div>
        <table id="example1" class="table table-bordered table-striped table-hover">
          <thead>
          <tr>
            <th><input type="checkbox" name="chkAll" id="chkAll"></th>
            <th>STT</th>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Danh mục</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
          </tr>
          </thead>
          <tbody>
             @foreach ($products as $item)
                <tr>
                    <td><input type="checkbox" name="chkItem[]" value="{!! $item['id'] !!}"></td>
                    <td>{{ $loop->index+1 }}</td>
                    <td style="text-align: center;">
                      <img src="{{ asset( 'uploads/product/avatar/'.$item->image ) }}" class="img-thumbnail" width="50px" height="50px">
                    </td>
                    <td>
                      {{ $item->name }} <br>
                      <a href="#">
                        <i class="fa fa-hand-o-right" aria-hidden="true"></i> Link: 
                        {{ asset( 'san-pham/'.$item->slug.'-'.$item->id ) }}
                      </a>
                    </td>
                    <td>
                      @foreach ($item->category as $value)
                        <span class="label label-success">{{  $value->name }}</span>
                      @endforeach
                    </td>
                    <td>
                      @if ($item->status == 1 )
                        <span class="label label-success">Hiển thị</span>
                      @else
                        <span class="label label-danger">Không hiển thị</span>
                      @endif
                      @if ($item->hot == 1)
                        <span class="label label-primary">Sản phẩm nổi bật</span>
                      @endif
                      @if ($item->new == 1)
                        <span class="label label-info">Sản phẩm mới</span>
                      @endif
                    </td>
                    <td>
                      <div>
                          <a href="{{ route('backend.product.getEdit', $item->id) }}" title="Sửa">
                              <i class="fa fa-pencil fa-fw"></i> Sửa
                          </a> &nbsp; &nbsp; &nbsp;
                          <a class="text-danger" href="{{ route('backend.product.getDelete', $item->id) }}" 
                              onclick="return confirm('Bạn có chắc chắn xóa không ?')" title="Xóa"> 
                              <i class="fa fa-trash-o fa-fw"></i> Xóa
                          </a>
                      </div>
                    </td>
                   
                </tr>

             @endforeach
          </tbody>
        </table>
    </form>

@endsection