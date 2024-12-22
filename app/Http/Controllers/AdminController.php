<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shop;
use App\Notifications\OrderStatusNotification;
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
            'image' => ('/storage/images/shops/'.$originalName),
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
            'image' => ('/storage/images/products/'.$originalName),
            'price'=>$request->price,
            'totalQuantity'=>$request->totalQuantity,
        ]);
        return response()->json($product,200);
    }

    public function showOrders() {
        $user = Auth::user();
        if(!$user) {
            return response()->json(['message' => 'you have to login/signup again']);
        }
        if($user->role ==false){
            return response()->json('You do not have permission in this page',400);
        }

        $orders = Order::where('cart',false)->get();
        $response=[];
        foreach($orders as $order){
            $childRegionId = $order->address_id;
            $childRegion = Address::where('id',$childRegionId)->first();
            $parentRegion = Address::where('id',$childRegion->parent_id)->first();
            $response [] = [
                'user_id' => $order->user_id,
                'Governorate'=>$parentRegion->region,
                'address'=>$childRegion->region,
                'orderLocation' => $order->orderLocation ,
                'totalPrice' => $order->totalPrice ,
                'status' => $order->status
            ];
            
        }
        return response()->json($response,200);
    }

    public function updateStatus(Request $request) {
        $user = Auth::user();
        if(!$user) {
            return response()->json(['message' => 'you have to login/signup again']);
        }
        if($user->role ==false){
            return response()->json('You do not have permission in this page',400);
        }

        $order = Order::where('id',$request->order_id)->first();
        $order->status = $request->status;
        $order->save();

        $order->user->notify(new OrderStatusNotification($order));

        // return response()->json(['order status updated successfully',200]);
        return response()->json([$order,200]);
    }
}
