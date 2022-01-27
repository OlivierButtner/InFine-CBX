<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Event;
// use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function show($bookingId)
   {
      $booking = Booking::find($bookingId);
      if(!$booking){
          return response()->json(["error" => "Booking not found or not in DB"], 400);
      }
      return response()->json(["result" => $booking], 200);   
   }
     public function index()
   {
      $bookings = Booking::all();
      return response()->json(["result" => $bookings], 200);   
   }
   public function store(Request $request)
   {
       $booking = new Booking;

       Event::find($request->id_event)->push('users',$request->id_user);
            // User::find($request->id_user)->push('users',$request->id_event);

       $booking->id_user = $request->id_user;
       $booking->id_event = $request->id_event;
       $booking->save();


       return response()->json(["booking" => $booking], 201);
   }
   public function destroy($bookingId)
 {
     $booking = Booking::find($bookingId);
      if(!$booking){
          return response()->json(["error" => "booking not found or not in DB"], 400);
      }
     $booking->delete();

     return response()->json(["result" => "booking deleted"], 200);       
 }
  public function update(Request $request, $bookingId)
   {
       $booking = Booking::find($bookingId);
       if(!$booking){
          return response()->json(["error" => "Booking not found or not in DB"], 400);
      }
       $booking->id_user = $request->id_user;
       $booking->id_event = $request->id_event;
       $booking->save();

       return response()->json(["result" => "Booking updated"], 201);       
   }
}