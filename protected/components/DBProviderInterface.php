<?php

/**
 * Interface DBProviderInterface
 */
interface DBProviderInterface
{
    /**
     * Return a list of IDs from q SQL query
     * @return array Results from the executed query
     */
    public function runQuery();
}