<?php

namespace Rluders\CRMSocial\Operation;

class UpdateLead extends AbstractOperation
{
    protected $operation = 'update_lead';

    public function validate($data = null)
    {
        $gump = new \GUMP();

        $gump->validation_rules([
            'page' => 'required',
            'email' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'city_id' => 'required',
            'state_id' => 'required',
            'message' => 'required',
            'destination' => 'required',
        ]);

        return $gump->run($data);
    }
}
