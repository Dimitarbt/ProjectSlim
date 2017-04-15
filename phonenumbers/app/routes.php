<?php


use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

$app->group('',function(){
    $this->get('/','SignInController:getSigIn')->setName('userSignIn');
    $this->post('/','SignInController:postSignIn');

    $this->get('/signup','SignUpController:getSigUp')->setName('userSignUp');
    $this->post('/signup','SignUpController:postSignUp');
})->add(new GuestMiddleware($container));


$app->group('',function() use ($app){
    $app->get('/home','HomeController:index')->setName('userHome');
    $app->post('/home','HomeController:postInfo');

    $app->get('/insertphone','PhoneController:getPhoneNumber')->setname('userPhone');
    $app->post('/insertphone','PhoneController:postPhoneNumber');

    $app->get('/sigout','SignoutController:getSignout')->setName('userSignout');

})->add(new AuthMiddleware($container));


