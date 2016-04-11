<?php

namespace Code\Providers;

use Illuminate\Support\ServiceProvider;


class CodeRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \Code\Repositories\ClientRepository::class,
            \Code\Repositories\ClientRepositoryEloquent::class
        );
        $this->app->bind(
            \Code\Repositories\ProjectRepository::class,
            \Code\Repositories\ProjectRepositoryEloquent::class
        );
        $this->app->bind(
            \Code\Repositories\ProjectNoteRepository::class,
            \Code\Repositories\ProjectNoteRepositoryEloquent::class
        );
        $this->app->bind(
            \Code\Repositories\UserRepository::class,
            \Code\Repositories\UserRepositoryEloquent::class
        );
    }
}
