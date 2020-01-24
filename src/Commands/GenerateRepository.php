<?php


namespace bigpaulie\repository\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Class GenerateRepository
 * @package bigpaulie\repository\Commands
 */
class GenerateRepository extends Command
{
    protected $signature = 'repository:generate {name : The name of your model i.e. "User"}';
    protected $description = 'Generate a new repository for a model';

    /**
     * @var string
     */
    private $packageBaseDir = __DIR__. '/../../';

    public function handle()
    {
        /** @var string $name */
        $name = $this->argument('name');
        /** @var string $repositoryClassName */
        $repositoryClassName = $this->generateRepositoryClassName($name);
        if (!empty($repositoryClassName)) {
            /** @var string $repositoryNamespace */
            $repositoryNamespace = $this->generateRepositoryNamespace();
            if ($this->checkRepositoryDirectory()) {
                $this->generateRepository($repositoryClassName, $repositoryNamespace);
            }
        }
    }

    /**
     * @param string $name
     * @return string|null
     */
    private function generateRepositoryClassName(string $name):?string
    {
        /** @var string $modelNamespace */
        $modelNamespace = config('repository.model_namespace') . ucfirst($name);
        if (!class_exists($modelNamespace)) {
            $this->error('Class not found '. $modelNamespace);
            return null;
        }

        /** @var string $repositoryName */
        $repositoryName = ucfirst($name) . 'Repository';
        return $repositoryName;
    }

    /**
     * @return string
     */
    private function generateRepositoryNamespace():string
    {
        return Str::replaceLast('\\', '', config('repository.repository_namespace'));
    }

    /**
     * @param string $repositoryName
     * @param string $repositoryNamespace
     */
    private function generateRepository(string $repositoryName, string $repositoryNamespace)
    {
        /** @var string $stubPath */
        $stubPath = realpath($this->packageBaseDir . '/resources/stubs/repository.stub');
        /** @var string $stubContents */
        $stubContents = File::get($stubPath);
        $stubContents = Str::replaceFirst('{{repository_name}}', $repositoryName, $stubContents);
        $stubContents = Str::replaceFirst('{{repository_namespace}}', $repositoryNamespace, $stubContents);

        /** @var string $repositoryTempPath */
        $repositoryTempPath = '/tmp/' . time() . '.stub';
        /** @var string $repositoryDestPath */
        $repositoryDestPath = config('repository.repository_path') . '/' . $repositoryName . '.php';

        File::put($repositoryTempPath, $stubContents);

        if(File::copy($repositoryTempPath, $repositoryDestPath)) {
            File::delete($repositoryTempPath);
            $this->info('Repository created.');
        }
    }

    /**
     * @return bool
     */
    private function checkRepositoryDirectory():bool
    {
        /** @var string $repositoryPath */
        $repositoryPath = config('repository.repository_path');
        if (!File::exists($repositoryPath)) {
            return File::makeDirectory($repositoryPath, 755);
        }
        return true;
    }
}
