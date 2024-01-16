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
        ], 'crawl-blog-data-migrations');
    }
}
