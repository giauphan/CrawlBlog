<?php

namespace Giauphan\CrawlBlog\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

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
        return $this->resolveStubPath('/stubs/CrawlBlogData.stub');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return "{$rootNamespace}\Console\Commands";
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

    /**
     * Get the path to the class file.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        return $this->laravel['path'] . '/Console/Commands/' . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            ['DummyNamespace', 'DummyRootNamespace', 'NamespacedDummyUserModel'],
            [$this->getNamespace($name), $this->rootNamespace(), $this->userProviderModel()],
            $stub
        );

        return $this;
    }
}
