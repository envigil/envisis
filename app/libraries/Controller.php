<?php
/*
*Base controller 
*Loads models and views.
*/

class Controller
{
    //load model
    public function model($model)
    {
        // reuire model file

        require_once '../app/models/' . $model . '.php';

        //instantiate model
        return new $model();
    }

    //load view
    public function view($view, $data = [])
    {
        //check for view file

        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            //view does not exists
            die('view does not exists');
        }
    }
}
