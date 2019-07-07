@extends('backend.index')
@section('controller','Giá trị cốt lõi')
@section('controller_route',route('backend.about'))
@section('action','Cập nhật')
@section('content')

    @include('backend.block.error')

    <form action="" method='POST' enctype="multipart/form-data" name="frmEditProduct">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin chung</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="activity">
                    <div class="row">

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input type="text" class="form-control" name="name" id="name" value="{!! old('name',isset($data) ? $data->name : null) !!}">
                            </div>

                            <div class="form-group">
                                <label>Trạng thái</label> <br>

                                <input type="checkbox" name="status" value="1" id="status" {!! $data->status === 1 ? 'checked' : null !!}>
                                <label for="status" class="lbl">Hiển thị</label>

                            </div>

                            <div class="form-group">
                                <label>Mô tả chi tiết</label>
                                <textarea id=""
                                          class="form-control"
                                          rows="10"
                                          name="content_main">{!! old('content_main',isset($data) ? $data->content_main : null) !!}</textarea>
                            </div>

                        </div>
                    </div> {{--./row--}}





                </div>

                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>

        <button type="submit" class="btn btn-primary">OK</button>
    </form>

@endsection