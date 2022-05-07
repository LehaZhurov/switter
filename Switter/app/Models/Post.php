<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model
{	
	use SoftDeletes;

     public function user()
    {
        return $this->belongsTo('App\Models\User')->get();
    }
}
