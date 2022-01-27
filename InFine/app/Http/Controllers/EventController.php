<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function show($eventId)
   {
      $event = Event::find($eventId);
      if(!$event){
          return response()->json(["error" => "Event not found or not in DB"], 400);
      }
      return response()->json(["result" => $event], 200);   
   }
     public function index()
   {
      $events = Event::all();
      return response()->json(["result" => $events], 200);   
   }
   public function store(Request $request)
   {
       $event = new Event;
 
        $event->title = $request->title;
       $event->description = $request->description;
       $event->keywords = $request->keywords;
       $event->adresse = $request->adresse;
       $event->location = $request->location;
       $event->pictures = $request->pictures;
       $event->users = [];
       $event->notes = [];
       $event->comments =[];
       $event->save();


       return response()->json(["event" => $event], 201);
   }
   public function destroy($eventId)
 {
     $event = Event::find($eventId);
      if(!$event){
          return response()->json(["error" => "Event not found or not in DB"], 400);
      }
     $event->delete();

     return response()->json(["result" => "Event deleted"], 200);       
 }
  public function update(Request $request, $eventId)
   {
       $event = Event::find($eventId);
       if(!$event){
          return response()->json(["error" => "Event not found or not in DB"], 400);
      }
       $event->title = $request->title;
       $event->description = $request->body;
       $event->keywords = $request->keywords;
       $event->adresse = $request->adresse;
       $event->location = $request->body;
       $event->pictures = $request->pictures;
       $event->users = [];
       $event->note = $request->note;
       $event->save();

       return response()->json(["result" => "Event updated"], 201);       
   }
}