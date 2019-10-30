@extends('layouts.guest')


@section('content')
<!--================Categories Banner Area =================-->
<section class="categories_banner_area">
    <div class="container">
        <div class="c_banner_inner">
            <h3>shop grid with left sidebar</h3>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Category</a></li>
                <li class="current"><a href="{{route('subcategory.show', $subcategory->id)}}">{{$subcategory->title}}</a></li>
            </ul>
        </div>
    </div>
</section>
<!--================End Categories Banner Area =================-->
<div class="container">
    <br><br>
    <div class="showing_fillter">
            <div class="row m0">
                <div class="first_fillter">
                    <h4>Showing Events in {{$subcategory->title}} </h4>
                </div>
                <div class="secand_fillter">
                    {{-- <h4>SORT BY :</h4>
                    <select class="selectpicker">
                        <option>Name</option>
                        <option>Name 2</option>
                        <option>Name 3</option>
                    </select> --}}
                </div>
                <div class="third_fillter">
                    {{-- <h4>Show : </h4>
                    <select class="selectpicker">
                        <option>09</option>
                        <option>10</option>
                        <option>10</option>
                    </select> --}}
                </div>
                <div class="four_fillter">
                    <h4>View</h4>
                    <a class="active" href="#"><i class="icon_grid-2x2"></i></a>
                    <a href="#"><i class="icon_grid-3x3"></i></a>
                </div>
            </div>
        </div>
        <div class="categories_product_area">
            <br>
                <div class="row">
                    

                        @foreach ($events as $event)
                    
                            <div class="col-lg-3 col-sm-6">
                                <div class="l_product_item">
                                    <div class="l_p_img">
                                        <img src="{{ url('images/events', $event->photo) }}" alt="">
                                        {{-- <h5 class="sale">Sale</h5> --}}
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
                    {!! $events->links('vendor.pagination.event_pagination') !!}
                </div>
                
                
            </div>
    
</div>
<style>
.liked{
	color: red;
}
</style>
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