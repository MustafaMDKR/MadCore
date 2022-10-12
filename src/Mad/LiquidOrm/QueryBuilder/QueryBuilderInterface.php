<?php

declare(strict_types=1);

namespace Mad\LiquidOrm\QueryBuilder;

interface QueryBuilderInterface
{
    /**
     * A method to insert a query string
     *
     * @return string
     * @throws QueryBuilderException
     */
    public function insertQuery(): string;


    /**
     * A method to select a query string
     *
     * @return string
     * @throws QueryBuilderException
     */
    public function selectQuery(): string;


    /**
     * A method to update a query string
     *
     * @return string
     * @throws QueryBuilderException
     */
    public function updateQuery(): string;


    /**
     * A method to delete a query string
     *
     * @return string
     * @throws QueryBuilderException
     */
    public function deleteQuery(): string;


    /**
     * A method to search|select a query string
     *
     * @return string
     * @throws QueryBuilderException
     */
    public function searchQuery(): string;


    /**
     * A method for RAW query string
     *
     * @return string
     * @throws QueryBuilderException
     */
    public function rawQuery(): string;
}
