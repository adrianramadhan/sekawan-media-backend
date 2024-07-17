<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $adminRole = Role::create(['name' => 'admin']);

        $approverRole = Role::create(['name' => 'Approver']);

        $userAdmin = User::create([
            'name' => 'Adrian Ramadhan',
            'email' => 'adrian@admin.com',
            'password' => bcrypt('password')
        ]);

        $userApprover1 = User::create([
            'name' => 'Adisa Laras',
            'email' => 'adisa@approver.com',
            'password' => bcrypt('password')
        ]);

        $userApprover2 = User::create([
            'name' => 'Adrian Ramadhan',
            'email' => 'adrian@approver.com',
            'password' => bcrypt('password')
        ]);

        $userAdmin->assignRole($adminRole);
        $userApprover1->assignRole($approverRole);
        $userApprover2->assignRole($approverRole);
    }
}
