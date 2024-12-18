<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $hc =new HomeController;
        $hc->cars();

        $activities = Activity::with('user')
        ->orderBy('id', 'DESC')
        ->get();
        $count =Car::count();
            $activitiesMonth= Activity::with('user')
            ->whereMonth('created_at', Carbon::now()->month)
            ->orderBy('id', 'DESC')
            ->get();
            $activitiesWeek = Activity::with('user')
            ->whereBetween('created_at', [Carbon ::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->orderBy('id', 'DESC')
            ->get();
            $activitiesYear =Activity::with('user')->whereYear('created_at', Carbon::now()->year)->get();
        return view('compte.activity', [
            'activitiesMonth'=>$activitiesMonth,
            'activitiesWeek'=>$activitiesWeek ,
            'activitiesYear'=>$activitiesYear,
            'activities' => $activities, 'count'=> $count]);
    }
    public function settings(){
        $hc =new HomeController;
        $hc->cars();
        $count =Car::count();
        return view('compte.settings', ['count'=> $count]);
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
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
