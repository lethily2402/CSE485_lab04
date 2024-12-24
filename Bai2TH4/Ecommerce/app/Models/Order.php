<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $fillable = ['customer_id', 'order_id', 'status'];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function getOrderTimeAttribute() 
    // Cột trong bảng là "order_date", và nếu mình để tên hàm là getBorrowDateAttribute thì lúc mình lấy ra: $each->order_date 
    {
        return date('d/m/Y', strtotime($this->order_date));
    }
}
