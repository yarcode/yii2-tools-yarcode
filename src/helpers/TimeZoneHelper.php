<?php
/**
 * @author Valentin Konusov <rlng-krsk@yandex.ru>
 */

namespace yarcode\base\helpers;

use yii\base\Component;

/**
 * Class TimeZoneHelper
 * @package yarcode\base\helpers
 */
class TimeZoneHelper extends Component
{
    /**
     * Return UTC timezone object
     * 
     * @return \DateTimeZone
     */
    public static function getUtc()
    {
        return new \DateTimeZone('UTC');
    }

    /**
     * Return current application timezone object
     *
     * @return \DateTimeZone
     */
    public static function getAppTz()
    {
        return new \DateTimeZone(\Yii::$app->timeZone);
    }

    /**
     * Return new datetime object, converted to UTC timezone
     * 
     * @param \DateTime $date
     * @return $this
     */
    public static function toUtc(\DateTime $date)
    {
        $newDate = clone $date;
        return $newDate->setTimezone(static::getUtc());
    }

    /**
     * Return new datetime object, converted to application timezone
     * 
     * @param \DateTime $date
     * @return $this
     */
    public static function toApp(\DateTime $date)
    {
        $newDate = clone $date;
        return $newDate->setTimezone(static::getAppTz());
    }
    
}