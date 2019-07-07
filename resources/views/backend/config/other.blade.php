@extends('backend.index')
@section('controller','Cấu hình khác')
@section('action','Cập nhật')
@section('content')

    @include('backend.block.error')


<?php //dd($other) ?>

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
                                <label>Tuyển cộng tác viên</label>
                                <input type="text" class="form-control" name="header_recruitment" id="header_recruitment"
                                       value="{!! old('header_recruitment', isset($other->header_recruitment->content) ? $other->header_recruitment->content : null) !!}">
                            </div>
                        </div>
                        <div class="col-lg-8">

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