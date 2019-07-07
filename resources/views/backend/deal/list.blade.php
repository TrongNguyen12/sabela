@extends('backend.index')
@section('controller','Chương trình ưu đãi')
@section('controller_route',route('backend.deal.list'))
@section('action','Danh sách')
@section('content')

    <form action="{!! route('backend.deal.mutidelete') !!}" method="POST">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

        <div class="btnAdd">
          <a href="{!! route('backend.deal.add') !!}">
              <fa class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</fa>
          </a>
          <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa ?')"><i class="fa fa-trash-o"></i> Xóa</button>
        </div>

        <?php $i=0; ?>
        <table id="example1" class="table table-bordered table-striped table-hover">
          <thead>
          <tr>
            <th><input type="checkbox" name="chkAll" id="chkAll"></th>
            <th>STT</th>
            <th>Hình ảnh</th>
            <th>Tiêu đề</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
          </tr>
          </thead>
          <tbody>
          @foreach($data as $item)
          <?php $i++; ?>
              <tr>
                <td><input type="checkbox" name="chkItem[]" value="{!! $item['id'] !!}"></td>
                <td>{!! $i !!}</td>
                 <td>
                     <a class="text-default" href="{!! route('backend.blog.getEdit',$item['id']) !!}" title="Sửa">
                         <img src="{{ asset( 'uploads/post/'.$item['image'] ) }}" class="img-responsive imglist" />
                     </a>
                 </td>
                <td>
                    <a class="text-default" href="{!! route('backend.deal.edit',$item['id']) !!}" title="Sửa">  {!! $item['name'] !!} </a>
                </td>
                <td>
                    @if ($item->status == 1 )
                        <span class="label label-success">Hiển thị</span>
                    @else
                        <span class="label label-danger">Không hiển thị</span>
                    @endif
                </td>
                <td>
                    <div>
                        <a href="{!! route('backend.deal.edit',$item['id']) !!}" title="Sửa"> <i class="fa fa-pencil fa-fw"></i> Sửa</a> &nbsp; &nbsp; &nbsp;
                        <a class="text-danger" href="{!! route('backend.deal.delete',$item['id']) !!}" onclick="return confirm('Bạn có chắc chắn xóa không ?')" title="Xóa"> <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                    </div>
                </td>
              </tr>
          @endforeach
          </tbody>
        </table>
    </form>
@endsection