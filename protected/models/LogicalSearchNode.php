<?php

/**
 * Class LogicNode
 * @property $parent_id int
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

    /**
     * @param $id int
     * @return SearchNode|null The node with the specified ID; otherwise null if no such node exists.
     */
    public function getNode($id)
    {
        if ($this->id === $id) {
            // If the current node has the requested ID, return it up the stack.
            return $this;
        }
        foreach ($this->children as $child) {
            if ($child instanceof self) {
                // Determine if the child or any of its descendants is the requested node.
                $currentNode = $child->getNode($id);
            } else {
                // If the child node is a parameter node, continue the loop as parameter nodes do not possess an ID.
                continue;
            }

            // If the node is not found for the current child node, continue the loop for the rest of the children.
            if (!$currentNode) {
                continue;
            }

            if ($currentNode->id === $id) {
                // If a child node passes back a node (meaning it or one of its descendants is the requested node), return it up the stack.
                return $currentNode;
            }
        }
        // Node has not been found in any descendants, so return null.
        return null;
    }
}