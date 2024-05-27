<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Customers extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'since', 'revenue' ];
    protected $casts = [ 'since' => 'date', 'revenue' => 'decimal:2' ];

    public function toArray()
    {
        $array = parent::toArray();
        $array['since'] = Carbon::parse($array['since'])->format('Y-m-d');
        return $array;
    }
}
