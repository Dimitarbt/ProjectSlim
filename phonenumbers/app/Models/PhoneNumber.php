<?php 


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model{
    
    protected $table='phonenumbers';

    protected $fillable=[
      'phone',
      'code',
      'id_user',
      
	];

}