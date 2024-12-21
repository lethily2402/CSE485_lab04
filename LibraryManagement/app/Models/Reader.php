<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
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
