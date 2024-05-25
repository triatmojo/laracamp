<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\User\Checkout\Store;
use Midtrans;

use App\Mail\Checkout\AfterCheckout;
use App\Models\Checkout;
use App\Models\Camp;



class CheckoutController extends Controller
{

    public function __construct()
    {
        Midtrans\Config::$serverKey = env('MIDTRANS_SERVERKEY');
        Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Camp $camp, Request $request)
    { 
        if($camp->isRegistered) {
            $request->session()->flash('error', "You already on {$camp->title} camp.");
            return redirect()->route('user.dashboard');
        }
        return view('checkout.create', [
            'camp' => $camp
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request, Camp $camp)
    {

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['camp_id'] = $camp->id;

        // update user data
        $user = Auth::user();
        $user['email'] = $data['email'];
        $user['name'] = $data['name'];
        $user['occupation'] = $data['occupation'];
        $user->save();

        // create checkout
        $checkout = Checkout::create($data);
        $this->getSnapRedirect($checkout);

        // send email
        Mail::to(Auth::user()->email)->send(new AfterCheckout($checkout));

        return redirect()->route('checkout.success');
    }

    /**
     * Display the specified resource.
     */
    public function show(checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(checkout $checkout)
    {
        //
    }

    public function success()
    {
        return view('checkout.success');
    }

    /**
     * Midtrans Handler
     */

     public function getSnapRedirect(Checkout $checkout)
     {
        $orderId = $checkout->id.'-'.Str::random(5);
        $price = $checkout->Camp->price * 1000;
        $checkout->midtrans_booking = $orderId;
        
        $transaction_detail = [
            "order_id" => $orderId,
            "gross_amount" => $price
        ];

        $item_details[] = [
            "id" => $orderId,
            "price" => $price,
            "quantity" => 1,
            "name" => "Payment for {$checkout->Camp->title} Camp"
        ];

        $userData = [
            "first_name" => $checkout->User->name,
            "last_name" => "",
            "address" => $checkout->User->address,
            "city" => "",
            "postal_code" => "",
            "phone" => $checkout->User->phone,
            "country_code" => "IDN",
        ];

        $customer_detail = [
            "first_name" => $checkout->User->name,
            "last_name" => "",
            "email" => $checkout->User->email,
            "phone" => $checkout->User->phone,
            "billing_address" => $userData,
            "shipping_address" => $userData
        ];

        $midtrans_param = [
            "transaction_detail" => $transaction_detail,
            "item_details" => $item_details,
            "customer_detail" => $customer_detail
        ];

        try {
            //Get Snap Payment Page
            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url();
            $checkout->midtrans_url = $paymentUrl;
            $checkout->save();

            return $paymentUrl;
        } catch (Exception $e) {
            return false;
        }
     }

}
