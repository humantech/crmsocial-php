<?php

namespace Rluders\CRMSocial\Operation;

class GetStates extends AbstractOperation
{
    protected $operation = 'get_states';

    public function validate($data = null)
    {
        return empty($data);
    }
}
