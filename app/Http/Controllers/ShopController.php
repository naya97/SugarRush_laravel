<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class ShopController extends Controller
{
    public function showShops(){
        if(Auth::user()){
        $shops = Shop::get()->all();
        return response()->json([
            'message' =>'All shops',
            'data' =>$shops,
        ]);
        }else {
            return response()->json(['message' => 'you have to login/signup again']);
        }
    }

    public function showShopDetails(Request $request){
        if(Auth::user()){
            $shop = Shop::find($request->id);
            return response()->json([
                'data'=>$shop,
            ]);
        }else {
            return response()->json(['message' => 'you have to login/signup again']);
        }
    
    }

    public function searchShop(Request $request)
    {
        if(Auth::user()) {
            $results = Shop::search(($request->name))->get();

            if($results->isEmpty()) {
                return response()->json([
                    'message' => 'not found'
                ]);
            }

            return response()->json([
                'message'=>'shop found successfully',
                'data'=>$results,
            ]); 
            
        }
        else {
            return response()->json(['message' => 'you have to login/signup again']);
        }
    }
}
