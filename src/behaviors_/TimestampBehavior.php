<?php
namespace YarCode\Yii2\Behaviors;

use yii\db\Expression;

class TimestampBehavior extends \yii\behaviors\TimestampBehavior
{
    public function init()
    {
        parent::init();

        if (empty($this->value)) {
            $this->value = new Expression('NOW()');
        }
    }
}