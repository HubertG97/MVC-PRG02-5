<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function create(){
        $all_ratings = Rating::all();
        $checkRating = Rating::where([
            ['user_id', '=', Auth::id()],
            ['crypto_id', '=', request('crypto_id')],
        ]);

        if ($checkRating->exists()) {

            $this->update($checkRating->first());

        }else{
            $rating = new Rating();
            $rating->crypto_id = request('crypto_id');
            $rating->user_id = Auth::id();
            $rating->rating = request('checker');
            $rating->save();
        }



        return redirect('/home');
    }

    public function update(Rating $rating){
        $rating->rating = request('checker');
        $rating->update();
        return redirect('/home');
    }
}
