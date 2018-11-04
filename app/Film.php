<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;


class Film extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'descripion', 'release_date', 'rating', 'ticket_price', 'country', 'genre', 'photo', 'slug'
    ];
	
	  /**
     * The attributes that are appends
     *
     * @var array
     */
    protected $appends = [
        'photo_url'
    ];
	 /**
     * The attributes that are date fileds, to use carbon date formats
     *
     * @var array
     */
	
	protected $dates = [
        'created_at',
        'updated_at'
    ];
	
	/**
     *
     * Defines the relationship between comments and film
     */
	
	public function comments() 
    {
        return $this->hasMany(Comment::class);
    }
	
	public function findBySlug($slug) 
	{
		return $this->whereSlug($slug)->first();
		
	}
	public function getPhotoUrlAttribute() {
		return asset('img/films/' . $this->photo);
	}
	
	

   
}
