<?php

namespace App\Providers;

use App\Interfaces\{AuthInterface, RoleInterface, UserInterface};
use App\Repositories\{AuthRepository, RoleRepository, UserRepository};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Custom repository and interface binding
     */
    public $bindings = [
        AuthInterface::class => AuthRepository::class,
        UserInterface::class => UserRepository::class,
        RoleInterface::class => RoleRepository::class,
        // PostInterface::class => PostRepository::class,
        // CategoryInterface::class => CategoryRepository::class,
    ];

    public function register()
    {
    }
}
