<?php namespace CRMSocial\Operation;

use CRMSocial\Operation\OperationAbstract as Base;

class UpdateLead extends Base
{
	
	public function validate($data)
	{

		return GUMP::is_valid($data, array(
			'page'        => 'required',
			'email'       => 'required',
			'name'        => 'required',
			'phone'       => 'required',
			'city_id'     => 'required',
			'state_id'    => 'required',
			'message'     => 'required',
			'destination' => 'required'
		));

	}

}