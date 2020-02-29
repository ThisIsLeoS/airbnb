<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\User;
use App\Service;
use App\Message;
use App\Sponsorship;
use App\Http\Requests\ApartmentRequest;
use Illuminate\Support\Facades\Auth;
use Braintree;
use DateTime;
use DB;
use Carbon\Carbon;
use App\Image;

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
    public function store(ApartmentRequest $request, $userId)
    {
        $data = $request->validated();

        // viene creato l'appartamento (senza salvarlo nel DB)
        $apt = Apartment::make($data);

        // all'appartamento viene "agganciato" l'utente
        $user = User::findOrFail($userId);
        $apt->user()->associate($userId);

        // l'appartamento viene salvato nel DB
        $apt->save();
        if ($request -> hasfile("poster_img")) {
          $file = $request -> file("poster_img");
          $filename = $file -> getClientOriginalName();
          $file -> move("images/AptImg/".$apt->id, $filename);
          $newAptImg = [
              "poster_img" => $filename
          ];
        }
        
        if (isset($data["images"])) { 
          foreach($data["images"] as $key => $value){
            
            if($request -> hasfile("images.".$key)){
              /* dd($request -> hasfile("images.".$key)); */
              $fileM = $request -> file("images.".$key);
              $filenameM = $fileM -> getClientOriginalName();
              $fileM -> move("images/AptImg/".$apt->id."/others", $filenameM);
              $newAptImgM = [
                "path" => $filenameM
              ];
              $image= Image::make($newAptImgM);
              $image -> apartment() -> associate($apt);
              $image -> save();
            };
          }
        }
        if (isset($data["services"]))
        {
          // all'appartamento vengono "agganciati" i servizi
          $services = Service::find($data["services"]);
          $apt -> services() -> sync($services);
        }
        else {
          $apt->services = [];
          // $apt -> services() -> sync($services);
        }
        if ($request -> hasfile("poster_img")) {
          $apt -> update($newAptImg);
        }

        // l'appartamento viene salvato nel DB
        return redirect()->route("userApartment.show", $userId) -> with('message', 'Appartamento Creato Correttamente');
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
      } else{
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
      } else{
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
    public function update(ApartmentRequest $request, $id)
    {
      $data = $request -> validated();
      
      $apartment = Apartment::findOrFail($id);
      if (isset($data['services'])) {
        $services = Service::find($data['services']);
        $apartment -> services() -> sync($services);
      } else {
        $services = [];
      }
      if ($request -> hasfile("poster_img")) {
          $file = $request -> file("poster_img");
          $extension = $file -> getClientOriginalExtension();
          $filename = time().'.'.$extension;
          $file -> move("images/AptImg/".$apartment->id, $filename);
          $newAptImg = [
              "poster_img" => $filename
          ];
      }
      $apartment -> services() -> sync($services);
      $apartment -> update($data);
      if ($request -> hasfile("poster_img")) {
        $apartment -> update($newAptImg);
      }


      return redirect() -> route('userApartment.show', Auth::user()->id)->with('message', 'Appartamento Aggiornato Correttamente');
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
      $apartment -> images() -> delete();
      $apartment -> messages() -> delete();
      $apartment -> views() -> delete();
      $apartment -> delete();
      return redirect() -> back() ->with('message', 'Appartamento Eliminato');
    }

    public function getApartmentsAndDistances($startTimeLat, $startTimeLon, $radius, $apartments) {
      $filteredAptsAndDists = [];
      foreach($apartments as $apartment) {
        $distance = $this->distance($startTimeLat, $startTimeLon, $apartment->lat, $apartment->lon, 6371);
        if ($distance < $radius) {
          $filteredAptsAndDists[]  = array(
            "apartment" => $apartment,
            "distance" => $distance
          );
        }
      }
      return $filteredAptsAndDists;
    }

    public function apartmentSearch(Request $request)
    {
      $data = $request -> all();
      $sponsorships = Sponsorship::all();
      // dd($sponsorships);
      $filteredAptsAndDists = $this->getApartmentsAndDistances($data["lat"], $data["lon"], 50, Apartment::all());
      $request->session()->put('searchedAddressLat', $data["lat"]);
      $request->session()->put('searchedAddresLon', $data["lon"]);
      $request->session()->put('apartmentsAndDistances', $filteredAptsAndDists);
      $request->session()->save();
      $html = view('partials.foundApartments')->with(compact('filteredAptsAndDists', "sponsorships"))->render();
      return view("pages.searchApartment", compact("html"));
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

  public function matchesFilters($apartment, $numOfRooms, $numOfBeds, $services) {
    // se l'appartamento ha lo stesso numero di stanze e letti passati in input
    if ($apartment->rooms == $numOfRooms && $apartment->beds == $numOfBeds) {
      /* si controlla anche che abbia come servizi gli stessi passati in input */
      $servicesMatch = false;
      // se il numero di servizi passati in input è lo stesso numero di servizi dell'appartamento
      if (count($services) === count($apartment->services)) {
        $numOfMatches = 0;
        // per ogni servizio tra quelli passati in input
        foreach ($services as $service) {
          // se il servizio è presente tra servizi dell'appartamento
          foreach($apartment->services as $aptmService) {
            if ($service === $aptmService->type) {
              $numOfMatches++;
              break;
            }
          }
        }
        if ($numOfMatches === count($services)) $servicesMatch = true;
      }

      return $servicesMatch;
    }
  }

  public function apartmentAdvSearch(Request $request) {
    $sponsorships = Sponsorship::all();
    $data = $request -> all();
    
    $numOfRooms = $data["rooms"];
    $numOfBeds = $data["beds"];
    $radius = $data["radius"];
    if (isset($data["services"])) $services = $data["services"];
    else $services = [];
    $aptsAndDists = [];
    $filteredAptsAndDists = [];
    if ($radius != 50) {
      $aptsAndDists = $this->getApartmentsAndDistances(
          $request->session()->get("searchedAddressLat"),
          $request->session()->get("searchedAddresLon"),
          $radius,
          Apartment::all()
        );
      foreach($aptsAndDists as $aptAndDist) {
        if($this->matchesFilters($aptAndDist["apartment"], $numOfRooms, $numOfBeds, $services)) {
          $filteredAptsAndDists[] = $aptAndDist;
        }
      }
    }
    else
    {
      foreach($request->session()->get('apartmentsAndDistances') as $aptAndDist) {
        if($this->matchesFilters($aptAndDist["apartment"], $numOfRooms, $numOfBeds, $services)) {
          $filteredAptsAndDists[] = $aptAndDist;
        }
      }
    }
    // return view("pages.searchApartment", compact("filteredAptsAndDists"));
    $html = view('partials.foundApartments')->with(compact('filteredAptsAndDists', "sponsorships"))->render();
    return response()->json($html, 200);
    /* return response()->json(compact("filteredAptsAndDists")); si può fare anche così ti restituisce sempre l'oggetto */
  }

  public function apartmentStatistics($id){
    $apartment = Apartment::findOrFail($id);
    
    
    if (Auth::user()-> id == $apartment -> user -> id){
    $messagesCount = $apartment->messages()
    ->selectRaw('count(*) as count, date(created_at) as created_date')
    ->groupBy('created_date')
    ->get();

    $viewsCount = $apartment->views()
    ->selectRaw('count(*) as count, date(created_at) as created_date')
    ->groupBy('created_date')
    ->get();

    return view("pages.apartmentStats" , compact("apartment" ,"messagesCount", "viewsCount"));
    } else{
        return view("pages.unauthorized").header("Refresh:4; url = 'http://localhost:3000");
    }
  }

  public function sendTokenToClient($aptId) {

    $apartment= Apartment::findOrFail($aptId);
    if (Auth::user()-> id == $apartment -> user -> id){
    $gateway = new Braintree\gateway([
      'environment' => config('services.braintree.environment'),
      'merchantId' => config('services.braintree.merchantId'),
      'publicKey' => config('services.braintree.publicKey'),
      'privateKey' => config('services.braintree.privateKey')
    ]);

    $clientToken = $gateway->clientToken()->generate([
      /* TODO? (see section "Generate a client token" in this page:
      https://developers.braintreepayments.com/start/hello-server/php) */
      // "customerId" => $aCustomerId
    ]);

    return view("pages.apartmentSponsor", compact("clientToken", "aptId"));
    } else{
      return view("pages.unauthorized").header("Refresh:4; url = 'http://localhost:3000");
    }
  }


   public function sendNonceToServer(Request $request) {
    
    $apartment = Apartment::findOrFail($request->aptId);
     if(count($apartment -> sponsorships) == 0){

       $gateway = new Braintree\Gateway([
         'environment' => config('services.braintree.environment'),
         'merchantId' => config('services.braintree.merchantId'),
         'publicKey' => config('services.braintree.publicKey'),
         'privateKey' => config('services.braintree.privateKey')
       ]);
       $amount = $request->plan;
       $nonce = $request->nonce;
       $result = $gateway->transaction()->sale([
           'amount' => $amount,
           'paymentMethodNonce' => $nonce,
           // 'customer' => [
           //     'firstName' => 'Tony',
           //     'lastName' => 'Stark',
           //     'email' => 'tony@avengers.com',
           // ],
           'options' => [
               'submitForSettlement' => true
           ]
       ]);
       if ($result->success) {

           // $transaction = $result->transaction;
           // header("Location: transaction.php?id=" . $transaction->id);
           // Sponsorizzare appartamento
           $sponsorships = Sponsorship::all();
           // $apSponsor = $apartment -> sponsored;
           // $apSponsor=[
           //     "sponsored" => 1
           // ];
           // $apartment -> update($apSponsor);
           foreach ($sponsorships as $sponsorship) {

               if($sponsorship->price == $amount){

                   if($amount == "2.99"){
                       $startTime = new DateTime();

                       $endTime = date("Y-m-d H:i:s", time() + 86400);

                       $apartment -> sponsorships() -> attach($sponsorship, ["start_time" => $startTime, "end_time" => $endTime]);

                   } else if ($amount == "5.99") {
                       $startTime = new DateTime();
                       $endTime = date("Y-m-d H:i:s", time() + 259200);
                       $apartment -> sponsorships() -> attach($sponsorship,["start_time" => $startTime, "end_time" => $endTime]);
                   } else if ($amount == "9.99") {
                       $startTime = new DateTime();
                       $endTime = date("Y-m-d H:i:s", time() + 518400);
                       $apartment -> sponsorships() -> attach($sponsorship,["start_time" => $startTime, "end_time" => $endTime]);
                   }
               }
           }
           $message = "Il pagamento è andato a buon fine";
           // return back()->with('message', 'Transaction successful');
           return view("pages.paymentResult", compact("message")).header("Refresh:5; url =" . route('userApartment.show', Auth::user()->id, false));
       } else {
           // $errorString = "C'è stato un errore";
           //foreach ($result->errors->deepAll() as $error) {
               // $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
           // }
           $message = "Il pagamento non è andato a buon fine";

           // return back()->with('message', 'Transaction UNsuccessful');
           return view("pages.paymentResult", compact("message")).header("Refresh:5; url =" . route('userApartment.show', Auth::user()->id, false));


           // return back()->withErrors('An error occurred with the message: ', "c'è stato un errore");
       }
     }else{
       return view("pages.alreadySponsored").header("Refresh:4; url =" . route('userApartment.show', Auth::user()->id, false));
     }
    // } else {
    //     return back()->withErrors('Hai già una sponsorizzazione attiva');
    // }


  }

  public function handleAptViews(Request $request) {
    $data = $request->all();
    
    $rows =
      DB::table("views")
      ->where("apartment_id", "=", $data["aptId"])
      ->where("ip_address", "=", $data["ip"])
      ->get();
    
      if($data["userId"] === null){

        if (count($rows) == 0) {
          DB::table('views')->insert(
            [
              'ip_address' => $data["ip"],
              'apartment_id' => $data["aptId"],
              'created_at' => Carbon::now()->toDateTimeString(),
              'updated_at' => Carbon::now()->toDateTimeString()
            ]
          );
        }
      }
    
  }

  public function makeAptVisible(Request $request)
  {
    $data = $request-> all();
    $apartment = Apartment::findOrFail($data["aptId"]);
    if ($apartment->visibility === 1) {
      $apartment -> visibility = 0;
      $apartment -> save();
    } else {
      $apartment -> visibility = 1;
      $apartment -> save();
    }
      return $apartment;
  }

  public function apartmentPlus(){
    $sponsorships = Sponsorship::all();
    return view("pages.apartmentPlus", compact("sponsorships"));
  }

}
