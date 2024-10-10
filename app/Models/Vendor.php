<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'users';
    public static $snakeAttributes = false;

    protected $guarded;

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
