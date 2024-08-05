<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::where('username', 'superadmin')->first();

        if (is_null($admin)) {
            $admin           = new Admin();
            $admin->per_id     = "8870941";
            $admin->nombre     = "Juan Pablo";
            $admin->apellidos     = "Valencia Catari";
            $admin->correo    = "superadmin@gmail.com";
            $admin->cargo    = "Técnico de Area / Sistemas informáticos";
            $admin->username = "superadmin";
            $admin->password = Hash::make('juanpa123');
            $admin->save();
        }
    }
}
