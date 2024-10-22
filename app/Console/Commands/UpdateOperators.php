<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Operator;

class UpdateOperators extends Command
{
    protected $signature = 'update:operators';
    protected $description = 'Actualiza los operarios desde una API externa';

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    public function handle(): int
    {
        try {
            // Obtiene los datos de la petición GET
//            $response = Http::get('https://api.external.com/operators/?sequence_number=12341234');
//
//            if ($response->failed()) {
//                $this->error('Error 500: Failed to retrieve operators.');
//                return 1;
//            }
//
//            $operatorsData = $response->json();

            //Datos de test para realziar la prueba
            $operatorsData = $this->getTestData();

            foreach ($operatorsData as $data) {
                // Creación de un nuevo objeto y lo completamos con los datos obtenidos
                $operator = new Operator();
                $operator->setCustomerId($data['customer_id']);
                $operator->setId($data['id']);
                $operator->setName($data['name']);
                $operator->setSurname1($data['surname_1']);
                $operator->setSurname2($data['surname_2']);
                $operator->setPhone($data['phone']);
                $operator->setEmail($data['email']);
                $operator->setOrderNotificationsEnabled($data['order_notifications']);
                $operator->setOrderNotificationsEmail($data['order_notification_email']);
                $operator->setOrderNotificationsByEmail($data['order_notification_by_email']);
                $operator->setOrderNotificationsBySms($data['order_notification_by_sms']);
                $operator->setOrderNotificationsByPush($data['order_notification_by_push']);
                $operator->setDeleted($data['deleted']);
                // Añadimos el objeto al entity manager
                $this->entityManager->persist($operator);
            }

            // Guardar los objetos en la base de datos
            $this->entityManager->flush();

            $this->info('Operators updated successfully.');
            return 0;
        } catch (\Exception $e) {
            $this->error('Error 500: Failed to update operators.');
            //$this->error($e->getMessage());
            return 1;
        }
    }

    private function getTestData(): array
    {
        return [
            [
                "entry_timestamp" => "2024-06-20-10.35.05.977824",
                "sequence_number" => 1510105,
                "journal_entry_type" => "UP",
                "customer_id" => 26,
                "id" => 2,
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
        ];
    }
}
