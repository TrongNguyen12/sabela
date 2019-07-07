<div class="col-lg-3 col-md-4 col-sm-4 order-sm-1 order-12">
	<aside class="vk-sidebar pro-aside">
	<h2 class="medium t5 pro-aside-tit">{{ trans('lang.title28') }}</h2>
	<div class="vk-sidebar__box">
	    <input type="hidden" value="0">
	    <ul class="vk-sidebar__list vk-list__link-filter" data-list="">
	    	@foreach ($product_cat as $item)
	    		@if ($item->parent_id !=0 )
		    		<?php
	                    $url_query_render = url_query_render('cat', $item->id);
	                    $url = $url_query_render['url']  ;
	                    $active = $url_query_render['active'] ? 'active' : null ;
	                ?>
			        <li data-value="{{ $item->name }}" class="{!! $active !!}">
			        	<a href="{{ $url }}">
			        		@if (App::isLocale('vi'))
								{{ $item->name }}
							@else
								{{ $item->nameeg }}
							@endif
			        	</a>
			        </li>
			    @endif
	        @endforeach
	    </ul>
	</div> <!--./box-->

	<div class="vk-sidebar__box">
	    <input type="hidden" value="0">
	    <h2 class="vk-sidebar__title">{{ trans('lang.title23') }}</h2>
	    <ul class="vk-sidebar__list vk-list__link-filter" data-list="">
	        @foreach ($filtersMaterial as $item)
		       <?php
                    $url_query_render = url_query_render('material', $item->slug);
                    $url = $url_query_render['url']  ;
                    $active = $url_query_render['active'] ? 'active' : null ;
                ?>
		        <li data-value="{{ $item->name }}" class="{!! $active !!}">
		        	<a href="{{ $url }}">
		        		@if (App::isLocale('vi'))
							{{ $item->name }}
						@else
							{{ $item->nameeg }}
						@endif
		        	</a>
		        </li>
	        @endforeach
	    </ul>
	</div> <!--./box-->

	<div class="vk-sidebar__box">
	    <input type="hidden" value="0">
	    <h2 class="vk-sidebar__title">SIZE</h2>
	    <ul class="vk-sidebar__list vk-list__link-filter" data-list="">
	    	@foreach ($filtersSize as $item)
		       <?php
                    $url_query_render = url_query_render('size', $item->slug);
                    $url = $url_query_render['url']  ;
                    $active = $url_query_render['active'] ? 'active' : null ;
                ?>
		        <li data-value="{{ $item->name }}" class="{!! $active !!}">
		        	<a href="{{ $url }}">
		        		@if (App::isLocale('vi'))
							{{ $item->name }}
						@else
							{{ $item->nameeg }}
						@endif
		        	</a>
		        </li>
	        @endforeach
	    </ul>
	</div> <!--./box-->

	<div class="vk-sidebar__box">
	    <input type="hidden" value="0">
	    <h2 class="vk-sidebar__title">{{ trans('lang.title29') }}</h2>
	    <ul class="vk-sidebar__list vk-list__link-filter" data-list="">
	       	@foreach ($filtersSeason as $item)
	       		<?php
                    $url_query_render = url_query_render('season', $item->slug);
                    $url = $url_query_render['url']  ;
                    $active = $url_query_render['active'] ? 'active' : null ;
                ?>
		        <li data-value="{{ $item->name }}" class="{!! $active !!}">
		        	<a href="{{ $url }}">
		        		@if (App::isLocale('vi'))
							{{ $item->name }}
						@else
							{{ $item->nameeg }}
						@endif
		        	</a>
		        </li>
	        @endforeach
	    </ul>
	</div> <!--./box-->
	</aside>
</div>