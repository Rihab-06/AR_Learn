<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategorieModel;
use App\Models\ThemeModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
{
    // On récupère l'objet session pour accéder aux données de l'utilisateur connecté
    $session = session();
    
    // Si pas connecté, rediriger vers login
    if(!$session->get('isLoggedIn')){
        return redirect()->to('/');
    }

    // Récupérer les catégories principales (celles qui n'ont pas de parent)
    $categorieModel = new CategorieModel();
    $categories = $categorieModel->where('parent_id', NULL)->where('is_active', 1)->findAll();
    // Résultat : Un tableau avec TOUTES les catégories parents + leurs IDs
    
    
    // Préparer les données à envoyer à la vue
    $data = [
        // Infos de l'utilisateur connecté
        'nom' => $session->get('nom'),
        'prenom' => $session->get('prenom'),
        'email' => $session->get('email'),
        
        // Tableau avec toutes les infos user
        'user' => [
            'nom' => $session->get('nom'),
            'prenom' => $session->get('prenom'),
            'email' => $session->get('email'),
            'role' => $session->get('role') ?? 'utilisateur'
        ],
        
        // Les catégories principales
        'categories' => $categories,
        
        
        // Titre de la page
        'title' => 'Tableau de bord'
    ];
    
    // Afficher la vue avec les données
    return view('/dash/dashboard', $data);
}
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
