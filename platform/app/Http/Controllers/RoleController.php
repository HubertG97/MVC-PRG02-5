<?php

namespace App\Http\Controllers;

use App\Rating;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function rolePromotion(){
        $ratingResults = Rating::where([
            ['user_id', '=', Auth::id()],
        ])->get();
        $promotedUser = User::find(Auth::id());
        $ratingCount = count($ratingResults);

        if($promotedUser->role_id === 1){
            $isAdmin = true;
        }else{
            $isAdmin = false;
        }


        if($ratingCount >= 3 && !$isAdmin) {

            User::where([
                ['id', '=', Auth::id()],
            ])->update(['role_id' => 2]);
        }
    }
}
