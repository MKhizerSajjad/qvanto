<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'users';
    public static $snakeAttributes = false;

    protected $guarded;

    public function cases() {
        return $this->hasMany(Cases::class);
    }
}
