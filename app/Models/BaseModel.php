<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
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
