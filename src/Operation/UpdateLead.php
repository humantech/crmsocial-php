<?php namespace Rluders\CRMSocial\Operation;



class UpdateLead extends OperationAbstract
{
	
	protected $operation = 'update_lead';

	public function validate($data = null)
	{

		return \GUMP::is_valid($data, array(
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