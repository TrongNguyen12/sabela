@extends('frontend.master')
@section('main')
	<main class="">
		<div class="bread-wrap">
			<div class="container">
				<ul class="list-unstyled bread">
					<li><a href="{{ asset('/') }}" title=""><i class="fas fa-home"></i></a></li>
					<li><a href="#" title="">Tin tức</a></li>
				</ul>
			</div>
		</div>
		<section class="blogpage">
			<div class="container">
				<h1 class="sr-only"></h1>
				<ul class="nav blog-tab" id="pills-tab" role="tablist">
					<?php $i = 0; ?>
					@foreach ($catPost as $item)
						<?php $i++ ?>
					  	<li class="">
					    	<a class="nav-link {{ $i == 1 ? 'active' : null }}" data-toggle="pill" 
					    		href="#pills-home{{ $item->id }}">{{ $item->name }}</a>
					  	</li>
				  @endforeach
				</ul>
				<div class="tab-content" id="pills-tabContent">
					<?php $j = 0; ?>
					@foreach ($catPost as $item)
						<?php 
							$j++;
							$listPost = DB::table('post')->where('idCatPost', $item->id)->paginate(4);
						?>
					  <div class="fade {{ $j == 1 ? 'show active' : null }}" id="pills-home{{ $item->id }}" >
						<div class="row">
							@foreach ($listPost as $item)
								<div class="col-lg-3 col-md-6 col-sm-6">
									<article class="blog-item">
										<figure class="blog-img">
											<a href="{{ asset( 'tin-tuc/'.$item->slug.'-p'.$item->id ) }}" title="">
												<img src="{{ asset( 'uploads/post/'.$item->image ) }}" alt="" title="">
											</a>
										</figure>
										<figcaption class="blog-info">
											<h2 class="text-uppercase medium blog-info-tit py-3 t5">
												<a href="{{ asset( 'tin-tuc/'.$item->slug.'-p'.$item->id ) }}" title="">
													
													@if (App::isLocale('vi'))
														{{ $item->name }}
													@else
														{{ $item->nameeg }}
													@endif
												</a>
											</h2>
											<div class="blog-info-content">
												
												@if (App::isLocale('vi'))
													{!!  $item->content_short !!}
												@else
													{!!  $item->content_shorteg !!}
												@endif

											</div>
											<div class="d-flex align-items-center justify-content-between blog-ft">
												<span class="s13">{{ date('d/m/Y', strtotime( $item->created_at )) }}</span>
												<i class="fas fa-chevron-circle-right t9"></i>
											</div>
										</figcaption>
									</article>
								</div>
							@endforeach
						</div>
						<ul class="pagi">
							{{ $listPost->links() }}
						</ul>
			  		  </div>
			  		@endforeach
				</div>
				
			</div>
		</section>
		
	</main>
@endsection