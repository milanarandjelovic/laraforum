<?php

namespace App\LaraForum\Repositories;

use App\Models\Country;
use App\LaraForum\Repositories\Eloquent\Repository;

class CountryRepository extends Repository
{

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Country::class;
    }
}
