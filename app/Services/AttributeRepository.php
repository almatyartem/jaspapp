<?php

namespace App\Services;

use App\Models\Attribute;
use App\Models\Entity;
use App\Models\Type;

class AttributeRepository
{
    public function createAttribute(Entity $entity, Type $type, string $name, array $properties = null) : Attribute
    {
        $attribute = new Attribute();
        $attribute->entity()->associate($entity);
        $attribute->type()->associate($type);
        $attribute->name = $name;
        $attribute->properties = $properties;
        $attribute->save();

        return $attribute;
    }

    public function updateAttribute(Attribute $attribute, Type $type, string $name, array $properties = null) : Attribute
    {
        $attribute->type()->associate($type);
        $attribute->name = $name;
        $attribute->properties = $properties;
        $attribute->save();

        return $attribute;
    }

    public function deleteAttribute(Attribute $attribute) : bool
    {
        return $attribute->delete();
    }
}
