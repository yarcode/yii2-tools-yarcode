<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace yarcode\base\traits;

use Carbon\Carbon;
use yii\base\Model;

/**
 * Class CarbonModelTrait
 * @package common\components\traits
 *
 * @mixin Model
 */
trait CarbonModelTrait
{
    /**
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
            }
            elseif (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $value)) {
                return Carbon::createFromFormat('Y-m-d', $value)->startOfDay();
            } else {
                return Carbon::createFromFormat($this->getCarbonFormat($attribute), $value);
            }
        }
    }

    public function getCarbonFormat($attribute)
    {
        return 'Y-m-d H:i:s';
    }
}