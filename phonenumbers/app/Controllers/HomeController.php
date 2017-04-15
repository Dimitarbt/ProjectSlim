<?php
namespace App\Controllers;
use App\Models\Personalinfo;
use App\Models\PhoneNumber;
use Respect\Validation\Validator as v;

class HomeController extends Controller{


	public function index($request,$response){
	$name='';
	$lastname='';
	$city='';
	$country='';

	  $personalInfo=Personalinfo::where('id_user',$_SESSION['user'])->get();
	  foreach ($personalInfo as $pi) {
		/*$_SESSION['name']=$pi->name;
		$_SESSION['lastname']=$pi->lastname;
		$_SESSION['city']=$pi->city;
		$_SESSION['country']=$pi->country;
*/
		$name=$pi->name;
		$lastname=$pi->lastname;
		$city=$pi->city;
		$country=$pi->country;
  
			}
		$phones=PhoneNumber::where('id_user',$_SESSION['user'])->get();
	   
	    $data = ['name' => $name,'lastname'=>$lastname,'city'=>$city,'country'=>$country,'phones'=>$phones];

	    if(empty($name) && empty($lastname) && empty($city) && empty($country)){

        return $this->view->render($response,'home.twig',$data);
      
      }
      return $this->view->render($response,'home1.twig',$data);
      
	}

	public function postInfo($request,$response){


		$validation=$this->validator->validate($request,[

			'name'		=>v::notEmpty(),
			'lastname'	=>v::notEmpty(),
			'city'		=>v::notEmpty(),
			'country'	=>v::notEmpty(),


			]);
		if($validation->failed()){

			return $response->withRedirect($this->router->pathFor('userHome'));
		}
        

       PersonalInfo::create([
             'name'		=> $request->getParam('name'),
             'lastname'	=> $request->getParam('lastname'),
             'city'		=> $request->getParam('city'),
             'country'	=> $request->getParam('country'),
             'id_user'	=> $request->getParam('id_user')
    		]);

        $this->flash->addMessage('info','Successfully entered your personal information.');
        return $response->withRedirect($this->router->pathFor('userHome'));

		//return $this->view->render($response,'home.twig');

	}


}