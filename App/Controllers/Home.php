<?php


namespace App\Controllers;
use \Core\Controller;
use \Core\Request;
use \Core\view;
class Home extends Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function index()
    {   
        return View::render('Home/index.php',["name"=>"omar"]);
       
    }

    /**
     * Show the add new page
     *
     * @return void
     */
    public function new()
    {

    	// print_r(htmlentities($_GET['s'],true));
    	
        echo 'Hello from the new action in the Home controller!';
    }

    public function edit(Request $request , $id, $user)
    {
    	echo "<br> Edit Function Home Controller ". $id; 
        // print_r($request->parameters);

    }
}

