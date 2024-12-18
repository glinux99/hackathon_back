<?php

namespace App\Http\Controllers;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Car;
use App\Models\User;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;
use function PHPUnit\Framework\isEmpty;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hc =new HomeController;
        $hc->cars();
        return view('docs.documents', ['docs'=> Document::all()]);
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

  
        $this->validate($request, [
            'title' => 'required|string|max:255',
        ], );
        $request['user_id'] = Auth::user()->id;
            // Activity::create(['title' => 'Creation du document '.$request['title'], 'actions' => $request['actions'], 'user_id' => $request['user_id']]);


            $trash = new Document;
            $request['champs'] = count($trash->getFillable());
            $data = $request->all();
            $request['actions'] = json_encode($data);
            $request['is_expired'] = isset($request->is_expired);
            $trash = Document::create($request->all());
            $request['title'] = "Création du document ".$request['title'];
            Activity::create(['title' => $request['title'], 'actions' => $request['actions'], 'user_id' => Auth::user()->id]);
        return back();
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
        return view('docs.document', ['doc' => Document::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $doc = Document::find($id);
        // return $request;
        $doc->update($request->all());
        $request['user_id'] = Auth::user()->id;
        $request['title'] = "Mis à  jour du document " . $doc->title;

        $request['champs'] = count($doc->getFillable());
        $data = $request->all();
        $request['actions'] = json_encode($data);
        Activity::create(['title' => $request['title'], 'actions' => $request['actions'], 'user_id' => Auth::user()->id]);

        return redirect()->route('documents.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Document::find($id)->delete();

        return redirect()->route('documents.index')->with('success', 'doc deleted successfully!');

    }
}
