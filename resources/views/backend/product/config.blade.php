@extends('backend.index')
@section('controller','Sản phẩm')
@section('controller_route',route('backend.product'))
@section('action','Cài đặt')
@section('content')

    @include('backend.block.error')

    <form action="{!! route('backend.product.postConfig') !!}" method='POST' enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Banner</a></li>
                <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Cấu hình SEO</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="activity">

                    <div class="row">
                        <div class="col-lg-4">

                            <div class="form-group">
                                <label>Hình ảnh banner</label> <br>

                                    <img src="{!! image_url(isset($video->image) ? $video->image->url : '') !!}" id="show-img" class="showImg">
                                <input type="hidden" name="video_id" value="{!!isset($video) ? $video->id : null !!}">
                                <div class="file-loading">
                                    <input id="inpImg3" name="fImageVideo" type="file" value="">
                                </div>
                            </div>


                            <div class="form-group">
                                <label>Tiêu đề Video: </label>
                                <input type="text" class="form-control" name="video_name"
                                       value="{!! old('video_name',isset($video) ? $video->name : null) !!}">
                            </div>
                            <div class="form-group">
                                <label>Link: </label>
                                <input type="text" class="form-control" name="video_link"
                                       value="{!! old('video_link',isset($video) ? $video->url : null) !!}">
                            </div>

                        </div>


                    </div>



                </div>

                <div class="tab-pane" id="settings">
                    <div class="form-group">
                        <label>Title SEO</label>
                        <input type="text" class="form-control" name="meta_title" value="{!! old('meta_title',isset($category) ? $category->meta_title : null) !!}">
                    </div>

                    <div class="form-group">
                        <label>Meta Description</label>
                        <textarea name="meta_description" id=""
                                  class="form-control"
                                  rows="5">{!! old('meta_description',isset($category) ? $category->meta_description : null) !!}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Meta Keyword</label>
                        <input type="text" class="form-control" name="meta_keyword" value="{!! old('meta_keyword',isset($category) ? $category->meta_keyword : null) !!}">
                    </div>
                </div>

                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>

        <button type="submit" class="btn btn-primary">OK</button>
    </form>

@endsection