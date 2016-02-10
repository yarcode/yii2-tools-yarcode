<?php
namespace yarcode\base\behaviors;

use yii\db\Expression;

class TimestampBehavior extends \yii\behaviors\TimestampBehavior
{
    public $createdAtAttribute = 'createdAt';
    public $updatedAtAttribute = 'updatedAt';

    public function init()
    {
        parent::init();

        if (empty($this->value)) {
            $this->value = new Expression('NOW()');
        }
    }
}