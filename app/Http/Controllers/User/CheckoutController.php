<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\Checkout\Store;
use App\Mail\Checkout\AfterCheckout;
use App\Models\Checkout;
use App\Models\Camp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
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

}
