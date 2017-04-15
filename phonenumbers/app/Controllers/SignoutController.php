<?php

namespace App\Controllers;

class SignoutController extends Controller{

	public function getSignout($request,$response){

		$this->auth->logout();

		return $response->withRedirect($this->router->pathFor('userSignIn'));

	}
}