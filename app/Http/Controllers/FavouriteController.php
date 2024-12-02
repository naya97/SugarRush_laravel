<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function addToFvourite(Request $request) {

        $user = Auth::user();

        if($user) {
            $favorite = Favorite::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
            ]);

            return response()->json([
                'message' => 'added successfully',
                'data' => $favorite,
            ]);
        }
        else {
            return response()->json(['message' => 'you have to login/signup again']);
        }
    }

    public function removeFromFavourite(Request $request) {

        $user = Auth::user();
        if($user) {
            Favorite::query()->where('product_id',$request->id)->where('user_id',$user->id)->destroy();

            return response()->json([
                'message' => 'product removed from favourite successfully',
            ]);
        }
        else {
            return response()->json(['message' => 'you have to login/signup again']);
        }
    }
}
