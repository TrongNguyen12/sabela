@extends('frontend.master')
@section('main')
	<main class="">
		<section class="album">
			<div class="bread-wrap">
				<div class="container">
					<ul class="list-unstyled bread">
						<li><a href="{{ asset('/') }}" title=""><i class="fas fa-home"></i> {{ trans('lang.title12') }}</a></li>
						<li><a href="#" title="">Album</a></li>
					</ul>
				</div>
			</div>
			<div class="container">
				<h1 class="medium s18 t5 album-tit sr-only">Album</h1>
				<div class="album-wrap">
					<div class="row album-row">
						@foreach ($albums as $item)
							<div class="col-lg-4 col-md-6 col-sm-6">
								<article class="album-item">
									<figure class="album-item-img">
										<a data-toggle="modal" data-target="#album-modal-{{ $item->id }}" href="#" title="">
											<img src="{{ asset('uploads/album/'.$item->image ) }}" alt="" title=""></a>
									</figure>
									<figcaption class="album-item-info">
										<h2 class="s16 t5 text-uppercase medium py-3 album-item-info-tit">
											<a href="#" data-toggle="modal" data-target="#album-modal-{{ $item->id }}" title="">
												@if (App::isLocale('vi'))
													{{ $item->content }}
												@else
													{{ $item->contenteg }}
												@endif
											</a>
										</h2>
									</figcaption>
								</article>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</section>
		@foreach ($albums as $item)
			<div class="modal fade album-modal" id="album-modal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <img src="{{ asset('public/frontend') }}/images/close.png" alt="" title="">
			        </button>
			      <div class="modal-body">
			        <div class="slider video-for">
			        	@foreach ($item->ImageAlbum as $item1)
			        		<div class="position-relative video-content">
							<img src="{{ asset( 'uploads/album/image/'.$item1->image ) }}" title="" width="" height="" alt="">
							<div class="bg-white album-content">
									<h3 class="pb-3 s16 medium t5 album-stit">
										@if (App::isLocale('vi'))
											{{ $item1->name }}
										@else
											{{ $item1->nameeg }}
										@endif
									</h3>
									<div class="album-scontent s14">
										<p>
											@if (App::isLocale('vi'))
												{{ $item1->content }}
											@else
												{{ $item1->contenteg }}
											@endif
										</p>
									</div>
								</div>
							</div>
			        	@endforeach
					</div>
					<div class="slider video-nav">
						@foreach ($item->ImageAlbum as $item2)
							<div class="d-flex position-relative video-thumb">
								<img src="{{ asset( 'uploads/album/image/'.$item2->imagethumb ) }}" alt="" title="" width="" height="" class="lazy">
							</div>
						@endforeach
					</div>
			      </div>
			    </div>
			  </div>
			</div>
		@endforeach
	</main>
@endsection