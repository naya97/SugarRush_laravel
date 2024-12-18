<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function addShop(Request $request) {
        $user = Auth::user();
        if(!$user) {
            return response()->json(['message' => 'you have to login/signup again']);
        }
        if($user->role == false) {
            return response()->json('You do not have permission in this page',400);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'description' => 'required|string|between:2,100',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'location' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $originalName = $request->image->getClientOriginalName();
        $path = $request->image->storeAs('images/shops', $originalName, 'public');

        $shop = Shop::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => ('/storage/images/shops'.$originalName),
            'location' => $request->location,
        ]);

        return response()->json($shop,200);
    }

    public function addProduct(Request $request){
        $user = Auth::user();
        if(!$user) {
            return response()->json(['message' => 'you have to login/signup again']);
        }
        if($user->role ==false){
            return response()->json('You do not have permission in this page',400);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'description' => 'required|string|between:2,100',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'price'=>'required|numeric',
            'totalQuantity'=>'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $originalName = $request->image->getClientOriginalName();
        $path = $request->image->storeAs('images/products', $originalName, 'public');

        $product = Product::create([
            'shop_id' => $request->shop_id,
            'name' => $request->name,
            'description' => $request->description,
            'image' => ('/storage/images/products'.$originalName),
            'price'=>$request->price,
            'totalQuantity'=>$request->totalQuantity,
        ]);
        return response()->json($product,200);
    }
}
