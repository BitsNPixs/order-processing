<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['user_id', 'sub_total', 'tax', 'grand_total', 'invoice_id', 'payment_type', 'payment_status', 'payment_token', 'communication_mode', 'status'];

    /**
     * Order user details
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * List of order items belongs to order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany('App\Models\OrderItem');
    }
}
