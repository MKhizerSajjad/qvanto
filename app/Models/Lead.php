<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    public static $snakeAttributes = false;
    protected $guarded;

    public function vendor() {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }

    public function leadStatus() {
        return $this->hasMany(LeadStatus::class);
    }
}
