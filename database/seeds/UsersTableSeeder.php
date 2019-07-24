<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = array(
            array(
                'name' => 'Admin Nayabazar',
                'email' => 'admin@nayabazar.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ),
            array(
                'name' => 'Vendor One Nayabazar',
                'email' => 'vendorone@nayabazar.com',
                'password' => Hash::make('vendorone123'),
                'role' => 'vendor'
            ),
            array(
                'name' => 'Vendor Two Nayabazar',
                'email' => 'vendortwo@nayabazar.com',
                'password' => Hash::make('vendortwo123'),
                'role' => 'vendor'
            ),
            array(
                'name' => 'Customer Nayabazar',
                'email' => 'customer@nayabazar.com',
                'password' => Hash::make('customer123'),
                'role' => 'customer'
            )
        );
        foreach($array as $user_data){
            $user = new User();
            $user_info = $user->where('email', $user_data['email'])->first();
            if($user_info){
               $user = $user_info;
            }

            $user->fill($user_data);
            $user->save();
        }
    }
}
