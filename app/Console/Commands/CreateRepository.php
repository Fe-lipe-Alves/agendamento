<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CreateRepository extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new class and interface for the new repository';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * Execute the console command.
     *
     * @return false|void
     * @throws FileNotFoundException
     */
    public function handle()
    {
        if (parent::handle() === false && ! $this->option('force')) {
            return false;
        }

        if(!$this->option('interface')) {
            $this->createInterface();
        }
    }

    /**
     * Create a interface for the repository.
     *
     * @return void
     */
    protected function createInterface()
    {
        $interface = str_replace('Repository', '', Str::studly($this->argument('name')));

        $this->call('make:ContractRepository', [
            'name' => "{$interface}Interface"
        ]);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->resolveStubPath('/Stubs/GenericRepository.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__.$stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Repositories';
    }

    /**
     * Build the class with the given name.
     *
     * @param $name
     * @return string
     * @throws FileNotFoundException
     */
    protected function buildClass($name)
    {
        $replace = [];

        $replace = $this->buildModelReplacements($replace, $name);

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    /**
     * Build the model replacement values.
     *
     * @param array $replace
     * @param $name
     * @return array
     */
    protected function buildModelReplacements(array $replace, $name)
    {
        $modelName = $this->getModelName();
        $modelClass = $this->parseModel($modelName);

        if (! class_exists($modelClass)) {
            if ($this->confirm("A {$modelClass} model does not exist. Do you want to generate it?", true)) {
                $this->call('make:model', ['name' => $modelClass]);
            }
        }

        $interfaceName = $this->option('interface') ?? class_basename($modelClass).'Interface';

        return array_merge($replace, [
            '{{ className }}' => class_basename($name),
            '{{ interfaceName }}' => $interfaceName,
            '{{ model }}' => class_basename($modelClass),
        ]);
    }

    /**
     * Get the model class name.
     *
     * @return array|bool|string|null
     */
    public function getModelName()
    {
        if($this->option('model'))
            return $this->option('model');

        return str_replace('Repository', '', $this->argument('name'));
    }

    /**
     * Get the fully-qualified model class name.
     *
     * @param string $model
     * @return string
     *
     * @throws InvalidArgumentException
     */
    protected function parseModel(string $model)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $model)) {
            throw new InvalidArgumentException('Model name contains invalid characters.');
        }

        return $this->qualifyModel($model);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'Model that the repository will operate'],
            ['interface', 'i', InputOption::VALUE_OPTIONAL, 'Interface that the repository will implement'],
        ];
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the repository.'],
        ];
    }
}
