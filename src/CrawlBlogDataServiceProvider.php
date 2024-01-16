<?php

namespace Giauphan\CrawlBlogData;

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
     
    }
}
