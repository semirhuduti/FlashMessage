<?php

require __DIR__ . '/config_with_app.php';

$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

$di = new \Anax\DI\CDIFactoryDefault();
$app = new \Anax\Kernel\CAnax($di);


// The following lines can be added in the CDIFactoryDefault that is located in src/DI
// 
//$di->setShared('flash', function() {
//    $flash = new \Anax\FlashMessage\FlashMessage();
//    return $flash;
//});

$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');

$app->router->add('flash', function() use ($app) {

    $app->theme->setTitle("Flash test");

    $app->flash->message('information', 'This is a info message');
    $app->flash->message('warning', 'This is a warning message');
    $app->flash->message('success', 'This is a success message');
    $app->flash->message('error', 'This is a error message');


    $app->theme->setVariable('title', "Flash test");

    $app->views->add('me/page', [
        'content' => $app->flash->getMessages(),
    ]);
});

$app->theme->addStylesheet('css/flash.css');

$app->router->handle();

$app->theme->render();
