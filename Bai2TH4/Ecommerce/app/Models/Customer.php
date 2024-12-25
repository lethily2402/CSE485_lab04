<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
    ];
    use HasFactory;
    public $timestamps = false;
    public function orders()
    {
        return $this->HasMany(Order::class);
    }
}
