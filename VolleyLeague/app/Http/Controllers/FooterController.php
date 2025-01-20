<?php

namespace App\Http\Controllers;

class FooterController extends Controller
{
    public function home()
    {
        return redirect()->route('leagues.index')
            ->with('success', 'League updated successfully.');
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
