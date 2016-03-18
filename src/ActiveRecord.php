<?php
namespace yarcode\base;

use yarcode\base\helpers\DateTimeHelper;
use yii\helpers\VarDumper;

/**
 * Class ActiveRecord
 * @package yarcode\base
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * @param bool $runValidation
     * @param array|null $attributeNames
     * @return true
     */
    public function trySave($runValidation = true, $attributeNames = null)
    {
        if (false === $this->save($runValidation, $attributeNames)) {
            throw new \LogicException("Saving error: " . VarDumper::dumpAsString($this->getErrors()));
        }
        return true;
    }

    /**
     * @param bool $runValidation
     * @param array|null $attributeNames
     * @return true
     */
    public function tryUpdate($runValidation = true, $attributeNames = null)
    {
        if (false === $this->update($runValidation, $attributeNames)) {
            throw new \LogicException("Saving error: " . VarDumper::dumpAsString($this->getErrors()));
        }
        return true;
    }

    /**
     * @param bool $runValidation
     * @param array|null $attributeNames
     * @return true
     */
    public function tryInsert($runValidation = true, $attributeNames = null)
    {
        if (false === $this->insert($runValidation, $attributeNames)) {
            throw new \LogicException("Saving error: " . VarDumper::dumpAsString($this->getErrors()));
        }
        return true;
    }

    /**
     * Converts model data to array of the params suitable for use in templates
     *
     * @return array
     */
    public function getTemplateParams() {
        return ['model' => $this];
    }

    /**
     * @param string $attribute Attribute name
     * @param \DateTimeZone $tz Timezone of the stored value
     * @throws \BadMethodCallException
     * @return \DateTime
     */
    public function getAttributeDateTime($attribute, \DateTimeZone $tz = null)
    {
        if (empty($tz)) {
            $tz = DateTimeHelper::getUtc();
        }
        $dt = \DateTime::createFromFormat(DateTimeHelper::FORMAT_SQL_DATETIME, $this->getAttribute($attribute), $tz);
        if ($dt == false) {
            throw new \BadMethodCallException('Cannot create datetime from attribute "' . $attribute . '"');
        }
        return $dt;
    }
}
