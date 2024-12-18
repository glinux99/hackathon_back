<?php

namespace App\Http\Controllers;

use App\Models\Analyse;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class AnalyseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hc =new HomeController;
        $hc->cars();
        $carCount = Car::count();
        $users = User::where('type','!=', 'aucun')->get();
        $carActive = Car::where('status', true)->count()??0;
        $carError = Car::where('lock', true)->count()??0;
        $carOk = Car::where('status', true)
        ->where('lock', false)->count()
        ;
        return view('dashboard.analyses', ['carCount' => $carCount, 'users' => $users, 'carActive' => $carActive, 'carError' => $carError, 'carOk' => $carOk]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Analyse $analyse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Analyse $analyse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Analyse $analyse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Analyse $analyse)
    {
        //
    }
}
