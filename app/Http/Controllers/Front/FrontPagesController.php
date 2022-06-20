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
    public function contactpage()
    {
        return view('front.pages.contact');
    }
    public function servicespage()
    {
        return view('front.pages.services');
    }
}
