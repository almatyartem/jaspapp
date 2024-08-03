<?php

namespace App\Services;

use App\Models\Type;

class TypeRepository
{
    public function createType(string $name, string $baseType) : Type
    {
        $type = new Type();
        $type->name = $name;
        $type->base_type = $baseType;
        $type->save();

        return $type;
    }

    public function updateType(Type $type, string $name, string $baseType) : Type
    {
        $type->name = $name;
        $type->base_type = $baseType;
        $type->save();

        return $type;
    }

    public function deleteType(Type $type) : bool
    {
        return $type->delete();
    }
}
