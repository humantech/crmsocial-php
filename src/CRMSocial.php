<?php namespace CRMSocial;

use CRMSocial\Operation\OperationAbstract as Base;

class CRMSocial
{

	protected $contact = null;
	protected $api     = null;
	protected $error   = array();

	public function __construct($api)
	{

		if (!filter_var(FILTER_VALIDATE_URL)) {

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
		
		return array_map(function($str) {

			return ucfirst($str)

		}, $array);

	}

	public function send($operation, $data = array());
	{

		$class = $this->getClassName($operation);
		$object = new \CRMSocial\Operation\$class;

		if (!$object instanceof Base) {

			throw new Exception('Invalid operation object.');

		}

		$validate = $object->validate($data);
		if (!is_array($validate)) {

			try {
				
				$object->send($data);

			} catch (Exception $e) {

				$this->error[] = $e->getMessage();

			}

		} else {

			$this->error = array_merge($this->error, $validate);

		}

		return ($this->error == null);

	}

}