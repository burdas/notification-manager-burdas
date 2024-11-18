<?php

namespace App\UseCaseOne\Infraestructure;

use App\UseCaseOne\Domain\OperatorProvider;

class LocalOperatorProvider implements OperatorProvider
{
    function getOperators(): array
    {
        return [200, [
            [
                "entry_timestamp" => "2024-06-20-10.35.05.977824",
                "sequence_number" => 1510105,
                "journal_entry_type" => "UP",
                "customer_id" => 26,
                "id" => 3,
                "name" => "654654",
                "surname_1" => "",
                "surname_2" => "",
                "phone" => 0,
                "email" => "",
                "order_notifications" => false,
                "order_notification_email" => "",
                "order_notification_by_email" => false,
                "order_notification_by_sms" => false,
                "order_notification_by_push" => false,
                "deleted" => true,
            ]
        ]];
    }
}
