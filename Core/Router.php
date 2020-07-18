<?php
// use App\Controllers;
namespace core;

class Router{
	   /**
     * Associative array of routes (the routing table)
     * @var array
     */
    protected $routes = [];
    protected $params = [];
    /**
     * Add a route to the routing table
     *
     * @param string $route  The route URL
     * @param array  $params Parameters (controller, action, etc.)
     *
     * @return void
     */
    public function add($route, $params=[])
    {

        // $this->routes[$route] = $params;

         $route = preg_replace('/\//', '\\/', $route);

        // Convert variables e.g. {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // Convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';
         // print("this is test ". $route);

        $this->routes[$route] = $params;
    }

    public function dispatch($url){
         $url = strtok($url, "&");
         // echo $url;
        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = "App\Controllers\\$controller";

            if (class_exists($controller)) {
                $controller_object= new $controller();
                if (array_key_exists("action", $this->params))
                  $action = $this->params['action'];
                else
                  $action = "index";


                if (is_callable([$controller_object , $action])) {

                     $fireParams = [];
                     $r = new \ReflectionMethod($controller_object, $action);
                     $functionParams = $r->getParameters();
                     foreach ($functionParams as $param  ) {
                       $paramName = $param->getName();
                       $type =  strval( $param->getType());
                       if ($param->hasType() and class_exists($type)){
                        
                         $re   =  new $type;
                         $fireParams[ $paramName] = $re;
                       }else{
                            if(array_key_exists($paramName, $this->params))
                                $fireParams[ $paramName] = $this->params[$paramName];
                            else
                                {
                                    if ($param->isOptional());
                                    else 
                                         die (" Erorr {$paramName}  in missing ");

                                }
                       }
                     }

                     
                     call_user_func_array(array($controller_object, $action), $fireParams);

                    // $controller_object->$action();
                }else{
                    print "Error {$action} in controller {$controller} not Found";
                }

            }else{
                print "Error class {$controller} Not Found" ;
            }
        }
        else{
            print "Error 404 Not Found";
        }
    }

  	public function match($url){
  		// foreach ($this->routes as $route => $param) {
  		// 	if ($url == $route) {
  		// 		$this->params = $param;
  		// 		return true;
  		// 	}
  		// } 
  		// Match to the fixed URL format /controller/action
        // $reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";

     foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                // Get named capture group values
                //$params = [];

                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;
                return true;
            }
        }

        return false;

  	}
    public function getRoutes()
    {
        return $this->routes;
    }
    public function getParams()
    {
        return $this->params;
    }
}