<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Providers;

use Egal\Model\Metadata\ModelMetadata;
use Egal\Model\ModelManager;
use Illuminate\Support\ServiceProvider;

class DebugModelServiceProvider extends ServiceProvider
{
    protected array $models = [];
    private array $config;
    private string $nameSpace;

    public function __construct($app)
    {
        parent::__construct($app);
        $this->getConfig();
        $this->getNameSpace();
        $this->scanModels();
    }

    private function getConfig()
    {
        $this->config = config("debugModel");
    }

    private function getNameSpace(): void
    {
        $splicedDirPath = explode("/", $this->config['debugDir']);

        $updatedPath = array_map(fn($item) => ucfirst($item), $splicedDirPath);

        $this->nameSpace = implode('\\', $updatedPath);
    }

    protected function scanModels(?string $dir = null): void
    {
        $debugDir = $this->config['debugDir'];
        $baseDir = base_path($debugDir);
        $dir = $dir ?? $baseDir;

        $modelsNamespace = $this->nameSpace;

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
            $class = $modelsNamespace . $class;
            $this->models[] = $class;
        }
    }

    public function register(): void
    {
        if ($this->config['include']) {
            foreach ($this->models as $model) {
                ModelManager::loadModel($model);
            }
        }
    }
}
