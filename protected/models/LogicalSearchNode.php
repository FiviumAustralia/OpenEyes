<?php

/**
 * Class LogicNode
 */
abstract class LogicalSearchNode extends SearchNode
{
    /**
     * @var SearchNode[]
     */
    protected $children = array();

    public function addChildren($children)
    {
        $this->children = $children;
    }

    /**
     * @param $child SearchNode
     */
    public function addChild($child)
    {
        $this->children[] = $child;
    }
}