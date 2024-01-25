<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


     /*
        Create a middleware to ensure only authenticated users can 
        access certain routes.
     */


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();
        return view('show_products',compact('products'));
    }

    public function create(){
        return view('create_product');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'price'=>'required|numeric',
            'quantity'=>'required|numeric',
            'category'=>'required|numeric'

         ]);

         $product = new Product;
         $product->name = $request->name;
         $product->category_id = $request->category;
         $product->price = $request->price;
         $product->quantity = $request->quantity;
         $product->save();

    }

    /* 
    Implement a route parameter and retrieve its value in the 
    controller
    */

    public function edit_product($id , User $user){
        //authorize that only admin user can open edit form
        $this->authorize('update_product', $user);
        $product = Product::find($id);
        return view('edit_product',compact('product'));
    }

    
   


    public function upload(Request $request , $id){
        $this->validate($request,[
            'name'=>'required',
            'price'=>'required|numeric',
            'quantity'=>'required|numeric',
            'category'=>'required|numeric'

         ]);

         
         $product = Product::find($id);
         $product->name = $request->name;
         $product->category_id = $request->category;
         $product->price = $request->price;
         $product->quantity = $request->quantity;
         $product->save();

         return redirect()->route('show_products');
    }


    public function destroy($id , User $user){
        //authorize that admin only can delete product
       if($this->authorize('delete_product', $user)){
        $product = Product::find($id);
        $product->delete();
       }else {
        return response()->json('message','Unauthorized User');
       }
        
    }


    public function filter(){
        return view('filter');
    }

    /*
    Implement a query to fetch all products with a price greater 
    than a specified amount.
    */

    public function search(Request $request){
        $this->validate($request,[
            'price'=>'required|numeric'
         ]);

         $products = Product::where('price','>',$request->price)->orderBy('price','desc')->get();
         return view('search',compact('products'));

    }


    public function checkout($id){
        $product = Product::find($id);
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        $session = $stripe->checkout->sessions->create([
            'line_items' => [[
              'price_data' => [
                'currency' => 'egp',
                'product_data' => [
                  'name' => $product->name,
                ],
                'unit_amount' => $product->price * 100,  //we've to specify price in cents
              ],
              'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success' , [] , true)."?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('checkout.cancel' , [] , true),
          ]);

          $order = new Order;
          $order->status = 'unpaid';
          $order->user_id = Auth::id();
          $order->price = $product->price;
          $order->session_id = $session->id;
          $order->save();

          return redirect($session->url);

    }

    public function success(Request $request){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        $sessionId = $request->get('session_id');
        $session = $stripe->checkout->sessions->retrieve($_GET['session_id']);
        if (!$session) {
            throw new NotFoundHttpException;
        }
        $order = Order::where('session_id','=',$session->id)->first();
        if ($order) {
            $order->status = 'paid';
            $order->save();
        }else {
            throw new NotFoundHttpException;
        }
        return view('checkout_success');
    }

    public function cancel(){
        return redirect()->back();
    }

    public function webhook(){
        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET'); 

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
        $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $endpoint_secret
        );
        } catch(\UnexpectedValueException $e) {
        return response('' , 400);
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            return response('' , 400);
        }

        // Handle the event
        switch ($event->type) {
        case 'checkout.session.completed':
            $session = $event->data->object;
            $sessionId = $session->id;
            $order = Order::where('session_id','=',$sessionId)->first();
            if ($order && $order->status == 'unpaid') {
                $order->status = 'paid';
                $order->save();
            }
        // ... handle other event types
        default:
            echo 'Received unknown event type ' . $event->type;
        }

        return response('');
    }

}

