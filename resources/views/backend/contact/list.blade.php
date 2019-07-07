@extends('backend.index')
@section('controller','Liên hệ')
@section('controller_route',route('backend.contact'))

@section('action','Danh sách')
@section('content')

    <form action="{!! route('backend.contact.postMultiDel') !!}" method="POST">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="btnAdd">
          <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn xóa không ?')"><i class="fa fa-trash-o"></i> Xóa</button>
          <a href="{!! route('backend.contact.export') !!}">
              <fa class="btn btn-success"><i class="fa fa-file-excel-o"></i> Xuất dữ liệu sang Excel <i class="fa fa-arrow-right"></i></fa>
          </a>
        </div>
        <?php $i=0; ?>
        <table id="example1" class="table table-bordered table-striped table-hover">
          <thead>
          <tr>
            <th><input type="checkbox" name="chkAll" id="chkAll"></th>
            <th>STT</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Nội dung</th>
            <th>Trạng thái</th>
            <th>Ngày nhận</th>
            <th>Thao tác</th>
          </tr>
          </thead>
          <tbody>
          @foreach($data as $item)
          <?php $i++; ?>
          {{--  $loop->index +1  --}}
              <tr>
                <td><input type="checkbox" name="chkItem[]" value="{!! $item['id'] !!}"></td>
                <td>{!! $i !!}</td>
                  <td>
                      <a class="text-default" href="{!! route('backend.contact.getEdit',$item['id']) !!}" title="Xem">{!! $item->customer->name !!}</a>
                  </td>
                 <td>
                     <a class="text-default" href="{!! route('backend.contact.getEdit',$item['id']) !!}" title="Xem">{!! $item->customer->email !!}</a>
                 </td>
                <td>
                    <a class="text-default" href="{!! route('backend.contact.getEdit',$item['id']) !!}" title="Xem">{!! $item->customer->phone !!}</a>
                </td>
                  <td>
                      <?php
                          if($item->type==='contact_news_register'){
                              $title = 'Đăng ký nhận tin khuyến mại';
                              $content = '<span class="badge label-warning">'.$title.'</span>';
                          }else{
                              $title = $item->content;
                              $content = str_limit($title,50,'...');
                          }
                      ?>
                      <a class="text-default" href="{!! route('backend.contact.getEdit',$item['id']) !!}"
                         title="{!! $title !!}">{!! $content !!}</a>
                  </td>


                <td>

                    {!! ($item['status'] != 1) ? '<span class="badge label-danger">Chưa xem</span>' : '<span class="badge label-success">Đã xem</span>' !!}
                </td>

                  <td>
                      <a class="text-default" href="{!! route('backend.contact.getEdit',$item['id']) !!}" title="{!! date_format(date_create($item->created_at),"d.m.Y - H:m:s")  !!}">
                      {!! date_format(date_create($item->created_at),"d.m.Y - H:i:s") !!}
                      </a>
                  </td>
               
                <td>
                    <div>
                        <a href="{!! route('backend.contact.getEdit',$item['id']) !!}" title="Xem"> <i class="fa fa-eye fa-fw"></i> Xem</a> &nbsp; &nbsp; &nbsp;
                        <a class="text-danger" href="{!! route('backend.contact.getDelete',$item['id']) !!}" onclick="return confirm('Bạn có chắc chắn xóa không ?')" title="Xóa"> <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                    </div>

                </td>

              </tr>

          @endforeach
          </tbody>
        </table>
    </form>

@endsection