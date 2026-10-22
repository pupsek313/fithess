<?php

namespace App\Providers;

use App\Contracts\SmsSender;
use App\Models\User;
use App\Services\Sms\LogSmsSender;
use App\Services\Sms\NullSmsSender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // какую реализацию SmsSender выдавать, выбирается настройкой из .env
        $this->app->singleton(SmsSender::class, function () {
            return match (config('services.sms.driver')) {
                'log'   => new LogSmsSender(),
                default => new NullSmsSender(),
            };
        });
    }

    public function boot(): void
    {
        Paginator::defaultView('pagination.custom');
        Model::preventLazyLoading(! app()->isProduction());

        // в админ-панель допускаются admin и editor
        Gate::define('admin-panel', fn (User $user) => in_array($user->role, ['admin', 'editor']));
    }
}