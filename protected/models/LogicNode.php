<?php

/**
 * Class LogicNode
 */
abstract class LogicNode extends SearchNode
{
    /**
     * @var SearchNode[]
     */
    protected $children = array();

    public function addChildren($children)
    {
        $this->children = $children;
    }
}