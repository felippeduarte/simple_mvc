<?php
session_start();

//autoload
include('autoload.php');

//exibe erros
error_reporting(E_ALL);

//carrega o template
$template = Framework\Template::getInstance();

//carrega o frontController
$frontController = new Framework\FrontController($template);
$frontController->setPath(dirname(__FILE__) . '/App/Controller');

//carrega o action
$frontController->loadAction();