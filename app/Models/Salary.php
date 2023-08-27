<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $table = 'salaries';
    public static $snakeAttributes = false;

    protected $guarded;
    
    public function employee() {
        return $this->hasOne(User::class, 'id', 'employee_id');
    }
}
