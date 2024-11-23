<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('auth/login');
        // $data['content'] = 'content'; 
        // return view('template', $data);
    }
    
}
