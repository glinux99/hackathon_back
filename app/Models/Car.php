<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'plaque',
        'year',
        'carburateur',
        'model',
        'marque',
        'color',
        'veh_id_number',
        'user_id',
        'status',
        'lock',
        'inf',
        "rose_card"
    ];
    public function customer(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function docs(){
        return $this->hasMany(DocumentCar ::class, 'car_id', 'id')->with('document');
    }
}
