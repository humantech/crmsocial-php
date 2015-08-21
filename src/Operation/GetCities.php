<?php

namespace Rluders\CRMSocial\Operation;

class GetCities extends AbstractOperation
{
    protected $operation = 'get_cities';

    public function validate($data = null)
    {
        return (isset($data['state']) && !empty($data['state']));
    }
}
