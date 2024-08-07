<?php

namespace App\Services\Repositories;

use App\Models\Base\BaseModel;
use App\Models\Entity;
use App\Models\Interfaces\TunedModel;
use App\Models\Project;

readonly class EntitiesRepository extends BaseRepository
{
    public function create(Project $project, string $name, bool $isDraft = false) : Entity
    {
        $entity = new Entity();
        $entity->project()->associate($project);
        $entity->name = $name;
        $entity->is_draft = $isDraft;
        $entity->save();

        return $entity;
    }

    public function update(Entity $entity, string $name, bool $isDraft = false) : Entity
    {
        $entity->name = $name;
        $entity->is_draft = $isDraft;
        $entity->save();

        return $entity;
    }

    protected function getModel(): TunedModel
    {
        return new Entity();
    }
}
