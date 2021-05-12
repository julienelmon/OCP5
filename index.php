<?php

require 'vendor/autoload.php';

if(empty($_GET['url']))
{
    $_GET['url'] = '/';
}

$router = new \OCP5\Route\Router($_GET['url']);
/*
try
{
*/
    $router->get('/login', 'User#loginView');
    $router->post('/connect', 'User#connectUser');
    $router->get('/user', 'User#interfaceUser');
    $router->get('/deco', 'User#disconnect');
    $router->get('/subscribe', 'User#subscribe');
    $router->post('/subs', 'User#subs');
    $router->get('/settingaccount', 'User#settingAccount');
    $router->post('/settingset', 'User#settingSet');
    $router->get('/listpost', 'User#getlistPost');
    $router->get('/listpost/addpost', 'User#addPost');
    $router->post('/listpost/addpost/addPostcreate', 'User#addPostcreate');

    $router->get('/', 'User#homeView');

    $router->run();
/*
}
catch(\Exception $e)
{
    $errorMessage = $e->getMessage();
    $_SESSION['errorMessage'] = $errorMessage;
    header('HTTP/1.1 404 Not Found');
    header('Location: /404');
}
*/

?>