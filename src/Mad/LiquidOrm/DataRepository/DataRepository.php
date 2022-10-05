<?php

declare (strict_types=1);

namespace Mad\LiquidOrm\DataRepository;

use Mad\LiquidOrm\DataRepository\Exception\DataRepositoryInvalidArgsException;
use Mad\LiquidOrm\EntityManager\EntityManagerInterface;
use Throwable;

class DataRepository implements DataRepositoryInterface
{

    protected EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    private function isArray(array $conditions): void
    {
        if (!is_array($conditions)) {
            throw new DataRepositoryInvalidArgsException('The argument supplied is not an array');
        }
    }

    private function isEmpty(int $id): void
    {
        if (empty($id)) {
            throw new DataRepositoryInvalidArgsException('Argument shold not be empty.');
        }
    }

    public function find(int $id): array
    {
        $this->isEmpty($id);
        try {
            return $this->findOneBy(['id' => $id]);
        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }


    public function findAll(): array
    {
        try {
            return $this->em->getCrud()->read();
        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }


    public function findBy(array $selectors = [], array $conditions = [], array $parameters = [], array $optional = []): array
    {
        try {
            return $this->em->getCrud()->read($selectors, $conditions, $parameters, $optional);
        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }

    public function findOneBy(array $conditions): array
    {
        $this->isArray($conditions);
        try {
            return $this->em->getCrud()->read([], $conditions);
        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }


    public function findObjectBy(array $conditions = [], array $selectors = []): object
    {
        
    }


    public function findBySearch(array $selectors = [], array $conditions = [], array $parameters = [], array $optional = []): array
    {
        $this->isArray($conditions);
        try {
            return $this->em->getCrud()->search($selectors, $conditions, $parameters, $optional);
        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }


    public function findByIdAndDelete(array $conditions): bool
    {
        $this->isArray($conditions);
        try {
            $result = $this->findOneBy($conditions);
            if ($result != null && count($result) > 0) {
                $delete = $this->em->getCrud()->delete($conditions);
                if ($delete) {
                    return true;
                }
            }
        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }


    public function findByIdAndUpdate(array $fields = [], int $id): bool
    {
        $this->isArray($fields);

        try {
            $result = $this->findOneBy([$this->em->getCrud()->getSchemaID() => $id]);
            if ($result != null && count($result) > 0) {
                $params = (!empty($fields)) ? array_merge([$this->em->getCrud()->getSchemaID() => $id], $fields) : $fields;
                $update = $this->em->getCrud()->update($params, $this->em->getCrud()->getSchemaID());

                if ($update) {
                    return true;
                }
            }
        } catch (Throwable $throwable) {
            throw $throwable;
        }
    }


    public function findWithSearchAndPaging(array $args, object $request): array
    {
        return [];
    }


    public function findAndReturn(int $id, array $selectors = []): DataRepositoryInterface
    {
        return $this;
    }

}