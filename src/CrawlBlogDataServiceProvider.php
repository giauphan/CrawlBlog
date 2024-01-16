<?php

namespace Giauphan\CrawlBlog;

use Illuminate\Support\ServiceProvider;

class CrawlBlogDataServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            Commands\CrawlBlogData::class,
        ]);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'giauphan-crawl-blog-migrations');
        $this->publishes([
            __DIR__.'/Commands' => app_path('Console/Commands'),
        ], 'giauphan-crawl-blog-command');
    }
}
