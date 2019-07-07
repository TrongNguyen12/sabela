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
                                <label>Chọn 3 Danh Mục Sản Phẩm Hiển Thị Trong Menu</label>
                                <select class="form-control multislt" name="category_id[]" multiple="">
                                    <option value="">Chọn danh mục sản phẩm</option>
                                    @foreach ($cate as $item)
                                        <?php $selected = false ?>
                                        @foreach ($menu as $itemmenu)
                                            @if ($itemmenu->id == $item->id)
                                                <?php $selected = true ?>
                                            @endif
                                        @endforeach
                                        <option value="{{ $item->id }}" {{  $selected == true ? 'selected' : null }} >{{ $item->name }}</option>
                                    @endforeach
                                </select>
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