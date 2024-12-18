<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DocumentCar;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all users
        $hc =new HomeController;
        $hc->cars();
        $users = User::with('connections')
        ->where('type','<>', 'client')
        ->where('type', '<>', 'aucun')
        ->get();

        return view('users.users', ['users' => $users]);
    }
    public function customers()
    {
        // Get all users
        $hc =new HomeController;
        $hc->cars();
        $users = User::with('connections')
        ->where('type', 'aucun')
        ->where('type', '<>', 'agent')
        ->get();

        return view('users.customers', ['users' => $users]);
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
        $hc =new HomeController;
        $hc->cars();

        // UserController to create user agent
        // Validate the request
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ],   [
            'name.required' => 'Le champ nom d\'utilisateur est obligatoire',
            'email.required' => 'le champ email est obligatoire',
            'email.email' => 'le champ email doit être une adresse email valide',
            'email.max' => 'le champ email ne doit pas dépasser 255 caractères',
            'email.unique' => 'l\'email existe déjà',
            'password.required' => 'le champ mot de passe est obligatoire',
            'password.min' => 'le champ mot de passe doit contenir au moins 8 caractères',
            'password.confirmed' => 'la confirmation du mot de passe ne correspond pas',
        ]);
        $avatar = $request->file('avatar');
        if ($request->file('avatar')) {
            $avatarPath = $avatar->store('avatars');
            $request['avatar'] = $avatarPath;
            User::create($request->all());
        }

        // Create a new user
        else {

            User::create($request->except(['avatar']));

        }


        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hc =new HomeController;
        $hc->cars();
        // Get the user
        $user = User::find($id);

        // Return the user
        return view('users.user', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hc =new HomeController;
        $hc->cars();
        $user = User::find($id);
        $docs = DocumentCar::where('car_id', $id)->get();
        return view('users.user', ['user' => $user, 'docs'=> $docs]);
    }
    public function document(String $car, String $option){
        if($option=="true"){
            $car = Car::with('customer')->find($car);
            $car->update(['lock'=> 1, 'inf'=> $car->inf+1]);
            // return $car;
            $docs = DocumentCar::with('document')->
            where('car_id', $car->id)->get();
            return response()->json([
                'message'=> "Scan de documents terminés",
                'user'=>$car, 'documents'=>$docs],200);
        }else{
            $car = Car::with('customer')->find($car);            // return $car;
            $car->update(['lock'=> 0, 'inf'=> $car->inf+1]);
            $docs = DocumentCar::with('document')->
            where('car_id', $car->id)->get();
            return response()->json([
                'message'=> "Scan de documents terminés",
                'user'=>$car, 'documents'=>$docs],200);
        }


    }
    public function documents(Request $request){
        $car = Car::with('customer')
        ->find($request->car_id);
        $docs = DocumentCar::with('document')->
        where('car_id', $request->car_id)->get();

        return response()->json([
            'message'=> "Affichage de donnee ",
            'user'=>$car, 'documents'=>$docs],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hc =new HomeController;
        $hc->cars();
        // Get the user
        //return $request;
        $user = User::find($id);
        // Validate the request
        // $this->validate($request, [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        // ]);

        // Update the user
        $hashed_password = $user->password;
        $confirmemailpassword = $request['confirmemailpassword'];
        $password = $request['password'];

        //return  Hash::check($password, $hashed_password);
        if (Hash::check($password, $hashed_password)) {

            $request['password'] = bcrypt($request->newpassword);
            $user->update($request->except(['avatar']));
        }
        if (Hash::check($confirmemailpassword, $hashed_password)) {

            $request['password'] = bcrypt($request->confirmemailpassword);
            $user->update($request->except(['avatar']));
        } else {

            // Le mot de passe ne correspond pas
            if (!isset($request['confirmemailpassword']) && !isset($request['newpassword'])) {
                $user->update($request->except(['avatar']));

                if ($request->hasFile('avatar')) {
                    $fileName = 'avatar-' . $user->id . '.png';
                    $path = $request->file('avatar')->storeAs(
                        'avatar' . $user->id,
                        $fileName,
                        'public'
                    );


                    $user->update(['avatar' => "/" . "storage/" . $path]);
                }
            }
        }


        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $hc =new HomeController;
        $hc->cars();
        $user = User::find($id);

        // Delete the user
        $user->delete();
        return back();
    }
}
