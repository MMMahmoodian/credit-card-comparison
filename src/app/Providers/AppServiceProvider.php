<?php

namespace App\Providers;

use App\Contracts\Database\CreditCardRepositoryInterface;
use App\Contracts\DataProviders\CreditCardDataProviderInterface;
use App\Contracts\Transformers\CreditCardTransformerInterface;
use App\Services\Database\CreditCardRepository;
use App\Services\DataProviders\FinanceAdsDataProvider;
use App\Services\Transformers\FinanceAdsCreditCardTransformer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerCreditCardClasses();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    private function registerCreditCardClasses()
    {
        $this->app->bind(CreditCardDataProviderInterface::class, FinanceAdsDataProvider::class);
        $this->app->bind(CreditCardTransformerInterface::class, FinanceAdsCreditCardTransformer::class);
        $this->app->bind(CreditCardRepositoryInterface::class, CreditCardRepository::class);
    }
}
