<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace YarCode\Yii2\Kernel;

use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

class Kernel extends Component implements BootstrapInterface
{
    /** @var KernelPlugin[] */
    protected $plugins = [];

    public function bootstrap($app)
    {
        static::getInstance();
    }

    /**
     * @return static
     * @throws \yii\base\InvalidConfigException
     */
    public static function getInstance()
    {
        return \Yii::$app->get('kernel');
    }

    /**
     * @param array $config
     */
    public function setPlugins($config)
    {
        if (!is_array($config)) {
            throw new \LogicException("Plugins configuration must be an array");
        }

        foreach ($config as $pluginClassName) {
            $this->registerPlugin($pluginClassName);
        }
    }

    /**
     * @param string $config
     * @throws InvalidConfigException
     */
    public function registerPlugin($config)
    {
        $plugin = \Yii::createObject($config);

        if (!$plugin instanceof KernelPlugin) {
            throw new \LogicException("Wrong plugin configuration");
        }

        $className = get_class($plugin);

        if (isset($this->plugins[$className])) {
            return;
        }

        $plugin->kernel = $this;
        $this->plugins[$className] = $plugin;
        $this->plugins[$className]->bootstrap();
    }

    /**
     * @param $class
     * @return KernelPlugin
     */
    public function getPlugin($class)
    {
        $plugin = ArrayHelper::getValue($this->plugins, $class);

        if (null === $plugin) {
            throw new \LogicException("Unknown plugin: {$class}");
        }

        return $plugin;
    }

}