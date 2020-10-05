<?php

namespace App\Http\Controllers;

use App\Crypto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CryptoController extends Controller
{
    public function index(){
        $allcryptos = Crypto::all();
        return view('home', ['allcryptos' => $allcryptos]);
    }

    public function create()
    {
        $allcryptos = Crypto::all();
        return view('cryptos.create', compact('allcryptos'));
    }

    public function store(){

        $data = request()->validate([
            'name' => 'required',
            'ticker' => 'required',
            'price' => 'required',
            'description' => 'required',
            'website' => 'required',
            'category' => 'required',

        ]);

        $crypto = new Crypto();
        $crypto->name = request('name');
        $crypto->ticker = request('ticker');
        $crypto->price = request('price');
        $crypto->description = request('description');
        $crypto->website = request('website');
        $crypto->category = request('category');
        $crypto->user_id = Auth::id();

        $crypto->save();

        return redirect('/cryptos');
    }
}
