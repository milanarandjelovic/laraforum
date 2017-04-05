<?php

namespace App\LaraForum\Traits;

trait Dateable
{

    /**
     * Return diffForHumans for created_at.
     *
     * @param $date
     * @return string
     */
    public function getCreatedAtAttribute($date)
    {
        return $this->asDateTime($date)->diffForHumans();
    }

    /**
     * Return diffForHumans for updated_at.
     *
     * @param $date
     * @return string
     */
    public function getUpdatedAtAttribute($date)
    {
        return $this->asDateTime($date)->diffForHumans();
    }
}
