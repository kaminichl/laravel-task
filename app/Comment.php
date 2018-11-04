<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'comments','user_id', 'film_id'
    ];
	
	/**
     *
     * Defines the relationship between comment and user
     */
	public function user()
    {
        $this->belongsTo(User::class);
    }
   
}
