@extends('layouts.guest')


@section('content')
<div class="container">
        <div class="categories_product_area">
            <h4> <?php if(isset($msg)){ echo $msg; } else{?> Features Item<?php }?>
            </h4>
            <br>
                <div class="row">
                    @if(isset($data))

                        @foreach ($data as $event)
                    
                            <div class="col-lg-3 col-sm-6">
                                <div class="l_product_item">
                                    <div class="l_p_img">
                                        <img src="{{ url('images/events', $event->photo) }}" alt="">
                                        <h5 class="sale">Sale</h5>
                                    </div>
                                    <div class="l_p_text">
                                    <ul>
                                            <li class="p_icon"><a href="#"><i class="icon_piechart"></i></a></li>
                                            <li><a class="add_cart_btn" href="#">Add To Cart</a></li>
                                            <li class="p_icon">
                                                <a>
                                                    <i class="icon_heart_alt {{$event->isLiked()?"liked":""}}" onclick="likeIt('{{$event->id}}',this)"></i>
                                                </a>
                                            </li>
                                        </ul>
                                        
                                        <h4>{{  $event->title}}</h4>
                                        @foreach ($event->tickets as $ticket)
                                            <h5>${{$ticket->price}}</h5>
                                        @endforeach
                                        
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {!! $data->links('vendor.pagination.event_pagination') !!}
                </div>
                @else
                <div class="d-flex justify-content-center">
                    <h3>  {{ $message }}</h3>
                </div>

                @endif
                
            </div>
    
</div>
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