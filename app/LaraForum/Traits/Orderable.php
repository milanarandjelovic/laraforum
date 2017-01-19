<?php

namespace App\LaraForum\Traits;

trait Orderable
{
    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}