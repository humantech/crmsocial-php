<?php namespace CRMSocial\Operation;

use CRMSocial\Operation\OperationAbstract as Base;

class GetCities extends Base
{

	public function valdiate($data)
	{

		return (isset($data['state']) && !empty($data['state']));

	}

}