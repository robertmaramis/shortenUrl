<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkHit extends Model
{
    protected $fillable = ['id','link_id', 'region'];
}
