@extends('layouts.guest')
@section('content')
	
<!--================Main Content Area =================-->
<section class="home_sidebar_area">
		<div class="container">
			<div class="row row_disable">
				<div class="col-lg-9 float-md-right">
					<div class="sidebar_main_content_area">
						<form action="/search" method="get">
							<div class="advanced_search_area">
								
								<select class="selectpicker" onchange="location = this.value;">
									<option value="">Select City</option>
									@foreach ($count_categories as $category)
										<option value="{{route('guest.home', ['id'=>$category->id])}}">{{ $category->name }}</option>
									@endforeach
								</select>
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search" aria-label="Search" name="q">
									<span class="input-group-btn">
										<input class="btn btn-secondary" type="submit"><i class="icon-magnifier icons"></i>
									</span>
								</div>
							</div>
						</form>
						<div class="main_slider_area">
							<div id="home_box_slider" class="rev_slider" data-version="5.3.1.6">
								<ul>
									<li data-index="rs-1587" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="300"  data-thumb="img/home-slider/slider-1.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Creative" data-param1="01" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
									<!-- MAIN IMAGE -->
									<img src="images/home-slider/slider-2.jpg"  alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg" data-no-retina>

										<!-- LAYER NR. 1 -->
										<div class="slider_text_box first_text">
											<div class="tp-caption tp-resizeme first_text" 
											data-x="['left','left','left','left','left','left']" 
											data-hoffset="['60','60','60','60','20','0']" 
											data-y="['top','top','top','top','top','top']" 
											data-voffset="['70','70','70','70','70','70']" 
											data-fontsize="['48','48','48','48','48','48']"
											data-lineheight="['56','56','56','56','56','48']"
											data-width="['none','none','none','none','none']"
											data-height="none"
											data-whitespace="nowrap"
											data-type="text" 
											data-responsive_offset="on" 
											data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:0px;s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
											data-textAlign="['left','left','left','left','left','left']"
											>
											
											@if (REQUEST()->get('id'))
												@foreach ($events as $event)
													@if ($loop->first)
														{{$event->categories->name}}
														</div>
													@endif
													@if ($event->categories->name)
													No Event <br >in the selected city
													@endif
												{{-- @empty
												  --}}
												@endforeach
											@endif

											@if (REQUEST()->get('ids'))
												@foreach ($events as $event)
													@if ($loop->first)
														{{$event->subcategories->title}}
														</div>
													@endif
													@if ($event->subcategories->title)
													No Event <br >in the selected city
													@endif
												{{-- @empty
												  --}}
												@endforeach
											@endif
											
											

											<div class="tp-caption tp-resizeme secand_text" 
												data-x="['left','left','left','left','left','left']" 
												data-hoffset="['60','60','60','60','20','0']" 
												data-y="['top','top','top','top']" data-voffset="['190','190','190','190','190','190']"  
												data-fontsize="['14','14','14','14','14','14']"
												data-lineheight="['24','24','24','24','24']"
												data-width="['300','300','300','300','300']"
												data-height="none"
												data-whitespace="normal"
												data-type="text" 
												data-responsive_offset="on"
												data-transform_idle="o:1;"
												data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:[100%];s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
												data-textAlign="['left','left','left','left','left','left']"
												>There is no one who loves to be bread, who looks after it and wants to have it, simply because it is pain. 
											</div>

											<div class="tp-caption tp-resizeme third_btn" 
												data-x="['left','left','left','left','left','left']" 
												data-hoffset="['60','60','60','60','20','0']" 
												data-y="['top','top','top','top']" data-voffset="['290','290','290','290','290','290']" 
												data-width="none"
												data-height="none"
												data-whitespace="nowrap"
												data-type="text" 
												data-responsive_offset="on" 
												data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:[100%];s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
												data-textAlign="['left','left','left','left','left','left']">
												<a class="checkout_btn" href="#">shop now</a>
											</div>
										</div>
									</li>
									<li data-index="rs-1588" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="300"  data-thumb="images/home-slider/slider-2.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Creative" data-param1="01" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
									<!-- MAIN IMAGE -->
									<img src="images/home-slider/slider-2.jpg"  alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg" data-no-retina>
									<!-- LAYERS -->
										<!-- LAYERS -->

										<!-- LAYER NR. 1 -->
										<div class="slider_text_box first_text">
											<div class="tp-caption tp-resizeme first_text" 
											data-x="['left','left','left','left','left','left']" 
											data-hoffset="['60','60','60','60','20','0']" 
											data-y="['top','top','top','top','top','top']" 
											data-voffset="['70','70','70','70','70','70']" 
											data-fontsize="['48','48','48','48','48','48']"
											data-lineheight="['56','56','56','56','56','48']"
											data-width="['none','none','none','none','none']"
											data-height="none"
											data-whitespace="nowrap"
											data-type="text" 
											data-responsive_offset="on" 
											data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:0px;s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
											data-textAlign="['left','left','left','left','left','left']"
											>Best Winter <br> Collection</div>

											<div class="tp-caption tp-resizeme secand_text" 
												data-x="['left','left','left','left','left','left']" 
												data-hoffset="['60','60','60','60','20','0']" 
												data-y="['top','top','top','top']" data-voffset="['190','190','190','190','190','190']"  
												data-fontsize="['14','14','14','14','14','14']"
												data-lineheight="['24','24','24','24','24']"
												data-width="['300','300','300','300','300']"
												data-height="none"
												data-whitespace="normal"
												data-type="text" 
												data-responsive_offset="on"
												data-transform_idle="o:1;"
												data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:[100%];s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
												data-textAlign="['left','left','left','left','left','left']"
												>There is no one who loves to be bread, who looks after it and wants to have it, simply because it is pain. 
											</div>

											<div class="tp-caption tp-resizeme third_btn" 
												data-x="['left','left','left','left','left','left']" 
												data-hoffset="['60','60','60','60','20','0']" 
												data-y="['top','top','top','top']" data-voffset="['290','290','290','290','290','290']" 
												data-width="none"
												data-height="none"
												data-whitespace="nowrap"
												data-type="text" 
												data-responsive_offset="on" 
												data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:[100%];s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
												data-textAlign="['left','left','left','left','left','left']">
												<a class="checkout_btn" href="#">shop now</a>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
						
						<div class="promotion_area">
							<div class="feature_inner row m0">
								<div class="left_promotion">
									<div class="f_add_item">
										<div class="f_add_img"><img class="img-fluid" src="images/feature-add/f-add-6.jpg" alt=""></div>
										<div class="f_add_hover">
											<div class="sale">Sale</div>
											<h4>Best Summer <br />Collection</h4>
											<a class="add_btn" href="#">Shop Now <i class="arrow_right"></i></a>
										</div>
									</div>
								</div>
								<div class="right_promotion">
									<div class="f_add_item right_dir">
										<div class="f_add_img"><img class="img-fluid" src="images/feature-add/f-add-7.jpg" alt=""></div>
										<div class="f_add_hover">
											<div class="off">10% off</div>
											<h4>Best Summer <br />Collection</h4>
											<a class="add_btn" href="#">Shop Now <i class="arrow_right"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
						@if (REQUEST()->get('ids'))		
							<div class="fillter_home_sidebar" id ="category">
									@foreach ($events as $event)
										
										@if ($loop->first)
										<h4>{{$event->subcategories->title}}</h4>
										@endif
									@endforeach
									<br>
									<div class="row">
					
										@foreach ($events as $event)
									
											<div class="col-lg-4 col-sm-6">
												<div class="l_product_item">
													<div class="l_p_img">
														<img src="{{ url('images/events', $event->photo) }}" alt="">
														<h5 class="sale">Sale</h5>
													</div>
													<div class="l_p_text">
													<ul>
															<li class="p_icon"><a href="#"><i class="icon_piechart"></i></a></li>
															<li><a class="add_cart_btn" href="#">Add To Cart</a></li>
															<li class="p_icon"><a>
																<i class="icon_heart_alt {{$event->isLiked()?"liked":""}}" onclick="likeIt('{{$event->id}}',this)"></i>
															</a></li>
														</ul>
														
														<h4>{{  $event->title}}</h4>
														@foreach ($event->tickets as $ticket)
															<h5>{{$ticket->price}}</h5>
														@endforeach
														
													</div>
												</div>
											</div>
										@endforeach
									</div>
							</div>
							<hr>
						{{-- Categories --}}
						@elseif(REQUEST()->get('id'))
							<div class="fillter_home_sidebar" id ="category">
								@foreach ($events as $event)
									
									@if ($loop->first)
									<h4>{{$event->categories->name}}</h4>
									@endif
								@endforeach
								<br>
								<div class="row">
				
									@foreach ($events as $event)
								
										<div class="col-lg-4 col-sm-6">
											<div class="l_product_item">
												<div class="l_p_img">
													<img src="{{ url('images/events', $event->photo) }}" alt="">
													<h5 class="sale">Sale</h5>
												</div>
												<div class="l_p_text">
												<ul>
													<li class="p_icon"><a href="#"><i class="icon_piechart"></i></a></li>
													{{-- <li><a class="add_cart_btn" href="#"></a></li> --}}

														<li>
														<a href="#" class="add_cart_btn" data-toggle="modal" data-target="#{{$event->id}}">
																Add To Cart
															</a>
														</li>


													<li class="p_icon"><a>
														<i class="icon_heart_alt {{$event->isLiked()?"liked":""}}" onclick="likeIt('{{$event->id}}',this)"></i>
													</a></li>
												</ul>
													
												<h4>{{  $event->title}}</h4>
												@foreach ($event->tickets as $ticket)
													<h5>{{$ticket->price}}</h5>
												@endforeach
												
											</div>
										</div>
									</div>

									<form action="" method="POST">
										<div class="modal fade" id="{{$event->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header" style="padding:0px !important;">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true" style="font-size:25px;color:white;z-index:1;position:absolute;">&times;</span>
												</button>
												</div>
												
												<div class="modal-body" style="margin-top:-20px;padding:0px !important;padding-left:0px !important;"> 
													<div class="__display_image">
														<img src="{{ url('images/events', $event->photo) }}"  alt="" style="">
													</div>
														
													@foreach($event->tickets as $ticket)
													
														@if(!$tickets->isEmpty())
															<script type="text/javascript">
																$(document).ready(function(){
																		$('.ticket-{{ $ticket->id }} .quantity').on('click keyup change blur', function() {
																			var quantity = parseInt($('.ticket-{{ $ticket->id }} .quantity').val());
																			if(isNaN(quantity)) {
																				quantity = 0;
																				$('.ticket-{{ $ticket->id }} .quantity').val(0);
																			} else if (quantity < 0) {
																				quantity = 0;
																				$('.ticket-{{ $ticket->id }} .quantity').val(0);
																			} else if (quantity > {{ $ticket->amount }}) {
																				quantity = parseInt({{ $ticket->amount }});
																				$('.ticket-{{ $ticket->id }} .quantity').val({{ $ticket->amount }});
																			}
																			var subtotal = parseFloat({{ $ticket->price }}) * quantity;
																			$('.ticket-{{ $ticket->id }} .subtotal').text(subtotal.toFixed(2));
																			$('.ticket-{{ $ticket->id }} .rsubtotal').val(subtotal.toFixed(2));
																		});
																	$('.quantity').on('click keyup change blur', function () {
																		var sum = 0;
																		var collection = { tickets: [] };
																		$('.quantity').each(function () {
																			var ticket = {};
																			ticket['id'] = $(this).data('ticket');
																			ticket['amount'] = $(this).val();
																			collection.tickets.push(ticket);
																		});
																		$('.rsubtotal').each(function () {
																			sum += Number($(this).val());
																			$('.rtotal').val(sum.toFixed(2));
																			$('.total').text(sum.toFixed(2));
																		});
																		$('input[name=tickets]').val(JSON.stringify(collection));
																	});
																});
															</script>
														@endif
													@endforeach
												
												@if (env('STRIPE_KEY'))
													<script type="text/javascript">
														$(document).ready(function () {
															var stripe = Stripe('{{ env('STRIPE_KEY') }}');
															var elements = stripe.elements();
												
															var style = {
																base: {
																	// Add your base input styles here. For example:
																	fontSize: '16px',
																	lineHeight: '24px'
																}
															};
												
															var card = elements.create('card', {style: style, hidePostalCode: true});
															card.mount('#card-element');
												
															card.addEventListener('change', function (event) {
																var displayError = document.getElementById('card-errors');
																if (event.error) {
																	displayError.textContent = event.error.message;
																	$('#card-errors').show(400, 'swing');
																} else {
																	displayError.textContent = '';
																	$('#card-errors').hide();
																}
															});
												
															var form = document.getElementById('payment-form');
															form.addEventListener('submit', function (event) {
																event.preventDefault();
												
																stripe.createToken(card).then(function (result) {
																	if (result.error) {
																		var errorElement = document.getElementById('card-errors');
																		errorElement.textContent = result.error.message;
																	} else {
																		stripeTokenHandler(result.token);
																	}
																})
															});
												
															function stripeTokenHandler(token) {
																var form = document.getElementById('payment-form');
																var hiddenInput = document.createElement('input');
																hiddenInput.setAttribute('type', 'hidden');
																hiddenInput.setAttribute('name', 'stripeToken');
																hiddenInput.setAttribute('value', token.id);
																form.appendChild(hiddenInput);
												
																form.submit();
															}
														});
													</script>
												@endif
												
													
																
																	
												<div class="panel-body">
													{{-- <i class="fa"></i> --}}
													<div class="__event">
														<div>
															<h2>{{ $event->title }}</h2>
														</div>
														<div class="__calendar">
															<i class="fa fa-calendar" aria-hidden="true" style="font-size:16px;">  {{ Carbon\Carbon::parse($event->start_time)->format('l jS \\of F Y h:i:s A') }}</i>
															<p></p>
														</div>		
													</div>
													
												</div>
												<br>
												<div class="__description">
													<p><b>#{{$event->subcategories->title}}</b></p>
													<p><b>Tickets</b></p>
													@foreach ($event->tickets as $ticket)
														<p class="__ticket"><i class="fa fa-ticket" aria-hidden="true"></i> {{$ticket->title}}</p>
													@endforeach
													
													<div class="__event_details" style="padding-top:10px;">
														<p><b>General Info</b></p>
														<p> <i class="fa fa-clock-o" aria-hidden="true"></i> Date and time: {{ Carbon\Carbon::parse($event->start_time)->format('l jS \\of F Y h:i:s A') }}</p>
														<p> <i class="fa fa-location-arrow" aria-hidden="true"></i> Venue: {{$event->venue}}</p>
													</div>
													<div style="margin-top:15px;">
														<p><b>Description</b></p>
														<p>
															{!! $event->description !!}
														</p>
													</div>
													
												</div>
											
												@if(!$event->tickets->isEmpty())
													<div class="__tickets_bill">
														<h3>Buy Tickets</h3>
														<form action="{{ route('guest.payment') }}" method="POST" id="payment-form">
															{{ csrf_field() }}
															<table class="table table-striped table-tickets">
																<thead class="thead-light">
																	<th>Type</th>
																	<th>Quantity</th>
																	<th>Price</th>
																	<th>Total</th>
																</thead>
																<tbody>
																	@foreach($event->tickets as $ticket)
																		<tr class="ticket-{{ $ticket->id }}">
																			<td>{{ $ticket->title }}</td>
																			<td><input
																						type="number"
																						class="quantity form-control"
																						min="0"
																						max="{{ $ticket->amount }}"
																						step="1"
																						value="0"
																						data-ticket="{{ $ticket->id }}">
																			</td>
																			<td><strong>{{ $ticket->price }}&nbsp;€</strong></td>
																			<td>
																				<strong class="subtotal">0.00</strong><strong>&nbsp;€</strong>
																				<input
																						class="rsubtotal"
																						type="hidden" value="0.00"
																						disabled>
																			</td>
																		</tr>
																	@endforeach
																		<tr class="last">
																			<td colspan="3"></td>
																			<td><strong class="total">0.00</strong><strong>&nbsp;€</strong><input type="hidden" name="total" class="rtotal" value="0.00"></td>
																		</tr>
																</tbody>
															</table>
															<input type="hidden" name="tickets">
															@if (!env('STRIPE_KEY'))
																<div id="card-errors" style="position:fixed;" class="alert alert-danger">Error: Stripe (.env) not configured for payment.</div>
																{{-- <button type="button"  class="btn btn-danger float-left" style="width:100%;margin-bottom:10px;">Error: Stripe (.env) not configured for payment.</button> --}}

															@else
																<div class="input-group">
																	<span class="input-group-addon">@</span>
																	<input type="email" name="email" class="form-control" placeholder="email@example.com">
																</div>
																<div id="card-element"></div>
																<div id="card-errors" class="card-errors alert alert-danger"></div>
																@if (session('message'))
																	<div class="alert alert-success">{{ session('message') }}</div>
																@endif
																@if (session('error'))
																	<div class="alert alert-danger">{{ session('error') }}</div>
																@endif
																<button class="btn btn-success" style="float: right">Pay Now</button>
															@endif
														</form>
													</div>
												@else
													<div class="alert alert-warning" style="font-size:16px;">We're sorry, but there are no tickets available</div>
												@endif
												</div>
												{{-- <div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												</div> --}}
											</div>
										</div>
										</div>
									</form>
									
								@endforeach
							</div>
							{!! $events->links('vendor.pagination.event_pagination') !!}

					</div>
						<hr>
					@else
						@foreach ($subcategories as $subcategory)
								
							
							<div class="fillter_home_sidebar">
								<ul class="portfolio_filter">
									<li><a>{{$subcategory->title}}</a></li>
									
								</ul>
								<div class="home_l_product_slider owl-carousel">
									@foreach ($subcategory->events as $item)
										<div class="item woman shoes">
												
											<div class="l_product_item">
												<div class="l_p_img">
													<img src="{{ url('images/events', $item->photo) }}" alt="">
													<h5 class="sale">Sale</h5>
												</div>
												<div class="l_p_text">
													<ul>
														<li class="p_icon"><a href="#"><i class="icon_piechart"></i></a></li>
														<li><a class="add_cart_btn" href="#">Add To Cart</a></li>
														<li class="p_icon">
															<a>
																<i class="icon_heart_alt {{$item->isLiked()?"liked":""}}" onclick="likeIt('{{$item->id}}',this)"></i>
															</a>
														</li>

														{{-- <span class="lnr lnr-heart></span>
													<p class="hover-text" id="{{$t->event->id}}-count" class="btn btn-sm btn-default">{{$t->event->likes()->count()}}</p> --}}
													</ul>
													<h4>{{$item->title}}</h4>
													@foreach ($item->tickets as $ticket)
														<h5><del>45</del>{{$ticket->price}}</h5>
													@endforeach
													
												</div>
											</div>
											
										</div>
									@endforeach						
								</div>
							</div>
							<hr>
						@endforeach
					@endif
					
				</div>
			</div>
			@include('partials.guest.side-categories')
		</div>
	</div>
</section>
	<!--================End Main Content Area =================-->
<script type="text/javascript">
	function likeIt(eventId,elem){
		var csrfToken='{{csrf_token()}}';
		var likesCount=parseInt($('#'+eventId+"-count").text());
		$.post('{{route('toggleLike')}}', {eventId: eventId,_token:csrfToken}, function (data) {
			console.log(data);
			if(data.message==='liked'){
				$(elem).addClass('liked');
				$('#'+eventId+"-count").text(likesCount+1);
				$(elem).css({color:'red'});
			}else{
				$('#'+eventId+"-count").text(likesCount-1);
				$(elem).removeClass('liked');
				$(elem).removeClass('liked');
			}
		});
	
	}
	
</script>
		
@endsection