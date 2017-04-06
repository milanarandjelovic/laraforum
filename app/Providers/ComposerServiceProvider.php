<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\LaraForum\ViewComposers\ForumSidebarComposer;

class ComposerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'forum.channels.partials.forum-sidebar',
            ForumSidebarComposer::class
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
