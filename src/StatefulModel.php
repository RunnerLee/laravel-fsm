<?php
/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2018-07
 */

namespace Runner\LaravelFsm;

use Illuminate\Database\Eloquent\Model;
use Runner\Heshen\Contracts\StatefulInterface;

abstract class StatefulModel extends Model implements StatefulInterface
{
    /**
     * @var string
     */
    protected $stateKey = 'status';

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->{$this->stateKey};
    }

    /**
     * @param string $state
     *
     * @throws \Throwable
     */
    public function setState(string $state): void
    {
        $this->getConnection()->transaction(
            function () use ($state) {
                $this->{$this->stateKey} = $state;

                if (!$this->exists) {
                    return $this->save();
                }

                if (false === $this->fireModelEvent('saving')
                    || false === $this->fireModelEvent('updating')
                ) {
                    return false;
                }

                if ($this->usesTimestamps()) {
                    $this->updateTimestamps();
                }

                $query = $this->newModelQuery()->where($this->stateKey, $this->original[$this->stateKey]);
                if (0 === $this->setKeysForSaveQuery($query)->update($this->getDirty())) {
                    return false;
                }

                $this->fireModelEvent('updated', false);
                $this->syncChanges();
                $this->finishSave([]);

                return true;
            }
        );
    }
}
