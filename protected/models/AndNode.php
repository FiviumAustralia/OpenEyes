<?php

/**
 * Class AndNode
 */
class AndNode extends LogicNode
{
    public function renderNode($id)
    {
    }

    public function getResultSet($universe)
    {
        $ids = array();
        foreach ($this->children as $i => $child) {
            $data = $child->getResultSet($universe);
            if ($i === 0) {
                // Assign the initial dataset.
                $ids = $data;
            } else {
                // Apply an INTERSECT to the aggregated dataset.
                $ids = array_intersect($ids, $data);
            }
        }
        return $ids;
    }
}