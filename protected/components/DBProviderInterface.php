<?php

/**
 * Interface DBProviderInterface
 */
interface DBProviderInterface
{
    /**
     * Return a list of database row ids conforming to conditions
     *
     * @return array Ids
     */
    public function getIds();
}