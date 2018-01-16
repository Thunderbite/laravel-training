<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'keyword', 'text', 
    ];
     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'created', 'updated',
    ];
}

