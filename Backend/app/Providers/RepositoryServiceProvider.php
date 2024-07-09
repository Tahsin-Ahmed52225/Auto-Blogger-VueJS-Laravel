<?php

namespace App\Providers;

use App\Interfaces\{AuthInterface,UserInterface};
use App\Repositories\{AuthRepository,UserRepository};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Custom repository and interface binding
     */
    public $bindings = [
        AuthInterface::class => AuthRepository::class,
        UserInterface::class => UserRepository::class,
        // PostInterface::class => PostRepository::class,
        // CategoryInterface::class => CategoryRepository::class,
    ];

    public function register()
    {
    }
}
