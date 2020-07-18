<?php

namespace App\Controllers;
/**
 * Posts controller
 *
 * PHP version 5.4
 */
use \Core\Controller;
use \Core\view;
class Posts extends Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function index()
    {
       return View::render('Home/index.php');
    }

    /**
     * Show the add new page
     *
     * @return void
     */
    public function new($id)
    {
        echo 'Hello from the addNew action in the Posts controller!';
    }
}
