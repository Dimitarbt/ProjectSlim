<?php

/*namespace App\Middleware;

class OldInputMiddleware extends Middleware{

	public function __invoke($request,$response,$next){

        if(isset($_SESSION['name'])){
		$this->container->view->getEnvironment()->addGlobal('name',$_SESSION['name']);
		$this->container->view->getEnvironment()->addGlobal('lastname',$_SESSION['lastname']);
        $this->container->view->getEnvironment()->addGlobal('city',$_SESSION['city']);
		$this->container->view->getEnvironment()->addGlobal('country',$_SESSION['country']);

		



	}
	if(isset($_SESSION['phones'])){
		$this->container->view->getEnvironment()->addGlobal('phones',$_SESSION['phones']);
	}

			//$_SESSION['old']= $request->getParams();

          

		$response=$next($request,$response);
		return $response;
	}
}*/