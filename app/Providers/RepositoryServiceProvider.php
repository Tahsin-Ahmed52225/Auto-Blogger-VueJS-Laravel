<?php

namespace App\Providers;

use App\Interfaces\{UserInterface, PostInterface, CategoryInterface, AuthInterface};
use App\Repositories\{UserRepository, PostRepository, CategoryRepository, AuthRepository};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Custom repository and interface binding
     */
    public $bindings = [
        UserInterface::class => UserRepository::class,
        PostInterface::class => PostRepository::class,
        CategoryInterface::class => CategoryRepository::class,
        AuthInterface::class => AuthRepository::class,
    ];

    public function register()
    {
    }
}
