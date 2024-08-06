<?php

namespace App\Services\Repositories;

use App\Models\BaseModel;
use App\Models\Type;

readonly class TypesRepository extends BaseRepository
{
    public function create(string $name, string $baseType) : Type
    {
        $type = new Type();
        $type->name = $name;
        $type->base_type = $baseType;
        $type->save();

        return $type;
    }

    public function update(Type $type, string $name, string $baseType) : Type
    {
        $type->name = $name;
        $type->base_type = $baseType;
        $type->save();

        return $type;
    }

    protected function getModel(): BaseModel
    {
        return new Type();
    }
}
