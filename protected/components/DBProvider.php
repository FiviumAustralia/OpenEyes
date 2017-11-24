<?php

/**
 * Class DBProvider
 */
class DBProvider extends \SearchProvider
{
    /**
     * @param array $criteria The parameters to search with. The parameters must implement the DBProviderInterface interface.
     * @return array The returned data from the search.
     */
    protected function executeSearch($criteria)
    {
        $result = array();
        $first = true;
        // Construct the SQL search string using each parameter as a separate dataset merged using JOINs.
        foreach ($criteria as $id => $param) {
            // Ignore any case search parameters that do not implement DBProviderInterface
            if ($param instanceof DBProviderInterface) {
                $new_ids = $param->runQuery();
                if(!$first) {
                    $result = array_unique(array_intersect($result, $new_ids));
                } else {
                    $result = $new_ids;
                    $first = false;
                }
            }
        }
        return $result;
    }
}