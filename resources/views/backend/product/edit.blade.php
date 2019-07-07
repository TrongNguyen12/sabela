@extends('backend.index')
@section('controller','Sản phẩm')
@section('controller_route',route('backend.product'))
@section('action','Sửa')
@section('content')
    @include('backend.block.error')
    <form action="{!! route('backend.product.postEdit', $product->id) !!}" method="POST" enctype="multipart/form-data" >
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin chung</a></li>
            <li class=""><a href="#product_gallery" data-toggle="tab" aria-expanded="false">Thư viện ảnh</a></li>
            <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Cấu hình SEO</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="activity">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            @if (!empty($product->image))
                                <img src="
                                {{ asset( 'uploads/product/avatar/'.$product->image ) }}" 
                                class="img-thumbnail" width="200px" height="200px">
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <div class="file-loading">
                                <input id="inpImg" name="fImage" type="file">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text" class="form-control" name="name" id="name" 
                            value="{!! old('name', isset($product) ? $product['name'] : null ) !!}">
                        </div>
                       
                        <div class="form-group">
                            <label>Đường dẫn tĩnh</label>
                            <input type="text" class="form-control" name="slug" id="slug" 
                            value="{!! old('slug', isset($product) ? $product['slug'] : null ) !!}">
                        </div>
                        <div class="form-group">
                            <?php $category =  $product->category->pluck('id')->toArray() ;?>
                            <label>Danh mục</label>
                            <select class="form-control multislt" name="category_id[]" multiple="">
                              <option value="">Chọn danh mục sản phẩm</option>
                              @foreach ($categories as $item)
                                <?php $selected = null;
                                    if($product->category->contains($item)){
                                        $selected = 'selected';
                                    }?>
                                <option value="{{ $item->id }}" {{ $selected }}>
                                    {{ $item->name }}
                                </option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Tùy chỉnh sản phẩm</label> <br>
                                    <input type="checkbox" name="status" value="1" {{ $product->status == 1 ? 'checked' : null }} >
                                    <label for="status" class="lbl">Hiển thị</label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="new" value="1" {{ $product->new == 1 ? 'checked' : null }}>
                                    <label for="status" class="lbl">Sản phẩm mới</label>
                                </div>
                                 <div class="form-group">
                                    <input type="checkbox" name="hot" value="1" {{ $product->hot == 1 ? 'checked' : null}}>
                                    <label for="status" class="lbl">Sản phẩm nổi bật</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                  <label>Mô tả ngắn</label>
                  <textarea id="desc" name="sort_desc">{!! old('sort_desc', isset($product) ? $product['sort_desc'] : null ) !!}</textarea>
                </div>
                <div class="form-group">
                  <label>Mô tả chi tiết</label>
                  <textarea id="content" name="desc">{!! old('desc', isset($product) ? $product['desc'] : null ) !!}</textarea>
                </div>
            </div>

            <div class="tab-pane" id="product_gallery">
                <label>Hình ảnh</label>
                <div class="file-loading">
                    <input id="gallery" name="fImageGallery[]" type="file" multiple>
                </div>
                @if (!empty($product->more_image))
                    <div class="row">
                        <?php $more_image = json_decode($product->more_image) ?>
                        @foreach ($more_image as $item)
                            <div class="col-sm-2" style="text-align: center;">
                                <img src="{{ asset('uploads/product/prod/'.$item ) }}" class="img-thumbnail" width="200px">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="tab-pane" id="settings">
                <div class="form-group">
                    <label>Title SEO</label>
                    <input type="text" class="form-control" name="meta_title" 
                    value="{!! old('meta_title', isset($product) ? $product['meta_title'] : null ) !!}">
                </div>

                <div class="form-group">
                    <label>Meta Description</label>
                    <input type="text" name="meta_description" id=""class="form-control" 
                    value="{!! old('meta_description', isset($product) ? $product['meta_description'] : null ) !!}" style="height: 70px">
                </div>

                <div class="form-group">
                    <label>Meta Keyword</label>
                    <input type="text" class="form-control" name="meta_keyword" 
                    value="{!! old('meta_keyword', isset($product) ? $product['meta_keyword'] : null ) !!}">
                </div>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@endsection
