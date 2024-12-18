<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Car;
use App\Models\User;
use App\Models\Document;
use App\Models\DocumentCar;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;
use function PHPUnit\Framework\isEmpty;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class CarController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $hc =new HomeController;
        $hc->cars();
        $carses = Car::with('customer')->get();

        return view('dashboard.trashes', ['cars' => $carses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trashes.create');
    }

    public function preview($carId){

        $qrcode = new QRCodeController;
        $car = Car::with('customer')->find($carId);
            // return $car;
            $code ='#'.str_pad($car->id, 9, "0", STR_PAD_LEFT);
            // return $car->customer->id;
            // return $customer = User::find($car->customer->user_id);
        $qrcode = QrCode::size(80)->generate($code);
        return view('cards.cardPreview', ['qrcode'=>$qrcode, 'car'=>$car, 'code'=>  $code ]);
    }
    public function previewData($carId){
        $qrcode = new QRCodeController;
        $car = Car::with('customer')->find($carId);
            // return $car;
            $customer = User::find($car->customer->id);
            $code ='#'.str_pad($car->id, 9, "0", STR_PAD_LEFT);
        $qrcode = QrCode::size(80)->generate($code);
        return response()->json([
            'message'=> "Visualisation de donnee ",
            'qrcode'=>$qrcode, 'car'=>$car, 'code'=>  $code, 'customer'=> $customer ]);
    }
    public function generatePdf()
    {
      // Obtenez le contenu du div Blade
      $carId=1;
      $car = Car::with('customer')->find($carId);
      // return $car;
      $code ='#'.str_pad($car->id, 9, "0", STR_PAD_LEFT);
  $qrcode = QrCode::size(80)->generate($code);
      $content = view('cards.cardComponent', ['qrcode'=>$qrcode, 'car'=>$car, 'code'=>  $code ])->render();

      // Créez un nouveau PDF
      $pdf = PDF::loadView('cards.cardComponent', ['qrcode'=>$qrcode, 'car'=>$car, 'code'=>  $code ]);

      // Configurez le PDF
      $pdf->setPaper('A4', 'portrait');

      // Ajoutez un en-tête et un pied de page
    //   $pdf->setHeader(
    //     [
    //       'L' => 'Mon en-tête',
    //       'C' => 'Laravel',
    //       'R' => 'Date',
    //     ]
    //   );
    //   $pdf->setFooter(
    //     [
    //       'L' => 'Page [page]',
    //       'R' => 'Copyright © 2023',
    //     ]
    //   );

      // Générez le PDF
     return $pdf->stream();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'plaque' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            // 'password' => 'required|string|min:6',
        ], [
            'plaque.required' => 'le champ plaque est obligatoire',
            'marque.required' => 'le champ marque est obligatoire',
            'name.required' => 'Le champ nom d\'utilisateur est obligatoire',
            'email.required' => 'le champ email est obligatoire',
            'email.email' => 'le champ email doit être une adresse email valide',
            'email.max' => 'le champ email ne doit pas dépasser 255 caractères',
            'email.unique' => 'l\'email existe déjà',
            'password.required' => 'le champ mot de passe est obligatoire',
            'password.min' => 'le champ mot de passe doit contenir au moins 8 caractères',
            'password.confirmed' => 'la confirmation du mot de passe ne correspond pas',
            ] );


            // $request['user_id'] = Auth::user()->id;
            $request['password']=bcrypt('12345678');
            $customer = User::create($request->all());
            // Activity::create(['title' => 'Creation du proprietaire du vehicule IM '.$request['plaque'], 'actions' => $request['actions'], 'user_id' => $request['user_id']]);
            $request['title'] = "Création d'un vehicule";
            $cars = new Car;

            $request['champs'] = count($cars->getFillable());
            $data = $request->all();
            $request['actions'] = json_encode($data);
            $request['user_id']= $customer->id;
            $cars = Car::create($request->all());
            Activity::create(['title' => $request['title'], 'actions' => $request['actions'], 'user_id' => Auth::user()->id]);
            if($request->file()){
                $documents = Document::all();
                for ($i=1; $i <= $documents->count() ; $i++) {
                 $image = $request['file'.$i];
                 if( is_file($image)){
                    $path = $image->storeAs(
                        'Documents/',
                        \str_replace(':', '', now()) .$i. '.png',
                        'public'
                    );
                    $carId = Car::orderBy('id', 'DESC')->first()->id;
                    DocumentCar::create([
                        'is_read'=> isset($request['is_read'. $documents[$id-1]->id]),
                        'path'=>'/storage'.'/'.$path,
                        'car_id'=>$carId,
                        'document_id'=>$documents[$i-1]->id,
                        'expiration'=>$request['expiration'.$documents[$i-1]->id]
                    ]);
                 }

                }
             }else{
                $documents = Document::all();
                for ($i=0; $i <  $documents->count() ; $i++) {
                    $carId = Car::orderBy('id', 'DESC')->first()->id;
                    DocumentCar::create([
                        'path'=>null,
                        'car_id'=>$carId,
                        'document_id'=> $documents[$i]->id,
                        'expiration'=>$request['expiration'.$documents[$i]->id],
                        'is_read'=>isset($request['is_read'.$documents[$i]->id])

                    ]);
                }
             }
            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trash  $cars
     * @return \Illuminate\Http\Response
     */
    public function show(Trash $cars)
    {
        return view('dashboard.trash', ['trash' => $cars]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trash  $cars
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {

$docs = DocumentCar::with('document')->
where('car_id', $car->id)->get();
$documents =Document::all();
if(!$docs->count()){

   for ($i=0; $i < $documents->count(); $i++) {
    DocumentCar::create([
        'path'=>null,
        'car_id'=>$car->id,
        'document_id'=>$documents[$i]->id,
        'expiration'=>null,
        'is_read' => false
    ]);
   }
   $docs = DocumentCar::with('document')->
where('car_id', $car->id)->get();
}elseif ($documents->count()!= $docs->count()) {
    $documentx =Document::whereNotIn('id', DocumentCar::where('car_id', $car->id)->pluck('document_id'))->get();
    for ($i=0; $i < $documentx->count(); $i++) {
        DocumentCar::create([
            'path'=>null,
            'car_id'=>$car->id,
            'document_id'=>$documentx[$i]->id,
            'expiration'=>null,
            'is_read'=> false
        ]);
       }
       $docs = DocumentCar::with('document')->
where('car_id', $car->id)->get();
}

        return view('dashboard.trash', ['car' => $car, 'docs'=>$docs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trash  $cars
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cars)
    {
        // return $request;
        $request['lock'] = isset($request->lock);
        $request['status'] = isset($request->status);
        $cars = Car::with('customer')->find($cars);
        // return $request;
        $request['user_id'] = Auth::user()->id;
        $request['title'] = "Mis à  jour du vehicule IMAT." . $cars->plaque;

        $request['champs'] = count($cars->getFillable());
        $data = $request->all();
        $request['actions'] = json_encode($data);
        $Activity= Activity::create(['title' => $request['title'], 'actions' => $request['actions'], 'user_id' => Auth::user()->id]);
        $cars->update($request->except(['user_id']));

       $doc= DocumentCar::find($request->document_id);

       foreach ($request->documents as $key=>$doc) {


        $document= DocumentCar::find($doc);

        $data = Document::find($document->document_id);
        $request['actions'] = json_encode($data);

        $request['title'] = "Mise à jour du document ". $data ['title']. " pour le vehicule de ".$cars->customer->name. " ".$cars->customer->l_name;
        Activity::create(['title' => $request['title'], 'actions' => $request['actions'], 'user_id' => Auth::user()->id]);
        
        $document->update([
           
            'expiration'=>$request->expiration[$key]]);
       }
       $docs = DocumentCar::with('document')->get();
    //    dd()
       foreach( $docs as $doc){
            if(isset($request["is_read_".$doc->id])){
                $doc->update(['is_read' =>true]);
            }else{
                // return $doc->document;
                if(!$doc->document->is_expired){
                    $doc->update([ 'is_read' =>false]);  
                }
            }
            // return isset($request["is_read_".$document->id]);
       }
    //    return $request->all();
    return redirect()->back();
        // return redirect()->route('cars.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trash  $cars
     * @return \Illuminate\Http\Response
     */
    public function destroy($cars)
    {
        Car::find($cars)->delete();

        return redirect()->route('cars.index')->with('success', 'car deleted successfully!');
    }
}


