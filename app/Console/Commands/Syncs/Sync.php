<?php


namespace App\Console\Commands\Syncs;


abstract class Sync
{
    /**
     * @var array
     */
    protected $limits;

    public function __construct($limits = [])
    {
        $this->limits = $limits;
    }
}
