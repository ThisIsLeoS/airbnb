<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\User;
use App\Service;
use App\Message;
use App\Http\Requests\ApartmentRequest;
use Illuminate\Support\Facades\Auth;


class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.apartmentCreate");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $userId)
    {
        // TODO: validazione dati
        $data = $request->all();

        // viene creato l'appartamento (senza salvarlo nel DB)
        $apt = Apartment::make($data);

        // all'appartamento viene "agganciato" l'utente
        $user = User::findOrFail($userId);
        $apt->user()->associate($userId);

        // l'appartamento viene salvato nel DB
        $apt->save();

        // all'appartamento vengono "agganciati" i servizi
        foreach ($data["services"] as $serviceType) {
            // viene creato un servizio nel DB
            $service = Service::create(['type' => $serviceType]);
            // il servizio è agganciato all'appartamento
            $apt->services()->attach($service->id);
        }

        // l'appartamento viene salvato nel DB
        return redirect()->route("userApartment.show", $userId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartment = Apartment::findOrFail($id);

        return view("pages.apartmentShow" , compact("apartment"));
    }

    public function apartmentUserMessageShow($id)
    {
      $user = User::findOrFail($id);

      if ($user == Auth::user()){
        return view('pages.messageApartmentShow', compact('user'));
      }else{
          return view("pages.unauthorized").header("Refresh:4; url = 'http://localhost:3000");
      }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userApartmentDelete($id)
    {
      $apartment = Apartment::findOrFail($id);

      $apartment -> services() -> detach();
      $apartment -> messages() -> delete();
      $apartment -> delete();
      return redirect() -> back() ->with('message', 'Appartamento Eliminato');
    }
}
