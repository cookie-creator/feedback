<?php
namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'manager';
        $user->email = 'manager@gmail.com';
        $user->password = Hash::make('manager');
        $user->save();

        $manager = new Role();
        $manager->name = 'manager';
        $manager->label = 'manager';
        $manager->save();

        $user->assignRole($manager);

        $viewFeedback = new Permission();
        $viewFeedback->name = 'view_feedbacks';
        $viewFeedback->label = 'view_feedbacks';
        $viewFeedback->save();

        $manager->allowTo($viewFeedback);
    }
}
