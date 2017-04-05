<?php

namespace App\LaraForum\Traits;

trait Orderable
{

    /**
     * @param $query
     * @return mixed
     */
    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}