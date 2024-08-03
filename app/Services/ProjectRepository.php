<?php

namespace App\Services;

use App\Models\Project;
use App\Models\User;

class ProjectRepository
{
    public function createProject(User $user, string $name) : Project
    {
        $project = new Project();
        $project->user()->associate($user);
        $project->name = $name;
        $project->save();

        return $project;
    }

    public function updateProject(Project $project, string $name) : Project
    {
        $project->name = $name;
        $project->save();

        return $project;
    }

    public function deleteProject(Project $project) : bool
    {
        return $project->delete();
    }
}
