<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{
    public function showProducts(Request $request) {
        
        if(Auth::user()) {

            //$products = Product::query()->where('shop_id',$request->id)->get();

            $products = Shop::find($request->id)->products;

            return response()->json([
                'message' => 'All Products',
                'Products' => $products
            ]);
        }else {
            return response()->json(['message' => 'you have to login/signup again']);
        }
        
    }

    public function showProductDetails(Request $request){
        if(Auth::user()){
        $product = Product::find($request->id);
        return response()->json([
            'data'=>$product,
        ]);
        }else {
        return response()->json(['message' => 'you have to login/signup again']);
        }
    }

    public function searchProduct(Request $request)
    {
        if(Auth::user()) {
            $products = Product::search(($request->name))->get();

            $results = $products->where('shop_id',$request->id);
        
            if($results->isEmpty()) {

                return response()->json([
                    'message' => 'not found'
                ]);
                
            }
            return response()->json([
                'message'=>'product found successfully',
                'data'=>$results,
            ]); 
    
        }
        else {
            return response()->json(['message' => 'you have to login/signup again']);
        }
    }
}
