<?php

namespace Applications\FrontEnd\Error;

final class Controller
{
    final public function __construct () {}
    
    final public function Index($args)
    {
    	new View($args);
    }
}

?>