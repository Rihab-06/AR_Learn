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
        $categorieModel = new CategorieModel();
        // Récupérer les statistiques
        // cette ligne sert a compter seulement les utlisateurs est non pas les admins dans le cas ou on veut ajouter plus qu'un admin
        $totalUsers = $utilisateurModel->where('role !=', 'admin')->countAllResults();
        $totalCategories = $categorieModel->where('parent_id', null)->countAllResults();
        

        $data = [
            'totalUsers' => $totalUsers ?? 0,
            'totalCategories' => $totalCategories ?? 0,
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
        //supprimer un utilisateur
    public function deleteUser($id){
        $utilisateur = new UtilisateurModel();
        $utilisateur->delete($id);
        return redirect()->to('/admin/users');
    }
        //editer un utilisateur
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


        // liste de categories
    public function listCategories(){
    $categories = new CategorieModel();
        // $data["categories"] = $categories->findAll();
        $data["categories"] = $categories->where('parent_id', null)->findAll();
        return view("/admin/manag-categories/index", $data);
    }
        // supprimer une categorie
    public function deleteCategories($id){
        $categories = new CategorieModel();
        $categories->delete($id);
        return redirect()->to('/admin/categories');
    }

    public function addCategories(){
        $categories = new CategorieModel();
        $data["categories"] = $categories->where('parent_id', null)->findAll();
        return view("/admin/manag-categories/categories-creation", $data);
    }

    public function storeCategories()
{
    // Validation
    $validation = $this->validate([
        'nom' => 'required|min_length[3]|max_length[50]'
    ], [
        'nom' => [
            'required' => 'Le nom est obligatoire',
            'min_length' => 'Le nom doit contenir au moins 3 caractères',
            'max_length' => 'Le nom ne peut pas dépasser 50 caractères'
        ]
    ]);
    
    if (!$validation) {
        return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
    }
    
    
    $data = [
        'nom' => trim($this->request->getPost('nom')),
        'explication' => trim($this->request->getPost('explication')),
    ];
    
    // Sauvegarde
    $categorieModel = new CategorieModel();
    
    if ($categorieModel->save($data)) {
        return redirect()->to('/admin/categories')->with('success', 'Catégorie créée avec succès.');
    } 

    else {
        return redirect()->back()->withInput()->with('error', 'Erreur lors de la création de la catégorie.');
    }
}
         // editer une categorie 
    
    public function editCategories($id){
        $category = new CategorieModel();
        $data["category"] = $category->find($id);
        return view("/admin/manag-categories/categories-modification", $data);
    }
        // mettre a jour une categorie
    public function updateCategories($id){
        // Validation avec règles adaptées pour la MODIFICATION
    $validation = $this->validate([
        'nom' => 'required|min_length[3]|max_length[50]',
    ],
    [
        'nom' => [
            'required' => 'Le nom est obligatoire',
            'min_length' => 'Le nom doit contenir au moins 3 caractères',
            'max_length' => 'Le nom ne peut pas dépasser 50 caractères'
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
        'explication' => $this->request->getPost('explication')
    ];
     // Mettre à jour dans la base de données
    $category = new CategorieModel();
    $category->update($id, $data);
    
    // Redirection avec message de succès
    return redirect()->to('/admin/categories')
                     ->with('success', 'Catégorie modifiée avec succès');
    }
    
    public function viewCategories($id){
        $categories = new CategorieModel();
        // $data["categories"] = $categories->findAll();
        $data["parentCategory"] = $categories->find($id);
        $data["categories"] = $categories->where('parent_id', $id)->findAll();
        
        return view("/admin/manag-categories/categories-information", $data);
    }

    public function addSousCategories($id){
        $categories = new CategorieModel();
        $data["parentCategory"] = $categories->find($id);
        $data["categories"] = $categories->where('parent_id', null)->findAll();
        
        return view("/admin/manag-categories/sous-categories-creation", $data);
    }

    public function storeSousCategories()
{
    // Validation
    $validation = $this->validate([
        'nom' => 'required|min_length[3]|max_length[50]'
    ], [
        'nom' => [
            'required' => 'Le nom est obligatoire',
            'min_length' => 'Le nom doit contenir au moins 3 caractères',
            'max_length' => 'Le nom ne peut pas dépasser 50 caractères'
        ]
    ]);
    
    if (!$validation) {
        return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
    }
    
    // Préparation des données
    $parentId = $this->request->getPost('parent_id');
    
    $data = [
        'nom' => trim($this->request->getPost('nom')),
        'explication' => trim($this->request->getPost('explication')),
        'parent_id' => !empty($parentId) ? $parentId : null,
    ];
    
    // Sauvegarde
    $categorieModel = new CategorieModel();
    
    if ($categorieModel->save($data)) {
        return redirect()->to('/admin/categories/view/' . $data['parent_id'])->with('success', 'Catégorie créée avec succès.');
    } 
    else {
        return redirect()->back()->withInput()->with('error', 'Erreur lors de la création de la catégorie.');
    }
}
        public function deleteSousCategories($id){
        $categories = new CategorieModel();
        $categories->delete($id);
        return redirect()->back();
    }

        // editer une categorie 
    
    public function editSousCategories($id){
        $category = new CategorieModel();
        
        $data["category"] = $category->find($id);
        $data["categories"] = $category->where('parent_id', null)->findAll();
        return view("/admin/manag-categories/sous-categories-modification", $data);
    }
        // mettre a jour une categorie
    public function updateSousCategories($id){
        // Validation avec règles adaptées pour la MODIFICATION
        $validation = $this->validate([
            'nom' => 'required|min_length[3]|max_length[50]',
            ],
    [
        'nom' => [
            'required' => 'Le nom est obligatoire',
            'min_length' => 'Le nom doit contenir au moins 3 caractères',
            'max_length' => 'Le nom ne peut pas dépasser 50 caractères'
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
        'explication' => $this->request->getPost('explication')
    ];
    $parent_id = $this->request->getPost('parent_id');
     // Ajouter parent_id SEULEMENT si fournie
     if (!empty($parent_id)) {
         $data['parent_id'] = $parent_id;
         }
         // Mettre à jour dans la base de données
         $category = new CategorieModel();
         $category->update($id, $data);
         $data["parentCategory"] = $category->find($id);
    
    
    // Redirection avec message de succès
     return redirect()->to('/admin/categories/view/'.$parent_id)->with('success', 'Catégorie modifiée avec succès');
     }
}
        

    

    