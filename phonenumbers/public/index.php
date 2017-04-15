<?php

use Respect\Validation\Validator as v;
session_start();

require __DIR__.'/../vendor/autoload.php';


$app= new \Slim\App([
    'settings'	=>[
      'displayErrorDetails'	=> true,

      'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'phonenumbers',
            'username' => 'root',
            'password' => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]

    ],
	]);

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();
$container['db'] = function ($container) use ($capsule){
    return $capsule;
};

$container['auth']=function($container){

    return new \App\Auth\Auth;
};

$container['flash']=function($container){
  return new \Slim\Flash\Messages;
};

$container['view']=function($container){

	$view= new \Slim\Views\Twig(__DIR__.'/../resources/views');

	$view->addExtension(new \Slim\Views\TwigExtension(
		$container->router,
		$container->request->geturi()
		));

  $view->getEnvironment()->addGlobal('auth',[
    'check' =>$container->auth->check(),
    'user'  =>$container->auth->user(),
    ]);

  $view->getEnvironment()->addGlobal('flash',$container->flash);

	return $view;

};

/*$container['global']=function($container){
   $loader = new Twig_Loader_Filesystem(__DIR__.'/../resources/views');
   $twig = new Twig_Environment($loader);
   return $twig;
};**/


$container['SignInController']=function($container){

	return new \App\Controllers\SignInController($container);
};

$container['SignUpController']=function($container){

	return new \App\Controllers\SignUpController($container);
};


$container['HomeController']=function($container){

    return new \App\Controllers\HomeController($container);
};

$container['PhoneController']=function($container){

    return new \App\Controllers\PhoneController($container);
};



$app->add(new \App\Middleware\SessionMiddleware($container));
//$app->add(new \App\Middleware\OldInputMiddleware($container));
$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));

$container['SignoutController']=function($container){

    return new \App\Controllers\SignoutController($container);
};

$container['validator']=function($container){
    return new \App\Validation\Validator;
};

$container['validatorPhone']=function($container){
    return new \App\ValidationPhone\ValidatorPhone;
};

v::with('App\\Validation\\Rules\\');

require __DIR__.'/../app/routes.php';

$app->run();