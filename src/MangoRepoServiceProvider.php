<?php

namespace LaraChimp\MangoRepo;

use Illuminate\Support\ServiceProvider as BaseProvider;
use LaraChimp\MangoRepo\Contracts\RepositoryInterface as RepositoryContract;

class MangoRepoServiceProvider extends BaseProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Make sure we are running in console
        if ($this->app->runningInConsole()) {
            // Register Commands.
            $this->commands([
                Console\MakeCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRepositories();
    }


    /**
     * Boot Repositories when resolving them.
     *
     * @return void
     */
    protected function registerRepositories()
    {
        $this->app->resolving(function ($repo) {
            // This is a repo.
            if ($repo instanceof RepositoryContract) {
                // Boot the Repository.
                $repo->boot();
            }
        });
    }
}
