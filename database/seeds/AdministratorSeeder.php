<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\User;
        $administrator->username = "administrator";
        $administrator->name = "Site Administrator";
        $administrator->email = "administrator@larashop.test";
        $administrator->roles = json_encode(["ADMIN"]);
        $administrator->password = Hash::make("admin");
        $administrator->avatar = "avatar.png";
        $administrator->email_verified_at = now();
        $administrator->phone = "085156148431";
        $administrator->address = "Cikarang utara , Cikarang ,Bekasi";
        $administrator->save();
        $this->command->info("Succesfuly added administrator account");
    }
}
