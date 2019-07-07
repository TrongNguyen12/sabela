@extends('backend.index')
@section('controller',  Request::segment(2) == 'about' ? 'Giới thiệu' : 'WHY-ORGANIC' )
@section('action','Cập nhật')
@section('content')
    @include('backend.block.error')
        @if (!empty($about->content_main))
            <?php $content = json_decode($about->content_main) ?>
        @endif
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <form action="" method='POST' enctype="multipart/form-data" name="frmEditProduct">
            <input type="hidden" name="_token" value="{!! csrf_token(); !!}">
            <input type="hidden" name="id" value="{!! isset($about) ? $about->id : null !!}">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#activity" data-toggle="tab" aria-expanded="true">Giới thiệu</a>
                    </li>
                    <li class="">
                        <a href="#activity2" data-toggle="tab" aria-expanded="true">Cấu hình SEO</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="activity">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Tiêu đề trang giới thiệu</label>
                                    <input type="text" class="form-control" name="title" value="{{ $about->name }}">
                                    <a href="{{ asset('gioi-thieu') }}">Link: {{ asset('gioi-thieu') }}</a>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="col-sm-6" style="padding-left: 0px;">
                                         <label>Banner trang giới thiệu</label>
                                         <div class="file-loading">
                                            <input id="inpImg" name="fImage" type="file">
                                        </div>
                                    </div>
                                    @if (!empty($about->image))
                                        <div class="col-sm-6" style="padding-right: 0px;">
                                            <img src="{{ asset( 'uploads/post/'.$about->image ) }}" alt="" class="img-thumbnail">
                                        </div>
                                    @endif
                                   
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea id="content" name="content" rows="8">
                                        {{ isset($content) ? $content->content : null }}
                                    </textarea>
                                </div>
                            </div>
                             <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Tiêu đề khối hai</label>
                                    <input type="text" class="form-control" name="title_second" value="{{ isset($content) ? $content->title_second : null }}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Mô tả ngắn khối 2</label>
                                    <textarea id="content1" name="content_second" rows="5">     
                                        {{ isset($content) ? $content->content_second : null }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Thư viện ảnh</label>
                                    <div class="file-loading">
                                        <input id="gallery" name="fImageGallery[]" type="file" multiple>
                                    </div>
                                </div>
                                @if (isset($content))
                                    <div class="form-group">
                                        @foreach ($content->image_gallery as $item)
                                            <div class="col-sm-3">
                                                <img src="{{ asset( 'uploads/post/'.$item ) }}" class="img-thumbnail">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="activity2">
                         <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Meta Title</label>
                                    <input type="text" class="form-control" name="meta_title" value="{{ $about->meta_title }}">
                                </div>
                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <input type="text" class="form-control" name="meta_description"
                                    value="{{ $about->meta_description }}">
                                </div>
                                <div class="form-group">
                                    <label>Meta Keyword</label>
                                    <input type="text" class="form-control" name="meta_keyword"
                                    value="{{ $about->meta_keyword }}">
                                </div>
                            </div>

                    </div>
                    </div>
                </div>
            </div>
                <button type="submit" class="btn btn-primary">Lưu Lại</button>
                <a href="{{ asset('/backend') }}" class="btn btn-danger">Hủy Bỏ</a>
        </form>
@endsection