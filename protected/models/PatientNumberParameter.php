<?php

/**
 * Class PatientNumberParameter
 */
class PatientNumberParameter extends ParameterNode
{
    public $number;

    /**
     * CaseSearchParameter constructor. This overrides the parent constructor so that the name can be immediately set.
     * @param string $scenario
     */
    public function __construct($scenario = '')
    {
        parent::__construct($scenario);
        $this->name = 'patient_number';
        $this->operation = '='; // Remove if more operations are added.
    }

    public function getLabel()
    {
        // This is a human-readable value, so feel free to change this as required.
        return Yii::app()->params['hos_label_long'] . ' Number';
    }

    /**
     * Override this function for any new attributes added to the subclass. Ensure that you invoke the parent function first to obtain and augment the initial list of attribute names.
     * @return array An array of attribute names.
     */
    public function attributeNames()
    {
        return array_merge(parent::attributeNames(), array(
                'number',
            )
        );
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), array(
            'number' => 'Value',
        ));
    }

    /**
     * Override this function if the parameter subclass has extra validation rules. If doing so, ensure you invoke the parent function first to obtain the initial list of rules.
     * @return array The validation rules for the parameter.
     */
    public function rules()
    {
        return array_merge(parent::rules(), array(
            array('number', 'required'),
            array('number', 'numerical'),
        ));
    }

    public function renderNode($id)
    {
        ?>
        <div class="row field-row">
            <div class="large-3 column">
                <?php echo CHtml::label($this->getLabel() . ' is', false); ?>
            </div>
            <div class="large-9 column">
                <?php echo CHtml::activeTextField($this, "[$id]number"); ?>
                <?php echo CHtml::error($this, "[$id]number"); ?>
            </div>
        </div>
        <?php
    }


    /**
     * Get patient ids based on patient number.
     * @param $universal_set int[] A list of all IDs in the reference data set.
     * @return array patient ids
     */
    public function getResultSet($universal_set)
    {
        $queryStr =
            'SELECT DISTINCT p.id 
        FROM patient p
        WHERE p.hos_num = :p_num_number';

        $query = Yii::app()->db->createCommand($queryStr);
        $this->bindParams($query, $this->bindValues());

        return array_column($query->queryAll(), 'id');
    }

    /**
     * Get the list of bind values for use in the SQL query.
     * @return array An array of bind values. The keys correspond to the named binds in the query string.
     */
    private function bindValues()
    {
        // Construct your list of bind values here. Use the format "bind" => "value".
        return array(
            'p_num_number' => $this->number,
        );
    }

    /**
     * @inherit
     */
    public function getAuditData()
    {
        return "$this->name: $this->operation $this->number";
    }
}
