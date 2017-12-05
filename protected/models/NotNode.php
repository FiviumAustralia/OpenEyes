<?php

/**
 * Class OrNode
 */
class NotNode extends LogicalSearchNode
{
    public function renderNode($id)
    {

    }

    public function getResultSet($universal_set)
    {
        $ids = array();
        foreach ($this->children as $child) {
            $data = $child->getResultSet($universal_set);
            $ids = array_diff($universal_set, $data);
        }
        return $ids;
    }
}