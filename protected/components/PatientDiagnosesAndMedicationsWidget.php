<?php

class PatientDiagnosesAndMedicationsWidget extends CWidget
{
    public $patient;


    public function init()
    {

    }

    public function getData()
    {
        return $this->patient;
    }

    public function run()
    {
        $this->render('PatientDiagnosesAndMedicationsWidget');
    }
}
