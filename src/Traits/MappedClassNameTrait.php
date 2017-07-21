<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace YarCode\Yii2\Traits;

use YarCode\Yii2\Services\ClassMapper;
use yii\base\Component;

/**
 * Trait MappedClassNameTrait
 * @package YarCode\Yii2\Traits
 *
 * @mixin Component
 */
trait MappedClassNameTrait
{
    /**
     * @return string
     */
    public static function className()
    {
        /** @var ClassMapper $mapper */
        $mapper = \Yii::$container->get(ClassMapper::class);
        return $mapper->resolve(get_called_class());
    }
}