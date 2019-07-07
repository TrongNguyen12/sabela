@extends('backend.index')
@section('controller','Đối tác')
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
                                <label>Hình ảnh</label><br>
                                @if ($data->image != null)
                                    <img src="{{ asset('uploads/custommer/'.$data->image) }}" id="show-img" class="showImg">
                                @endif
                                <div class="file-loading">
                                    <input id="inpImg" name="fImage" type="file" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Họ tên</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       value="{!! old('name', isset($data) ? $data['name'] : null) !!}" required>
                            </div>

                            <div class="form-group">
                                <label>Nghề nghiệp</label>
                                <input type="text" class="form-control" name="job" id="job"
                                       value="{!! old('job', isset($data) ? $data['job'] : null) !!}" required>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label> <br>

                                <input type="checkbox" name="status" value="1" id="active"
                                       @if($data['status'] === 1)
                                       checked="checked"
                                        @endif
                                >
                                <label for="active" class="lbl">Hiển thị</label>

                            </div>
                        </div>


                    </div> {{--./row--}}

                    <hr>
                    <div class="form-group">
                        <label>Nội dung</label><br>

                        <textarea name="content_main"
                                  id="content"
                                  class="form-control">{!! old('content_main', isset($data) ? $data->content : null) !!}</textarea>
                    </div>



                </div>



            </div>
            <!-- /.tab-content -->
        </div>

        <button type="submit" class="btn btn-primary">OK</button>
    </form>

@endsection