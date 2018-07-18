<?php
/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2018-07
 */

namespace Runner\LaravelFsm;

trait Stateful
{
    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->{$this->stateKey};
    }

    /**
     * @param string $state
     */
    public function setState(string $state): void
    {
        $this->{$this->stateKey} = $state;

        $this->save();
    }
}
