<?php
/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2018-07
 */

namespace Runner\LaravelFsm;

use Illuminate\Support\Facades\Facade;

class FsmFacade extends Facade
{
    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'heshen.factory';
    }
}
