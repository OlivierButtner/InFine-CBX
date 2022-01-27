<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Event;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show($commentId)
   {
      $comment = Comment::find($commentId);
      if(!$comment){
          return response()->json(["error" => "Comment not found or not in DB"], 400);
      }
      return response()->json(["result" => $comment], 200);   
   }
     public function index()
   {
      $comments = Comment::all();
      return response()->json(["result" => $comments], 200);   
   }
   public function store(Request $request)
   {
       $comment = new Comment;
 
        $comment->content = $request->content;
       $comment->id_user = $request->id_user;
       $comment->id_event = $request->id_event;
       $comment->pictures = $request->pictures;
        $event = Event::find($comment->id_event);
        $event->push('comments',json_decode($comment));
        $event->save();
       $comment->save();

       

       return response()->json(["comment" => $comment], 201);
   }
   public function destroy($commentId)
 {
     $comment = Comment::find($commentId);
      if(!$comment){
          return response()->json(["error" => "comment not found or not in DB"], 400);
      }
     $comment->delete();

     return response()->json(["result" => "comment deleted"], 200);       
 }
  public function update(Request $request, $commentId)
   {
       $comment = Comment::find($commentId);
       if(!$comment){
          return response()->json(["error" => "Comment not found or not in DB"], 400);
      }
      $comment->content = $request->content;
       $comment->id_user = $request->id_user;
       $comment->id_event = $request->id_event;
       $comment->pictures = $request->pictures;
       $comment->save();

       return response()->json(["result" => "Comment updated"], 201);       
   }
}