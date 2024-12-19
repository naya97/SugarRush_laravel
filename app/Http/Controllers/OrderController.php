<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function makeOrder(){
        $user = Auth::user();
        if(!$user) {

            return response()->json(['message' => 'you have to login/signup again']);
        }
        $order = Order::where('user_id',$user->id)->where('cart',true);
        if($order->exists()){
            return response()->json('you have to complete your order first');
        }
        $order = Order::create([
            'user_id'=> $user->id,
            'cart'=>true,
        ]);
        return response($order->id,200);
    }

    public function addToCart(Request $request){
        $user = Auth::user();
        if(!$user) {

            return response()->json(['message' => 'you have to login/signup again']);
        }
        $validator = Validator::make($request->all(), [
            'quantity' =>'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $order = Order::where('user_id',$user->id)->where('cart',true)->first();
        if(!$order){
            return response()->json('you have to make an order first',400);
        }
        $productDetails = ProductDetails::where('order_id',$order->id)->where('product_id',$request->product_id);
        if($productDetails->exists()){
            return $this->editCart($request);
        }
        $product = Product::query()->find($request->product_id);
        if($request->quantity >$product->totalQuantity){
            return response()->json('Quantity not available',400);
        }
        
        $product->update([
            'totalQuantity'=>($product->totalQuantity) -($request->quantity),
        ]);

        $productPrice = $product->price;
        $price =( $request->quantity) * $productPrice;
        $productDetails = ProductDetails::create([
            'product_id'=>$request->product_id,
            'order_id'=>$order->id,
            'quantity'=>$request->quantity,
            'totalPrice'=>$price,
        ]);

        return response()->json($productDetails,200);
    }

    public function showCart(){
        $user = Auth::user();
        if(!$user) {

            return response()->json(['message' => 'you have to login/signup again']);
        }
        $order = Order::where('user_id',$user->id)->where('cart',true)->first();
        if(!$order){
            return response()->json('make an order',400);
        }
        $productsDetails = ProductDetails::where('order_id', $order->id)->get();
        $productIds = $productsDetails->pluck('product_id')->all();
        $products  = Product::whereIn('id',$productIds)->get();
        $size = count($products);
        $response = [] ;
        for($i=0;$i<$size;$i++) {
            $response [] =[
                'product_id'=> $products[$i]->id,
                'name' => $products[$i]->name,
                'image' => $products[$i]->image,
                'price' => $products[$i]->price,
                'quantity' => $productsDetails[$i]->quantity,
            ];
        }
        return response()->json($response,200);
    }

    public function removeFromCart(Request $request) {
        $user = Auth::user();
        if(!$user) {
            return response()->json(['message' => 'you have to login/signup again']);
        }
        $order = Order::where('user_id',$user->id)->where('cart',true)->first();
        $productDetails = ProductDetails::where('order_id',$order->id)->where('product_id',$request->product_id)->first();
        $product = Product::where('id',$request->product_id)->first();
        $product->update([
            'totalQuantity'=>($product->totalQuantity) +($productDetails->quantity),
        ]);

        $productDetails->delete();
       

        return response()->json('removed successfully',200);
    }


    public function editCart(Request $request){
        $user = Auth::user();
        if(!$user) {
            return response()->json(['message' => 'you have to login/signup again']);
        }
        $validator = Validator::make($request->all(), [
            'quantity' =>'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $order = Order::where('user_id',$user->id)->where('cart',true)->first();
        $productDetails = ProductDetails::where('order_id',$order->id)->where('product_id',$request->product_id)->first();
        $product = Product::find($request->product_id);
        if($request->quantity >$product->totalQuantity){
            return response()->json('Quantity not available',400);
        }

        $newQuantity =  ($request->quantity) - ($productDetails->quantity);
        $product->update([
            'totalQuantity' => ($product->totalQuantity) - ($newQuantity)
        ]);

        $productPrice = $product->price;
        $newPrice =( $request->quantity) * $productPrice;
        $productDetails->update([
            'quantity'=>$request->quantity,
            'totalPrice'=>$newPrice,
        ]);
        return response()->json('updated successfully',200);
    }

    public function order(Request $request){
        $user = Auth::user();
        if(!$user) {

            return response()->json(['message' => 'you have to login/signup again']);
        }
        $validator = Validator::make($request->all(), [
            'parentRegion' => 'required',
            'childRegion' => 'required',
            'orderLocation' => 'required',
            'bankAccount' => 'required|string|size:5',
        ]);
        
        
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $parent= $request->parentRegion;
        if($parent == 1){
            $deliveryPrice = 10000;
        }
        if($parent == 2){
            $deliveryPrice = 40000;
        }
        if($parent == 3){
            $deliveryPrice = 25000;
        }
        
        $order = Order::where('user_id',$user->id)->where('cart',true)->first();
        $orderPrice =0;
        $productsDetails = ProductDetails::where('order_id', $order->id)->get();
        $productsTotalPrice = $productsDetails->pluck('totalPrice')->all();
        foreach($productsTotalPrice as $productTotalPrice) {
            $orderPrice += $productTotalPrice;
        }

        $totalPrice = $deliveryPrice +$orderPrice;
        
        $order->update([
            'address_id'=>$request->childRegion,
            'cart'=>false,
            'orderLocation'=>$request->orderLocation,
            'orderPrice'=>$orderPrice,
            'deliveryPrice'=>$deliveryPrice,
            'totalPrice'=>$totalPrice,
            'bankAccount'=>$request->bankAccount,
        ]);

        // $productsDetailsIds = $productsDetails->pluck('product_id')->all();
        // $products = Product::whereIn('id',$productsDetailsIds)->get();
        // $productsTotalQuantity = $products->pluck('totalQuantity')->all();
        // $size = count($products);
        // for($i=0;$i<$size;$i++) {
        //    $products[$i]->update([
        //         'totalQuantity' => ($productsTotalQuantity[$i]) - ($productsDetails[$i]->quantity)
        //    ]);
        // }

        return response()->json($order,200);
    }

    public function showOrders() {
        $user = Auth::user();
        if(!$user) {

            return response()->json(['message' => 'you have to login/signup again']);
        }
        $orders = Order::where('user_id',$user->id)->where('cart',false)->get();
        $response=[];
        foreach($orders as $order){
            $childRegionId = $order->address_id;
            $childRegion = Address::where('id',$childRegionId)->first();
            $parentRegion = Address::where('id',$childRegion->parent_id)->first();
            $response [] = [
                'Governorate'=>$parentRegion->region,
                'address'=>$childRegion->region,
                'orderLocation' => $order->orderLocation ,
                'totalPrice' => $order->totalPrice ,
            ];
            
        }
        return response()->json($response,200);
    }

    public function showOrderDetails(Request $request) {
        $user = Auth::user();
        if(!$user) {

            return response()->json(['message' => 'you have to login/signup again']);
        }

        $productsDetails = ProductDetails::where('order_id', $request->order_id)->get();
        $productIds = $productsDetails->pluck('product_id')->all();
        $products  = Product::whereIn('id',$productIds)->get();
        $size = count($products);
        $response = [] ;
        for($i=0;$i<$size;$i++) {
            $response [] =[
                'product_id'=> $products[$i]->id,
                'name' => $products[$i]->name,
                'image' => $products[$i]->image,
                'price' => $products[$i]->price,
                'quantity' => $productsDetails[$i]->quantity,
                'totalPrice' => $productsDetails[$i]->totalPrice,
            ];
        }
        return response()->json($response,200);

    }
}
