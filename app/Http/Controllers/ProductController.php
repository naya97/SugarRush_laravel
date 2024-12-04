<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class ProductController extends Controller
{
    public function showProducts(Request $request) {
        
        $user = Auth::user();
        if(!$user) {

            return response()->json(['message' => 'you have to login/signup again']);
        }

        $products = Shop::find($request->id)->products;

        $response = [];
        foreach($products as $product)
        {
            $response [] = [
                'id' => $product->id ,
                'name' => $product->name ,
                'description' => $product->description ,
                'image' =>  $product->image,
                'price' =>  $product->price,
                'totalQuantity' =>  $product->totalQuantity,
                'shop_id' =>  $product->shop_id,
            ];
        }

        return response()->json($response,200);
    }

    public function isFav($user,$id) {
        $fav = Favorite::where('user_id', $user->id)->where('product_id',$id)->get();

        if($fav->isEmpty()) {
            return false;
        }
        else {
            return true;
        }

    }

    public function showProductDetails(Request $request){
        $user = Auth::user();
        if(!$user){
          return response()->json(['message' => 'you have to login/signup again']);
        }
        $product = Product::find($request->id);

        return response()->json([$product,$this->isFav($user,$request->id)],200);
    }

    public function searchProduct(Request $request)
    {
        $user = Auth::user();
        if(!$user) {
            return response()->json(['message' => 'you have to login/signup again']);
        }
        $products = Product::search(($request->name))->get();

        $results = $products->where('shop_id',$request->id);
    
        if($results->isEmpty()) {

            return response()->json([
                'message' => 'not found'
            ]);                
        }

        $response = [];
        foreach($results as $result) {
            $response [] = [
                'id' => $result->id ,
                'name' => $result->name ,
                'description' => $result->description ,
                'image' =>  $result->image,
                'price' =>  $result->price,
                'totalQuantity' =>  $result->totalQuantity,
                'shop_id' =>  $result->shop_id,
            ];
        }

        return response()->json($response,200);
        
    }
}
