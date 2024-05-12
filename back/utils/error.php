<?php
    function error_invalid_argument(string $method, string $type, string $given, int $argument = 1){
        $message = \sprintf('Argument %d passed to %s() must be of the type %s, %s given', $argument, $method, $type, $given);
        return new Error($message);
    }
    function error_empty_name(){
        return new Error('EMPTY NAME');
    }
?>