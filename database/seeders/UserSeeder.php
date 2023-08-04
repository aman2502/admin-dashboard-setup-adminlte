<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Create Roles
         */

        foreach (config('project.user.roles') as $role) {
            Role::firstOrCreate([
                'guard_name' => 'web',
                'name' => $role
            ]);
        };

        $users = [
            [
                'uid' => getUID(),
                'role' => 'teacher',
                'name' => 'Teacher',
                'email' => 'teacher@gmail.com',
                'password' => 'password',
            ],
            [
        'uid' => getUID(),
                'role' => 'student',
                'name' => 'Student',
                'email' => 'student@gmail.com',
                'password' => 'password',
            ],
        ];

        foreach ($users as $user) {
            $exist = User::where('email', $user['email'])->first();
            if(empty($exist)){
                $role_user = User::firstOrCreate([
                    'uid'=> $user['uid'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => bcrypt($user['password']),
                ]);
                $role_user->assignRole($user['role']);
            }
        }
    }
}
