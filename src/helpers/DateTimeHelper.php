<?php
namespace yarcode\base\helpers;

use yii\base\Component;

class DateTimeHelper extends Component
{
    const FORMAT_SQL_DATETIME = 'Y-m-d H:i:s';
    const FORMAT_SQL_DATE = 'Y-m-d';
    const FORMAT_SQL_TIME = 'H:i:s';

    /**
     * @return \DateTimeZone
     */
    public static function getUtc()
    {
        return new \DateTimeZone('UTC');
    }

    /**
     * @param \DateTimeZone|null $tz
     * @return \DateTime
     */
    public static function getNow(\DateTimeZone $tz = null)
    {
        $result = new \DateTime('now');
        if (isset($tz)) {
            $result->setTimezone($tz);
        }
        return $result;
    }
}