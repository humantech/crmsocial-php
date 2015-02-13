<?php namespace CRMSocial\Operation;

abstract class OperationAbstract
{

	protected $error = array();

	public abstract validate($data);

	public function send($api, $data)
	{

		$json = json_encode($data);

        $ch = curl_init($api);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json)
        ));

        return curl_exec($ch);

	}

	public function getErrors()
	{

		return $this->error;

	}

}