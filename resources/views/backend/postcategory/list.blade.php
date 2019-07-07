@extends('backend.index')
@section('controller','Danh mục tin tức')
@section('controller_route',asset('/backend/blog/cat'))
@section('action','Danh sách')
@section('content')

    @include('backend.block.error')


<?php //dd($site_info) ?>

    <form action="{!! route('backend.blog.cat.postMultiDel') !!}" method="POST">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

        <div class="btnAdd">
            <a href="{!! route('backend.blog.cat.getAdd') !!}">
                <fa class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</fa>
            </a>
            <button type="submit" class="btn btn-danger" style="display: none;"><i class="fa fa-trash-o"></i> Xóa</button>
        </div>

        <?php $i=1; ?>
        <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th><input type="checkbox" name="chkAll" id="chkAll"></th>
                <th>STT</th>
                <th>Danh mục tin tức</th>
                <th>Slug</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                    <tr>
                        <td><input type="checkbox" name="chkItem[]" value="{!! $item['id'] !!}"></td>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>
                            <div>
                                <a href="{!! route('backend.blog.cat.getEdit',$item['id']) !!}" title="Sửa"> <i class="fa fa-pencil fa-fw"></i> Sửa</a> &nbsp; &nbsp; &nbsp;
                                <a class="text-danger" href="{!! route('backend.blog.cat.getDelete',$item['id']) !!}" onclick="return confirm('Bạn có chắc chắn xóa không ?')" title="Xóa"> <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>

@endsection