<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;
    protected $table = 'examinations';
    public static $snakeAttributes = false;

    protected $guarded;

    public function customer() {
        return $this->hasOne(User::class, 'id', 'customer_id');
    }

    public function employee() {
        return $this->hasOne(User::class, 'id', 'employee_id');
    }

    public function counselor() {
        return $this->hasOne(User::class, 'id', 'employee_id');
    }
}
