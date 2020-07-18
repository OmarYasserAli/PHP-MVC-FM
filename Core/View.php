<?php

namespace Core;

class View{



	public static function render($view,$args=[]){
		$file = "../App/views/$view";
		if(is_readable($file))
			{
				extract($args, EXTR_SKIP);
				require $file;
				return false;
			}
		else 
			echo "$view  is not Found";
	}
}