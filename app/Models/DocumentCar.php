<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentCar extends Model
{
    use HasFactory;
    protected $fillable=[
        'path',
        'car_id',
        'expiration',
        'document_id',
        'is_read'
    ];
    public function document(){
        return $this->hasOne(Document::class, 'id', 'document_id');
    }
}
