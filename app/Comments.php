<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model {
  // protected $fillable = array('id', 'title', 'body');
  protected $table = 'comments';

  public function author() {
    return $this->belongsTo('App\User','author_id');
  }

  public function post() {
    return $this->belongsTo('App\Posts','post_id');
  }

}
