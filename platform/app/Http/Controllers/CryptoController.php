<?php

namespace App\Http\Controllers;

use App\Classification;
use App\Crypto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Filters\CryptoFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CryptoController extends Controller
{
    public function index(){
        $visible_cryptos = Crypto::where([
            ['visible', '=', 1],
        ])->get();

        $classifications = Classification::all();


        return view('home', ['visible_cryptos' => $visible_cryptos, 'classifications' => $classifications]);
    }

    public function review(){

        $all_cryptos = Crypto::orderBy('visible', 'desc')->latest()->get();

        return view('cryptos.review', ['all_cryptos' => $all_cryptos]);
    }

    public function visibility(){
        $crypto_id = request('crypto_id');

        $crypto = Crypto::where([
            ['id', '=', $crypto_id],
        ])->first();
        $crypto_visibility = !($crypto->visible);
        $crypto->visible = $crypto_visibility;
        $crypto->save();
        return $this->review();
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
            'image' => 'mimes:jpeg,png|max:1024',

        ]);

        $crypto = new Crypto();
        $crypto->name = request('name');
        $crypto->ticker = request('ticker');
        $crypto->price = request('price');
        $crypto->description = request('description');
        $crypto->website = request('website');
        $crypto->classification_id = request('classification');
        $crypto->user_id = Auth::id();

        if (request()->hasFile('image')){
            $image_name = time().'.'.request('image')->extension();
            request()->file('image')->move(public_path('image/logo'), $image_name);
            $crypto->logo_url = $image_name;

        }else{
            $crypto->logo_url = 'no_image.jpg';
        }
        $crypto->save();

        return redirect('/home');
    }
    public function show(Crypto $crypto){

        return view('cryptos.show', compact('crypto'));
    }

    public function edit(Crypto $crypto){
        $classifications = Classification::all();
        return view('cryptos.edit', compact('crypto', 'classifications'));

    }

    public function update(Crypto $crypto){
        $data = request()->validate([
            'name' => 'required',
            'ticker' => 'required',
            'price' => 'required',
            'description' => 'required',
            'website' => 'required',

        ]);
        $crypto->name = request('name');
        $crypto->ticker = request('ticker');
        $crypto->price = request('price');
        $crypto->description = request('description');
        $crypto->website = request('website');
        $crypto->classification_id = request('classification');

        $crypto->update($data);
        return redirect('cryptos/' . $crypto->id);
    }

    public function delete(Crypto $crypto){
        Crypto::where('id', $crypto->id)->delete();

        return redirect('/home');
    }

    public function cryptoFilter(Request $request) {
        $classifications = Classification::all();
        $filteredcryptos = Crypto::filter($request)->get();
        return view ('cryptos.results', compact('filteredcryptos', 'classifications'));
    }


}
