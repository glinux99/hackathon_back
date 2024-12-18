<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Connection;
use App\Models\User;
use Browser;
// use Teckwei1993\LaravelOtp\Otp;
use Otp;
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function asklogin(Request $request){
        $user =User::where('phone', $request->phone)
        ->where('type','<>', 'client')
        ->where('type', '<>', 'aucun')
        ->first();
        $digits = range(0, 9);
$otp = "";
for ($i = 0; $i < 5; $i++) {
    $otp .= $digits[array_rand($digits)];
}


        if($user){
            $userU = Connection::where('user_id', $user->id)->update(['opt_used' => true]);
            $appareil = "Mobile";
            Connection::create(['user_id' => $user->id,
            'opt'=>$otp, 'ip'=>  $request->ip(),
            'navigator'=> Browser::browserName(),
             'appareil'=>$appareil]);
            return response()->json(
                ['data'=>$user,
                    'opt'=>$otp,
    'message'=> "Utilisateur connecté"
                ]
            );
        }else{
            return response()->json(
                ['data'=>null,
                    'opt'=>null,
    'message'=> "L'utilisateur n'est pas reconnu ou n'est pas autorisé à se connecter."
                ]
           ,401 );
        }

    }
    public function login(Request $request)
    {
        $user=Connection::where('opt',$request->opt)
        ->where('opt_used', false)
        ->first();
        if($user){
            $user->update(['opt_used'=>true]);
            $user =User::find($user->user_id);
            $token =$user->createToken("API TOKEN")->plainTextToken;
            return response()->json(['user'=> $user , 'token'=>$token]);
        }
        else{
            return response()->json(['user'=> $user , 'token'=>''], 401);
        }

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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
