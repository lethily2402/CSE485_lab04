<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Reader extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birthday',
        'address',
        'phone',
    ];
    public $timestamps = false;
    public function borrows()
    {
        return $this->hasMany(Reader::class);
    }
    public function getBirthDateAttribute()
    {
        return date('d/m/Y', strtotime($this->birthday));
    }
}
