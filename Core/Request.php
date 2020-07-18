<?php 

namespace Core;

class Request{
	public $parameters ;

	public function __construct()
    {
        $this->parameters = $_GET;
    }

	
}