<?php

namespace App\Console\Commands;

use App\UseCaseOne\Application\UpdateOperatorsService;
use App\UseCaseOne\Infraestructure\LocalOperatorProvider;
use App\UseCaseOne\Infraestructure\MysqlOperatorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Console\Command;

class UpdateOperatorsCommand extends Command
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
        $operatorsRepository = new MysqlOperatorRepository($this->entityManager);
        $operatorProvider = new LocalOperatorProvider();
        $updateOperatorService = new UpdateOperatorsService($operatorsRepository, $operatorProvider);
        $response = $updateOperatorService->updateOperators();

        if ($response[0] !== 200) {
            $this->error($response[1]);
            return 1;
        }
        $this->info($response[1]);
        return 0;
    }
}
