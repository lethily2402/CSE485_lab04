<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $timestamps = false;

    public function borrows(){
        return $this->hasMany(Reader::class);
    }
}
