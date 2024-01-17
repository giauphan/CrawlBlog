<?php

namespace Giauphan\CrawlBlog;

use Illuminate\Support\ServiceProvider;

class CrawlBlogDataServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            Commands\CrawlBlogData::class,
            Commands\MakeCrawlBlogCommand::class,
        ]);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');
        $this->publishes([
            __DIR__.'/Commands' => app_path('Console/Commands'),
        ], 'command');
    }
}
