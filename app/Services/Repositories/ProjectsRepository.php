<?php

namespace App\Services\Repositories;

use App\Models\Base\BaseModel;
use App\Models\Interfaces\TunedModel;
use App\Models\Project;
use App\Models\User;

readonly class ProjectsRepository extends BaseRepository
{
    public function create(User $user, string $name) : Project
    {
        $project = new Project();
        $project->user()->associate($user);
        $project->name = $name;
        $project->save();

        return $project;
    }

    public function update(Project $project, string $name) : Project
    {
        $project->name = $name;
        $project->save();

        return $project;
    }

    protected function getModel(): TunedModel
    {
        return new Project();
    }
}
