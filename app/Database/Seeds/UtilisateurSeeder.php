<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UtilisateurSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nom' => 'Admin',
                'prenom' => 'Système',
                'date_naissance' => '1990-01-01',
                'email' => 'admin@arlearn.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin',
                'avatar' => 'avatars/admin.png',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'Alami',
                'prenom' => 'Fatima',
                'date_naissance' => '2000-05-15',
                'email' => 'fatima@example.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'utilisateur',
                'avatar' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'Benali',
                'prenom' => 'Mohammed',
                'date_naissance' => '1998-08-20',
                'email' => 'mohammed@example.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'utilisateur',
                'avatar' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nom' => 'El Idrissi',
                'prenom' => 'Amina',
                'date_naissance' => '2001-03-10',
                'email' => 'amina@example.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'utilisateur',
                'avatar' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        
        $this->db->table('utilisateurs')->insertBatch($data);
    }
}