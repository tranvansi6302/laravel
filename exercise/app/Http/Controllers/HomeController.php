<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class HomeController extends Controller
{
    private $data;
    public function __construct()
    {
        $this->data = [];
    }
    public function index()
    {

        $this->data['title'] = 'Welcome';
        return view('home.welcome', $this->data);
    }
}
