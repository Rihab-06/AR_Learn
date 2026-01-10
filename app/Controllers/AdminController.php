<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use App\Models\CategorieModel;
use App\Models\TestModel;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
        public function dashboard()
    {
       $session = session();
    
    
    if(!$session->get('isLoggedIn') || $session->get('role') !== 'admin'){
        return redirect()->to('/')->with('error', 'Accès refusé.');
    }
        // Charger le modèle
        $utilisateurModel = new UtilisateurModel();
        
        // Récupérer les statistiques
        // cette ligne sert a compter seulement les utlisateurs est non pas les admins dans le cas ou on veut ajouter plus qu'un admin
        $totalUsers = $utilisateurModel->where('role !=', 'admin')->countAllResults();

        $data = [
            'totalUsers' => $totalUsers ?? 0,
            'totalCategories' => 0,  // À compléter plus tard
            'totalTests' => 0        // À compléter plus tard
        ];
        
        // Afficher la vue HTML du dashboard
        return view('/dash/admin_dash', $data);
    }


    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
    // Les methodes de la gestion des utilisateurs
        //lister les utilisateurs
    public function listUsers(){
        $utilisateur = new UtilisateurModel();
        $data["utilisateur"] = $utilisateur->findAll();
        return view("/admin/manag-users/index", $data);
    }
    public function deleteUser($id){
        $utilisateur = new UtilisateurModel();
        $utilisateur->delete($id);
        return redirect()->to('/admin/users');
    }
    
    /*On va chercher dans la base de données les informations de l'utilisateur avec l'ID demandé
    -On les stocke dans $data["user"]
    -On affiche la vue (le formulaire) avec ces informations pré-remplies
    ici dans l'URL on a GET */

    public function editUser($id){
        $utilisateur = new UtilisateurModel();
        //récupère les données de l'utilisateur
        $data["user"] = $utilisateur->find($id);
        // passer les données à la vue dans la partie {$data}
        return view("/admin/manag-users/user-modification", $data);
    }

    /* Mais maintenant ici dans cette fonction **update** on va faire l'action de la 
    mise a jour dans la db*/

   public function updateUser($id){
    // Validation avec règles adaptées pour la MODIFICATION
    $validation = $this->validate([
        'nom' => 'required|min_length[3]|max_length[50]',
        'prenom' => 'required|min_length[3]|max_length[50]',
        'date_naissance' => 'permit_empty|valid_date',
        'email' => "required|valid_email|is_unique[utilisateurs.email,id_utilisateur,{$id}]",
        'password' => 'permit_empty|min_length[8]',
    ],
    [
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
            'valid_date' => 'La date de naissance n\'est pas valide'
        ],
        'email' => [
            'required' => 'L\'email est obligatoire',
            'valid_email' => 'Veuillez entrer une adresse email valide',
            'is_unique' => 'Cet email est déjà utilisé par un autre utilisateur'
        ],
        'password' => [
            'min_length' => 'Le mot de passe doit contenir au moins 8 caractères'
        ]    
    ]);
    
    // Si validation échoue, retour avec erreurs
    if(!$validation) {
        return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
    }
    
    // Préparer les données de base (toujours modifiées)
    $data = [
        'nom' => $this->request->getPost('nom'),
        'prenom' => $this->request->getPost('prenom'),
        'email' => $this->request->getPost('email')
    ];
    
    // Ajouter date_naissance SEULEMENT si fournie
    $dateNaissance = $this->request->getPost('date_naissance');
    if (!empty($dateNaissance)) {
        $data['date_naissance'] = $dateNaissance;
    }
    
    // Ajouter password SEULEMENT s'il est fourni et hashé
    $password = $this->request->getPost('password');
    if (!empty($password)) {
        $data['password'] = password_hash($password, PASSWORD_BCRYPT);
    }
    
    // Mettre à jour dans la base de données
    $utilisateur = new UtilisateurModel();
    $utilisateur->update($id, $data);
    
    // Redirection avec message de succès
    return redirect()->to('/admin/users')
                     ->with('success', 'Utilisateur modifié avec succès');
}


        //ajouter un utilisateur
    public function addUser(){

    }
    
    

     

}
