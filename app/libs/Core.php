<?php

/**
 * App Core Class
 *
 * Creates URL and Loads core controller
 * URL Format - (/controller/method/params)
 *
 */

class Core {

    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $parameters = [];

    public function __construct() {
        //print_r($this->getURL());

        $url = $this->getURL();

        // Look in controllers for first value
        // Example.. MVC-Framework/post -> ../app/controllers/Posts.php
        if(isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            // If file exists, set as current controller
            $this->currentController = ucwords($url[0]);
            // Unset the 0 index
            unset($url[0]);
        }

        // Require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';
        // Instantiate Controller class
        $this->currentController = new $this->currentController;

        // Check for the methods in the URL
        if(isset($url[1])) {
            // Check for method exists in Controller
            if(method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                // Unset the 1 index
                unset($url[1]);
            }
        }

       // Gets the Parameters in the URL
        $this->parameters = $url ? array_values($url) : [];

        // Call a callback with array of parameters
        call_user_func_array([$this->currentController, $this->currentMethod], $this->parameters);
    }

    public function getURL() {
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }

}