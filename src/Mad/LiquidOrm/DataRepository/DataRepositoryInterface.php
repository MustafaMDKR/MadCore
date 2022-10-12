<?php

declare (strict_types=1);

namespace Mad\LiquidOrm\DataRepository;


interface DataRepositoryInterface
{

    /**
     * A method to find and return item by its ID
     *
     * @param integer $id
     * @return array
     */
    public function find(int $id): array;


    /**
     * A method to find and return all data table as an array
     *
     * @return array
     */
    public function findAll(): array;


    /**
     * A method to find and return 1 or more rows by various 
     * arguments which are optional by default.
     *
     * @param array $selectors
     * @param array $conditions
     * @param array $parameters
     * @param array $optional
     * @return array
     */
    public function findBy(array $selectors = [], array $conditions = [], array $parameters = [], array $optional = []): array;


    /**
     * A method to find and return 1 row by the method argument
     *
     * @param array $conditions
     * @return array
     */
    public function findOneBy(array $conditions): array;


    /**
     * A method to find and return a single row from the data table as an object.
     *
     * @param array $conditions
     * @param array $selectors
     * @return Object
     */
    public function findObjectBy(array $conditions = [], array $selectors = []): Object;


    /**
     * A method to return the search results based on the user 
     * search conditions and parameters.
     *
     * @param array $selectors  = []
     * @param array $conditions = []
     * @param array $parameters = []
     * @param array $optional   = []
     * @return array
     * @throws DataRepositoryInvalidArgsException
     */
    public function findBySearch(array $selectors = [], array $conditions = [], array $parameters = [], array $optional = []): array;


    /**
     * A method to find a row by its ID and delete it from the data storage.
     *
     * @param array $conditions
     * @return boolean
     */
    public function findByIdAndDelete(array $conditions): bool;


    /**
     * A method to find a row and update the queried row then return true 
     * on success. We can use the second argument to specify which col to be updated
     * by within the WHERE clause.
     *
     * @param array   $fields
     * @param integer $id
     * @return boolean
     */
    public function findByIdAndUpdate(array $fields =[], int $id): bool;


    /**
     * A method to find and return the storage data as an array within formatted
     * paginated results. Then return queried search results
     *
     * @param array  $args
     * @param object $request
     * @return array
     */
    public function findWithSearchAndPaging(array $args, Object $request): array;


    /**
     * A method to find Item by its ID and return the object row
     * else return 404 chaining method
     *
     * @param integer $id
     * @param array   $selectors
     * @return self
     */
    public function findAndReturn(int $id, array $selectors = []): self;

}
