<?php

class Pages extends Controller {
    public function __construct()
    {
        $this->postsModel = $this->model('Posts');
    }

    public function index(){

        $posts = $this->postsModel->getPosts();

        $data =  [
            'title' => 'Home Page',
            'posts' => $posts,
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