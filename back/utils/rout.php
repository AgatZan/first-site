<?php
    function template_pattern($guess_param){
        return join( ' '
					, array_map(
						fn($x)=>match(true){
							is_numeric($x) => '_',
							(bool)$x=> $x
						}
					, $guess_param
					)
	);
    }
    /**
    * CONTROLLER NAMING PATTERN ' ' <-> path_separ || _ <-> /\d+ 
    * @param string $root path to controler
    * @param string $method HTTP method
    * @param string $guess $SERVER['REQUEST_URI']
    * @param string $err path to base error
    * @return requrire path/to/controller
    */
    function rout_recieve_auto_mult($root, $method, $guess, $err){
        if(is_file(realpath("$root/{$method}{$guess}.php")))
            return require realpath("$root/{$method}{$guess}.php");
        $guess_param = explode('/', $guess);
        array_shift($guess_param);
        $guess = array_shift($guess_param);
        if(! is_dir(realpath("$root/{$method}/$guess")))
            return include $err;
        $name = template_pattern($guess_param);
        $name = realpath("$root/{$method}/$guess/{$name}.php");
        if($name === false){
            $name = realpath("$root/{$method}/$guess/*.php");
			return $name === false ? include $err: require $name;
        }
        return require $name;
    }
    function rout_recieve_auto_single($root, $method, $guess, $err){
        if(is_file(realpath("$root/{$method}{$guess}.php"))) return require realpath("$root/{$method}{$guess}.php");
        $guess_param = explode('/', $guess);
        array_shift($guess_param);
        if(! is_dir(realpath("$root/{$method}"))) return include $err;
        $guess = template_pattern($guess_param);
        $guess = realpath("$root/{$method}/$guess.php");
		return $guess === false ? include $err : require $guess;
    }
    
