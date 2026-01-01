<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UtilisateurModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function processRegister()
    {
        $validation = $this->validate([
            'nom' => 'required|min_length[3]|max_length[50]',
            'prenom' => 'required|min_length[3]|max_length[50]',
            'date_naissance' => 'valid_date',
            'email' => 'required|valid_email|is_unique[utilisateurs.email]',
            'password' => 'required|min_length[8]',
            'confirm_password' => 'matches[password]'
        ],
        [
         // Messages personnalisés pour chaque champ
        'nom' => [
            'required' => 'Le nom est obligatoire',
            'min_length' => 'Le nom doit contenir au moins 3 caractères',
            'max_length' => 'Le nom ne peut pas dépasser 50 caractères'
        ],
        'prenom' => [
            'required' => 'Le prénom est obligatoire',
            'min_length' => 'Le prénom doit contenir au moins 3 caractères',
            'max_length' => 'Le prénom ne peut pas dépasser 50 caractères'
        ],
        'date_naissance' => [
            'required' => 'La date de naissance est obligatoire',
            'valid_date' => 'La date de naissance n\'est pas valide'
        ],
        'email' => [
            'required' => 'L\'email est obligatoire',
            'valid_email' => 'Veuillez entrer une adresse email valide',
            'is_unique' => 'Cet email est déjà utilisé. Veuillez en choisir un autre.'
        ],
        'password' => [
            'required' => 'Le mot de passe est obligatoire',
            'min_length' => 'Le mot de passe doit contenir au moins 8 caractères'
        ],
        'confirm_password' => [
            'required' => 'La confirmation du mot de passe est obligatoire',
            'matches' => 'Les mots de passe ne correspondent pas'
        ]
        ]);
        
        if(!$validation) {
            return redirect()->back()
                        ->withInput()
                        ->with('errors', $this->validator->getErrors());
        } 
        echo "Validation passed";
        $data = [    
            //dataBase fields = .....->getPost('form field name(aka input name )')
            'nom' => $this->request->getPost('nom'),
            'prenom' => $this->request->getPost('prenom'),
            'date_naissance' => $this->request->getPost('date_naissance'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT)
            
        ];


        $userModel = new UtilisateurModel();
        $userModel->save($data);

        return redirect()->route('/')->with('statuts', "Vous êtes inscrit avec succès. Veuillez vous connecter.");
    }

 public function processLogin()
{
    $validation = $this->validate([
        'email' => 'required|valid_email',
        'password' => 'required'
    ]);
    
    if (!$validation) {
        return view('auth/login', ['validation' => $this->validator]);
    }
    
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');
    
    $userModel = new UtilisateurModel();
    $user = $userModel->where('email', $email)->first();
    
    if (!$user) {
        return redirect()->back()->with('error', 'Email ou mot de passe incorrect.');
    }
    
    if (!password_verify($password, $user['password'])) {
        return redirect()->back()->with('error', 'Email ou mot de passe incorrect.');
    }

    // Créer la session utilisateur
    $session = session();
    $sessionData = [
        'user_id' => $user['id_utilisateur'],
        'nom' => $user['nom'],
        'prenom' => $user['prenom'],
        'email' => $user['email'],
        'role' => $user['role'] ?? 'user',
        'isLoggedIn' => true
    ];
    $session->set($sessionData);

    if (isset($user['role']) && $user['role'] === 'admin') {
        return redirect()->to('/admin_dash')->with('success', 'Connexion réussie. Bienvenue Admin ' . $user['prenom'] . ' !');
    }
    
    return redirect()->to('/dashboard')->with('success', 'Connexion réussie. Bienvenue ' . $user['prenom'] . ' !');
}


    
    public function log()
    {
        return view('auth/login');
    }
    public function index()
    {
        return view('auth/login');
    }
    public function register()
    {
        return view('auth/register');
    }
}
