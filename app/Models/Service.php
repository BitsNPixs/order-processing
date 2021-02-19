<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'img', 'description', 'price', 'offer_price', 'featured', 'sort_order', 'status'];

    protected $appends = ['absolute_img', 'customer_price'];

    public function getAbsoluteImgAttribute()
	{
	    return url($this->attributes['img']);
	}

}
