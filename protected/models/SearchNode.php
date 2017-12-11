<?php

/**
 * Class SearchNode
 */
abstract class SearchNode extends CFormModel
{
    public $parent_id;
    public $id;

    public function __construct($scenario = '') {
        parent::__construct($scenario);
        $this->parent_id = 0; // Default all nodes to a root parent.
    }
    /**
     * @param $universal_set int[] The universal set of IDs. This is primarily used for NOT nodes.
     * @return int[] A list of IDs.
     */
    abstract public function getResultSet($universal_set);

    public function rules()
    {
        return array(
            array('parent_id, id', 'safe'),
        );
    }

    public function getIDString()
    {
        if (!$this->parent_id) {
            return $this->id;
        }
        return $this->parent_id . '_' . $this->id;
    }

    /**
     * Render the parameter on-screen.
     * @param $id string The position of the parameter in the list of parameters, in the format parentID_id.
     */
    abstract public function renderNode($id);
}
