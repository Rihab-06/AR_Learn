<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use App\Models\CategorieModel;
use App\Models\TestModel;

use App\Controllers\BaseController;
use App\Models\QuizModel;
use App\Models\ThemeModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    // Dashboard admin mais avec l'authentification et les statistiques
        public function dashboard() 
    {
        // Récupère la session en cours
        $session = session();
        // VÉRIFICATION DE SÉCURITÉ : 
        // 1. Vérifie si l'utilisateur est connecté
        // 2. Vérifie si l'utilisateur a le rôle 'admin'
        // Si une des conditions n'est pas remplie, redirige vers la page d'accueil
        if(!$session->get('isLoggedIn') || $session->get('role') !== 'admin'){
        return redirect()->to('/')->with('error', 'Accès refusé.');}   
        // CHARGEMENT DES MODÈLES :
        // - UtilisateurModel pour gérer les utilisateurs
        // - CategorieModel pour gérer les catégories
        $utilisateurModel = new UtilisateurModel();
        $categorieModel = new CategorieModel();
        // Récupérer les statistiques
        // cette ligne sert a compter seulement les utlisateurs est non pas les admins dans le cas ou on veut ajouter plus qu'un admin
        $totalUsers = $utilisateurModel->where('role !=', 'admin')->countAllResults();
        $totalAdmins = $utilisateurModel->where('role ', 'admin')->countAllResults();
        $totalCategories = $categorieModel->where('parent_id', null)->countAllResults();
        // PRÉPARATION DES DONNÉES POUR LA VUE
        // On organise toutes les statistiques dans un tableau
        $data = [
            'totalUsers' => $totalUsers ?? 0,
            'totalCategories' => $totalCategories ?? 0,
            'totalAdmins' => $totalAdmins ?? 0        // À compléter plus tard
        ];
        
        // Afficher la vue HTML du dashboard
        return view('/dash/admin_dash', $data);
    }


    public function logout()
    {
        $session = session();
        // DÉCONNEXION :
        // 1. Détruit toutes les données de session
        // 2. Efface l'information "utilisateur connecté"
        $session->destroy();
        return redirect()->to('/');
    }

    /*===================================
    ===== GESTION DES UTILISATEURS ======
    =====================================*/
    //lister les utilisateurs
    public function listUsers(){
        //Obtenir un OUTIL pour parler à la table 'utilisateurs' de la base de données
        //hna le model li ghadi ykhdem m3a les utilisateurs
        $utilisateur = new UtilisateurModel();
        //yrji3 lia les utilisateurs kolhom
        $data["utilisateur"] = $utilisateur->findAll();
        //hna le fihcier view li ghadi yaffichi les utilisateurs
        return view("/admin/manag-users/index", $data);
    }
        //supprimer un utilisateur
    public function deleteUser($id){
        $utilisateur = new UtilisateurModel();
        $utilisateur->delete($id);
        //hna khdmna b URL redirection ba3d ma tms7 l'utilisateur machi lview
        return redirect()->to('/admin/users');
    }
        //editer un utilisateur
    /*On va chercher dans la base de données les informations de l'utilisateur avec l'ID demandé
    -On les stocke dans $data["user"]
    -On affiche la vue (le formulaire) avec ces informations pré-remplies
    ici dans l'URL on a GET */

    /*Lfr9 ben edit w update hiya edit hiya li taffichi 
    les données f formulaire w update hiya li t3ml update f db*/
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
    /*darori la validation bash t9dr t3rf wach les données li jayin mn lformulaire
    sahihin wla la*/
    $validation = $this->validate([
        'nom' => 'required|min_length[3]|max_length[50]',
        'prenom' => 'required|min_length[3]|max_length[50]',
        'date_naissance' => 'permit_empty|valid_date',
        'email' => "required|valid_email|is_unique[utilisateurs.email,id_utilisateur,{$id}]",
        'password' => 'permit_empty|min_length[8]',
    ],
    // Messages personnalisés pour chaque champ
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
    //ila kan chi mouchkil f validation nrj3o lformulaire m3a les erreurs
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
    //hna kancheckiw wach date_naissance jaya wla la sinon knkhdmo bl9dima li already kayna f db
    $dateNaissance = $this->request->getPost('date_naissance');
    if (!empty($dateNaissance)) {
        $data['date_naissance'] = $dateNaissance;
    }
    //same hna
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
        //hna bghina ghir les categories principales li ma3ndhomch parent_id machi sous cateories
        $data["categories"] = $categories->where('parent_id', null)->findAll();
        return view("/admin/manag-categories/index", $data);
    }
        // supprimer une categorie
    public function deleteCategories($id){
        $categories = new CategorieModel();
        $categories->delete($id);
        return redirect()->to('/admin/categories');
    }
    // 
     public function addCategories(){
    //     $categories = new CategorieModel();
    //     $data["categories"] = $categories->where('parent_id', null)->findAll();
        return view("/admin/manag-categories/categories-creation");
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
        //trim() kat7iyd les espaces f bidaya wla flkhr hadik li kna 9rina 
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
    //$this fait référence à l'instance actuelle de la classe dans un contexte orienté objet PHP
    $data = [
    //smiya dial le champ f db =$this->request->getPost('smiya dial input flformulaire aka li derna flview')
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
    // voir les informations d'une categorie
    public function viewCategories($id){
        $categories = new CategorieModel();
        // $data["categories"] = $categories->findAll();
        //Récupérer l'id de la catégorie parente 
        $data["parentCategory"] = $categories->find($id);
        //Lister toutes les sous-catégories de cette catégorie
        $data["categories"] = $categories->where('parent_id', $id)->findAll();
        
        return view("/admin/manag-categories/categories-information", $data);
    }

    public function addSousCategories($id){
        // Créer une instance du modèle Catégorie
        $categories = new CategorieModel();
        
        // Récupérer les informations de la catégorie parente
        // On en a besoin pour afficher "Sous-catégorie de : [Nom de la catégorie]"
        $data["parentCategory"] = $categories->find($id);
        
        // Récupérer toutes les catégories principales
        // Au cas où l'utilisateur voudrait changer de catégorie parente dans le formulaire
        $data["categories"] = $categories->where('parent_id', null)->findAll();
        
        // Afficher le formulaire de création de sous-catégorie
        return view("/admin/manag-categories/sous-categories-creation", $data);
    }

/**
     * Enregistre une nouvelle sous-catégorie dans la base de données
     * Cette méthode crée une sous-catégorie rattachée à une catégorie parente
     */
    public function storeSousCategories()
    {
        // ÉTAPE 1 : VALIDATION
        $validation = $this->validate([
            'nom' => 'required|min_length[3]|max_length[50]'
        ], [
            'nom' => [
                'required' => 'Le nom est obligatoire',
                'min_length' => 'Le nom doit contenir au moins 3 caractères',
                'max_length' => 'Le nom ne peut pas dépasser 50 caractères'
            ]
        ]);
        
        // ÉTAPE 2 : SI VALIDATION ÉCHOUE
        if (!$validation) {
            return redirect()->back()
                        ->withInput()
                        ->with('errors', $this->validator->getErrors());
        }
        
        // ÉTAPE 3 : RÉCUPÉRER L'ID DE LA CATÉGORIE PARENTE
        // C'est l'ID de la catégorie à laquelle on rattache cette sous-catégorie
        $parentId = $this->request->getPost('parent_id');
        
        // ÉTAPE 4 : PRÉPARER LES DONNÉES
        $data = [
            'nom' => trim($this->request->getPost('nom')),
            'explication' => trim($this->request->getPost('explication')),
            // parent_id est défini ici, ce qui fait de cette catégorie une SOUS-CATÉGORIE
            // !empty($parentId) vérifie si $parentId n'est pas vide
            // ? $parentId : null = si vide, mettre NULL, sinon mettre la valeur de $parentId
            'parent_id' => !empty($parentId) ? $parentId : null,
        ];
        
        // ÉTAPE 5 : SAUVEGARDE
        $categorieModel = new CategorieModel();
        
        if ($categorieModel->save($data)) {
            // Si la sauvegarde réussit, rediriger vers la page de détails de la catégorie parente
            // On utilise $data['parent_id'] pour rediriger vers la bonne catégorie
            return redirect()->to('/admin/categories/view/' . $data['parent_id'])
                             ->with('success', 'Sous-catégorie créée avec succès.');
        } 
        else {
            // Si la sauvegarde échoue, retourner au formulaire avec erreur
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Erreur lors de la création de la sous-catégorie.');
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
        // Récupère la catégorie à modifier
        $data["category"] = $category->find($id);
        // Récupère TOUTES les catégories principales (pour changer de parent si besoin dnas le formulaire)
        //hna bach ybano parent category f formulaire dyal modification
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
    /* mn mora modification ila bdlna partie dial parent_id awla la categorie mere kaydini lhad lkhra
    o y afficher lia dkchi li bdlt aka ghadi l9aha fla nouvelle categorie mere  */
     return redirect()->to('/admin/categories/view/'.$parent_id)->with('success', 'Catégorie modifiée avec succès');
     }
    // Les methodes de la gestion des parametres de l'admin
    public function manageSettings(){
        $utilisateur = new UtilisateurModel();
        // rj3li ghir les admins
        $data["utilisateur"] = $utilisateur->where('role', 'admin')->findAll();
        return view("/admin/manag-settings/index", $data);
    }

    public function addAdmin(){
        return view("/admin/manag-settings/admin-creation");
    }
    
    /*hna ra nfss code dial validation li f register ghi hna ghadi nkhlli 
    hadak le champ role fl view readonly o hna ghadi yt3ta nichan*/
    public function storeAdmin(){
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
        
        $data = [    
            //dataBase fields = .....->getPost('form field name(aka input name )')
            'nom' => $this->request->getPost('nom'),
            'prenom' => $this->request->getPost('prenom'),
            'date_naissance' => $this->request->getPost('date_naissance'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            // hna kayt3ta lrole dial admin b directement
            'role' => 'admin'
            
        ];
        $admin = new UtilisateurModel();
        $admin->save($data);

        return redirect()->to('/admin/settings')->with('success', 'Nouvel administrateur ajouté avec succès');
        }

        public function editAdmin($id){
        $admin = new UtilisateurModel();
        //récupère les données de l'utilisateur
        $data["admin"] = $admin->find($id);
        // passer les données à la vue dans la partie {$data}
        return view("/admin/manag-settings/admin-modification", $data);
    }
    
    /* Mais maintenant ici dans cette fonction **update** on va faire l'action de la 
    mise a jour dans la db*/
   public function updateAdmin($id){
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
    $admin = new UtilisateurModel();
    $admin->update($id, $data);
    
    // Redirection avec message de succès
    return redirect()->to('/admin/settings')
                     ->with('success', 'Administrateur modifié avec succès');
}

public function deleteAdmin($id){
        $admin = new UtilisateurModel();
        $admin->delete($id);
        return redirect()->to('/admin/settings');
    }

    public function viewThemes($id_sous_cat){
        $categories = new CategorieModel();
        $themeModel = new ThemeModel();
        // $data["categories"] = $categories->findAll();
        //Récupérer l'id de la catégorie parente 
        $data["category"] = $categories->find($id_sous_cat);
        //Lister toutes les sous-catégories de cette catégorie
        $data["themes"] = $themeModel->where('id_categorie', $id_sous_cat)->findAll();
        
        return view("/admin/manag-themes/index", $data);
    }
    public function deleteThemes($id){
        $theme = new ThemeModel();
        $theme->delete($id);
        return redirect()->back();
    }
    public function viewQuizzes($id_theme){
        $themeModel = new ThemeModel();
        $quizModel = new QuizModel();

        $data["themes"] = $themeModel->find($id_theme);
        $data["quizzes"] = $quizModel->where('theme_id', $id_theme)->findAll();
        return view('admin/manag-quizzes/index', $data);
    }
    public function deleteQuizzes($id){
        $quiz = new QuizModel();
        $quiz->delete($id);
        return redirect()->back();
    }

}
        

    

    