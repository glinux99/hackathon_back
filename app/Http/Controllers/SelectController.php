<?php

namespace App\Http\Controllers;

use App\Models\Select;
use Illuminate\Http\Request;

class SelectController extends Controller
{

    public function model(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Select::select("id", "model", "marque", 'carburateur')
                ->where('model', 'LIKE', "%$search%")
                ->where('marque', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data->unique('model'));
    }
    // public function carburateur(Request $request)
    // {
    //     $data = [];

    //     if ($request->has('q')) {
    //         $search = $request->q;
    //         $data = Select::select("id", "carburateur")
    //             ->where('carburateur', 'LIKE', "%$search%")
    //             ->get();
    //     }
    //     return response()->json($data->unique('carburateur'));
    // }
    public function search($choice, $id)
    {
        // $prod = Produit::where($choice, $id)->get();
        // $home = new HomeController;
        // return $home->produit($prod);
    }
}
