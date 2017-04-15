<?php
namespace App\Middleware;

class PhoneErrorMiddleware extends Middleware{

		public function __invoke($request,$response,$next){

		if(isset($_SESSION['error'])){

        $this->container->view->getEnvironment()->addGlobal('error',$_SESSION['error']);
        unset($_SESSION['error']);

    }
		$response=$next($request,$response);
		return $response;

	}

}