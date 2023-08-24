<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';
    public static $snakeAttributes = false;

    protected $guarded;
    
    public function customer() {
        return $this->hasOne(User::class, 'id', 'customer_id');
    }
    
    public function employee() {
        return $this->hasOne(User::class, 'id', 'employee_id');
    }
}
