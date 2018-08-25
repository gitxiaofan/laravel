<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(Request $request,$id=0)
    {
        $page_id = $id ? intval($id) : 0;
        return view('home.index',[
            'page_id' => $page_id,
        ]);
    }

    public function show()
    {
        return view('home.show');
    }

    public function role()
    {
        return view('home.role');
    }
}