<?php 

namespace App\Controllers;
use App\Models\PhoneNumber;
use Respect\Validation\Validator as v;


class PhoneController extends Controller{
    
	public function getPhoneNumber($request,$response){

		return $this->view->render($response,'insertNumber.twig');
	}



	public function postPhoneNumber($request,$response){

		$validation=$this->validator->validate($request,[
             
             'phone'=>v::notEmpty(),
             'code' =>v::notEmpty(),

			]);

		if($validation->failed()){

			return $response->withRedirect($this->router->pathFor('userPhone'));
		}

      
    
	$phone =$request->getParam('phone');
    $code=strtoupper ($request->getParam('code'));
      
    $phoneNumberUtil = \libphonenumber\PhoneNumberUtil::getInstance();
    $shortNumberInfo = \libphonenumber\ShortNumberInfo::getInstance();
    $phoneNumberGeocoder = \libphonenumber\geocoding\PhoneNumberOfflineGeocoder::getInstance();
    
      for($i=1; $i<count($phone)+1; $i++){

    $phoneNumber = $phoneNumberUtil->parse($phone[$i], $code, null, true);
    $possibleNumber = $phoneNumberUtil->isPossibleNumber($phoneNumber);
    $validNumber = $phoneNumberUtil->isValidNumber($phoneNumber);
    $validNumberForRegion = $phoneNumberUtil->isValidNumberForRegion($phoneNumber, $code);
    $phoneNumberRegion = $phoneNumberUtil->getRegionCodeForNumber($phoneNumber);
    $phoneNumberType = $phoneNumberUtil->getNumberType($phoneNumber);
    $format=$phoneNumberUtil->format($phoneNumber, \libphonenumber\PhoneNumberFormat::E164);
    $format1=$phoneNumberUtil->format($phoneNumber, \libphonenumber\PhoneNumberFormat::NATIONAL);
    $format2=$phoneNumberUtil->format($phoneNumber, \libphonenumber\PhoneNumberFormat::INTERNATIONAL);

   // var_dump($possibleNumber,$validNumber,$validNumberForRegion,$phoneNumberRegion,$phoneNumberType,$format,$format1,$format2);
     
    if($possibleNumber == 0 ){

        $this->container->flash->addMessage('error','This is not phone number. Please try again.');
        return $response->withRedirect($this->router->pathFor('userPhone'));

     }

     if($validNumber == 0 ){

        $this->container->flash->addMessage('error','Incorect Phone Number. Please try again.');
     	return $response->withRedirect($this->router->pathFor('userPhone'));

     }
    

     if($validNumberForRegion == 0){

        $this->container->flash->addMessage('error','Incorect Country Code. Please try again.');
        return $response->withRedirect($this->router->pathFor('userPhone'));

     }
     
		PhoneNumber::create([
             'phone'	=> $format2,
             'code'		=> $phoneNumberRegion,
             'id_user'	=> $request->getParam('id_user')
			]);
}
        $this->flash->addMessage('info','Successfully entered phone number.');
        return $response->withRedirect($this->router->pathFor('userPhone'));
	}
}