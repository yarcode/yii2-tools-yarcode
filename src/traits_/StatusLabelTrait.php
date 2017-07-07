<?php

namespace YarCode\Yii2\Traits;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Trait for default status column
 *
 * Class StatusTrait
 * @package YarCode\Yii2\Traits
 *
 * @property string|null $statusLabel
 */
trait StatusLabelTrait
{
    /**
     * @param null $default
     * @return string|null
     */
    public function getStatusLabel($default = null)
    {
        return ArrayHelper::getValue(static::getStatusLabels(), static::getStatusAttributeName(), $default);
    }

    /**
     * @throws InvalidConfigException
     * @return array|null
     */
    public static function getStatusLabels()
    {
        throw new InvalidConfigException('Please override ' . __METHOD__);
    }

    /**
     * @return string
     */
    public static function getStatusAttributeName()
    {
        return 'status';
    }
}