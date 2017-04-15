<?php
namespace App\Controllers;

use App\Models\User;
use Respect\Validation\Validator as v;

class SignUpController extends Controller {

	public function getSigUp($request,$response){
		
    return $this->view->render($response,'signup.twig');

}

    public function postSignUp($request,$response){


        $validation=$this->validator->validate($request,[
             
             'username'=>v::noWhitespace()->notEmpty()->IsUsernameAvailable(),
             'password'=>v::noWhitespace()->notEmpty()

            ]);

        if($validation->failed()){

        return $response->withRedirect($this->router->pathFor('userSignUp'));

        }

    	User::create([
             'username'		=> $request->getParam('username'),
             'password'		=>password_hash($request->getParam('password'),PASSWORD_DEFAULT)
    		]);
        
        $this->flash->addMessage('info','You are registered. Now you can Sign In !!!');
    	return $response->withRedirect($this->router->pathFor('userSignIn'));

    }
}