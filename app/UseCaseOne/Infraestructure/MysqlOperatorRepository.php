<?php

namespace App\UseCaseOne\Infraestructure;
use App\UseCaseOne\Domain\Operator;
use App\UseCaseOne\Domain\OperatorRepository;

class MysqlOperatorRepository extends OperatorRepository
{
    public function checkIfOperatorExists(int $operatorId): bool
    {
        $operator = $this->entityManagerInterface->getRepository(Operator::class)->findOneBy(['id' => $operatorId]);
        return $operator !== null;
    }

    public function save(Operator $operator): int
    {
        try {
            $this->entityManagerInterface->persist($operator);
            $this->entityManagerInterface->flush();
            return 0;
        } catch (\Exception $e) {
            return 1;
        }
    }
}
