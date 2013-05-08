<?php

namespace Applications\BackEnd\Error;

final class Controller
{
    final public function __construct () {}
    
    final public function Index($args)
    {
    	new View($args);
    }
}