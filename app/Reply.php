<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Reply extends Model
{   
    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
