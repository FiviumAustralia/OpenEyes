<?php

/**
 * Class PatientAllergyParameterTest
 */

class PatientAllergyParameterTest extends CDbTestCase
{
    /**
     * @var PatientAllergyParameter
     */
    protected $object;

    protected $fixtures = array(
        'patient' => 'Patient',
        'allergy' => 'Allergy',
        'et_ophciexamination_allergies' => ':et_ophciexamination_allergies',
        'ophciexamination_allergy_entry' => OEModule\OphCiExamination\models\AllergyEntry::class,
        'event' => 'Event',
        'episode' => 'Episode',
    );

    public function __construct()
    {
        parent::__construct();
        $sql = Yii::app()->db->createCommand('SELECT id FROM patient');
        $this->universe = array_column($sql->queryAll(), 'id');
    }

    protected function setUp()
    {
        parent::setUp();
        $this->object = new PatientAllergyParameter();
    }

    protected function tearDown()
    {
        parent::tearDown();
        unset($this->object);
    }

    public function testSearch()
    {
        $this->object->textValue = 'allergy 1';
        $this->object->operation = '=';

        $expected = array($this->patient('patient1'));

        $results = $this->object->getResultSet($this->universe);

        $patients = Patient::model()->findAllByPk($results);

        $this->assertEquals($expected, $patients);

        $this->object->operation = '!=';

        $expected = array();

        for ($i = 2; $i < 10; $i++) {
            $expected[] = $this->patient("patient$i");
        }

        $results = $this->object->getResultSet($this->universe);

        $patients = Patient::model()->findAllByPk($results);

        $this->assertEquals($expected, $patients);
    }

}
