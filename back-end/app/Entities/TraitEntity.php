<?php


namespace App\Entities;

use Carbon\Carbon;

/**
 * Trait TraitEntity
 * @package App\Entities
 */
trait TraitEntity
{
    /**
     * @Doctrine\ORM\Mapping\Column(type="datetime", nullable=true)
     */
    protected $created;

    /**
     * @Doctrine\ORM\Mapping\Column(type="datetime", nullable=true)
     */
    protected $updated;

    /**
     * @Doctrine\ORM\Mapping\PrePersist
     */
    public function prePersist()
    {
        $this->created = Carbon::now()->utc();
        $this->updated = Carbon::now()->utc();
    }
}
