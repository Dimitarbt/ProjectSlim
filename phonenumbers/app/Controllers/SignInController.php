<?php
namespace App\Controllers;

class SignInController extends Controller {

	public function getSigIn($request,$response){

       return $this->view->render($response,'signin.twig');
    

}

    public function postSignIn($request,$response){

         $auth= $this->auth->attempt(
             
             $request->getParam('username'),
             $request->getParam('password')
         	);
          
 
         if($auth){
         	return $response->withRedirect($this->router->pathFor('userHome'));
         }
         else{

            $this->flash->addMessage('error','Invalid Entries. Please try again.');
         	return $response->withRedirect($this->router->pathFor('userSignIn'));
         }
    	 


    }
}