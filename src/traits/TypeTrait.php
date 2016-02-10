<?php
namespace yarcode\base\traits;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Trait for default type column
 *
 * Class StatusTrait
 * @package common\traits
 *
 * @property int $type
 * @property string|null $typeLabel
 */
trait TypeTrait
{
    /**
     * @param null $default
     * @return string|null
     */
    public function getStatusLabel($default = null)
    {
        return ArrayHelper::getValue(static::getTypeLabels(), $this->type, $default);
    }

    /**
     * @throws InvalidConfigException
     * @return array|null
     */
    public static function getTypeLabels()
    {
        throw new InvalidConfigException('Please define static getTypeLabels() in your class ' . get_called_class());
    }
}