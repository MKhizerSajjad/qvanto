<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    use HasFactory;

    protected $guarded;
    
    public function customer() {
        return $this->hasOne(User::class, 'id', 'customer_id');
    }
    
    public function employee() {
        return $this->hasOne(User::class, 'id', 'employee_id');
    }
}
