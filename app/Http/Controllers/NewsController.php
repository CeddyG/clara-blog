<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('abricot/main');
    }


    public function show()
    {
        return view('abricot/news/show');
    }
}
