@extends('backend.index')
@section('controller','Mạng xã hội')
@section('action','Cập nhật')
@section('content')

    @include('backend.block.error')


<?php //dd($socials) ?>

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
                                <label>Twitter</label>
                                <input type="text"
                                       class="form-control"
                                       name="twitter"
                                       id="twitter"
                                       value="{!! old('twitter', isset($socials->twitter->url) ? $socials->twitter->url : null) !!}">
                            </div>
                            <div class="form-group">
                                <label>Facebook</label>
                                <input type="text"
                                       class="form-control"
                                       name="facebook"
                                       id="facebook"
                                       value="{!! old('facebook', isset($socials->facebook->url) ? $socials->facebook->url : null) !!}">
                            </div>
                            <div class="form-group">
                                <label>Linkedin</label>
                                <input type="text" class="form-control" name="instagram" id="instagram" value="{!! old('instagram', isset($socials->instagram->url) ? $socials->instagram->url : null) !!}">
                            </div>
                            <div class="form-group" style="display: none;">
                                <label>Youtube</label>
                                <input type="text" class="form-control" name="youtube" id="youtube"
                                       value="{!! old('youtube', isset($socials->youtube->url) ? $socials->youtube->url : null) !!}">
                            </div>
                            <div class="form-group" style="display: none;">
                                <label>Google plus</label>
                                <input type="text"
                                       class="form-control"
                                       name="google_plus"
                                       id="google_plus"
                                       value="{!! old('google_plus', isset($socials->google_plus->url) ? $socials->google_plus->url : null) !!}">
                            </div>
                            <div class="form-group" style="display: none;">
                                <label>Skype</label>
                                <input type="text" class="form-control" name="skype" id="skype" value="{!! old('skype', isset($socials->skype->url) ? $socials->skype->url : null) !!}">
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