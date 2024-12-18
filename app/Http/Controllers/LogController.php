<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Connection;
use Browser;
use Illuminate\Support\Facades\Auth;
class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $count =Car::count();

        $logs = Connection::where('user_id', Auth::user()->id)
        ->get();
        // dd(Browser::browserName());
        return view('compte.logs', ['count'=>$count, 'logs'=>$logs]);
    }
    public function oauth(Request $request){

        $connections = Connection::
        with('user')->
        where('user_id','<>', Auth::user()->id)
        ->whereHas('user', function ($query) {
            $query->where('status', true);
        })
        ->get();
        return view('auth.askConnexion', ['connections'=>$connections]);
    }
    public function unauthorization(){
        $connections = Connection::
        with('user')->
        where('user_id','<>', Auth::user()->id)
        ->whereHas('user', function ($query) {
            $query->where('status', false);
        })
        ->get();
        return view('auth.unauthorization', ['connections'=>$connections]);
    }
    public function access ($id){
        $user = User::find($id);
        $user->update(['status'=>true]);

        return redirect()->back();
    }
    public function accessdenied ( $id){
        $user = User::find($id);
        $user->update(['status'=>false]);
        return redirect()->back();
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
    public function show(Log $log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Log $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Log $log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Log $log)
    {
        //
    }
}
