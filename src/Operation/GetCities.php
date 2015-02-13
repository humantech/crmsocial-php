<?php namespace Rluders\CRMSocial\Operation;

class GetCities extends OperationAbstract
{

	protected $operation = 'get_cities';

	public function validate($data = null)
	{

		return (isset($data['state']) && !empty($data['state']));

	}

}