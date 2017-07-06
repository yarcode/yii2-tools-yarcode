<?php

namespace YarCode\Yii2\Traits;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Trait for default type column
 *
 * Class StatusTrait
 * @package YarCode\Yii2\Traits
 *
 * @property string|null $typeLabel
 */
trait TypeLabelTrait
{
    /**
     * @param null $default
     * @return string|null
     */
    public function getTypeLabel($default = null)
    {
        return ArrayHelper::getValue(static::getTypeLabels(), static::getTypeAttributeName(), $default);
    }

    /**
     * @throws InvalidConfigException
     * @return array|null
     */
    public static function getTypeLabels()
    {
        throw new InvalidConfigException('Please override ' . __METHOD__);
    }

    /**
     * @return string
     */
    public static function getTypeAttributeName()
    {
        return 'type';
    }
}
