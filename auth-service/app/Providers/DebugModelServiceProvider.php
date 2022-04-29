<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Providers;

use Egal\Model\Metadata\ModelMetadata;
use Egal\Model\ModelManager;
use Illuminate\Support\ServiceProvider;

class DebugModelServiceProvider extends ServiceProvider
{
    public string $class;
    public bool $include;
    public string $dir;

    public function __construct($app)
    {
        parent::__construct($app);
        $this->dir = env('DEBUG_MODELS_ROOT');
        $this->include = env('DEBUG_MODELS_INCLUDE', false);
        $this->scanModels($this->dir);
    }

    protected function scanModels(?string $dir = null): void
    {
        $baseDir = base_path('app/DebugModels/');

        if ($dir === null) {
            $dir = $baseDir;
        }

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
            $class = str_replace($dir, '', $itemPath);
            $class = str_replace($dirItem, $classShortName, $class);
            $class = str_replace('/', '\\', $class);
            $this->class = $modelsNamespace . $class;
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public
    function register(): void
    {
        if ($this->include) {
            ModelManager::loadModel($this->class);
            $this->commands([]);
        }
    }
}
