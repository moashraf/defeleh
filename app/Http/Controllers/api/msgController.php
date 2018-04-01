<?php
namespace App\Http\Controllers\api;
 use App\Facades\Helpers;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Room;
use App\Models\Msg;

class msgController extends Controller
{
  
  
  
  
   public function get_my_reserved_message_only (Request $request)
  { 
      
             $validator = Validator::make($request->all(), [
             'reciever_id' => 'required|min:1' 
        ]);

        if ($validator->fails())
            return Helpers::returnJsonResponse(false,'Error , Missing inputs   ...',null);
      
      $Msg = Msg::where('reciever_id',$request->reciever_id)->with('get_user')->with('get_profile')->get();
     
      if( !$Msg->isEmpty() ){
                  return Helpers::returnJsonResponse(true,'   my Msg  ...', $Msg);
          
                }else{       return Helpers::returnJsonResponse(false,'Error ...',null);    }
  }
  
  
  
  
  
    


  public function Rooms (Request $request)
  { 
      
             $validator = Validator::make($request->all(), [
            'sender_id' => 'required|min:1',  
            'reciever_id' => 'required|min:1' 
        ]);

        if ($validator->fails())
            return Helpers::returnJsonResponse(false,'Error , Missing inputs   ...',null);
      
      $Room = Room::where('sender_id',$request->sender_id)->Orwhere('reciever_id',$request->sender_id)->get();
                  return Helpers::returnJsonResponse(true,'   Rooms  ...',$Room);
  }
  
  
  
  
  public function Msgs (Request $request)
  {   
           $validator = Validator::make($request->all(), [
            'room_id' => 'required|min:1'  
        ]);

        if ($validator->fails())
            return Helpers::returnJsonResponse(false,'Error , Missing inputs   ...',null);
      
      $Msg = Msg::where('room_id',$request->room_id)->get();
      
         return Helpers::returnJsonResponse(true,'    Msg  ...',$Msg);
  }
  
     
  
    public function create_Msg (Request $request){



             $validator = Validator::make($request->all(), [
            'sender_id' => 'required|min:1',  
            'message' => 'required|min:1',
            'reciever_id' => 'required|min:1' 
        ]);

        if ($validator->fails())
            return Helpers::returnJsonResponse(false,'Error , Missing inputs   ...',null);
            
            
  
        $msg = new Msg;
        $msg->sender_id = $request->sender_id;
        $msg->reciever_id = $request->reciever_id;
        $msg->message = $request->message;
       	$room = Room::whereSender_idAndReciever_id($request->sender_id,$request->reciever_id)->first();
       	$room1 = Room::whereReciever_idAndSender_id($request->sender_id,$request->reciever_id)->first();
       	if(!$room && !$room1){
	       	$new_room = new Room;
	        $new_room->sender_id = $request->sender_id;
	        $new_room->reciever_id = $request->reciever_id;
	        $new_room->save();
	        $msg->room_id = $new_room->id;
	        $msg->save();
	   //     return response()->json('true');
	              return Helpers::returnJsonResponse(true,' msg successfully...', $msg );
       		
        }
        else if(!$room1){
        	$room_id = $room->id;
       		$msg->room_id = $room_id;
        	$msg->save();
      return Helpers::returnJsonResponse(true,'  room1 successfully...', $msg );
      }
        else if(!$room){
       		$room_id = $room1->id;
       		$msg->room_id = $room_id;
        	$msg->save();
      return Helpers::returnJsonResponse(true,'  room  successfully...', $msg );
      }
        
        
        

    } 



}
