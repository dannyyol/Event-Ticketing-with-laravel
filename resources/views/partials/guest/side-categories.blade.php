<div class="col-lg-3 float-md-right">
	<div class="left_sidebar_area">
		<aside class="l_widget l_categories_widget">
			<div class="l_title">
				<h3>categories</h3>
			</div>
			<ul>
				@foreach ($count_subcategories as $count)
					<li><a href="{{ route('guest.home', ['ids'=>$count->id]) }}#category" aria-expanded="false" aria-controls="fruitsVegetable"><span
					class="lnr lnr-arrow-right"></span>{{$count->title}}<span class="badge badge-pill badge-info">{{$count->events_count}}</span></a>
					</li>
				@endforeach
				
			</ul>
		</aside>
		<!-- <aside class="l_widget l_supper_widget">
			<img class="img-fluid" src="img/supper-add-1.jpg" alt="">
			<h4>Super Summer Collection</h4>
		</aside> -->
		<aside class="l_widget l_feature_widget">
			<div class="verticalCarousel">
				<div class="verticalCarouselHeader">
					<div class="float-md-left">
						<h3>New Events</h3>
					</div>
					<div class="float-md-right">
						<a href="#" class="vc_goUp"><i class="arrow_carrot-left"></i></a>
						<a href="#" class="vc_goDown"><i class="arrow_carrot-right"></i></a>
					</div>
				</div>
				<ul class="verticalCarouselGroup vc_list">
					@foreach ($new_events as $item)
						
						<li>
							@guest()
								<a href="{{ route("auth.login")}}">
							@endif
							<a href="#" class="" data-toggle="modal" data-target="#{{$item->id}}">
								<div class="media">
									<div class="d-flex">
										<img src="{{ url('images/events', $item->photo) }}" alt="" width='80', height='80'>
									</div>
									<div class="media-body">
										<h4>{{$item->title}}</h4>
											@foreach ($item->tickets as $ticket)
												<h5>${{$ticket->price}}</h5>
											@endforeach
										
									</div>
								</div>
							</a>
						</li>
					@endforeach
				</ul>
			</div>
		</aside>
		<!-- <aside class="l_widget l_news_widget">
			<h3>newsletter</h3>
			<p>Sign up for our Newsletter !</p>
			<div class="input-group">
				<input type="email" class="form-control" placeholder="yourmail@domain.com" aria-label="Search for...">
				<span class="input-group-btn">
					<button class="btn btn-secondary subs_btn" type="button">Subscribe</button>
				</span>
			</div>
		</aside> -->
		<!-- <aside class="l_widget l_hot_widget">
			<h3>Summer Hot Sale</h3>
			<p>Premium 700 Product , Titles and Content Ideas</p>
			<a class="discover_btn" href="#">shop now</a>
		</aside> -->
	</div>
</div>

