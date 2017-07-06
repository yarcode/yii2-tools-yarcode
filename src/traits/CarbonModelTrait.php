<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace YarCode\Yii2\Traits;

use Carbon\Carbon;
use yii\base\Model;

/**
 * Class CarbonModelTrait
 * @package YarCode\Yii2\Traits
 *
 * @mixin Model
 */
trait CarbonModelTrait
{
    /**
     * Returns attribute value as a Carbon instance
     * @param $attribute
     * @return Carbon
     */
    public function getCarbonAttribute($attribute)
    {
        $value = $this->$attribute;
        if (!empty($value)) {
            if ($value instanceof Carbon) {
                return $value;
            }
            if (is_numeric($value)) {
                return Carbon::createFromTimestamp($value);
            } elseif (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $value)) {
                return Carbon::createFromFormat('Y-m-d', $value)->startOfDay();
            } else {
                return Carbon::createFromFormat($this->getCarbonFormat($attribute), $value);
            }
        }
    }

    /**
     * Returns datetime format for a specified attribute
     * @param string $attribute
     * @return string
     */
    public function getCarbonFormat($attribute)
    {
        return 'Y-m-d H:i:s';
    }
}