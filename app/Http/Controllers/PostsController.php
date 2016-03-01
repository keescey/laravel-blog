<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Posts;

class PostsController extends Controller
{
  public function __construct() {
    // Apply the jwt.auth middleware to all methods in this controller
    // except for the authenticate method. We don't want to prevent
    // the user from retrieving their token if they don't already have it
    $this->middleware('jwt.auth', ['except' => ['index']]);
  }

  /**
  * Display a listing of the resource.
  *
  * @return Response
  */
  public function index($id = null) {

    if ($id == null) {
      $posts = Posts::orderBy('created_at', 'desc')->with('author')->get();
      return response()->json($posts, 200);
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
    $post = new Posts;

    $post->title = $request->input('title');
    $post->subheading = $request->input('subheading');
    $post->body = $request->input('body');
    $post->author_id = $request->input('author_id');
    $post->active = 1;
    $post->save();

    return response()->json($post, 201);
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return Response
  */
  public function show($id) {
    $post = Posts::with('author')->find($id);
    return response()->json($post, 200);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Request  $request
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id) {
    $post = Posts::find($id);

    $post->title = $request->input('title');
    $post->subheading = $request->input('subheading');
    $post->body = $request->input('body');
    $post->save();

    return response()->json($post, 200);
      // return "Sucess updating post #" . $post->id;
  }
  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return Response
  */
  public function destroy(Request $request, $id) {

    $post = Posts::find($id);
    if($post) {
      $post->delete();
      return response()->json($post, 204);
      // return "Post record successfully deleted #" . $request->input('id');
    } else {
      return response()->json(404);
    }

  }

}
