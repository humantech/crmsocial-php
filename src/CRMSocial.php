<?php

namespace Rluders\CRMSocial;

use Rluders\CRMSocial\Operation\AbstractOperation;

class CRMSocial
{
    protected $contact = null;
    protected $api = null;

    public function __construct($api)
    {
        if (!filter_var($api, FILTER_VALIDATE_URL)) {
            throw new \Exception('Invalid CRMSocial API address.');
        }

        $this->api = $api;
    }

    protected function getClassName($operation)
    {
        $array = explode('_', $operation);
        $class = implode(array_map(function ($str) {
            return ucfirst($str);
        }, $array));

        return "Rluders\\CRMSocial\\Operation\\$class";
    }

    public function send($operation, $data = [])
    {
        $class = $this->getClassName($operation);
        $object = new $class();

        if (!$object instanceof AbstractOperation) {
            throw new \Exception('Invalid operation object.');
        }

        if ($object->validate($data)) {
            try {
                return $object->send($this->api, $data);
            } catch (\Exception $e) {
                throw new \Exception('Unable to save the lead.');
            }
        }

        return false;
    }
}
