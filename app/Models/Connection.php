<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    use HasFactory;
    protected $fillable = [
        'opt',
        'opt_used',
        'user_id',
        'appareil',
        'ip',
        'navigator'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getSessionTimeAttribute()
    {
        return now()->diffInSeconds($this->updated_at);
    }
}
