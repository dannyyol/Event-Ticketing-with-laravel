@if ($message = Session::get('success'))
<strong>Success !</strong> {{session()->get('success')}}
   <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success !</strong> {{session()->get('success')}}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
   </div>
@endif

@if ($message = Session::get('warning'))
   <div class="alert alert-warning alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button>	
      <strong>{{ $message }}</strong>
   </div>
@endif
