<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Posts;
use App\Comments;

class CommentsController extends Controller
{
  public function __construct() {
    // Apply the jwt.auth middleware to all methods in this controller
    // except for the authenticate method. We don't want to prevent
    // the user from retrieving their token if they don't already have it
    $this->middleware('jwt.auth', ['except' => ['index', 'showByPost']]);
  }

  /**
  * Display a listing of the resource.
  *
  * @return Response
  */
  public function index($id = null) {

    if ($id == null) {
      $comments = Comments::orderBy('created_at', 'desc')->with('author')->get();
      return response()->json($comments, 200);
    } else {
      return $this->show($id);
    }
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  Request  $request
  * @return Response
  */
  public function store(Request $request) {
    $comment = new Comments;

    $comment->comment = $request->input('comment');
    $comment->post_id  = $request->input('post_id');
    $comment->author_id = $request->input('author_id');
    $comment->active = 1;
    $comment->save();

    return response()->json($comment, 201);
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return Response
  */
  public function show($id) {
    $comment = Comments::with('author')->find($id);
    return response()->json($comment, 200);
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $post_id
  * @return Response
  */
  public function showByPost($post_id) {
    $comments = Comments::orderBy('created_at', 'desc')
                          ->with('author')
                          ->where('post_id',$post_id)
                          ->get();
    return response()->json($comments, 200);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Request  $request
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id) {
    $comment = Comments::find($id);

    $comment->comment = $request->input('comment');
    $comment->post_id  = $request->input('post_id');
    $comment->author_id = $request->input('author_id');
    $comment->save();

    return response()->json($comment, 200);

  }
  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return Response
  */
  public function destroy(Request $request, $id) {

    $comment = Comments::find($id);
    if($comment) {
      $comment->delete();
      return response()->json($comment, 204);
    } else {
      return response()->json(404);
    }

  }

}
