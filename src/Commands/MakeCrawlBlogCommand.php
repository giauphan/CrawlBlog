<?php

namespace Giauphan\CrawlBlog\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeSettingCommand extends Command
{
    protected $name = 'make:crawl-blog';

    protected $description = 'Create a new crawl blog class';

    protected $type = 'crawl-blog';

    protected $files;
    /**
     * The signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crawl-blog {name : The name of the crawl blog class}';

    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/CrawlBlogData.stub');
    }

    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "{$rootNamespace}\Console\Commands";
    }

    public function handle()
    {
        $name = Str::studly($this->argument('name'));

        $path = $this->getPath($name);

        // Check if the class already exists
        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        // Create the crawl blog class
        $this->makeDirectory($path);
        $this->files->put($path, $this->buildClass($name));

        $this->info($this->type . ' created successfully.');
        $this->line("<info>Created Crawl Blog Class:</info> $name");
    }

    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . '.php';
    }

    protected function buildClass($name): string
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)
            ->replaceClass($stub, $name);
    }
}
