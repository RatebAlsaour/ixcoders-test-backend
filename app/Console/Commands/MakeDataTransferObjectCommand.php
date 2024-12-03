<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Str;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class MakeDataTransferObjectCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:dto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new DTOs class for model';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'DTOs';

    /**
     * The name of class being generated.
     *
     * @var string
     */
    private $className;

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        $this->setClassName();

        $path = $this->getPath($this->className);

        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($this->className));

        $this->info($this->type.' created successfully.');

        $this->line("<info>Created $this->type :</info> $this->className");
    }

    /**
     * Parse the name and format according to the root namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function parseName($name)
    {
        $rootNamespace = $this->laravel->getNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        if (str_contains($name, '/')) {
            $name = str_replace('/', '\\', $name);
        }

        return $this->parseName($this->getDefaultNamespace(trim($rootNamespace, '\\')).'\\'.$name);
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return base_path().'/'.str_replace('\\', '/', $name).'.php';
    }

    /**
     *
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../../../stubs/dto.stub';
    }

    /**
     * Set class name
     *
     * @return  void
     */
    private function setClassName()
    {
        $name = ucfirst(Str::camel($this->argument('name')));

        $this->name = $name;

        $this->className = $this->parseName($name);
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\App\Http\DTOs';
    }


    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        if(!$this->argument('name')){
            throw new InvalidArgumentException("Missing required argument model name");
        }

        $stub = parent::replaceClass($stub, $name);

        $stub = str_replace('{{ class }}', $this->argument('name'), $stub);

        return $stub;
    }


    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the DTOs class'],
        ];
    }

}
