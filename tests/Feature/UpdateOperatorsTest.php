<?php

namespace Tests\Feature;

use App\Entity\Operator;
use Doctrine\ORM\EntityRepository;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use Mockery;
use Illuminate\Support\Facades\Http;
class UpdateOperatorsTest extends TestCase
{
    protected $entityManager;

    protected function setUp(): void
    {
        parent::setUp();

        // Crear un mock para el EntityManager
        $this->entityManager = Mockery::mock(EntityManagerInterface::class);
    }

    #[Test] public function it_updates_operators_successfully()
    {
        $this->entityManager->shouldReceive('persist')->once();
        $this->entityManager->shouldReceive('flush')->once();

        $this->app->instance(EntityManagerInterface::class, $this->entityManager);

        // Ejecutar el comando
        $this->artisan('update:operators')
            ->expectsOutput('Operators updated successfully.')
            ->assertExitCode(0);
    }

    #[Test] public function it_handles_exception_when_updating_operators()
    {
        $this->entityManager->shouldReceive('persist')->andThrow(new \Exception('Database error'));

        $this->app->instance(EntityManagerInterface::class, $this->entityManager);

        // Ejecutar el comando
        $this->artisan('update:operators')
            ->expectsOutput('Error 500: Failed to update operators.')
            ->assertExitCode(1);
    }

    #[Test] public function it_updates_operators_from_external_api()
    {
        // Simular la respuesta de la API
        Http::fake([
            'https://api.extexnal.com/operators/?sequence_number=12341234' => Http::response([
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
            ]),
        ]);

        $this->entityManager->shouldReceive('persist')->once();
        $this->entityManager->shouldReceive('flush')->once();

        $this->app->instance(EntityManagerInterface::class, $this->entityManager);

        // Ejecutar el comando
        $this->artisan('update:operators')
            ->expectsOutput('Operators updated successfully.')
            ->assertExitCode(0);
    }

    #[Test] public function it_handles_error_when_api_request_fails()
    {
        // Simular un fallo en la respuesta de la API
        Http::fake([
            'https://api.extexnal.com/operators/?sequence_number=12341234' => Http::response([], 500),
        ]);

        $this->entityManager->shouldReceive('persist')->never();
        $this->entityManager->shouldReceive('flush')->never();

        $this->app->instance(EntityManagerInterface::class, $this->entityManager);

        // Ejecutar el comando
        $this->artisan('update:operators')
            ->expectsOutput('Error 500: Failed to retrieve operators.')
            ->assertExitCode(1);
    }

    #[Test]
    public function it_checks_if_operator_exists_before_creating()
    {
        // Crear un operador existente en la base de datos
        $existingOperator = new Operator();
        $existingOperator->setCustomerId(26);
        $existingOperator->setId(999999);
        $existingOperator->setName('654654');
        $existingOperator->setSurname1('');
        $existingOperator->setSurname2('');
        $existingOperator->setPhone(0);
        $existingOperator->setEmail('');
        $existingOperator->setOrderNotificationsEnabled(false);
        $existingOperator->setOrderNotificationsEmail('');
        $existingOperator->setOrderNotificationsByEmail(false);
        $existingOperator->setOrderNotificationsBySms(false);
        $existingOperator->setOrderNotificationsByPush(false);
        $existingOperator->setDeleted(true);

        // Mock para el repositorio de Operator
        $repositoryMock = Mockery::mock(EntityRepository::class);
        $repositoryMock->shouldReceive('findOneBy')
            ->with(Mockery::any())
            ->andReturn($existingOperator); // Simulamos que ya existe un operador con este ID

        // Configurar el mock del EntityManager para retornar el repositorio simulado
        $this->entityManager->shouldReceive('getRepository')
            ->with(Operator::class)
            ->andReturn($repositoryMock);

        // Simular la respuesta de la API externa
        Http::fake([
            'https://api.extexnal.com/operators/?sequence_number=12341234' => Http::response([[
                'customer_id' => 26,
                'id' => 999999, // El mismo ID que el existente
                'name' => '654654',
                'surname_1' => '',
                'surname_2' => '',
                'phone' => 0,
                'email' => '',
                'order_notifications' => false,
                'order_notification_email' => '',
                'order_notification_by_email' => false,
                'order_notification_by_sms' => false,
                'order_notification_by_push' => false,
                'deleted' => true,
            ]]),
        ]);

        $this->app->instance(EntityManagerInterface::class, $this->entityManager);

        // Ejecutar el comando
        $result = $this->artisan('update:operators')
            ->expectsOutput('Operator already exists.')
            ->assertExitCode(1);
    }
}
