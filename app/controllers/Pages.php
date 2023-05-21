<?php

class Pages extends Controller {
    public function __construct()
    {

    }

    public function index(){
        $data =  [
            'title' => 'Home Page',
        ];

        $this->view('Pages/index', $data);
    }

    public function about(){
        $data =  [
            'title' => 'About Page',
        ];
        $this->view('Pages/about', $data);
    }

}