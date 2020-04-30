<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function show(){
        return view('welcome')->with('products', Product::all());
    }
}
