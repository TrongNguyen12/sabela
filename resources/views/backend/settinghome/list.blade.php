@extends('backend.index')
@section('controller','Cài đặt trang chủ')
@section('controller_route')
@section('action','Danh sách')
@section('content')

    @include('backend.block.error')


<?php //dd($site_info) ?>

    <form action="" method="POST">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="btnAdd">
            <a href="{!! route('backend.homesetting.getAdd') !!}">
                <fa class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</fa>
            </a>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn xóa không ?')"><i class="fa fa-trash-o" ></i> Xóa</button>
        </div>
        <?php $i=0; ?>
        <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th><input type="checkbox" name="chkAll" id="chkAll"></th>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tiêu đề</th>
                <th>Loại hiển thị</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach($SettingHome as $item)
                <?php $i++; ?>
                <tr>
                    <td><input type="checkbox" name="chkItem[]" value="{!! $item['id'] !!}"></td>
                    <td>{!! $i !!}</td>
                    <td>
                        <a class="text-default" href="{!! route('backend.homesetting.getEdit',$item['id']) !!}" title="Sửa">
                            <img src="{{ asset('uploads/home/config/'.$item['image']) }}" class="img-responsive imglist" />
                        </a>
                    </td>
                    <td>
                        <a class="text-default" href="{!! route('backend.homesetting.getEdit',$item['id']) !!}" title="Sửa">  {!! $item['name'] !!} </a>
                    </td>
                    <td>
                       
                        @if ( $item['type'] == 1 )
                            Hiển thị các sản phẩm đang giảm giá
                        @elseif( $item['type'] == 2 )
                            Hiển thị theo đường link tĩnh<br>
                            {{ $item['link'] }}
                        @elseif( $item['type'] == 3 )
                            Hiển thị các sản phẩm đang giảm giá theo % <br>
                            {{ $item['value'] }}
                        @elseif( $item['type'] == 4 )
                            Hiển thị một danh mục sản phẩm <br>
                            {{ $item['value'] }}
                        @elseif( $item['type'] == 5 )
                            Hiển thị ngẫu nhiên các sản phẩm <br>
                        @endif
                    </td>
                    <td>
                        <div>
                            <a href="{!! route('backend.homesetting.getEdit',$item['id']) !!}" title="Sửa"> <i class="fa fa-pencil fa-fw"></i> Sửa</a> &nbsp; &nbsp; &nbsp;
                            <a class="text-danger" href="{!! route('backend.homesetting.getDelete',$item['id']) !!}" onclick="return confirm('Bạn có chắc chắn xóa không ?')" title="Xóa"> <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                        </div>

                    </td>

                </tr>

            @endforeach
            </tbody>
        </table>
    </form>

@endsection