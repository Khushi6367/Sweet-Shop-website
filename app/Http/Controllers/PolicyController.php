<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function privacyPolicy()
    {
        return view('policy.privacypolicy');
    }

    public function shippingPolicy()
    {
        return view('policy.shippingpolicy');
    }

    public function returnrefundPolicy()
    {
        return view('policy.returnrefundpolicy');
    }

    public function termsConditions()
    {
        return view('policy.termsconditions');
    }
}
