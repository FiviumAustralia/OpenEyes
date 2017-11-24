<?php

/**
 * Class OrNode
 */
class NotNode extends LogicNode
{
    public function renderNode($id)
    {

    }

    public function getResultSet($universe)
    {
        $ids = array();
        foreach ($this->children as $child) {
            $data = $child->getResultSet($universe);
            $ids = array_diff($universe, $data);
        }
        return $ids;
    }
}