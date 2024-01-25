<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $products = Product::orderBy('created_at','DESC')->get();
        if (count($products) == 0) {
            return response()->json([
                'success'=>false,
                'message'=>"No products found",
                'data'=>null,
            ],404);
        }
        return response()->json([
                'success'=>true,
                'message'=>"",
                'data'=>$products,
        ],200);
        
         
    }


   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
             'name' => ['required','max:255'], 
             'price'=>['required','numeric','min:0'],
             'quantity'=>['required','integer','min:0'],
             'category_id'=>['required'],  
            ]);

         if ($validator->fails()) {
            return response()->json([
                'success'=>false,
                'message'=>"There exist one or more errors",
                'data'=>$validator->messages(),
            ],400);
        }

        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->save();

        return response()->json([
            'success'=>true,
            'message'=>"Product added successfully",
            'data'=>$product,
        ],201);

    }
}
