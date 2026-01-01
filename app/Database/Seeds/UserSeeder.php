<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
                'nom'       => 'Admin',
                'prenom'    => 'Super',
                'date_naissance' => '1990-01-01',
                'email'     => 'admin@gmail.com',
                'password'  => password_hash('admin123', PASSWORD_BCRYPT),
                'role'      => 'admin',
        ];
        $this->db->table('utilisateurs')->insert($data);
    }
}
