<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Car;
use App\Models\Document;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function cars(){
        Session()->put('documents', Document::all());
        Session()->put('cars', Car::with('customer')->get());
    }
}
