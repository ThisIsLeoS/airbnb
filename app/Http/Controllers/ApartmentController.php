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
  public static $apartmentsAndDistances = [];
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

        $services = Service::all();
        return view("pages.apartmentCreate" , compact("services"));
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

        if (isset($data["services"]))
        {

          $services = Service::find($data["services"]);
          $apt -> services() -> attach($services);
          // all'appartamento vengono "agganciati" i servizi
         /*  foreach ($data["services"] as $serviceType) { */
              // viene creato un servizio nel DB
              /* $service = Service::create(['type' => $serviceType]); */
              // il servizio è agganciato all'appartamento
              /* $apt->services()->attach($service->id); */
          
        }
        else {
          $apt->services =[];
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

      $apartment = Apartment::findOrFail($id);
      $services = Service::all();
      if (Auth::user()-> id == $apartment -> user -> id){
        return view('pages.editApartment', compact('apartment', 'services'));
      }else{
          return view("pages.unauthorized").header("Refresh:4; url = 'http://localhost:3000");
      }
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
      $data = $request -> all();
      $apartment = Apartment::findOrFail($id);
      $apartment -> update($data);
      if (isset($data['services'])) {
        $services = Service::find($data['services']);
        $apartment -> services() -> attach($services);
      } else {
        $services = [];
      }
      $apartment -> services() -> sync($services);

      return redirect() -> route('userApartment.show', Auth::user()->id);
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

    // public function distance($lat1, $lon1, $lat2, $lon2 /*unit*/) {
    //   if (($lat1 === $lat2) && ($lon1 === $lon2)) {
    //     return 0;
    //     }
    //   else {
    //     $radlat1 = pi() * $lat1/180;
    //     $radlat2 = pi() * $lat2/180;
    //     $theta = $lon1-$lon2;
    //     $radtheta = pi() * $theta/180;
    //     $dist = sin($radlat1) * sin($radlat2) + cos($radlat1) * cos($radlat2) * cos($radtheta);
    //     if ($dist > 1) {
    //     $dist = 1;
    //     }
    //     $dist = acos($dist);
    //     $dist = $dist * 180/pi();
    //     $dist = $dist * 60 * 1.1515;
    //     $dist = $dist * 1.609344;
    //     return $dist;
    //   }
    // }
    
    public function apartmentSearch(Request $request)
    {
      $data = $request -> all();
      $apartments = Apartment::all();
      $apartmentsAndDistances = [];
      foreach($apartments as $apartment) {
        $distance = $this->distance($data["lat"], $data["lon"], $apartment->lat, $apartment->lon, 6371);
        if ($distance < 50) {
          $apartmentsAndDistances[]  = array(
            "apartment" => $apartment, 
            "distance" => $distance
          );
        }
      }
      session()->put('latFirstSearch', $data["lat"]);
      session()->put('lonFirstSearch', $data["lon"]);
      session()->put('apartmentsAndDistances', $apartmentsAndDistances);
      session()->save();
      return view("pages.searchApartment", compact("apartmentsAndDistances"));
    }

  public function distance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius) {
    $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) +
          pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return $angle * $earthRadius;
  }

  /* public function apartmentAdvSearch(Request $request) {
    $apartmentsAndDistances = [];
    $data = $request -> all();
    $numOfRooms = $data["rooms"];
    $numOfBeds = $data["beds"];
    $radius = $data["radius"];
    if (isset($data["services"])) $services = $data["services"];
    else $services = [];
    $apartments = Apartment::all();
    $apartmentsAndDistances = [];
      foreach($apartments as $apartment) {
        $distance = $this->distance(session()->get('latFirstSearch'), 
                                    session()->get("lonFirstSearch"), 
                                    $apartment->lat, 
                                    $apartment->lon, 6371);
        if ($distance < $radius) {
          $apartmentsAndDistances[]  = array(
            "apartment" => $apartment, 
            "distance" => $distance
          );
        }
      }
    if ($radius != 50)
    {
      // foreach sugli appartamenti ottenuti dalla ricerca della home page
      foreach($apartmentsAndDistances as $aptmAndDist) {
        // se l'appartamento ha lo stesso numero di stanze e letti indicato dall'utente
        if(
          $aptmAndDist["apartment"]->rooms == $numOfRooms &&
          $aptmAndDist["apartment"]->beds == $numOfBeds
        ) {
          // si controlla anche che abbia tutti i servizi indicati dall'utente
          $numOfMatches = 0;
          // per ogni servizio indicato dall'utente
          foreach ($services as $service) {
            // cerca se il servizio è presente nei servizi dell'appartamento        
            foreach($aptmAndDist["apartment"]->services as $aptmService)
            {
              if ($service === $aptmService->type) {
                $numOfMatches++;
                break;
              }
            }
          }
          if ($numOfMatches == count($services))
          {
            $apartmentsAndDistances[] = array(
            "apartment" => $aptmAndDist["apartment"],
            "distance" => $aptmAndDist["distance"]
            );
          }
        }
      }
    }
    else
    {
      // foreach sugli appartamenti ottenuti dalla ricerca della home page
      foreach(session()->get('apartmentsAndDistances') as $aptmAndDist) {
        // se l'appartamento ha lo stesso numero di stanze e letti indicato dall'utente
        if(
          $aptmAndDist["apartment"]->rooms == $numOfRooms &&
          $aptmAndDist["apartment"]->beds == $numOfBeds
        ) {
          // si controlla anche che abbia tutti i servizi indicati dall'utente
          $numOfMatches = 0;
          // per ogni servizio indicato dall'utente
          foreach ($services as $service) {
            // cerca se il servizio è presente nei servizi dell'appartamento        
            foreach($aptmAndDist["apartment"]->services as $aptmService)
            {
              if ($service === $aptmService->type) {
                $numOfMatches++;
                break;
              }
            }
          }
          if ($numOfMatches == count($services))
          {
            $apartmentsAndDistances[] = array(
            "apartment" => $aptmAndDist["apartment"],
            "distance" => $aptmAndDist["distance"]
            );
          }
        }
      }
    }
    return view("pages.searchApartment", compact("apartmentsAndDistances"));
  } */
}
