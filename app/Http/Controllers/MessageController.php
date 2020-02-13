<?php

namespace App\Http\Controllers;
use App\Message;
use App\Apartment;
use App\User;
use App\Http\Requests\MessageRequest;
use Illuminate\Http\Request;

class MessageController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }

    public function createMessageForApt(MessageRequest $request , $id){
         $validatedData = $request -> validated();
         $message = Message::make($validatedData);
         $apartament = Apartment::findOrFail($id);
         $message -> apartment() -> associate($apartament);
         $message -> save();
         return redirect() -> back() ->with('message', 'Messaggio inviato');
    }


     /* public function search()
    {
        return view('pages.testAutocomplete');
    }

    public function autoComplete(Request $request){

       
        $data=User::select("email")
        -> where("email","LIKE","%".$request-> input("query")."%")->get();
        return response() -> json($data);
    } */

    
}
