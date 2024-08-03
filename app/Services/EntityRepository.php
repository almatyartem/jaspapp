<?php

namespace App\Services;

use App\Models\Entity;
use App\Models\Project;

class EntityRepository
{
    public function createEntity(Project $project, string $name, bool $isDraft = false) : Entity
    {
        $entity = new Entity();
        $entity->project()->associate($project);
        $entity->name = $name;
        $entity->is_draft = $isDraft;
        $entity->save();

        return $entity;
    }

    public function updateEntity(Entity $entity, string $name, bool $isDraft = false) : Entity
    {
        $entity->name = $name;
        $entity->is_draft = $isDraft;
        $entity->save();

        return $entity;
    }

    public function deleteEntity(Entity $entity) : bool
    {
        return $entity->delete();
    }
}
