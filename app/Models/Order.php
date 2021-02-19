<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable = ['user_id', 'sub_total', 'tax', 'grand_total', 'invoice_id', 'payment_type', 'payment_status', 'payment_token', 'communication_mode', 'status'];

	public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function items()
    {
        return $this->hasMany('App\Models\OrderItem');
    }
}
