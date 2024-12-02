<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function addToFvourite(Request $request) {

        $user = Auth::user();

        if($user) {

            $isExsist = Favorite::where('product_id',$request->product_id)->where('user_id',$user->id)->exists();
            
            if($isExsist) {
                return response()->json(['already exists']);
            }

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

    public function removeFavourite(Request $request) {

        $user = Auth::user();
        if($user) {
            $fav = Favorite::where('product_id',$request->product_id)->where('user_id',$user->id);
            $fav->delete();

            return response()->json([
                'message' => 'product removed from favourite successfully',
            ]);
        }
        else {
            return response()->json(['message' => 'you have to login/signup again']);
        }
    }

    public function showFav() {
        $user = Auth::user();
        if($user) {
            $favs = Favorite::where('user_id', $user->id)->pluck('product_id')->all();

            $products  = Product::whereIn('id',$favs)->get();

            return response()->json(['data'=>$products]);     
            
        }
        else {
            return response()->json(['message' => 'you have to login/signup again']);
        }
    }
}
