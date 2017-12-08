<?php

/**
 * Class SearchNode
 */
abstract class SearchNode extends CFormModel
{
    public $parent_id;

    public function __construct($scenario = null) {
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
            array('parent_id', 'safe'),
        );
    }

    /**
     * Render the parameter on-screen.
     * @param $id integer The position of the parameter in the list of parameters.
     */
    abstract public function renderNode($id);

}