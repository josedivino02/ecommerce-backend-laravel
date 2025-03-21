<?php

namespace App\Auth\Providers;

use App\Auth\Contracts\Repositories\UserRepositoryInterface;
use App\Auth\Contracts\Services\AuthServiceInterface;
use App\Auth\Repositories\UserRepository;
use App\Auth\Services\Auth\JwtAuthService;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\{DB, Date, URL};
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        $this->app->bind(
            AuthServiceInterface::class,
            JwtAuthService::class
        );
    }

    public function boot(): void
    {
        $this->setupLogViewer();
        $this->configModels();
        $this->configCommands();
        $this->configUrls();
        $this->configDate();
    }

    private function setupLogViewer(): void
    {
        LogViewer::auth(fn ($request) => $request->user()?->is_admin);
    }

    private function configModels(): void
    {
        Model::unguard();
        Model::shouldBeStrict();
    }

    private function configCommands(): void
    {
        DB::prohibitDestructiveCommands(
            app()->isProduction()
        );
    }

    private function configUrls(): void
    {
        URL::forceHttps(
            force: config('app.force_https')
        );
    }

    private function configDate(): void
    {
        Date::use(CarbonImmutable::class);
    }
}
