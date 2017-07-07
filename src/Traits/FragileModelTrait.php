<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace YarCode\Yii2\Traits;

use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\helpers\VarDumper;

/**
 * Trait FragileActiveRecordTrait
 * @package YarCode\Yii2\Traits
 *
 * @mixin ActiveRecord
 */
trait FragileModelTrait
{
    /**
     * @param bool $runValidation
     * @param array|null $attributeNames
     * @return true
     * @throws Exception
     * @throws \LogicException
     */
    public function trySave($runValidation = true, $attributeNames = null)
    {
        if (false === $this->save($runValidation, $attributeNames)) {
            if ($this->hasErrors()) {
                throw new \LogicException('Model save failed due to validation errors: ' . VarDumper::dumpAsString($this->getErrors()));
            } else {
                $pdo = static::getDb()->pdo;
                throw new Exception('Model save failed', $pdo->errorInfo(), $pdo->errorCode());
            }
        }
        return true;
    }

    /**
     * @param bool $runValidation
     * @param array|null $attributeNames
     * @return true
     * @throws Exception
     * @throws \LogicException
     */
    public function tryUpdate($runValidation = true, $attributeNames = null)
    {
        if (false === $this->update($runValidation, $attributeNames)) {
            if ($this->hasErrors()) {
                throw new \LogicException('Model update failed due to validation errors: ' . VarDumper::dumpAsString($this->getErrors()));
            } else {
                $pdo = static::getDb()->pdo;
                throw new Exception('Model update failed', $pdo->errorInfo(), $pdo->errorCode());
            }
        }
        return true;
    }

    /**
     * @param bool $runValidation
     * @param array|null $attributeNames
     * @return true
     * @throws Exception
     * @throws \LogicException
     */
    public function tryInsert($runValidation = true, $attributeNames = null)
    {
        if (false === $this->insert($runValidation, $attributeNames)) {
            if ($this->hasErrors()) {
                throw new \LogicException('Model insert failed due to validation errors: ' . VarDumper::dumpAsString($this->getErrors()));
            } else {
                $pdo = static::getDb()->pdo;
                throw new Exception('Model insert failed', $pdo->errorInfo(), $pdo->errorCode());
            }
        }
        return true;
    }
}