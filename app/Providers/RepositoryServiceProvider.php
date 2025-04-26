<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\SystemSetting\SystemSettingInterface;
use App\Repositories\SystemSetting\SystemSettingRepository;
use App\Repositories\ExpenseCategory\ExpenseCategoryInterface;
use App\Repositories\ExpenseCategory\ExpenseCategoryRepository;
use App\Repositories\Unit\UnitInterface;
use App\Repositories\Unit\UnitRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            SystemSettingInterface::class,
            SystemSettingRepository::class
        );
        $this->app->bind(
            UnitInterface::class,
            UnitRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
