<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobile extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','number' ,'user_id',
    ];


    public function users()
    {
        return $this->belongsTo(User::class);
    }

    //
}
