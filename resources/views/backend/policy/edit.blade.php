@extends('backend.index')
@section('controller','Chính sách')
@section('controller_route',route('backend.config.policy'))
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
                                <input type="text" class="form-control" name="name" id="name"
                                       value="{!! old('name', isset($data) ? $data['name'] : null) !!}" required>
                            </div>
                        </div>
                    </div> {{--./row--}}



                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea id="content"
                                  name="content_main">{!! old('content_main', isset($data) ? $data['content_main'] : null) !!}</textarea>
                    </div>



                </div>

                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>

        <button type="submit" class="btn btn-primary">OK</button>
    </form>

@endsection