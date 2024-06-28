<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FooterController extends Controller
{
    
    
    function home(){
		return redirect()->route('leagues.index')
		  ->with('success', 'League updated successfully.');
	}
    
    function legal(){
		return view('footer.legal');
	}
    
    function about_us(){
		return view('footer.about-us');
	}
    
    function contact(){
		return view('footer.contact');
	}
    
}
