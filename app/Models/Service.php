<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'img', 'description', 'price', 'offer_price', 'featured', 'sort_order', 'status'];

    /**
     * The attributes that are appended.
     *
     * @var array`
     */
    protected $appends = ['absolute_img'];

    /**
     * Get Absolute image path value
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getAbsoluteImgAttribute()
	{
	    return url($this->attributes['img']);
	}

}
