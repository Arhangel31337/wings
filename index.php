<?php
//phpinfo();exit();
require $_SERVER['DOCUMENT_ROOT'] . '/Wings/Wings.php';

$wings = new Wings();

$wings->start();

$wings->view();