<?php

/**
 * Class SearchTree
 * @property $rootNode SearchNode
 */
class SearchTree
{
    public $rootNode;

    /**
     * Construct a list of IDs by chaining set operations using post-order tree traversal.
     * @return int[] An array of patient IDs
     */
    public function getResultSet()
    {
        $sql = Yii::app()->db->createCommand('SELECT id FROM patient');
        $patients = array_column($sql->queryAll(), 'id');

        return $this->rootNode->getResultSet($patients);
    }
}

