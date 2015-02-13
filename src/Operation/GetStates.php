<?php namespace Rluders\CRMSocial\Operation;

class GetStates extends OperationAbstract
{

	protected $operation = 'get_states';

	public function validate($data = null)
	{

		return empty($data);

	}

}