<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::defaultView('pagination.custom');
        //Model::preventLazyLoading(! app()->isProduction());

        // в админ-панель допускаются admin и editor
        Gate::define('admin-panel', fn (User $user) => in_array($user->role, ['admin', 'editor']));
    }
}