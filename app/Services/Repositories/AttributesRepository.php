<?php

namespace App\Services\Repositories;

use App\Models\Attribute;
use App\Models\BaseModel;
use App\Models\Entity;
use App\Models\Type;
use Illuminate\Pagination\LengthAwarePaginator;

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

    protected function getModel(): BaseModel
    {
        return new Attribute();
    }
}
