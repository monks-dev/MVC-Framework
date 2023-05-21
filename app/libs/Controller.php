<?php

/**
 * Base Controller
 * Loads the models and views
 */

class Controller {

    // Load Model
    public function model($model) {
        // Requires Model File
        require_once '../app/models/' . $model . '.php';

        // Instantiate Model
        return new $model();
    }

    // Load View
    public function view($view, $data = []) {
        // Check for view File
        if(file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            // View does not exist
            die('View does not exist');
        }
    }
}