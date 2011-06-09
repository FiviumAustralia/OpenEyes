<?php
class CommonOphthalmicDisorderTest extends CDbTestCase
{
	public $fixtures = array(
		'specialties' => 'Specialty',
	);

	public function testGetSpecialtyOptions()
	{
		$specialties = PhraseBySpecialty::model()->getSpecialtyOptions();
		$this->assertTrue(is_array($specialties));
		$this->assertEquals(16, count($specialties));
	}
}
