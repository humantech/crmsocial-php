<?php namespace Rluders\CRMSocial\Operation;

abstract class OperationAbstract
{

	protected $error = array();
	protected $operation = null;

	abstract public function validate($data = null);

	public function send($api, $data = null)
	{

		$return = false;

		$data = array(
			'operation' => $this->operation,
			'params'    => $data
		);

		$json = json_encode($data);

		try {
        
        	$ch = curl_init();

	        if (defined('PROXY_HOST')) {

	        	curl_setopt($ch, CURLOPT_PROXY, PROXY_HOST);				

			}

			if (defined('PROXY_AUTH')) {

				curl_setopt($ch, CURLOPT_PROXYUSERPWD, PROXY_AUTH);

			}

			curl_setopt($ch, CURLOPT_URL, $api);
	        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	            'Content-Type: application/json',
	            'Content-Length: ' . strlen($json)
	        ));

	        $return = curl_exec($ch);
	        if ($return) {

	        	$return = json_decode($return, true);

	        }

	        curl_close($ch);

	    } catch (\Exception $e) {

	    	$this->error[] = $e->getMessage();

	    }

        return $return;

	}

	public function getErrors()
	{

		return $this->error;

	}

}