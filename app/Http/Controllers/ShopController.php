<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class ShopController extends Controller
{
    public function showShops(){
        
        $user = Auth::user();
        if(!$user)
        {
            return response()->json(['message' => "you have to login/signup again"]);
        }
        $shops = Shop::query()->get(); 
        $response = [];
        foreach($shops as $shop)
        {
            $response [] = [
                'id' => $shop->id ,
                'name' => $shop->name ,
                'description' => $shop->description ,
                'location' => $shop->location ,
                'image' =>  $shop->image,
            ];
        }
        return response()->json($response , 200);
    }

    public function showShopDetails(Request $request){
       $user = Auth::user();
        if(!$user){
            return response()->json(['message' => 'you have to login/signup again']);
        }
        $shop = Shop::find($request->id);

        return response()->json($shop, 200);
    }

    public function searchShop(Request $request)
    {
        $user = Auth::user();
        if(!$user) {
            return response()->json(['message' => 'you have to login/signup again']);
        }

        $results = Shop::search(($request->name))->get();
        if($results->isEmpty()) {
            return response()->json(['message' => 'Not Found']);
        }
        
        return response()->json($results,200);
            
    }
}
