<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function show()
    {
        return view('auth.disclaimer');
    }

    public function legal()
    {
        return view('footer.legal');
    }

    public function about_us()
    {
        return view('footer.about-us');
    }

    public function contact()
    {
        return view('footer.contact');
    }
}
