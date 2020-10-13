<?php

namespace App\Http\Controllers;

use App\Classification;
use App\Crypto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassificationController extends Controller
{
    public function index(){
        $classifications = Classification::all();
        return view('home', compact('classifications'));
    }

    public function create()
    {
        $all_classifications = Classification::all();
        return view('classifications.create', compact('all_classifications'));
    }

    public function store(){

        $data = request()->validate([
            'classification' => 'required',
            'description' => 'required',

        ]);

        $classification = new Classification();
        $classification->classification = request('classification');
        $classification->description = request('description');
        $classification->user_id = Auth::id();
        $classification->save();

        return redirect('/classifications');
    }


    public function load(){
        $classifications = Classification::all();
        return view('cryptos.create', compact('classifications'));
    }


}
