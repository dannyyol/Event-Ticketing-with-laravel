@can('role_access')
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="/img/fav-icon.png" type="image/x-icon" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Persuit</title>
        

        <!-- Icon css link -->
        <link href="/css/font-awesome.min.css" rel="stylesheet">
        <link href="/vendors/line-icon/css/simple-line-icons.css" rel="stylesheet">
        <link href="/vendors/elegant-icon/style.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Rev slider css -->
        <link href="/vendors/revolution/css/settings.css" rel="stylesheet">
        <link href="/vendors/revolution/css/layers.css" rel="stylesheet">
        <link href="/vendors/revolution/css/navigation.css" rel="stylesheet">
        
        <!-- Extra plugin css -->
        <link href="/vendors/owl-carousel/owl.carousel.min.css" rel="stylesheet">
        <link href="/vendors/bootstrap-selector/css/bootstrap-select.min.css" rel="stylesheet">
        <link href="/vendors/vertical-slider/css/jQuery.verticalCarousel.css" rel="stylesheet">
        
        <link href="{{asset("css/style.css")}}" rel="stylesheet">
        <link href="{{ asset('css/responsive.css')}}" rel="stylesheet">
        @include('partials.guest.head')

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="home_sidebar">
            {{-- modal --}}
<style>
.home_sidebar{
  background: rgba(1, 8, 14, 0.9);
  
}
</style>

            <div class="" id="{{$event->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        {{-- <div class="modal-header" style="padding:0px !important;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="font-size:25px;color:white;z-index:1;position:absolute;">&times;</span>
                        </button>
                        </div> --}}
                        
                        <div class="modal-body" style="margin-top:-20px;padding:0px !important;padding-left:0px !important;"> 
                            <div class="__display_image">
                                <img src="{{ url('images/events', $event->photo) }}"  alt="" style="">
                            </div>
                                
                            {{-- @foreach($event->tickets as $ticket) --}}
                            
                                @if($event->tickets)
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                                $('.ticket-{{ $event->tickets->id }} .quantity').on('click keyup change blur', function() {
                                                    var quantity = parseInt($('.ticket-{{ $event->tickets->id }} .quantity').val());
                                                    if(isNaN(quantity)) {
                                                        quantity = 0;
                                                        $('.ticket-{{ $event->tickets->id }} .quantity').val(0);
                                                    } else if (quantity < 0) {
                                                        quantity = 0;
                                                        $('.ticket-{{ $event->tickets->id }} .quantity').val(0);
                                                    } else if (quantity > {{ $event->tickets->amount }}) {
                                                        quantity = parseInt({{ $event->tickets->amount }});
                                                        $('.ticket-{{ $event->tickets->id }} .quantity').val({{ $event->tickets->amount }});
                                                    }
                                                    var subtotal = parseFloat({{ $event->tickets->price }}) * quantity;
                                                    $('.ticket-{{ $event->tickets->id }} .subtotal').text(subtotal.toFixed(2));
                                                    $('.ticket-{{ $event->tickets->id }} .rsubtotal').val(subtotal.toFixed(2));
                                                    
                                                    var x = $("#unit_price").val();
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

                            {{-- @endforeach --}}


                            {{-- something here --}}
                        
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
                            {{-- @foreach ($event->tickets as $ticket) --}}
                                {{-- <p class="__ticket"><i class="fa fa-ticket" aria-hidden="true"></i> {{$ticket->title}}</p> --}}
                                {{-- @foreach ($cartItems as $item) --}}
                                    @if($event->tickets)
                                    {{$event->tickets->title}}
                                    @endif
                                {{-- @endforeach --}}
                            {{-- @endforeach --}}
                            
                            <div class="__event_details" style="padding-top:10px;">
                                <p><b>General Info</b></p>
                                <p> <i class="fa fa-clock-o" aria-hidden="true"></i> Date and time: {{ Carbon\Carbon::parse($event->start_time)->format('l jS \\of F Y h:i:s A') }}</p>
                                <p> <i class="fa fa-location-arrow" aria-hidden="true"></i> Venue: {{$event->venue}}</p>
                            </div>
                            <div style="margin-top:15px;">
                                {{-- <p><b>Description</b></p> --}}
                                <p>
                                    {!! $event->description !!}
                                </p>
                            </div>
                            
                        </div>
                    @if (REQUEST()->get('paypal')==1)	
                        @if($event->tickets)
                            <div class="__tickets_bill">
                                <h3>Buy Tickets</h3>
                                <form action="{{ route('paypal.express-checkout') }}" method="POST" id="payment-form">
                                    {{ csrf_field() }}
                                    <table class="table table-striped table-tickets">
                                        <thead class="thead-light">
                                            <th>Type</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach($event->tickets as $ticket) --}}
                                                <tr class="ticket-{{ $event->tickets->id }}">
                                                    <td>{{ $event->tickets->title }}</td>
                                                    <td><input
                                                                type="number"
                                                                name="qty"
                                                                class="quantity form-control"
                                                                min="0"
                                                                max="{{ $event->tickets->amount }}"
                                                                step="1"
                                                                value="0"
                                                                data-ticket="{{ $event->tickets->id }}">
                                                    </td>
                                                    
                                                    <td><strong>${{$event->tickets->price}}</strong></td>
                                                    <input type="hidden" id="unit_price" name="amount_price" value="{{ $event->tickets->price }}">
                                                    <td>
                                                        <strong class="subtotal">0.00</strong><strong>&nbsp;$</strong>
                                                        <input
                                                                class="rsubtotal"
                                                                type="hidden" value="0.00" name="total"
                                                                disabled>
                                                    </td>
                                                </tr>
                                            {{-- @endforeach --}}
                                                <tr class="last">
                                                    <td colspan="3"></td>
                                                    <td><strong class="total">0.00</strong><strong>&nbsp;$</strong><input type="hidden" name="total" class="rtotal" value="0.00"></td>
                                                </tr>
                                        </tbody>
                                    </table>

                                    <input type="hidden" name="tickets">
                                   
                                    {{-- somethin here --}}
                                    <div class="input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="email" name="email" class="form-control" placeholder="email@example.com" required>
                                    </div>
                                    
                                    <input type="hidden" name="event_title" value="{{$event->title}}">
                                    <br>
                                    @include('session.message')
                                    
                                    <div class="modal-footer" style="padding:10px 0px 10px 0px !important;">
                                        <button type="submit" class="btn btn-primary float-left" style="width:100%;">Pay with Paypal</button>

                                    </div>
                                </div>
                            </form>
                        @else
                            <div class="modal-footer" style="padding:10px !important;">
                                <button type="submit" class="btn btn-warning text-white float-left" style="width:100%;">We're sorry, but there are no tickets available</button>


                            </div>
                        @endif
                        @endif

                        {{-- For stripes --}}
                        
                        @if (REQUEST()->get('stripes')==2)
                        @if($event->tickets)
                            <div class="__tickets_bill">
                                <h3>Buy Tickets</h3>
                                <form action="{{ route('payment') }}" method="POST" id="payment-form">
                                    {{ csrf_field() }}
                                    <table class="table table-striped table-tickets">
                                        <thead class="thead-light">
                                            <th>Type</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach($event->tickets as $ticket) --}}
                                                <tr class="ticket-{{ $event->tickets->id }}">
                                                    
                                                    <td>{{ $event->tickets->title }}</td>
                                                    
                                                    <td><input
                                                                type="number"
                                                                name="qty"
                                                                class="quantity form-control"
                                                                min="0"
                                                                max="{{ $event->tickets->amount }}"
                                                                step="1"
                                                                value="0"
                                                                data-ticket="{{ $event->tickets->id }}">
                                                    </td>
                                                    
                                                    <td><strong>${{$event->tickets->price}}</strong></td>
                                                    <input type="hidden" id="unit_price" name="amount_price" value="{{ $event->tickets->price }}">
                                                    <td>
                                                        <strong class="subtotal">0.00</strong><strong>&nbsp;$</strong>
                                                        <input
                                                                class="rsubtotal"
                                                                type="hidden" value="0.00" name="total"
                                                                disabled>
                                                    </td>
                                                </tr>
                                            {{-- @endforeach --}}
                                                <tr class="last">
                                                    <td colspan="3"></td>
                                                    <td><strong class="total">0.00</strong><strong>&nbsp;$</strong><input type="hidden" name="total" class="rtotal" value="0.00"></td>
                                                </tr>
                                        </tbody>
                                    </table>

                                    <input type="hidden" name="tickets">
                                    @if (!env('STRIPE_KEY'))
                                        <div id="card-errors" class="alert alert-danger">Error: Stripe (.env) not configured for payment.</div>
                                    @else
                                        <div class="input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="email" name="email" class="form-control" placeholder="email@example.com">
                                        </div>
                                        <div id="card-element"></div>
                                        <div id="card-errors" class="card-errors alert alert-danger"></div>
                                        @include('session.message')
                                        <button class="btn btn-primary btn-block float-right" style="margin-bottom:10px;">Pay Now</button>
                                        <br>
                                    @endif
                                    {{-- somethin here --}}
                                    
                                </div>
                            </form>
                        @else
                            <div class="modal-footer" style="padding:10px !important;">
                                <button type="submit" class="btn btn-warning text-white float-left" style="width:100%;">We're sorry, but there are no tickets available</button>


                            </div>
                        @endif
                        @endif {{--stripes end here--}}

                        </div>
                            
                            
                        

                        
                        </div>
                    </div>
                </div>
                
            

        
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <!-- Rev slider js -->
    </body>
</html>




@endcan