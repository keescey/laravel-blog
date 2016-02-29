<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model {
  // protected $fillable = array('id', 'title', 'body');
  protected $table = 'posts';

  public function author() {
    return $this->belongsTo('App\User','author_id');
  }

}
