<?php
//versie 1.0 Team ao 13-9-2016
include "smoelenboek/config.php";

function __autoload($className) {
    $class = str_replace('\\',DIRECTORY_SEPARATOR,$className);
    $file = "$class.php";
    @include $file;
}

// $control = filter_input(INPUT_GET,'control');
//
// if($control === NULL){
//     $control='bezoeker';
// }

$control = !empty(filter_input(INPUT_GET, 'control')) ? filter_input(INPUT_GET, 'control') : 'bezoeker';


$action = filter_input(INPUT_GET, 'action');

if($action === NULL) {
    $action = 'default';
}

$controllerName = 'smoelenboek\controllers'.'\\'.ucfirst($control).'Controller';

if(class_exists($controllerName)) {
    $myControl = new $controllerName($control, $action);
    $myControl->execute();
} else {
    $myControl= new smoelenboek\controllers\BezoekerController('bezoeker','default','Er is iets mis gegegaan, de door jou gebruikte url wordt niet begrepen');
    $myControl->execute();
}
