<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function index()
    {
        $categories = Category::all(); // get all categories
        return view('home', compact('categories')); // or your main view with navbar
    }
}
