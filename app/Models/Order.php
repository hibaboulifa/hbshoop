<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
       'id',
        'customer_id',
        'total',
        'created_at',
        'updated_at',
       
        // tout autre champ utilisé dans ta table orders
    ];
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
