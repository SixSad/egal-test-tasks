<?php

declare(strict_types=1);

namespace App\Helpers;

use Egal\Core\Exceptions\ModelNotFoundException;
use Egal\Model\Exceptions\LoadModelImpossiblyException;
use Egal\Model\Metadata\ModelMetadata;

class ModelManager
{
    /**
     * @var \Egal\Model\Metadata\ModelMetadata[]
     */
    protected array $modelsMetadata = [];
    private array $config;
    private string $nameSpace;

    public function __construct()
    {
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

        $updatedPath = array_map(fn ($item) => ucfirst($item), $splicedDirPath);

        $this->nameSpace = implode('\\', $updatedPath);
    }

    public static function getInstance(): ModelManager
    {
        return app(self::class);
    }

    /**
     * @return \Egal\Model\Metadata\ModelMetadata[]
     */
    public function getModelsMetadata(): array
    {
        return $this->modelsMetadata;
    }

    public static function actionGetAllModelsMetadata(): array
    {
        $result = [];
        foreach (self::getInstance()->modelsMetadata as $modelName => $modelMetadata) {
            $result[$modelName] = $modelMetadata->toArray();
        }

        return $result;
    }

    public static function getModelMetadata(string $model): ModelMetadata
    {
        if (class_exists($model)) {
            return self::getInstance()->modelsMetadata[get_class_short_name($model)];
        }

        if (isset(self::getInstance()->modelsMetadata[$model])) {
            return self::getInstance()->modelsMetadata[$model];
        }

        throw ModelNotFoundException::make($model);
    }

    public static function loadModel(string $class): void
    {
        $instance = static::getInstance();
        $classShortName = get_class_short_name($class);

        if (isset($instance->modelsMetadata[$classShortName])) {
            throw new LoadModelImpossiblyException();
        }

        $instance->modelsMetadata[$classShortName] = new ModelMetadata($class);
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

            $class = str_replace($baseDir, '', $itemPath);
            $class = str_replace($dirItem, $classShortName, $class);
            $class = str_replace('/', '\\', $class);
            $class = $modelsNamespace . $class;
            $this->modelsMetadata[$classShortName] = new ModelMetadata($class);
        }
    }
}
