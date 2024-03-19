<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard()
    {
        $checkout = Checkout::with('camp')->whereUserId(Auth::id())->get(); 
        return view('user.dashboard', [
            'checkouts' => $checkout
        ]);
    }
}
