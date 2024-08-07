<?php

namespace App\Services\Repositories;

use App\Models\Base\BaseModel;
use App\Models\Interfaces\TunedModel;
use App\Models\Space;
use App\Models\User;

readonly class SpacesRepository extends BaseRepository
{
    public function create(string $name) : Space
    {
        $space = new Space();
        $space->name = $name;
        $space->save();

        return $space;
    }

    public function update(Space $space, string $name) : Space
    {
        $space->name = $name;
        $space->save();

        return $space;
    }

    protected function getModel(): TunedModel
    {
        return new Space();
    }
}
