<?php

namespace App\Services\Repositories;

use App\Models\BaseModel;
use App\Models\Entity;
use App\Models\Relation;
use RelationTypeEnum;

readonly class RelationsRepository extends BaseRepository
{
   public function create(
       Entity $firstEntity,
       Entity $secondEntity,
       RelationTypeEnum $relationType,
       string $relationName = null,
       array $properties = null
   ) : Relation
   {
        $relation = $this->createEmptyRelation($relationType, $relationName, $properties);
        $relation->entities()->attach($firstEntity->id, ['is_main' => true]);
        $relation->entities()->attach($secondEntity->id, ['is_main' => false]);

        return $relation;
   }

    public function update(
        Relation $relation,
        RelationTypeEnum $relationType,
        string $name = null,
        array $properties = null
    ) : Relation
    {
        $relation->relation_type = $relationType->name;
        $relation->name = $name;
        $relation->properties = $properties;
        $relation->save();

        return $relation;
    }

    protected function createEmptyRelation(RelationTypeEnum $relationType, string $name = null, array $properties = null) : Relation
    {
        $relation = new Relation();
        $relation->relation_type = $relationType->name;
        $relation->name = $name;
        $relation->properties = $properties;
        $relation->save();

        return $relation;
    }

    protected function getModel(): BaseModel
    {
        return new Relation();
    }
}
