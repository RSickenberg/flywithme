<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
          'name' => 'admin',
          'email' => 'admin@example.com',
          'password' => 'admin',
        ]);
    }

    private function seedRolesAndPermissions(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $client = Role::create(['name' => 'client']);

        $this->seedPermissionsToAdmin($admin);
    }

    private function seedPermissionsToAdmin(Role $admin): void
    {
        $roles = [
          Permission::create(['name' => 'create flight']),
          Permission::create(['name' => 'edit flight']),
          Permission::create(['name' => 'delete flight']),
        ];

        foreach ($roles as $role) {
            $admin->givePermissionTo($role);
        }
    }

    private function seedPermissionToClient(Role $client): void
    {
        $roles = [
          Permission::create(['name' => 'book flight']),
          Permission::create(['name' => 'un-book flight']),
        ];

        foreach ($roles as $role) {
            $client->givePermissionTo($role);
        }
    }

}
