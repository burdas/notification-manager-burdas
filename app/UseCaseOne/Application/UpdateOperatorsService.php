<?php

namespace App\UseCaseOne\Application;

use App\UseCaseOne\Domain\Operator;
use App\UseCaseOne\Domain\OperatorRepository;
use App\UseCaseOne\Domain\OperatorProvider;

class UpdateOperatorsService
{
    private OperatorRepository $operatorRepository;
    private OperatorProvider $operatorProvider;

    public function __construct(OperatorRepository $operatorRepository, OperatorProvider $operatorProvider)
    {
        $this->operatorRepository = $operatorRepository;
        $this->operatorProvider = $operatorProvider;
    }

    public function updateOperators(): array {
        [ $status, $operatorsData] = $this->operatorProvider->getOperators();

        if ($status !== 200) {
            return [500, 'Error 500: Failed to retrieve operators.'];
        }

        foreach ($operatorsData as $operatorData) {
            if ($this->operatorRepository->checkIfOperatorExists($operatorData['id'])) {
                return [500, 'Operator already exists.'];
            }

            $operator = $this->convertToOperatorObject($operatorData);
            $saveResponse = $this->operatorRepository->save($operator);

            if ($saveResponse !== 0) {
                return [500, 'Error 500: Failed to update operators.'];
            }
        }
        return [200, 'Operators updated successfully.'];
    }

    private function convertToOperatorObject($operatorData): Operator
    {
        $operator = new Operator();
        $operator->setCustomerId($operatorData['customer_id']);
        $operator->setId($operatorData['id']);
        $operator->setName($operatorData['name']);
        $operator->setSurname1($operatorData['surname_1']);
        $operator->setSurname2($operatorData['surname_2']);
        $operator->setPhone($operatorData['phone']);
        $operator->setEmail($operatorData['email']);
        $operator->setOrderNotificationsEnabled($operatorData['order_notifications']);
        $operator->setOrderNotificationsEmail($operatorData['order_notification_email']);
        $operator->setOrderNotificationsByEmail($operatorData['order_notification_by_email']);
        $operator->setOrderNotificationsBySms($operatorData['order_notification_by_sms']);
        $operator->setOrderNotificationsByPush($operatorData['order_notification_by_push']);
        $operator->setDeleted($operatorData['deleted']);
        return $operator;
    }
}
