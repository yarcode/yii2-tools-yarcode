<?php

namespace yarcode\base\traits;

/**
 * Class LoopTrait
 * @package yarcode\base\traits
 *
 * Trait for easier making spool console commands
 * All what you need:
 * 1. Add trait to your console controller
 * 2. Setup cron to run spool command
 *  /var/www/{your_site_dir}/yii {your_controller-name}/spool {methodName} 1000 50
 *
 * where {methodName} like actionProcessOne
 *
 */
trait SpoolTrait
{
    public function actionSpool($methodName, $loopLimit = 1000, $chunkSize = 50)
    {
        if (!method_exists($this, $methodName)) {
            throw new \InvalidArgumentException("Method {$methodName} not exist");
        }

        set_time_limit(0);
        for ($i = 1; $i < $loopLimit; $i++) {
            for ($j = 1; $j < $chunkSize; $j++) {
                $r = call_user_func([$this, $methodName]);
                if (!$r) {
                    break 1;
                }
            }
            sleep(1);
        }
    }
}
