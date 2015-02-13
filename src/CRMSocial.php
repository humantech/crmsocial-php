<?php namespace Rluders\CRMSocial;

use Rluders\CRMSocial\Operation\OperationAbstract as Base;

class CRMSocial
{

	protected $contact = null;
	protected $api     = null;
	protected $error   = array();

	public function __construct($api)
	{

		if (!filter_var($api, FILTER_VALIDATE_URL)) {

			throw new Exception('Invalid CRMSocial API address.');
			
		}

		$this->api = $api;

	}

	public function getErrors()
	{

		return $this->error;

	}

	protected function getClassName($operation)
	{

		$array = explode('_', $operation);

		$class = implode(array_map(function($str) {

			return ucfirst($str);

		}, $array));

		return "Rluders\\CRMSocial\\Operation\\$class";

	}

	public function send($operation, $data = array())
	{

		$return = null;

		$class = $this->getClassName($operation);		
		$object = new $class;

		if (!$object instanceof Base) {

			throw new \Exception('Invalid operation object.');

		}

		$validate = $object->validate($data);
		if (!is_array($validate) && $validate === true) {

			try {
				
				$return = $object->send($this->api, $data);

			} catch (\Exception $e) {

				$this->error[] = $e->getMessage();

			}

		} else {

			$this->error = array_merge($this->error, $validate);

		}

		return $this->error !== null ? $return : false;

	}

}