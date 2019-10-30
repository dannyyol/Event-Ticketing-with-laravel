<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;

use App\Event;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //

    public function toggleLike()
     {
         $eventId=Input::get('eventId');
         $event=Event::find($eventId);

  //        $usersLike= $comment->likes()->where('user_id',auth()->id())->where('likable_id',$commentId)->first();
          if(!$event->isLiked()){
              $event->likeIt();
              return response()->json(['status'=>'success','message'=>'liked']);

          }else{
              $event->unlikeIt();
              return response()->json(['status'=>'success','message'=>'unliked']);

          }


     }
}
