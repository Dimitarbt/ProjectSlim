<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model {

protected $table='personalinfo';

	protected $fillable=[
      'name',
      'lastname',
      'city',
      'country',
      'id_user'
	];

}