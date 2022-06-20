<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontPagesController extends Controller
{
    //

    public function homepage()
    {
        return view('front.pages.home');
    }
    public function aboutpage()
    {
        return view('front.pages.about');
    }
    public function servicespage()
    {
        return view('front.pages.services');
    }
    public function term_of_servicepage()
    {
        return view('front.pages.term_of_service');
    }
    public function privacy_policypage()
    {
        return view('front.pages.privacy_policy');
    }
}
