<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Dashboard',
            'menu_active' => 'dashboard'
        ];
        return view('Admin/Dashboard', $data);
    }
}