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


            $this->update($checkRating->first(), $checkRatingCount->first());

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
        $gemResults = Rating::where([
            ['crypto_id', '=', request('crypto_id')],
            ['rating', '=', true],
        ])->get();
        $scamResults = Rating::where([
            ['crypto_id', '=', request('crypto_id')],
            ['rating', '=', false],
        ])->get();

        if($gemResults){
            $gemCount = count($gemResults);
        } else {
            $gemCount = 0;
        }

        if ($scamResults){
            $scamCount = count($scamResults);
        } else {
            $scamCount = 0;
        }

        $ratingCount->gem_count = $gemCount;
        $ratingCount->scam_count = $scamCount;
        $ratingCount->save();

    }

    public function update(Rating $rating, RatingCount $ratingCount){
        $rating->rating = request('checker');
        $rating->update();
        $this->updateCount($ratingCount);
        return $rating;
    }

    public function updateCount(RatingCount $ratingCount){

        $gemResults = Rating::where([
            ['crypto_id', '=', request('crypto_id')],
            ['rating', '=', true],
        ])->get();
        $scamResults = Rating::where([
            ['crypto_id', '=', request('crypto_id')],
            ['rating', '=', false],
        ])->get();
        $ratingCount->crypto_id = request('crypto_id');
        $gemCount = count($gemResults);
        $scamCount = count($scamResults);
        $ratingCount->gem_count = $gemCount;
        $ratingCount->scam_count = $scamCount;


        $ratingCount->save();
        return redirect('/home' );
    }

}
