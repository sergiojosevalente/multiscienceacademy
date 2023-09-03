<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return redirect()->to(base_url('/auth'));
    }
    public function fn_home()
    {
        $footer = $this->footer();
        $data = [
            'footer' => "$footer",
            'title' => 'Home',
        ];
        echo view('layout/header', $data);
        echo view('layout/sidenavbar');
        echo view('home/home');
        echo view('layout/footer');
    }
}
