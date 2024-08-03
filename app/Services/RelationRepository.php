<?php

namespace App\Services;

use App\Models\Entity;
use App\Models\Relation;
use RelationTypeEnum;

class RelationRepository
{

   public function createRelation(
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

    public function updateRelation(
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

    public function deleteRelation(Relation $relation) : bool
    {
        return $relation->delete();
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
}
