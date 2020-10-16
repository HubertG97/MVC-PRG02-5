<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;

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
//        $crypto_id = $rating->crypto_id;
        $rating->update();
//        $ratings_array = $this->show($crypto_id);
        return redirect('/home' );
    }

//    public function show($crypto_id){
//        $ratings_true = Rating::where([
//            ['user_id', '=', Auth::id()],
//            ['crypto_id', '=', $crypto_id],
//            ['rating', '=', true]
//        ]);
//        $ratings_false = Rating::where([
//            ['user_id', '=', Auth::id()],
//            ['crypto_id', '=', $crypto_id],
//            ['rating', '=', false]
//        ]);
//
//        $ratings_true_count = count($ratings_true);
//        $ratings_false_count = count($ratings_false);
//        return array($ratings_true_count, $ratings_false_count);
//    }
}
