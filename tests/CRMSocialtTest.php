<?php

use Rluders\CRMSocial\CRMSocial as CRMSocial;

class CRMSocialTest extends PHPUnit_Framework_TestCase
{

	protected function _assert($result = null)
	{

		$this->assertNotNull($result);
		$this->assertArrayHasKey('data', $result);

	}

	public function testClassExists()
	{

		$crmsocial = new CRMSocial(CRMSOCIAL_URL);
		$this->assertInstanceOf('Rluders\CRMSocial\CRMSocial', $crmsocial);

	}

	public function testGetStates()
	{

		$crmsocial = new CRMSocial(CRMSOCIAL_URL);

		$result = $crmsocial->send('get_states');		
		$this->_assert($result);

	}

	public function testGetCities()
	{

		$crmsocial = new CRMSocial(CRMSOCIAL_URL);

		$params = array('state' => 'SC');

		$result = $crmsocial->send('get_cities', $params);
		$this->assertNotNull($result);
		$this->assertArrayHasKey('data', $result);

	}

	public function testUpdateLead()
	{

		$crmsocial = new CRMSocial(CRMSOCIAL_URL);

		$params = array(
			'page'               => 'phpunit-page',
			'email'              => 'ricardo.luders@humantech.com.br',
			'name'               => 'PHPUnit',
			'phone'              => '(47) 3333-3333',
			'city_id'            => 4414,
			'state_id'           => 'SC',
			'message'            => 'PHPUnit test',
			'destination'        => 'phpunit@tuper.net',
			'campaign_matchtype' => '',
			'campaign_keyword'   => ''
		);

		$result = $crmsocial->send('update_lead', $params);
		$this->_assert($result);

	}

}