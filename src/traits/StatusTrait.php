<?php
namespace yarcode\base\traits;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Trait for default status column
 *
 * Class StatusTrait
 * @package common\traits
 *
 * @property int $status
 * @property string|null $statusLabel
 */
trait StatusTrait
{
    /**
     * @param null $default
     * @return string|null
     */
    public function getStatusLabel($default = null)
    {
        return ArrayHelper::getValue(static::getStatusLabels(), $this->status, $default);
    }

    /**
     * @throws InvalidConfigException
     * @return array|null
     */
    public static function getStatusLabels()
    {
        throw new InvalidConfigException('Please define static getStatusLabels() in your class ' . get_called_class());
    }
}