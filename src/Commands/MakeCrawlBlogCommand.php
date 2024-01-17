<?php

namespace Giauphan\CrawlBlog\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeCrawlBlogCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crawl-blog {name : The name of the crawl blog class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new crawl blog class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'CrawlBlogData';

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return $this->laravel->getNamespace();
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/CrawlBlogData.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return "{$rootNamespace}\CrawlBlog";
    }
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        parent::handle();
        $this->info('Crawl blog class created successfully.');
    }

    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }
}
