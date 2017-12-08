<?php

/**
 * Class FamilyHistoryParameter
 */
class FamilyHistoryParameter extends ParameterNode
{
    /**
     * @var integer $relative
     */
    public $relative;

    /**
     * @var integer $side
     */
    public $side;

    /**
     * @var integer $condition
     */
    public $condition;

    /**
     * CaseSearchParameter constructor. This overrides the parent constructor so that the name can be immediately set.
     * @param string $scenario
     */
    public function __construct($scenario = '')
    {
        parent::__construct($scenario);
        $this->name = 'family_history';
        $this->operation = '=';
    }

    public function getLabel()
    {
        return 'Family History';
    }

    /**
     * Override this function for any new attributes added to the subclass. Ensure that you invoke the parent function first to obtain and augment the initial list of attribute names.
     * @return array An array of attribute names.
     */
    public function attributeNames()
    {
        return array_merge(parent::attributeNames(), array(
                'relative',
                'side',
                'condition',
            )
        );
    }

    /**
     * Override this function if the parameter subclass has extra validation rules. If doing so, ensure you invoke the parent function first to obtain the initial list of rules.
     * @return array The validation rules for the parameter.
     */
    public function rules()
    {
        return array_merge(parent::rules(), array(
                array('condition', 'required'),
                array('relative, side, condition', 'safe'),
            )
        );
    }

    public function renderNode($id)
    {
        $ops = array(
            '=' => 'has',
            '!=' => 'does not have',
        );

        $relatives = CHtml::listData(OEModule\OphCiExamination\models\FamilyHistoryRelative::model()->findAll(), 'id',
            'name');
        $sides = CHtml::listData(OEModule\OphCiExamination\models\FamilyHistorySide::model()->findAll(), 'id', 'name');
        $conditions = CHtml::listData(OEModule\OphCiExamination\models\FamilyHistoryCondition::model()->findAll(), 'id',
            'name');

        ?>
      <div class="row field-row">
        <div class="large-2 column">
            <?php echo CHtml::label($this->getLabel(), false); ?>
        </div>

        <div class="large-2 column">
            <?php echo CHtml::activeDropDownList($this, "[$id]side", $sides, array('empty' => 'Any side')); ?>
        </div>

        <div class="large-2 column">
            <?php echo CHtml::activeDropDownList($this, "[$id]relative", $relatives,
                array('empty' => 'Any relative')); ?>
        </div>

        <div class="large-3 column">
            <?php echo CHtml::activeDropDownList($this, "[$id]operation", $ops, array('prompt' => 'Select One...')); ?>
            <?php echo CHtml::error($this, "[$id]operation"); ?>
        </div>
        <div class="large-3 column">
            <?php echo CHtml::activeDropDownList($this, "[$id]condition", $conditions,
                array('prompt' => 'Select One...')); ?>
            <?php echo CHtml::error($this, "[$id]condition"); ?>
        </div>
      </div>

        <?php
    }

    /**
     * Get patient ids based on patient number.
     * @param $universal_set int[] A list of all IDs in the reference data set.
     * @return array patient ids
     * @throws CHttpException In case of invalid operator
     */
    public function getResultSet($universal_set)
    {
        $queryStr = '
SELECT DISTINCT p.id 
FROM patient p 
JOIN patient_family_history fh
  ON fh.patient_id = p.id
WHERE (:f_h_side IS NULL OR fh.side_id = :f_h_side)
  AND (:f_h_relative IS NULL OR fh.relative_id = :f_h_relative)
  AND (:f_h_condition = :f_h_condition)';
        switch ($this->operation) {
            case '=':
                // Do nothing.
                break;
            case '!=':
                $queryStr = "
SELECT id
FROM patient
WHERE id NOT IN (
  $queryStr
)";
                break;
            default:
                throw new CHttpException(400, 'Invalid operator specified.');
                break;
        }

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
            'f_h_relative' => $this->relative,
            'f_h_side' => $this->side,
            'f_h_condition' => $this->condition,
        );
    }

    /**
     * @inherit
     */
    public function getAuditData()
    {
        return "$this->name: $this->side $this->relative $this->operation \"$this->condition\"";
    }
}
