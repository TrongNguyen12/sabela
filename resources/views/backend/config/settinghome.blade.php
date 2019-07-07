<?php //dd($content->sec1) ?>
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
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Khối thứ 1</label><br>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề </label>
                                <input type="text" class="form-control" name="name1"
                                       value="{{ $content->sec1->tile }}">
                            </div>
                             <div class="form-group">
                                <label>Tùy chọn hiển thị</label>
                                <select class="form-control" name="optionDisplaySec1" id="optionDisplaySec1">
                                    <option value="1" {{ $content->sec1->optionDisplay == 1 ? 'selected' : null }} >Hiển thị các sản phẩm đang giảm giá</option>
                                    <option value="2" {{ $content->sec1->optionDisplay == 2 ? 'selected' : null }}>Hiển thị các sản phẩm đang giảm giá với giá chính xác</option>
                                </select>
                            </div>
                            <div class="form-group" id="priceSale" style="{{ $content->sec1->optionDisplay == 1 ? 'display: none' : null }}">
                                <input type="number" name="priceSale" placeholder="Nhập giá chính xác" class="form-control" value="{{ $content->sec1->priceOptionDisplay }}">
                            </div>
                            <div class="form-group">
                                <label>Link </label>
                                <input type="text" class="form-control" name="url1"
                                       value="{!! $content->sec1->link !!}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Khối thứ 2</label><br>
                                
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề </label>
                                <input type="text" class="form-control" name="name2"
                                       value="{!! $content->sec2->tile !!}">
                            </div>
                            <div class="form-group">
                                <label>Danh mục sản phẩm hiển thị</label>
                                <select class="form-control " name="category_id2">
                                    <option value="">Chọn danh mục</option>
                                     {!! menuMulti($cate,0,'', $content->sec2->categoryList) !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Link </label>
                                <input type="text" class="form-control" name="url2"
                                       value="{!! $content->sec2->link  !!}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Khối thứ 3</label><br>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề </label>
                                <input type="text" class="form-control" name="name3"
                                       value="{!! $content->sec3->tile !!}">
                            </div>
                            <div class="form-group">
                                <label>Danh mục sản phẩm hiển thị</label>
                                <select class="form-control " name="category_id3" >
                                    <option value="">Chọn danh mục</option>
                                     {!! menuMulti( $cate,0,'',$content->sec3->categoryList ) !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Link </label>
                                <input type="text" class="form-control" name="url3"
                                       value="{!! $content->sec3->link !!}">
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

@section('script')
    <script>
        jQuery(document).ready(function($) {
            $('#optionDisplaySec1').change(function(event) {
               if($(this).val() == 2){
                $('#priceSale').slideDown();
               }else{
                $('#priceSale').slideUp();
               }
            });
        });
    </script>
@endsection