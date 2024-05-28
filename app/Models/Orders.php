<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [ 'id', 'customerId', 'items', 'discount', 'total' ];
    protected $casts = [ 'items' => 'array' ];
}
