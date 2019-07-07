@extends('backend.index')
@section('controller','Danh mục sản phẩm')
@section('controller_route',route('backend.product.category'))
@section('action','Danh sách')
@section('content')
    @include('backend.block.error')
    <form action="{!! route('backend.product.category.postMultiDel') !!}" method="POST">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="btnAdd">
            <a href="{!! route('backend.product.category.getAdd') !!}">
                <fa class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</fa>
            </a>
            <button type="submit" class="btn btn-danger" style="display: none;"><i class="fa fa-trash-o"></i> Xóa</button>
        </div>
        <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên danh mục</th>
                <th>Đường dẫn</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td><a href="{{ asset($item->slug) }}">{{ asset($item->slug) }}</a></td>
                        <td>
                            <a href="{{ route('backend.product.category.getEdit', $item->id) }}" title="Sửa">
                                <i class="fa fa-pencil fa-fw"></i> Sửa
                            </a> &nbsp; &nbsp; &nbsp;
                            <a class="text-danger" href="{{ route('backend.product.category.getDelete', $item->id) }}" 
                                onclick="return confirm('Bạn có chắc chắn xóa không ?')" title="Xóa"> 
                                <i class="fa fa-trash-o fa-fw"></i> Xóa
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
@endsection