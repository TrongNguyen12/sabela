@extends('backend.index')
@section('controller','Đại lý')
@section('controller_route',  route('backend.about.agency.getListAgency'))
@section('action','Danh sách')
@section('content')
    @include('backend.block.error')
    <form action="{{ route('backend.about.agency.postDeleteMuti') }}" method="POST">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="btnAdd">
            <a href="{{ route('backend.about.agency.add') }}">
                <fa class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</fa>
            </a>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chăc chắn ?')">
                <i class="fa fa-trash-o"></i> Xóa
            </button>
        </div>

        <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th><input type="checkbox" name="chkAll" id="chkAll"></th>
                <th>STT</th>
                <th>Tên đại lý</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
                 @foreach($data as $key => $item)
                    <tr>
                        <td><input type="checkbox" name="chkItem[]" value="{!! $item['id'] !!}"></td>
                        <td>{!! $key + 1 !!}</td>
                        <td>
                            {!! $item->name !!}
                        </td>
                        <td>
                            {!! $item->address !!}
                        </td>
                        <td>
                            {!! $item->phone !!}
                        </td>
                        <td>
                            {!! $item->email !!}
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
                                <a href="{{ route('backend.about.agency.edit', $item->id) }}" title="Sửa">
                                    <i class="fa fa-pencil fa-fw"></i> Sửa
                                </a> &nbsp; &nbsp; &nbsp;
                                <a class="text-danger" href="{{ route('backend.about.agency.delele', $item->id) }}" 
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