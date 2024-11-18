<?php

namespace App\UseCaseOne\Domain;
use Doctrine\ORM\EntityManagerInterface;

abstract class OperatorRepository
{
    protected EntityManagerInterface $entityManagerInterface;

    public function __construct(EntityManagerInterface $EntityManagerInterface)
    {
        $this->entityManagerInterface = $EntityManagerInterface;
    }
    public abstract function checkIfOperatorExists(int $operatorId): bool;
    public abstract function save(Operator $operator): int;
}
