@extends('backend.index')
@section('controller','Quảng cáo')
@section('action','Cập nhật')
@section('content')

    @include('backend.block.error')


<?php //dd($ads) ?>

    <form action="" method='POST' enctype="multipart/form-data" name="frmEditProduct">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin chung</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="activity">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Vị trí thứ 1</label><br>
                                <?php

                                $image = image_url($ads[0]->image);
                                ?>
                                <img src="{!! $image !!}" id="show-img" class="showImg">

                                <div class="file-loading">
                                    <input id="inpImg" name="fImage1" type="file" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Tiêu đề </label>
                                <input type="text" class="form-control" name="name1"
                                       value="{!! old('name1', isset($ads[0]->name) ? $ads[0]->name : null) !!}">
                            </div>

                            <div class="form-group">
                                <label>Link </label>
                                <input type="text" class="form-control" name="url1"
                                       value="{!! old('url1', isset($ads[0]->url) ? $ads[0]->url : null) !!}">
                            </div>


                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Vị trí thứ 2</label><br>
                                <?php

                                $image = image_url($ads[1]->image);

                                ?>
                                <img src="{!! $image !!}" id="show-img" class="showImg">

                                <div class="file-loading">
                                    <input id="inpImg3" name="fImage2" type="file" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Tiêu đề </label>
                                <input type="text" class="form-control" name="name2"
                                       value="{!! old('name2', isset($ads[1]->name) ? $ads[1]->name : null) !!}">
                            </div>
                            <div class="form-group">
                                <label>Link </label>
                                <input type="text" class="form-control" name="url2"
                                       value="{!! old('url2', isset($ads[1]->url) ? $ads[1]->url : null) !!}">
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