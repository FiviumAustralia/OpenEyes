<?php

/**
 * Class OrNode
 */
class OrNode extends LogicalSearchNode
{
    public function renderNode($id)
    {

    }

    public function getResultSet($universal_set)
    {
        $ids = array();
        foreach ($this->children as $child) {
            $data = $child->getResultSet($universal_set);
            $ids = array_unique(array_merge($ids, $data));
        }
        return $ids;
    }
}