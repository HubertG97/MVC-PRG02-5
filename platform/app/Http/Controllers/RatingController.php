<?php

namespace App\Http\Controllers;

use App\Rating;
use App\RatingCount;
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
        $checkRatingCount = RatingCount::where([
            ['crypto_id', '=', request('crypto_id')],
        ]);

        if ($checkRating->exists() && $checkRatingCount->exists()) {

            $this->updateCount($checkRatingCount->first(), $checkRating->first());
            $this->update($checkRating->first());

        }else if (!($checkRating->exists())){
            $rating = new Rating();
            $rating->crypto_id = request('crypto_id');
            $rating->user_id = Auth::id();
            $rating->rating = request('checker');
            $rating->save();
            $this->createRatingCount();

        }



        return redirect('/home');
    }

    public function createRatingCount(){
        $ratingCount = new RatingCount();
        $ratingCount->crypto_id = request('crypto_id');

        if (request('checker') == true){
            $ratingCount->gem_count = 1;
        }else if (request('checker') == false){
            $ratingCount->scam_count = 1;
        }

        $ratingCount->save();

    }

    public function update(Rating $rating){
        $rating->rating = request('checker');
        $rating->update();
        return $rating;
    }

    public function updateCount(RatingCount $ratingCount, Rating $rating){

        if (request('checker') == true && $rating->rating == false){
            $ratingCount->gem_count = $ratingCount->gem_count + 1;
            $ratingCount->scam_count = $ratingCount->scam_count - 1;
        }else if (request('checker') == false && $rating->rating == true){
            $ratingCount->gem_count = $ratingCount->gem_count - 1;
            $ratingCount->scam_count = $ratingCount->scam_count + 1;
        }


        $rating->update();
        return redirect('/home' );
    }

}
