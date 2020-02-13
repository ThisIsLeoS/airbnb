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
        // $validatedData = $aptRequest->validate();
        $data = $request->all();
        dd($data);
        // l'utente che ha aggiunto l'appartamento viene salvato in una var.
        $user = User::findOrFail($userId);
        // viene creato l'appartamento
        $apt = Apartment::create($data);
        // all'utente viene "agganciato" l'appartamento
        $apt->user()->associate($userId);
        // all'appartamento vengono "agganciati" i servizi
            // i servizi vengono creati e salvati in una collezione
            $services = collect();
            foreach ($data["services"] as $serviceType) {
                $service = Service::make([$serviceType]);
                $services->push($service);
            }
        // agganciarlo a user, messages, services, images
        $apt->services()->attach($services);

        // l'appartamento viene salvato nel DB
        return redirect()->route("userApartment.show");
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
