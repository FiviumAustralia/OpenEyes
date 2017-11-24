<?php

/**
 * Class OrNode
 */
class OrNode extends LogicNode
{
    public function renderNode($id)
    {

    }

    public function getResultSet($universe)
    {
        $ids = array();
        foreach ($this->children as $child) {
            $data = $child->getResultSet($universe);
            $ids = array_unique(array_merge($ids, $data));
        }
        return $ids;
    }
}