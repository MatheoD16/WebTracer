<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function accueil() {
        return view('home.accueil', ['title'=>'Accueil']);
    }

    public function home() {
        return view('home.home', ['title' => 'Home']);
    }


    public function contact(){
        return view('home.contact', ['title'=>'Contact']);
    }


    public function aPropos()
    {
        return view('home.apropos', ['title' => 'A propos']);
    }

    public function contactShow(Request $request){
        $email = $request->email;
        $identity = $request->identity;
        $description = $request->description;

        return view('home.contactShow',['email'=>$email, 'identity' => $identity, 'description' => $description, 'title'=>'Information du contact']);
    }
}
