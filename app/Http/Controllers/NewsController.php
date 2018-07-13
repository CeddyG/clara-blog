<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('abricot/news/index');
    }


    public function show()
    {
        return view('abricot/news/show');
    }
}
