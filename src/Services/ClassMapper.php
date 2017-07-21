<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace YarCode\Yii2\Services;

class ClassMapper
{
    /** @var string[] */
    protected $classMap = [];

    /**
     * @return static
     */
    public static function getInstance()
    {
        /** @var static $obj */
        $obj = \Yii::$container->get(self::class);
        return $obj;
    }

    /**
     * @param array $classMap
     */
    public function setClassMap($classMap)
    {
        $this->classMap = array_merge($this->classMap, $classMap);
    }

    public function createObject($className)
    {
        $className = $this->resolve($className);
        return new $className;
    }

    /**
     * @param $className
     * @return string
     */
    public function resolve($className)
    {
        if (!isset($this->classMap[$className])) {
            return $className;
        } else {
            return $this->classMap[$className];
        }
    }
}