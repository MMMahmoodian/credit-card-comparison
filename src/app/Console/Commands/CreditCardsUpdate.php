<?php

namespace App\Console\Commands;

use App\Contracts\Database\CreditCardRepositoryInterface;
use App\Contracts\DataProviders\CreditCardDataProviderInterface;
use App\Contracts\ETLInterface;
use App\Contracts\Transformers\CreditCardTransformerInterface;
use Illuminate\Console\Command;

class CreditCardsUpdate extends Command implements ETLInterface
{
    public function __construct(
        private CreditCardDataProviderInterface $extractor,
        private CreditCardTransformerInterface $transformer,
        private CreditCardRepositoryInterface $loader,
    )
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'credit-cards:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update credit cards data from 3rd party API.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating credit cards data...');
        $data = $this->extractData();
        $this->info('Data extracted. Transforming...');
        $transformed = $this->transformData($data);
        $this->info('Data transformed. Loading...');
        $this->loadData($transformed);
        $this->info('Data loaded successfully.');

        return 0;
    }

    public function extractData(): array
    {
        return $this->extractor->fetchCreditCardData();
    }

    public function transformData(array $data): array
    {
        return $this->transformer->transformBulk($data);
    }

    public function loadData(array $data): void
    {
        $this->loader->storeOrUpdateBulk($data);
    }
}
