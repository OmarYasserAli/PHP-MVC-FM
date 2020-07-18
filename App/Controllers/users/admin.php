<?php


namespace App\Controllers\users;
use \Core\Controller;
use \Core\Request;
class admin extends Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function index()
    {
       

        echo 'Hello from the index action in the admin controller!';
    }

    /**
     * Show the add new page
     *
     * @return void
     */
    public function new()
    {
         
    	// print_r(htmlentities($_GET['s'],true));
    	
        echo 'Hello from the new action in the admin controller!';
    }

    public function edit(Request $request , $id, $user)
    {

    	echo "<br> Edit Function admin Controller ". $id; 
        // print_r($request->parameters);

    }
}
