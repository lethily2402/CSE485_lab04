<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    // Mình muốn thêm dữ liệu, thì mình phải liệt kê ra những cột mà mình sẽ thêm. Nếu muốn liệt kê các cột mình muốn thêm thì sử dụng protected $fillable.
    // $protected $guarded là trường hợp ngược lại với $fillable (Liệt kê những cột mình không muốn thêm).
    protected $guarded = ['created_at', 'updated_at'];
    public $timestamps = false;
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function reader()
    {
        return $this->belongsTo(Reader::class, 'reader_id', 'id');
    }
    public function getBorrowTimeAttribute() 
    // Cột trong bảng là "borrow_date", và nếu mình để tên hàm là getBorrowDateAttribute thì lúc mình lấy ra: $each->borrow_date 
    {
        return date('d/m/Y', strtotime($this->borrow_date));
    }
    public function getReturnTimeAttribute()
    {
        if (!$this->return_date) {
            return 'Chưa trả';
        }
        return date('d/m/Y', strtotime(datetime: $this->return_date));
    }
    public function getConditionAttribute(){
        return $this->status == 0 ? 'Đang mượn' : 'Chưa trả';
    }
}
