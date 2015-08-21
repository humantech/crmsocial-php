<?php

namespace Rluders\CRMSocial\Operation;

abstract class AbstractOperation
{
    protected $error = array();
    protected $operation = null;

    abstract public function validate($data = null);

    public function send($api, $data = null)
    {
        $response = $this->sendRequest($api, json_encode([
            'operation' => $this->operation,
            'params' => $data,
        ]));

        return $response ? json_decode($response, true) : false;
    }

    protected function sendRequest($api, $json)
    {
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
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: '.strlen($json),
        ]);

        $return = curl_exec($ch);
        curl_close($ch);

        return $return;
    }
}
