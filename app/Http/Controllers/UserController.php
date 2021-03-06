<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Apartment;
use App\Message;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
      $user = User::findOrFail($id);
      if ($user == Auth::user()){
        return view('pages.userShow', compact('user'));
      } else{
          return view("pages.unauthorized").header("Refresh:4; url = 'http://localhost:3000");
      }


    }

    public function userApartmentShow($id)
    {
      $user = User::findOrFail($id);
        if ($user == Auth::user()){
            return view('pages.userApartmentShow', compact('user'));
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

    public function setUserImage(Request $request){
        $file = $request -> file("profile_img");
        $filename = $file -> getClientOriginalName();
        $file -> move("images/UserProfileImg", $filename);
        $newUserImg = [
            "profile_img" => $filename
        ];
        Auth::user() -> update($newUserImg);

        return redirect() -> back();
    }
}
