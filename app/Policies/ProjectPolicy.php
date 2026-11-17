<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role?->canAccessAdmin() ?? false;
    }

    public function view(User $user, Project $project): bool
    {
        if ($user->role === UserRole::Client) {
            return $project->client_user_id === $user->id;
        }

        return $user->role?->canAccessAdmin() ?? false;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, [UserRole::SuperAdmin, UserRole::Admin, UserRole::Manager, UserRole::Demo], true);
    }

    public function update(User $user, Project $project): bool
    {
        return $this->create($user);
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->isAdmin();
    }
}