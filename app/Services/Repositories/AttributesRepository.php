<?php

namespace App\Services\Repositories;

use App\Models\Attribute;
use App\Models\Base\BaseModel;
use App\Models\Entity;
use App\Models\Interfaces\TunedModel;
use App\Models\Type;

readonly class AttributesRepository extends BaseRepository
{
    public function create(Entity $entity, Type $type, string $name, array $properties = null) : Attribute
    {
        $attribute = new Attribute();
        $attribute->entity()->associate($entity);
        $attribute->type()->associate($type);
        $attribute->name = $name;
        $attribute->properties = $properties;
        $attribute->save();

        return $attribute;
    }

    public function update(Attribute $attribute, Type $type, string $name, array $properties = null) : Attribute
    {
        $attribute->type()->associate($type);
        $attribute->name = $name;
        $attribute->properties = $properties;
        $attribute->save();

        return $attribute;
    }

    protected function getModel(): TunedModel
    {
        return new Attribute();
    }
}
