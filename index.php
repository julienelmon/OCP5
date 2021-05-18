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
    $router->get('/article-:id', 'User#viewPost')->with('id', '[0-9]+');
    $router->post('/addcomment-:id', 'User#addComment')->with('id', '[0-9]+');
    $router->get('/admin', 'User#interfaceAdmin');

    $router->get('/admin/editpost', 'Admin#editPost');
    $router->post('/admin/editpost/admindeletepost', 'Admin#deletePost');
    $router->get('/admin/editcomment', 'Admin#editComment');
    $router->post('/admin/editcomment/setvalidcomment', 'Admin#setValidComment');
    $router->get('/admin/editaccount', 'Admin#editAccount');
    $router->post('/admin/editaccount/deleteaccount', 'Admin#deleteAccount');

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