@extends('backend.index')
@section('controller','Trang chủ')
@section('controller_route', 'Home')
@section('action','Slider & Video')
@section('content')

    @include('backend.block.error')


    <?php //dd($site_info) ?>


    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="{!! session('video_updated') ? null : 'active'  !!}"><a href="#slider" data-toggle="tab" aria-expanded="true">Slider</a></li>
            <li class="{!! session('video_updated') ? 'active' : null  !!}"><a href="#video" data-toggle="tab" aria-expanded="true">Video</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane {!! session('video_updated') ? null : 'active'  !!}" id="slider">

                <form action="{!! route('backend.config.home.postMultiDel') !!}" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                    <div class="btnAdd">
                        <a href="{!! route('backend.config.home.getAdd') !!}">
                            <fa class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</fa>
                        </a>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Xóa</button>
                    </div>

                    <?php $i = 0; ?>
                    <table id="example1" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th><input type="checkbox" name="chkAll" id="chkAll"></th>
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Tiêu đề</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($slider as $item)
                            <?php $i++; ?>
                            <tr>
                                <td><input type="checkbox" name="chkItem[]" value="{!! $item['id'] !!}"></td>
                                <td>{!! $i !!}</td>

                                <td>
                                    <a class="text-default" href="{!! route('backend.config.home.getEdit',$item['id']) !!}"
                                       title="Sửa">
                                        <img src="{!! image_url($item->url) !!}" class="img-responsive imglist"/>
                                    </a>
                                </td>

                                <td>
                                    <a class="text-default" href="{!! route('backend.config.home.getEdit',$item['id']) !!}"
                                       title="Sửa">  {!! $item['name'] !!} </a>
                                </td>

                                <td>
                                    <div>
                                        <a href="{!! route('backend.config.home.getEdit',$item['id']) !!}" title="Sửa"> <i
                                                    class="fa fa-pencil fa-fw"></i> Sửa</a> &nbsp; &nbsp; &nbsp;
                                        <a class="text-danger"
                                           href="{!! route('backend.config.home.getDelete',$item['id']) !!}"
                                           onclick="return confirm('Bạn có chắc chắn xóa không ?')" title="Xóa"> <i
                                                    class="fa fa-trash-o fa-fw"></i> Xóa</a>
                                    </div>

                                </td>

                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </form>

            </div>

            <div class="tab-pane {!! session('video_updated') ? 'active' : null  !!}" id="video">
                <form action="{!! route('backend.config.postVideoUpdate') !!}" method='POST' enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token(); !!}">
                    <div class="row">
                        <div class="col-lg-4">

                            <div class="form-group">
                                <label>Hình ảnh</label> <br>


                                <img src="{!! image_url(isset($video->image) ? $video->image->url : ''); !!}" id="show-img" class="showImg">
                                <input type="hidden" name="id" value="{!! $video->id !!}">

                                <div class="file-loading">
                                    <input id="inpImg3" name="fImageVideo" type="file" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Tiêu đề Video: </label>
                                <input type="text" class="form-control" name="video_name"
                                       value="{!! old('video_name',$video->name) !!}">
                            </div>
                            <div class="form-group">
                                <label>Link: </label>
                                <input type="text" class="form-control" name="video_link"
                                       value="{!! old('video_link',$video->url) !!}">
                            </div>

                        </div>

                    </div> {{--./row--}}

                    <button type="submit" class="btn btn-primary">Lưu</button>

                </form>

            </div>

        </div>
        <!-- /.tab-content -->
    </div>



@endsection