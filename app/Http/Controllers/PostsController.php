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
  /**
  * Display a listing of the resource.
  *
  * @return Response
  */
  public function index($id = null) {

    if ($id == null) {
      return Posts::orderBy('created_at', 'asc')->with('author')->get();
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
    $post->body = $request->input('body');
    $post->author_id = $request->input('author_id');
    $post->active = 1;
    $post->save();

    return 'Post record successfully created with id ' . $post->id;
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return Response
  */
  public function show($id) {
    return Posts::find($id);
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
    $post->body = $request->input('body');
    $post->save();

      return "Sucess updating post #" . $post->id;
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
      return "Post record successfully deleted #" . $request->input('id');
    }

  }

}
