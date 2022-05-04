<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Providers;

use Egal\Model\Exceptions\LoadModelImpossiblyException;
use Egal\Model\ModelManager;
use Illuminate\Support\ServiceProvider;

class DebugModelServiceProvider extends ServiceProvider
{
    public string $class;
    public bool $debugMode;
    public string $dir;

    public function __construct($app)
    {
        parent::__construct($app);
        $this->setDir();
        $this->setDebugModel();
        $this->scanModels($this->dir);
    }

    protected function setDir()
    {
        $this->dir = env('DEBUG_MODELS_ROOT');
    }

    protected function setDebugModel()
    {
        $this->debugMode = env('DEBUG_MODELS_INCLUDE', false);
    }

    protected function scanModels(?string $dir = null): void
    {
        $baseDir = base_path('app/DebugModels/');
        $dir = $dir ?? $baseDir;

        $modelsNamespace = 'App\DebugModels\\';

        foreach (scandir($dir) as $dirItem) {
            $itemPath = str_replace('//', '/', $dir . '/' . $dirItem);

            if ($dirItem === '.' || $dirItem === '..') {
                continue;
            }

            if (is_dir($itemPath)) {
                $this->scanModels($itemPath);
            }

            if (!str_contains($dirItem, '.php')) {
                continue;
            }

            $classShortName = str_replace('.php', '', $dirItem);

            if (!preg_match("/^[a-z]+(Debug)$/i", $classShortName)) {
                continue;
            }

            $class = str_replace($dir, '', $itemPath);
            $class = str_replace($dirItem, $classShortName, $class);
            $class = str_replace('/', '\\', $class);

            $this->class = $modelsNamespace . $class;
        }
    }

    /**
     * @return void
     * @throws LoadModelImpossiblyException
     */
    public
    function register(): void
    {
        if ($this->debugMode) {
            ModelManager::loadModel($this->class);
            $this->commands([]);
        }
    }
}
