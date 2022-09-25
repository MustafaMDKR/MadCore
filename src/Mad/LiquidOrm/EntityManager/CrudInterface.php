<?php

declare(strict_types=1);

namespace Mad\LiquidOrm\EntityManager;

interface CrudInterface
{
    /**
     * Returns the storage schema name as a string
     *
     * @return string
     */
    public function getSchema(): string;

    /**
     * Returns the primary key for the storage schema
     *
     * @return string
     */
    public function getSchemaID(): string;

    /**
     * Returns the last inserted ID
     *
     * @return integer
     */
    public function lastID(): int;

    /**
     * Create method for inserting data to storage table
     *
     * @param array $fields
     * @return boolean
     */
    public function create(array $fields = []): bool;

    /**
     * Returns database rows based on the supplied arguments
     *
     * @param array $selectors
     * @param array $conditions
     * @param array $params
     * @param array $optional
     * @return array
     */
    public function read(array $selectors = [], array $conditions = [], array $params = [], array $optional = []): array;

    /**
     * A method to update 1 or more rows of data in the storage table
     *
     * @param array  $fields
     * @param string $primaryKey
     * @return boolean
     */
    public function update(array $fields = [], string $primaryKey): bool;

    /**
     * A method to permanently delete a row from the storage table
     *
     * @param array $conditions
     * @return boolean
     */
    public function delete(array $conditions = []): bool;

    /**
     * A method to return an array of queried search results
     *
     * @param array $selectors
     * @param array $conditions
     * @return array
     */
    public function search(array $selectors = [], array $conditions = []): array;

    /**
     * Returns a custome query string. Within an optional array of conditions 
     * for the query string
     *
     * @param string $rawQuery
     * @param array|null  $conditions
     * @return void
     */
    public function rawQuery(string $rawQuery, ?array $conditions = []);

}
