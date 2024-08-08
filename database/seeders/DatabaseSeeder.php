<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Services\AuthService;
use App\Utils\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Tests\Feature\ScenarioTest;

class DatabaseSeeder extends Seeder
{
    public function __construct(
        protected readonly AuthService $authService
    ){}

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::query()->firstOrCreate(['name' => User::ROLE_ADMIN]);
        $user = $this->authService->register(
            'Admin Artemio',
            ScenarioTest::ADMIN_EMAIL,
            ScenarioTest::ADMIN_PSWD
        );
        $user->markEmailAsVerified();
        $user->assignRole(User::ROLE_ADMIN);
    }
}
